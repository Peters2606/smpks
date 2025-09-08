<div>
    <div class="mb-6 flex justify-between items-center">
        <input type="text" wire:model.live="search" placeholder="Cari kontrak..." class="form-input rounded-lg shadow-sm px-4 py-2 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out w-1/3">
        <select wire:model.live="filterTariffYear" class="form-select rounded-lg shadow-sm px-4 py-2 pr-10 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out w-1/4 appearance-none">
            <option value="">Semua Tahun</option>
            @foreach ($availableTariffYears as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        <a href="#" wire:click.prevent="sortBy('pks_number_partner')" class="flex items-center">No. PKS Rekanan</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        <a href="#" wire:click.prevent="sortBy('pks_number_hospital')" class="flex items-center">No. PKS RS</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        <a href="#" wire:click.prevent="sortBy('contract_name')" class="flex items-center">Nama Kontrak</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        <a href="#" wire:click.prevent="sortBy('tariff_year')" class="flex items-center">Tarif Tahun</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        <a href="#" wire:click.prevent="sortBy('start_date')" class="flex items-center">Tgl. Mulai</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        <a href="#" wire:click.prevent="sortBy('end_date')" class="flex items-center">Tgl. Berakhir</a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        File Pendukung
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($contracts as $contract)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out even:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->pks_number_partner }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->pks_number_hospital }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->contract_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->tariff_year ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->start_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->end_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($contract->status_color === 'success') bg-green-500 text-white
                                @elseif($contract->status_color === 'warning') bg-orange-500 text-white
                                @elseif($contract->status_color === 'danger') bg-red-500 text-white
                                @else bg-gray-500 text-white
                                @endif">
                                {{ $contract->status_description }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @forelse ($contract->contractFiles as $file)
                                @php
                                $textColorClass = 'text-gray-900'; // Default color for dashboard
                                if (isset($file->uploaded_by_role)) { // Use -> instead of [''] for object properties
                                    if ($file->uploaded_by_role === 'legal') {
                                        $textColorClass = 'text-green-600';
                                    } elseif ($file->uploaded_by_role === 'marketing') {
                                        $textColorClass = 'text-red-600';
                                    } elseif ($file->uploaded_by_role === 'admin') {
                                        $textColorClass = 'text-blue-600';
                                    }
                                }
                            @endphp
                                <a href="{{ Storage::url($file->file_path) }}" target="_blank" class="{{ $textColorClass }} hover:text-blue-800 block underline">{{ $file->original_name }}</a>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @can('update', $contract)
                                <a href="{{ route('contracts.edit', $contract) }}" class="text-indigo-600 hover:text-indigo-800 mr-2 font-bold">Edit</a>
                            @endcan
                            @can('delete', $contract)
                                <form action="{{ route('contracts.destroy', $contract) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kontrak ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada kontrak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $contracts->links() }}
    </div>
</div>
