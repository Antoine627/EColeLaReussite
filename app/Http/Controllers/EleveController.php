<?php
namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EleveController extends Controller
{
    // Afficher la liste des élèves
    public function index(Request $request)
    {
        $query = Eleve::query();
    
        // Recherche par nom ou prénom
        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('nom', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('prenom', 'LIKE', "%{$searchTerm}%");
            });
        }
    
        // Pagination avec 9 enregistrements par page, trié par created_at décroissant
        $eleves = $query->orderBy('created_at', 'desc')->paginate(9);
    
        // Comptage total des filles et des garçons
        $totalFilles = Eleve::where('sexe', 'F')->count();
        $totalGarcons = Eleve::where('sexe', 'M')->count();
    
        // Retourne la vue avec les données
        return view('eleves.index', compact('eleves', 'totalFilles', 'totalGarcons'));
    }


    // Formulaire d'ajout d'un élève
    public function create()
    {
        return view('eleves.create');
    }

    // Ajouter un nouvel élève
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:M,F',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:15',
            'date_inscription' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Générer le numéro de matricule
        $numero_matricule = 'ELV-' . strtoupper(Str::random(6));

        // Gérer l'upload de la photo ou définir un avatar par défaut
        $photoPath = $request->hasFile('photo') 
            ? $request->file('photo')->store('photos', 'public') 
            : 'images/avatar.webp';

        // Créer un nouvel élève
        Eleve::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'date_inscription' => $request->date_inscription,
            'numero_matricule' => $numero_matricule,
            'photo' => $photoPath,
        ]);

        return redirect()->route('eleves.index')->with('success', 'Élève ajouté avec succès.');
    }

    public function show($id)
    {
        $eleve = Eleve::findOrFail($id);
        return view('eleves.show', compact('eleve'));
    }

    // Éditer un élève existant
    public function edit(Eleve $eleve)
    {
        return view('eleves.edit', compact('eleve'));
    }

    
    public function update(Request $request, Eleve $eleve)
    {
        // Valider les données reçues
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:M,F',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Mettre à jour les informations de l'élève
        $eleve->nom = $request->input('nom');
        $eleve->prenom = $request->input('prenom');
        $eleve->date_naissance = $request->input('date_naissance');
        $eleve->sexe = $request->input('sexe');
        $eleve->adresse = $request->input('adresse');
        $eleve->telephone = $request->input('telephone');
    
        // Gérer le téléchargement de la photo
        if ($request->hasFile('photo')) {
            if ($eleve->photo && $eleve->photo !== 'images/avatar.webp') {
                Storage::disk('public')->delete($eleve->photo);
            }
            
            $path = $request->file('photo')->store('photos', 'public');
            $eleve->photo = $path;
        }
    
        // Enregistrer les modifications
        $eleve->save();
    
        return redirect()->route('eleves.index')->with('success', 'Élève modifié avec succès.');
    }

    // Supprimer un élève
    public function destroy(Eleve $eleve)
    {
        // Supprimer la photo si elle existe et n'est pas l'avatar par défaut
        if ($eleve->photo && $eleve->photo !== 'images/avatar.webp') {
            Storage::disk('public')->delete($eleve->photo);
        }
        
        $eleve->delete();
        return redirect()->route('eleves.index')->with('success', 'Élève supprimé avec succès.');
    }
}
