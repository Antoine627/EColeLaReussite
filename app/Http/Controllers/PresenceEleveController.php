<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\PresenceEleve;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class PresenceEleveController extends Controller
{
    /**
     * Affiche la liste des présences du jour.
     */
    public function index()
    {
        $classes = Classe::all();
        $eleves = Eleve::with('classe')->get();
        
        return view('presences.index', compact('classes', 'eleves'));
    }

    /**
     * Filtre les élèves par date et classe.
     */
    public function filter(Request $request)
    {
        $query = Eleve::with(['classe', 'presences' => function ($query) use ($request) {
            $query->whereDate('date', $request->date);
        }]);

        if ($request->classe_id) {
            $query->where('classe_id', $request->classe_id);
        }

        $eleves = $query->get()->map(function ($eleve) {
            $presence = $eleve->presences->first();
            return [
                'id' => $eleve->id,
                'nom' => $eleve->nom,
                'prenom' => $eleve->prenom,
                'classe' => $eleve->classe->nom,
                'status' => $presence ? $presence->status : null,
                'heure_arrivee' => $presence ? $presence->heure_arrivee : null,
                'commentaire' => $presence ? $presence->commentaire : null,
            ];
        });

        return response()->json($eleves);
    }

    /**
     * Enregistre une nouvelle présence.
     */
    public function store(Request $request)
    {
        $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,retard',
            'heure_arrivee' => 'nullable|date_format:H:i',
            'commentaire' => 'nullable|string|max:255',
        ]);

        // Vérifie si une présence existe déjà pour cet élève à cette date
        $presence = PresenceEleve::updateOrCreate(
            [
                'eleve_id' => $request->eleve_id,
                'date' => $request->date,
            ],
            [
                'status' => $request->status,
                'heure_arrivee' => $request->heure_arrivee,
                'commentaire' => $request->commentaire,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Présence enregistrée avec succès',
            'presence' => $presence
        ]);
    }

    /**
     * Affiche le rapport des présences.
     */
    public function rapport(Request $request)
{
    $classes = Classe::all();
    $mois = $request->get('mois', Carbon::now()->format('Y-m'));
    $classe_id = $request->get('classe_id');

    $query = DB::table('presences')
        ->join('eleves', 'presences.eleve_id', '=', 'eleves.id')
        ->join('classes', 'eleves.classe_id', '=', 'classes.id')
        ->whereYear('presences.date', substr($mois, 0, 4))
        ->whereMonth('presences.date', substr($mois, 5, 2));

    if ($classe_id) {
        $query->where('classes.id', $classe_id);
    }

    $rapports = $query
        ->select(
            'eleves.id as eleve_id',
            'eleves.nom',
            'eleves.prenom',
            'classes.nom as classe_nom',
            DB::raw('COUNT(CASE WHEN status = "present" THEN 1 END) as jours_present'),
            DB::raw('COUNT(CASE WHEN status = "retard" THEN 1 END) as retards'),
            DB::raw('COUNT(CASE WHEN status = "absent" THEN 1 END) as absences'),
            DB::raw('ROUND(COUNT(CASE WHEN status IN ("present", "retard") THEN 1 END) * 100.0 / COUNT(*), 2) as taux_presence')
        )
        ->groupBy('eleves.id', 'eleves.nom', 'eleves.prenom', 'classes.nom')
        ->get();

    if ($request->get('format') === 'pdf') {
        try {
            $pdf = PDF::loadView('presences.rapport-pdf', compact('rapports', 'mois'));
            return $pdf->download('rapport-presences-' . $mois . '.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la génération du PDF : ' . $e->getMessage()], 500);
        }
    }

    return view('presences.rapport', compact('rapports', 'classes', 'mois'));
}

    /**
     * Marque tous les élèves d'une classe comme présents.
     */
    public function marquerTousPresents(Request $request)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'date' => 'required|date',
        ]);

        $eleves = Eleve::where('classe_id', $request->classe_id)->get();

        foreach ($eleves as $eleve) {
            PresenceEleve::updateOrCreate(
                [
                    'eleve_id' => $eleve->id,
                    'date' => $request->date,
                ],
                [
                    'status' => 'present',
                    'heure_arrivee' => '08:00:00', // Heure par défaut
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Tous les élèves ont été marqués présents'
        ]);
    }

    /**
     * Récupère les statistiques de présence d'un élève.
     */
    public function statistiquesEleve($eleve_id, Request $request)
    {
        $debut = $request->get('debut', Carbon::now()->startOfMonth());
        $fin = $request->get('fin', Carbon::now()->endOfMonth());

        $statistiques = DB::table('presences')
            ->where('eleve_id', $eleve_id)
            ->whereBetween('date', [$debut, $fin])
            ->select(
                DB::raw('COUNT(CASE WHEN status = "present" THEN 1 END) as presents'),
                DB::raw('COUNT(CASE WHEN status = "retard" THEN 1 END) as retards'),
                DB::raw('COUNT(CASE WHEN status = "absent" THEN 1 END) as absences'),
                DB::raw('ROUND(COUNT(CASE WHEN status IN ("present", "retard") THEN 1 END) * 100.0 / COUNT(*), 2) as taux_presence')
            )
            ->first();

        // Récupérer l'historique des présences
        $historique = PresenceEleve::where('eleve_id', $eleve_id)
            ->whereBetween('date', [$debut, $fin])
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'statistiques' => $statistiques,
            'historique' => $historique
        ]);
    }

    /**
     * Exporte les présences en PDF.
     */
    public function exportPDF(Request $request)
    {
        $date = $request->get('date', Carbon::now()->format('Y-m-d'));
        $classe_id = $request->get('classe_id');

        $query = PresenceEleve::with(['eleve.classe'])
            ->whereDate('date', $date);

        if ($classe_id) {
            $query->whereHas('eleve', function ($q) use ($classe_id) {
                $q->where('classe_id', $classe_id);
            });
        }

        $presences = $query->get();

        $pdf = PDF::loadView('presences.export-pdf', [
            'presences' => $presences,
            'date' => $date
        ]);

        return $pdf->download('presences-' . $date . '.pdf');
    }
}