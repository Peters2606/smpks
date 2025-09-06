<div>
    <form wire:submit.prevent="save">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="pks_number_partner" class="block text-sm font-medium text-gray-700 mb-1">No. PKS Rekanan</label>
                <input type="text" id="pks_number_partner" wire:model="pks_number_partner" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('pks_number_partner') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="pks_number_hospital" class="block text-sm font-medium text-gray-700 mb-1">No. PKS Rumah Sakit</label>
                <input type="text" id="pks_number_hospital" wire:model="pks_number_hospital" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('pks_number_hospital') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="contract_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kontrak</label>
                <input type="text" id="contract_name" wire:model="contract_name" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('contract_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" id="start_date" wire:model="start_date" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('start_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                <input type="date" id="end_date" wire:model="end_date" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('end_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="tariff_year" class="block text-sm font-medium text-gray-700 mb-1">Tarif Tahun</label>
                <input type="number" id="tariff_year" wire:model="tariff_year" placeholder="Contoh: 2024" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('tariff_year') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="is_new_contract" class="inline-flex items-center mt-2">
                    <input type="checkbox" id="is_new_contract" wire:model="is_new_contract" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">Ini adalah Kontrak Baru?</span>
                </label>
                <p class="text-xs text-gray-500 mt-1">Kontrak baru memerlukan persetujuan Legal & Marketing. Kontrak lama akan langsung aktif.</p>
            </div>

            <div class="md:col-span-2">
                <label for="files" class="block text-sm font-medium text-gray-700 mb-1">Upload File Tarif (PDF, DOC, DOCX)</label>
                <input type="file" id="files" wire:model="files" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @error('files.*') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                <div wire:loading wire:target="files" class="text-sm text-gray-500 mt-2 text-indigo-600">Mengunggah file...</div>
            </div>

            @if ($existingFiles)
                <div class="md:col-span-2 mt-4">
                    <h4 class="text-md font-semibold text-gray-700 mb-2">File yang Sudah Ada:</h4>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($existingFiles as $file)
                            <li class="text-sm text-gray-700 flex items-center justify-between">
                                <a href="{{ Storage::url($file['file_path']) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 underline">{{ $file['original_name'] }}</a>
                                <button type="button" wire:click="deleteFile({{ $file['id'] }})" onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')" class="ml-4 text-red-600 hover:text-red-800 text-xs font-medium">Hapus</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="mt-8">
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition duration-300">
                Simpan Kontrak
            </button>
        </div>
    </form>
</div>
