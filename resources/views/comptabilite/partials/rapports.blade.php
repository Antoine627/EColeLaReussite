<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Graphique des revenus -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Revenus mensuels</h3>
        <canvas id="revenusChart"></canvas>
    </div>

    <!-- Graphique des dépenses -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Dépenses mensuelles</h3>
        <canvas id="depensesChart"></canvas>
    </div>

    <!-- Statistiques de paiement -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Statistiques de paiement</h3>
        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-600">Taux de paiement à temps</p>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $tauxPaiementTemps }}%"></div>
                </div>
                <p class="text-right text-sm text-gray-600">{{ $tauxPaiementTemps }}%</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Factures impayées</p>
                <p class="text-2xl font-bold text-red-600">{{ $facturesImpayees }}