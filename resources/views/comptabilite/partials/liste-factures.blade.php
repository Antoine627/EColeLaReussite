<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Liste des factures</h3>
            <div class="flex space-x-2">
                <input type="text" placeholder="Rechercher..." class="border rounded px-3 py-1">
                <select class="border rounded px-3 py-1">
                    <option value="">Tous les statuts</option>
                    <option value="payée">Payée</option>
                    <option value="en_attente">En attente</option>
                    <option value="annulée">Annulée</option>
                </select>
            </div>
        </div>
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Facture</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Élève/Parent</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($factures as $facture)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $facture->numero }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $facture->date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $facture->destinataire }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($facture->montant, 2, ',', ' ') }} €</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $facture->statut === 'payée' ? 'bg-green-100 text-green-800' : 
                               ($facture->statut === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($facture->statut) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('comptabilite.factures.edit', $facture) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('comptabilite.factures.show', $facture) }}" class="text-gray-600 hover:text-gray-900 mr-3">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('comptabilite.factures.download', $facture) }}" class="text-green-600 hover:text-green-900">
                            <i class="fas fa-download"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $factures->links() }}
        </div>
    </div>
</div>