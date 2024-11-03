<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Resultat;
use Illuminate\Http\Request;

class ResultatController extends Controller
{
    public function index(Request $request)
    {
        $query = Resultat::with('eleve');

        // Filtres
        if ($request->has('classe') && $request->classe) {
            $query->where('classe', $request->classe);
        }
        if ($request->has('matiere') && $request->matiere) {
            $query->where('matiere', $request->matiere);
        }
        if ($request->has('periode') && $request->periode) {
            $query->where('periode', $request->periode);
        }

        $resultats = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('resultats.index', compact('resultats'));
    }

    public function create()
    {
        $eleves = Eleve::orderBy('nom')->get();
        return view('resultats.create', compact('eleves'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'matiere' => 'required|string|max:255',
            'note' => 'required|numeric|min:0|max:20',
            'periode' => 'required|string|max:255',
            'commentaire' => 'nullable|string',
        ]);

        Resultat::create($validated);

        return redirect()->route('resultats.index')
            ->with('success', 'Le résultat a été ajouté avec succès.');
    }

    public function show(Resultat $resultat)
    {
        return view('resultats.show', compact('resultat'));
    }

    public function edit(Resultat $resultat)
    {
        $eleves = Eleve::orderBy('nom')->get();
        return view('resultats.edit', compact('resultat', 'eleves'));
    }

    public function update(Request $request, Resultat $resultat)
    {
        $validated = $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'matiere' => 'required|string|max:255',
            'note' => 'required|numeric|min:0|max:20',
            'periode' => 'required|string|max:255',
            'commentaire' => 'nullable|string',
        ]);

        $resultat->update($validated);

        return redirect()->route('resultats.index')
            ->with('success', 'Le résultat a été mis à jour avec succès.');
    }

    public function destroy(Resultat $resultat)
    {
        $resultat->delete();

        return redirect()->route('resultats.index')
            ->with('success', 'Le résultat a été supprimé avec succès.');
    }
}