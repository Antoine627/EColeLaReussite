@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Détails du résultat</h2>
            <a href="{{ route('resultats.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Retour
            </a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <h3 class="text-gray-700 font-bold mb-2">Élève</h3>
                <p class="text-gray-600">{{ $resultat->eleve->nom }} {{ $resultat->eleve->prenom }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-gray-700 font-bold mb-2">Classe</h3>
                <p class="text-gray-600">{{ $resultat->classe }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-gray-700 font-bold mb-2">Matière</h3>
                <p class="text-gray-600">{{ $resultat->matiere }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-gray-700 font-bold mb-2">Note</h3>
                <p class="text-gray-600">{{ $resultat->note }}/20</p>
            </div>

            <div class="mb-4">
                <h3 class="text-gray-700 font-bold mb-2">Période</h3>
                <p class="text-gray-600">{{ $resultat->periode }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-gray-700 font-bold mb-2">Commentaire</h3>
                <p class="text-gray-600">{{ $resultat->commentaire ?? 'Aucun commentaire' }}</p>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('resultats.edit', $resultat->id) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Modifier
                </a>
                <form action="{{ route('resultats.destroy', $resultat->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce résultat ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection