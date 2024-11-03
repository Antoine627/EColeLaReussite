@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Gestion des Résultats</h2>
            <a href="{{ route('resultats.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ajouter un résultat
            </a>
        </div>

        {{-- Filtres --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form action="{{ route('resultats.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="classe">
                        Classe
                    </label>
                    <select name="classe" id="classe" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                        <option value="">Toutes les classes</option>
                        <option value="6ème">6ème</option>
                        <option value="5ème">5ème</option>
                        <option value="4ème">4ème</option>
                        <option value="3ème">3ème</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="matiere">
                        Matière
                    </label>
                    <select name="matiere" id="matiere" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                        <option value="">Toutes les matières</option>
                        <option value="Mathématiques">Mathématiques</option>
                        <option value="Français">Français</option>
                        <option value="Histoire-Géo">Histoire-Géo</option>
                        <option value="Sciences">Sciences</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="periode">
                        Période
                    </label>
                    <select name="periode" id="periode" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                        <option value="">Toutes les périodes</option>
                        <option value="T1">Trimestre 1</option>
                        <option value="T2">Trimestre 2</option>
                        <option value="T3">Trimestre 3</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Filtrer
                    </button>
                </div>
            </form>
        </div>

        {{-- Tableau des résultats --}}
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Élève</th>
                        <th class="py-3 px-6 text-left">Classe</th>
                        <th class="py-3 px-6 text-left">Matière</th>
                        <th class="py-3 px-6 text-left">Note</th>
                        <th class="py-3 px-6 text-left">Période</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($resultats as $resultat)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                {{ $resultat->eleve->nom }} {{ $resultat->eleve->prenom }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resultat->classe }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resultat->matiere }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resultat->note }}/20
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resultat->periode }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('resultats.edit', $resultat->id) }}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('resultats.destroy', $resultat->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce résultat ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200">
                            <td colspan="6" class="py-3 px-6 text-center">Aucun résultat trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $resultats->links() }}
        </div>
    </div>
@endsection