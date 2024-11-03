@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- En-tête avec photo -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('storage/' . $eleve->photo) }}" 
                             alt="Photo de {{ $eleve->prenom }} {{ $eleve->nom }}"
                             class="h-24 w-24 rounded-full border-4 border-white object-cover">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">
                            {{ $eleve->prenom }} {{ $eleve->nom }}
                        </h1>
                        <p class="text-blue-100 font-medium">
                            Matricule : {{ $eleve->numero_matricule }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informations détaillées -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations personnelles -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">
                            Informations personnelles
                        </h2>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Date de naissance</p>
                                    <p class="font-medium text-gray-900">
                                        {{ date('d/m/Y', strtotime($eleve->date_naissance)) }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Sexe</p>
                                    <p class="font-medium text-gray-900">
                                        {{ $eleve->sexe == 'M' ? 'Masculin' : 'Féminin' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations de contact -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900 border-b pb-2">
                            Coordonnées
                        </h2>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Téléphone</p>
                                    <p class="font-medium text-gray-900">
                                        {{ $eleve->telephone ?: 'Non renseigné' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Adresse</p>
                                    <p class="font-medium text-gray-900">
                                        {{ $eleve->adresse ?: 'Non renseignée' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations d'inscription -->
                <div class="mt-6 pt-6 border-t">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Informations d'inscription
                    </h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Date d'inscription</p>
                                <p class="font-medium text-gray-900">
                                    {{ date('d/m/Y', strtotime($eleve->date_inscription)) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('eleves.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour à la liste
                    </a>
                    
                    <a href="{{ route('eleves.edit', $eleve->id) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection