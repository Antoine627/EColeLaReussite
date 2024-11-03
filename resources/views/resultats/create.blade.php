@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Ajouter un résultat</h2>
            <a href="{{ route('resultats.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Retour
            </a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('resultats.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="eleve_id">
                        Élève
                    </label>
                    <select name="eleve_id" id="eleve_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('eleve_id') border-red-500 @enderror">
                        <option value="">Sélectionnez un élève</option>
                        @foreach($eleves as $eleve)
                            <option value="{{ $eleve->id }}">{{ $eleve->nom }} {{ $eleve->prenom }}</option>
                        @endforeach
                    </select>
                    @error('eleve_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="matiere">
                        Matière
                    </label>
                    <select name="matiere" id="matiere" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('matiere') border-red-500 @enderror">
                        <option value="">Sélectionnez une matière</option>
                        <option value="Mathématiques">Mathématiques</option>
                        <option value="Français">Français</option>
                        <option value="Histoire-Géo">Histoire-Géo</option>
                        <option value="Sciences">Sciences</option>
                    </select>
                    @error('matiere')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note">
                        Note (/20)
                    </label>
                    <input type="number" step="0.5" min="0" max="20" name="note" id="note" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('note') border-red-500 @enderror">
                    @error('note')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="periode">
                        Période
                    </label>
                    <select name="periode" id="periode" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('periode') border-red-500 @enderror">
                        <option value="">Sélectionnez une période</option>
                        <option value="T1">Trimestre 1</option>
                        <option value="T2">Trimestre 2</option>
                        <option value="T3">Trimestre 3</option>
                    </select>
                    @error('periode')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection