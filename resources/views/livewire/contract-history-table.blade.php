<div>
    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Cari kontrak..." class="form-input rounded-lg shadow-sm px-4 py-2 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out w-1/3">
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Kontrak</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Dibuat Pada</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Aktif Pada</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Legal Review</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Marketing Review</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Legal Approved</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Marketing Approved</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Admin Approved</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($contracts as $contract)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out even:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->contract_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->active_at ? $contract->active_at->format('d M Y H:i') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->legal_reviewed_at ? $contract->legal_reviewed_at->format('d M Y H:i') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->marketing_reviewed_at ? $contract->marketing_reviewed_at->format('d M Y H:i') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->legal_approved_at ? $contract->legal_approved_at->format('d M Y H:i') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->marketing_approved_at ? $contract->marketing_approved_at->format('d M Y H:i') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->admin_approved_at ? $contract->admin_approved_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada riwayat kontrak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contracts->links() }}
    </div>
</div>