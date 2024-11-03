@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Modifier le résultat</h2>
            <a href="{{ route('resultats.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Retour
            </a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('resultats.update', $resultat->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="eleve_id">
                        Élève
                    </label>
                    <select name="eleve_id" id="eleve_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('eleve_id') border-red-500 @enderror">
                        @foreach($eleves as $eleve)
                            <option value="{{ $eleve->id }}" {{ $resultat->eleve_id == $eleve->id ? 'selected' : '' }}>
                                {{ $eleve->nom }} {{ $eleve->prenom }}
                            </option>
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
                        <option value="Mathématiques" {{ $resultat->matiere == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                        <option value="Français" {{ $resultat->matiere == 'Français' ? 'selected' : '' }}>Français</option>
                        <option value="Histoire-Géo" {{ $resultat->matiere == 'Histoire-Géo' ? 'selected' : '' }}>Histoire-Géo</option>
                        <option value="Sciences" {{ $resultat->matiere == 'Sciences' ? 'selected' : '' }}>Sciences</option>
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
                           value="{{ $resultat->note }}"
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
                        <option value="T1" {{ $resultat->periode == 'T1' ? 'selected' : '' }}>Trimestre 1</option>
                        <option value="T2" {{ $resultat->periode == 'T2' ? 'selected' : '' }}>Trimestre 2</option>
                        <option value="T3" {{ $resultat->periode == 'T3' ? 'selected' : '' }}>Trimestre 3</option>
                    </select>
                    @error('periode')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection