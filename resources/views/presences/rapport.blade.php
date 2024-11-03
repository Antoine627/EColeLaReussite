@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Rapport des Présences</h1>
                <div class="flex gap-4">
                    <input type="month" 
                           id="mois_rapport" 
                           name="mois_rapport" 
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                           value="{{ date('Y-m') }}">
                    <select id="classe_rapport" name="classe_rapport" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="">Toutes les classes</option>
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                        @endforeach
                    </select>
                    <button type="button" 
                            id="export-pdf" 
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Exporter en PDF
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Élève</th>
                            <th scope="col" class="px-6 py-3">Classe</th>
                            <th scope="col" class="px-6 py-3">Jours présent</th>
                            <th scope="col" class="px-6 py-3">Retards</th>
                            <th scope="col" class="px-6 py-3">Absences</th>
                            <th scope="col" class="px-6 py-3">Taux de présence</th>
                        </tr>
                    </thead>
                    <tbody id="rapport-table-body">
                        @foreach($rapports as $rapport)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $rapport->eleve->nom }} {{ $rapport->eleve->prenom }}</td>
                                <td class="px-6 py-4">{{ $rapport->eleve->classe->nom }}</td>
                                <td class="px-6 py-4">{{ $rapport->jours_present }}</td>
                                <td class="px-6 py-4">{{ $rapport->retards }}</td>
                                <td class="px-6 py-4">{{ $rapport->absences }}</td>
                                <td class="px-6 py-4">{{ number_format($rapport->taux_presence, 2) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection