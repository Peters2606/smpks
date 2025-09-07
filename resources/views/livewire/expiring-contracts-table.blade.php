<div>
    <div class="mb-6 flex justify-end">
        <select wire:model.live="filterDays" class="form-select rounded-lg shadow-sm px-4 py-2 pr-10 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out appearance-none">
            <option value="30">Dalam 30 Hari</option>
            <option value="60">Dalam 60 Hari</option>
            <option value="90">Dalam 90 Hari</option>
        </select>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-purple-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">No. PKS Rekanan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">No. PKS RS</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Kontrak</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Tarif Tahun</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Tanggal Berakhir</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Sisa Hari</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($contracts as $contract)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out even:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->pks_number_partner }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->pks_number_hospital }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->contract_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->tariff_year ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->end_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $contract->remaining_days <= 7 ? 'text-red-600' : ($contract->remaining_days <= 30 ? 'text-orange-500' : 'text-green-600') }}">
                            {{ $contract->remaining_days }} hari
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada kontrak yang akan berakhir dalam {{ $filterDays }} hari.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $contracts->links() }}
    </div>
</div>