<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Afficher la liste des paiements.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $paiements = Paiement::all();
        return view('comptabilite.paiements.index', compact('paiements'));
    }

    /**
     * Afficher le formulaire pour créer un nouveau paiement.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('comptabilite.paiements.create');
    }

    /**
     * Enregistrer un nouveau paiement.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'date_paiement' => 'required|date',
        ]);

        Paiement::create($request->all());

        return redirect()->route('comptabilite.paiements.index')->with('success', 'Paiement ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un paiement spécifique.
     *
     * @param  Paiement  $paiement
     * @return \Illuminate\View\View
     */
    public function show(Paiement $paiement)
    {
        return view('comptabilite.paiements.show', compact('paiement'));
    }

    /**
     * Afficher le formulaire pour éditer un paiement.
     *
     * @param  Paiement  $paiement
     * @return \Illuminate\View\View
     */
    public function edit(Paiement $paiement)
    {
        return view('comptabilite.paiements.edit', compact('paiement'));
    }

    /**
     * Mettre à jour un paiement spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Paiement  $paiement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'date_paiement' => 'required|date',
        ]);

        $paiement->update($request->all());

        return redirect()->route('comptabilite.paiements.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    /**
     * Supprimer un paiement spécifique.
     *
     * @param  Paiement  $paiement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Paiement $paiement)
    {
        $paiement->delete();

        return redirect()->route('comptabilite.paiements.index')->with('success', 'Paiement supprimé avec succès.');
    }
}
