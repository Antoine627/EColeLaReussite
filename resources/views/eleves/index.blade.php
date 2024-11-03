@extends('layouts.admin')

@section('content')
<!-- En-tête -->
<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex-shrink-0 flex items-center">
                <h1 class="text-2xl font-bold text-gray-800">Gestion des élèves</h1>
            </div>
            <div class="flex items-center">
                <button id="openModal" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H6a1 1 0 110-2h4V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Nouvel élève
                </button>
            </div>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">{{ session('success') }}</div>
@endif

<!-- Sections pour le nombre de filles et de garçons -->
<div class="flex justify-between mb-4 px-4 sm:px-6 mt-10">
    <div class="bg-pink-100 border border-pink-300 text-pink-700 p-4 rounded-md shadow-md flex-1 mr-2 flex items-center">
        <i class="fas fa-female fa-2x mr-2"></i>
        <div>
            <h3 class="font-bold">Total Filles</h3>
            <p class="text-2xl">{{ $totalFilles }}</p>
        </div>
    </div>
    <div class="bg-blue-100 border border-blue-300 text-blue-700 p-4 rounded-md shadow-md flex-1 ml-2 flex items-center">
        <i class="fas fa-male fa-2x mr-2"></i>
        <div>
            <h3 class="font-bold">Total Garçons</h3>
            <p class="text-2xl">{{ $totalGarcons }}</p>
        </div>
    </div>
</div>

<div class="mb-6 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Liste des élèves</h2>
        <form action="{{ route('eleves.index') }}" method="GET" class="flex items-center gap-4">
            <div class="flex-1 max-w-xs">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Rechercher par nom ou prénom...">
                </div>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                Rechercher
            </button>
        </form>
    </div>
</div>

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Numéro matricule</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Prénom</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Date de naissance</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Sexe</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($eleves as $eleve)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $eleve->numero_matricule }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $eleve->nom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $eleve->prenom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $eleve->date_naissance }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $eleve->sexe }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('eleves.show', $eleve->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="#" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 rounded-md transition-colors duration-200 edit-button" 
           data-id="{{ $eleve->id }}" 
           data-nom="{{ $eleve->nom }}" 
           data-prenom="{{ $eleve->prenom }}" 
           data-date_naissance="{{ $eleve->date_naissance }}" 
           data-sexe="{{ $eleve->sexe }}" 
           data-adresse="{{ $eleve->adresse }}" 
           data-telephone="{{ $eleve->telephone }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </a>
                                <form action="{{ route('eleves.destroy', $eleve->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cet élève ?')" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 rounded-md transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Liens de pagination -->
<div class="py-4 px-6">
    {{ $eleves->links() }} <!-- Ajoute les liens de pagination -->
</div>

<!-- La Modal -->
<div id="addStudentModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl w-full transform transition-transform scale-95 opacity-0" id="modalContent">
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
            
            <button type="button" id="closeModal" class="mt-4 w-full inline-block px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 text-center">
                Annuler
            </button>
        </form>
    </div>
</div>


<!-- La Modal de Modification -->
<div id="editStudentModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl w-full transform transition-transform scale-95 opacity-0" id="editModalContent">
        <h1 class="text-3xl font-bold mb-4">Modifier un élève</h1>

        <form id="editStudentForm" action="{{ route('eleves.update', $eleve->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="edit_nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="edit_nom" value="{{ $eleve->nom }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
                </div>

                <div class="mb-4">
                    <label for="edit_prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name="prenom" id="edit_prenom" value="{{ $eleve->prenom }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
                </div>

                <div class="mb-4">
                    <label for="edit_date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                    <input type="date" name="date_naissance" id="edit_date_naissance" value="{{ $eleve->date_naissance }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
                </div>

                <div class="mb-4">
                    <label for="edit_sexe" class="block text-sm font-medium text-gray-700">Sexe</label>
                    <select name="sexe" id="edit_sexe" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300" required>
                        <option value="M" {{ $eleve->sexe == 'M' ? 'selected' : '' }}>Masculin</option>
                        <option value="F" {{ $eleve->sexe == 'F' ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="edit_adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <input type="text" name="adresse" id="edit_adresse" value="{{ $eleve->adresse }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label for="edit_telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" name="telephone" id="edit_telephone" value="{{ $eleve->telephone }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label for="edit_photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" id="edit_photo" accept="image/*" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
                </div>
            </div>

            <button type="submit" class="mt-4 w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                Enregistrer les modifications
            </button>
            
            <button type="button" id="closeEditModal" class="mt-4 w-full inline-block px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 text-center">
                Annuler
            </button>
        </form>
    </div>
</div>


<script>
    // Script pour ouvrir et fermer la modal avec animation
    const modal = document.getElementById('addStudentModal');
    const modalContent = document.getElementById('modalContent');
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');

    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10); // Donne le temps au navigateur de rendre le modal avant d'ajouter les classes d'animation
    });

    closeModalButton.addEventListener('click', () => {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Temps pour l'animation de fermeture
    });


    // Script pour ouvrir et fermer la modal de modification avec animation
    const editModal = document.getElementById('editStudentModal');
    const editModalContent = document.getElementById('editModalContent');
    const closeEditModalButton = document.getElementById('closeEditModal');

    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const nom = button.getAttribute('data-nom');
            const prenom = button.getAttribute('data-prenom');
            const dateNaissance = button.getAttribute('data-date_naissance');
            const sexe = button.getAttribute('data-sexe');
            const adresse = button.getAttribute('data-adresse');
            const telephone = button.getAttribute('data-telephone');

            // Remplir le formulaire avec les données
            document.getElementById('editStudentForm').action = `/eleves/${id}`;
            document.getElementById('edit_nom').value = nom;
            document.getElementById('edit_prenom').value = prenom;
            document.getElementById('edit_date_naissance').value = dateNaissance;
            document.getElementById('edit_sexe').value = sexe;
            document.getElementById('edit_adresse').value = adresse;
            document.getElementById('edit_telephone').value = telephone;

            // Afficher la modal
            editModal.classList.remove('hidden');
            setTimeout(() => {
                editModalContent.classList.remove('scale-95', 'opacity-0');
                editModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        });
    });

    closeEditModalButton.addEventListener('click', () => {
        editModalContent.classList.remove('scale-100', 'opacity-100');
        editModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            editModal.classList.add('hidden');
        }, 300);
    });
</script>

<style>
    /* Styles pour la transition */
    .transition-transform {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
</style>
@endsection