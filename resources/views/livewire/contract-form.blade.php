<div class="p-6 bg-white rounded-lg shadow-xl">
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        @if (session()->has('message'))
            <div class="bg-green-500 text-white px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                <span class="block sm:inline font-semibold">{{ session('message') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="col-span-1">
                <label for="pks_number_partner" class="block text-sm font-semibold text-gray-700 mb-2">No. PKS Rekanan</label>
                <input type="text" id="pks_number_partner" wire:model="pks_number_partner" class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm placeholder-gray-400 transition duration-150 ease-in-out" {{ $disableFields ? 'disabled' : '' }}>
                @error('pks_number_partner') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-1">
                <label for="pks_number_hospital" class="block text-sm font-semibold text-gray-700 mb-2">No. PKS Rumah Sakit</label>
                <input type="text" id="pks_number_hospital" wire:model="pks_number_hospital" class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm placeholder-gray-400 transition duration-150 ease-in-out" {{ $disableFields ? 'disabled' : '' }}>
                @error('pks_number_hospital') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="contract_name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kontrak</label>
                <input type="text" id="contract_name" wire:model="contract_name" class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm placeholder-gray-400 transition duration-150 ease-in-out" {{ $disableFields ? 'disabled' : '' }}>
                @error('contract_name') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-1">
                <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" id="start_date" wire:model="start_date" class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out" {{ $disableFields ? 'disabled' : '' }}>
                @error('start_date') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-1">
                <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Berakhir</label>
                <input type="date" id="end_date" wire:model="end_date" class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out" {{ $disableFields ? 'disabled' : '' }}>
                @error('end_date') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-1">
                <label for="tariff_year" class="block text-sm font-semibold text-gray-700 mb-2">Tarif Tahun</label>
                <input type="number" id="tariff_year" wire:model="tariff_year" placeholder="Contoh: 2024" class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm placeholder-gray-400 transition duration-150 ease-in-out" {{ $disableFields ? 'disabled' : '' }}>
                @error('tariff_year') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="is_new_contract" class="inline-flex items-center mt-2 cursor-pointer">
                    <input type="checkbox" id="is_new_contract" wire:model="is_new_contract" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 transition duration-150 ease-in-out" {{ $disableFields ? 'disabled' : '' }}>
                    <span class="ml-2 text-sm text-gray-700 font-medium">Ini adalah Kontrak Baru?</span>
                </label>
                <p class="text-xs text-gray-500 mt-1">Kontrak baru memerlukan persetujuan Legal & Marketing. Kontrak lama akan langsung aktif.</p>
            </div>

            <div class="md:col-span-2">
                <label for="files" class="block text-sm font-semibold text-gray-700 mb-2">Upload File Tarif (PDF, DOC, DOCX)</label>
                <input type="file" id="files" wire:model="newUploads" multiple class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 cursor-pointer transition duration-150 ease-in-out">
                @error('allFiles.*') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                <div wire:loading wire:target="newUploads" class="text-sm text-indigo-600 mt-2 font-medium">Mengunggah file...</div>
                @if (!empty($allFiles))
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h4 class="text-md font-semibold text-gray-700 mb-3">File yang Dipilih:</h4>
                        <ul class="list-disc list-inside space-y-2">
                            @foreach ($allFiles as $file)
                                <li class="text-sm text-gray-700 truncate">{{ $file->getClientOriginalName() }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            @if ($existingFiles)
                <div class="md:col-span-2 mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h4 class="text-md font-semibold text-gray-700 mb-3">File yang Sudah Ada:</h4>
                    <ul class="list-disc list-inside space-y-2">
                        @foreach ($existingFiles as $index => $file)
                            <li class="text-sm flex items-center justify-between @php
                                $textColorClass = 'text-gray-700'; // Default color
                                if (isset($file['uploaded_by_role'])) {
                                    if ($file['uploaded_by_role'] === 'legal') {
                                        $textColorClass = 'text-green-600';
                                    } elseif ($file['uploaded_by_role'] === 'marketing') {
                                        $textColorClass = 'text-red-600';
                                    }
                                }
                            @endphp {{ $textColorClass }}">
                                <a href="{{ Storage::url($file['file_path']) }}" target="_blank" class="{{ $textColorClass }} hover:text-indigo-800 underline font-medium truncate flex items-center">
                                    <i class="fa-solid fa-eye mr-2"></i> Lihat File {{ $index + 1 }}
                                </a>
                                <button type="button" wire:click="deleteFile({{ $file['id'] }})" onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')" class="ml-4 text-red-600 hover:text-red-800 text-xs font-medium px-3 py-1 rounded-md border border-red-300 hover:bg-red-50 transition duration-150 ease-in-out">Hapus</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="mt-8">
            <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-semibold rounded-lg shadow-lg text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition duration-300 ease-in-out" {{ $disableFields && empty($allFiles) ? 'disabled' : '' }}>
                <i class="fa-solid fa-save mr-2"></i> Simpan Kontrak
            </button>
        </div>
    </form>
</div>
