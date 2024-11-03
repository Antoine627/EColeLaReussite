<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Paiement;
use Illuminate\Http\Request;

class ComptabiliteController extends Controller
{
    /**
     * Afficher la page principale de comptabilité.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère les paiements avec pagination (10 par page par exemple)
        $paiements = Paiement::paginate(10);

        // Récupère également les factures avec pagination
        $factures = Facture::paginate(10);

        // Calculez les revenus mensuels
        $revenuesMensuel = Paiement::whereMonth('created_at', now()->month)
            ->sum('montant');

        // Calculez les dépenses mensuelles
        $depensesMensuel = Facture::where('statut', 'payée')
            ->whereMonth('created_at', now()->month)
            ->sum('montant');

        // Calculez le solde
        $solde = $revenuesMensuel - $depensesMensuel;

        // Calculez le taux de paiement à temps
        $paiementsATemps = Paiement::where('statut', 'à temps')
            ->whereMonth('created_at', now()->month)
            ->count();
        $totalPaiements = Paiement::whereMonth('created_at', now()->month)
            ->count();
        $tauxPaiementTemps = $totalPaiements > 0 ? ($paiementsATemps / $totalPaiements) * 100 : 0;

        // Calculez le nombre de factures impayées
        $facturesImpayees = Facture::where('statut', 'impayée')->count();

        // Passe les paiements et autres données nécessaires à la vue
        return view('comptabilite.index', compact('paiements', 'factures', 'revenuesMensuel', 'depensesMensuel', 'solde', 'tauxPaiementTemps', 'facturesImpayees'));
    }
}
