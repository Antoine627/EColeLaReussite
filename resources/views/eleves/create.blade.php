@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-4">Ajouter un élève</h1>

    @if($errors->any())
        <div class="mb-4">
            <div class="bg-red-500 text-white p-3 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('eleves.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="sexe" class="block text-sm font-medium text-gray-700">Sexe</label>
                <select name="sexe" id="sexe" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" name="telephone" id="telephone" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label for="date_inscription" class="block text-sm font-medium text-gray-700">Date d'inscription</label>
                <input type="date" name="date_inscription" id="date_inscription" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" id="photo" accept="image/*" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
            </div>
        </div>

        <button type="submit" class="mt-4 w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
            Ajouter
        </button>
        
        <!-- Button Annuler -->
        <a href="{{ route('eleves.index') }}" class="mt-4 w-full inline-block px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 text-center">
            Annuler
        </a>
    </form>
</div>
@endsection
