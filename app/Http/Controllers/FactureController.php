<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Afficher la liste des factures.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $factures = Facture::all();
        return view('comptabilite.factures.index', compact('factures'));
    }

    /**
     * Afficher le formulaire pour créer une nouvelle facture.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('comptabilite.factures.create');
    }

    /**
     * Enregistrer une nouvelle facture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'date_facture' => 'required|date',
            'statut' => 'required|in:payée,impayée',
        ]);

        Facture::create($request->all());

        return redirect()->route('comptabilite.factures.index')->with('success', 'Facture ajoutée avec succès.');
    }

    /**
     * Afficher les détails d'une facture spécifique.
     *
     * @param  Facture  $facture
     * @return \Illuminate\View\View
     */
    public function show(Facture $facture)
    {
        return view('comptabilite.factures.show', compact('facture'));
    }

    /**
     * Afficher le formulaire pour éditer une facture.
     *
     * @param  Facture  $facture
     * @return \Illuminate\View\View
     */
    public function edit(Facture $facture)
    {
        return view('comptabilite.factures.edit', compact('facture'));
    }

    /**
     * Mettre à jour une facture spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Facture  $facture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Facture $facture)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'date_facture' => 'required|date',
            'statut' => 'required|in:payée,impayée',
        ]);

        $facture->update($request->all());

        return redirect()->route('comptabilite.factures.index')->with('success', 'Facture mise à jour avec succès.');
    }

    /**
     * Supprimer une facture spécifique.
     *
     * @param  Facture  $facture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();

        return redirect()->route('comptabilite.factures.index')->with('success', 'Facture supprimée avec succès.');
    }
}
