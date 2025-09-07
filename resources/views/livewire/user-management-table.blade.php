<div>
    <div class="mb-4 flex justify-between items-center">
        <input type="text" wire:model.live="search" placeholder="Cari pengguna..." class="form-input rounded-lg shadow-sm px-4 py-2 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out w-1/3">
        <button wire:click="newUser" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out">
            Tambah Pengguna Baru
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <span class="block sm:inline font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out even:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="editUser({{ $user->id }})" class="text-indigo-600 hover:text-indigo-800 mr-2 font-bold">Edit</button>
                            <button wire:click="deleteUser({{ $user->id }})" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada pengguna ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

    {{-- User Modal --}}
    @if ($showUserModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">{{ $editMode ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}</h2>
                <form wire:submit.prevent="{{ $editMode ? 'updateUser' : 'createUser' }}">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" id="name" wire:model="name" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" wire:model="email" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password {{ $editMode ? '(Kosongkan jika tidak ingin mengubah)' : '' }}</label>
                        <input type="password" id="password" wire:model="password" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" wire:model="password_confirmation" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('password_confirmation') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select id="role" wire:model="role" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="admin">Admin</option>
                            <option value="legal">Legal</option>
                            <option value="marketing">Marketing</option>
                        </select>
                        @error('role') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="button" wire:click="$set('showUserModal', false)" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Batal</button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">
                            {{ $editMode ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>