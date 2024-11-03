<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Liste des paiements</h3>
            <div class="flex space-x-2">
                <input type="text" placeholder="Rechercher..." class="border rounded px-3 py-1">
                <select class="border rounded px-3 py-1">
                    <option value="">Tous les mois</option>
                    <option value="01">Janvier</option>
                    <option value="02">Février</option>
                    <!-- ... autres mois ... -->
                </select>
            </div>
        </div>
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Élève</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($paiements as $paiement)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->eleve->nom }} {{ $paiement->eleve->prenom }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($paiement->montant, 2, ',', ' ') }} €</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $paiement->statut === 'payé' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($paiement->statut) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('comptabilite.paiements.edit', $paiement) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('comptabilite.paiements.show', $paiement) }}" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $paiements->links() }}
        </div>
    </div>
</div>