@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- En-tête -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tableau de bord</h2>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>

        <!-- Cartes de statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Élèves -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-500 bg-opacity-10">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-500">Total Élèves</h4>
                            <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format(10000) }}</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-green-600">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>+2.5% depuis le mois dernier</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Présents aujourd'hui -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-green-500 bg-opacity-10">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-500">Présents aujourd'hui</h4>
                            <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format(9500) }}</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-green-600">
                            <span>95% de présence</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Employés -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-500 bg-opacity-10">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-500">Total Employés</h4>
                            <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format(600) }}</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-blue-600">
                            <span>42 départements</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenus du mois -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-indigo-500 bg-opacity-10">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-500">Revenus du mois</h4>
                            <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format(950000) }} FCFA</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-green-600">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>+12% depuis le dernier mois</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableaux récents -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Dernières inscriptions -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Dernières inscriptions</h3>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">Voir tout</a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Classe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Koné Amadou</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6ème A</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">23/10/2024</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Touré Fatima</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3ème B</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22/10/2024</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Diallo Ibrahim</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">CM2</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22/10/2024</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Derniers paiements -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Derniers paiements</h3>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">Voir tout</a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Élève</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Koné Amadou</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">150,000 FCFA</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Payé
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Touré Fatima</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">150,000 FCFA</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Diallo Ibrahim</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">150,000 FCFA</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Payé
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouvelles sections -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
            <!-- Événements à venir -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Événements à venir</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg">
                                    <span class="text-blue-600 font-semibold">15</span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Réunion des parents</p>
                                <p class="text-sm text-gray-500">Nov 2024 • 14:00</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-lg">
                                    <span class="text-green-600 font-semibold">20</span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Journée sportive</p>
                                <p class="text-sm text-gray-500">Nov 2024 • 08:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance par classe -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Performance par classe</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-sm font-semibold text-gray-700">6ème A</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-semibold text-gray-600">85%</span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-100">
                                <div style="width:85%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                            </div>
                        </div>
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-sm font-semibold text-gray-700">5ème B</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-semibold text-gray-600">78%</span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-100">
                                <div style="width:78%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages récents -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Messages récents</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-600 font-medium">KA</span>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">Koné Aminata</p>
                                <p class="text-sm text-gray-500">Demande de rendez-vous pour discuter...</p>
                                <p class="mt-1 text-xs text-gray-400">Il y a 2 heures</p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-600 font-medium">SD</span>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">Sylla Dramane</p>
                                <p class="text-sm text-gray-500">Confirmation de la réunion de demain...</p>
                                <p class="mt-1 text-xs text-gray-400">Il y a 5 heures</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section finale -->
        <div class="mt-8 bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Aperçu des activités</h3>
            </div>
            <div class="p-6">
                <div class="flow-root">
                    <ul class="-mb-8">
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Nouvelle inscription <span class="font-medium text-gray-900">Koné Amadou</span></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2024-10-23">Il y a 2 jours</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Paiement effectué par <span class="font-medium text-gray-900">Touré Fatima</span></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2024-10-22">Il y a 3 jours</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection