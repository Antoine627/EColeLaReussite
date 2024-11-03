@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Gestion des Présences</h1>
                <div class="flex gap-4">
                    <input type="date" 
                           id="date_presence" 
                           name="date_presence" 
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                           value="{{ date('Y-m-d') }}">
                    <select id="classe" name="classe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="">Sélectionner une classe</option>
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Élève</th>
                            <th scope="col" class="px-6 py-3">Classe</th>
                            <th scope="col" class="px-6 py-3">Statut</th>
                            <th scope="col" class="px-6 py-3">Heure d'arrivée</th>
                            <th scope="col" class="px-6 py-3">Commentaire</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="presence-table-body">
                        @foreach($eleves as $eleve)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $eleve->nom }} {{ $eleve->prenom }}</td>
                                <td class="px-6 py-4">{{ $eleve->classe->nom }}</td>
                                <td class="px-6 py-4">
                                    <select name="status_{{ $eleve->id }}" class="presence-status bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="present">Présent</option>
                                        <option value="absent">Absent</option>
                                        <option value="retard">Retard</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="time" 
                                           name="heure_arrivee_{{ $eleve->id }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" 
                                           name="commentaire_{{ $eleve->id }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                           placeholder="Commentaire...">
                                </td>
                                <td class="px-6 py-4">
                                    <button type="button" 
                                            class="save-presence text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                                            data-eleve-id="{{ $eleve->id }}">
                                        Enregistrer
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mise à jour du tableau lors du changement de date ou de classe
            const dateInput = document.getElementById('date_presence');
            const classeSelect = document.getElementById('classe');

            dateInput.addEventListener('change', updatePresenceTable);
            classeSelect.addEventListener('change', updatePresenceTable);

            // Fonction pour mettre à jour le tableau
            function updatePresenceTable() {
                const date = dateInput.value;
                const classeId = classeSelect.value;

                fetch(`/presences/filter?date=${date}&classe_id=${classeId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Mettre à jour le tableau avec les nouvelles données
                        const tableBody = document.getElementById('presence-table-body');
                        tableBody.innerHTML = ''; // Vider le tableau

                        data.forEach(eleve => {
                            // Créer une nouvelle ligne pour chaque élève
                            const row = createPresenceRow(eleve);
                            tableBody.appendChild(row);
                        });
                    });
            }

            // Gestion des boutons de sauvegarde
            document.querySelectorAll('.save-presence').forEach(button => {
                button.addEventListener('click', function() {
                    const eleveId = this.dataset.eleveId;
                    const row = this.closest('tr');
                    const status = row.querySelector(`select[name="status_${eleveId}"]`).value;
                    const heureArrivee = row.querySelector(`input[name="heure_arrivee_${eleveId}"]`).value;
                    const commentaire = row.querySelector(`input[name="commentaire_${eleveId}"]`).value;

                    // Envoi des données au serveur
                    fetch('/presences', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            eleve_id: eleveId,
                            date: dateInput.value,
                            status: status,
                            heure_arrivee: heureArrivee,
                            commentaire: commentaire
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Afficher un message de succès
                            alert('Présence enregistrée avec succès !');
                        }
                    });
                });
            });
        });

        function createPresenceRow(eleve) {
            // Créer une nouvelle ligne pour le tableau
            const row = document.createElement('tr');
            row.className = 'bg-white border-b hover:bg-gray-50';
            // Ajouter le contenu de la ligne
            // ... (code pour créer les cellules du tableau)
            return row;
        }
    </script>
    @endpush
@endsection
