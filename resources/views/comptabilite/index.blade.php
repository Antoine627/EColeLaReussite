@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Comptabilité</h2>
            <div class="space-x-2">
                <a href="{{ route('comptabilite.paiements.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    <i class="fas fa-plus mr-2"></i>Nouveau Paiement
                </a>
                <a href="{{ route('comptabilite.factures.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    <i class="fas fa-file-invoice mr-2"></i>Nouvelle Facture
                </a>
            </div>
        </div>

        <!-- Résumé financier -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Revenus du mois</h3>
                <p class="text-2xl font-bold text-green-600">{{ number_format($revenuesMensuel, 2, ',', ' ') }} €</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Dépenses du mois</h3>
                <p class="text-2xl font-bold text-red-600">{{ number_format($depensesMensuel, 2, ',', ' ') }} €</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Solde</h3>
                <p class="text-2xl font-bold text-blue-600">{{ number_format($solde, 2, ',', ' ') }} €</p>
            </div>
        </div>

        <!-- Onglets -->
        <div class="mb-4">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex">
                    <button class="tab-button active whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm" data-target="paiements">
                        Paiements
                    </button>
                    <button class="tab-button whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm" data-target="factures">
                        Factures
                    </button>
                    <button class="tab-button whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm" data-target="rapports">
                        Rapports
                    </button>
                </nav>
            </div>
        </div>

        <!-- Contenu des onglets -->
        <div id="paiements" class="tab-content active">
            @include('comptabilite.partials.liste-paiements')
        </div>
        <div id="factures" class="tab-content hidden">
            @include('comptabilite.partials.liste-factures')
        </div>
        <div id="rapports" class="tab-content hidden">
            @include('comptabilite.partials.rapports')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-button');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Désactiver tous les onglets
                    tabs.forEach(t => {
                        t.classList.remove('active', 'border-blue-500', 'text-blue-600');
                        t.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    });

                    // Cacher tout le contenu
                    contents.forEach(c => c.classList.add('hidden'));

                    // Activer l'onglet cliqué
                    tab.classList.add('active', 'border-blue-500', 'text-blue-600');
                    tab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');

                    // Afficher le contenu correspondant
                    const target = document.getElementById(tab.dataset.target);
                    target.classList.remove('hidden');
                });
            });
        });
    </script>
@endsection