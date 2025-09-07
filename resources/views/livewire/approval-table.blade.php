<div>
    @if (session()->has('message'))
        <div class="bg-green-500 text-white px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <span class="block sm:inline font-semibold">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-500 text-white px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <span class="block sm:inline font-semibold">{{ session('error') }}</span>
        </div>
    @endif

    <div class="mb-6">
        <input type="text" wire:model.live="search" placeholder="Cari kontrak..." class="form-input rounded-lg shadow-sm mt-1 block w-full px-4 py-2 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">No. PKS Rekanan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">No. PKS RS</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Kontrak</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Tarif Tahun</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Admin</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Legal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Marketing</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">File Pendukung</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($contracts as $contract)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out even:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->pks_number_partner }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->pks_number_hospital }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->contract_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contract->tariff_year ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $contract->admin_approved_at ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $contract->admin_approved_at ? 'Disetujui' : 'Belum' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $contract->legal_approved_at ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $contract->legal_approved_at ? 'Disetujui' : 'Belum' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $contract->marketing_approved_at ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $contract->marketing_approved_at ? 'Disetujui' : 'Belum' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @forelse ($contract->contractFiles as $file)
                                <a href="{{ Storage::url($file->file_path) }}" target="_blank" wire:click="recordFileReview({{ $contract->id }}, '{{ Auth::user()->role }}')" class="text-blue-600 hover:text-blue-800 block underline">{{ $file->original_name }}</a>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @php
                                $userRole = Auth::user()->role;
                                $approvalField = "{$userRole}_approved_at";
                                $approvedAt = $contract->$approvalField ? \Carbon\Carbon::parse($contract->$approvalField) : null;
                                $canRevert = $approvedAt && $approvedAt->diffInMinutes(now()) <= 20;
                            @endphp

                            @if (is_null($approvedAt) && in_array($userRole, ['admin', 'legal', 'marketing']))
                                <button wire:click="approve({{ $contract->id }})" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg text-xs transition duration-150 ease-in-out shadow-md">Setujui</button>
                            @elseif ($approvedAt && $canRevert && in_array($userRole, ['admin', 'legal', 'marketing']))
                                <button wire:click="revertApproval({{ $contract->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg text-xs transition duration-150 ease-in-out shadow-md">Batalkan Persetujuan</button>
                            @else
                                <span class="text-gray-500 text-xs">Sudah Disetujui / Tidak Ada Izin</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada kontrak yang menunggu persetujuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contracts->links() }}
    </div>