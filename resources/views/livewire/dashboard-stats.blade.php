<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    {{-- Total Kontrak --}}
    <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-lg p-6 text-center transform hover:scale-105 transition duration-300">
        <h3 class="text-xl font-bold text-white">Total Kontrak</h3>
        <p class="mt-2 text-5xl font-extrabold text-white">{{ $totalContracts }}</p>
    </div>

    {{-- Kontrak Aktif --}}
    <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-xl shadow-lg p-6 text-center transform hover:scale-105 transition duration-300">
        <h3 class="text-xl font-bold text-white">Kontrak Aktif</h3>
        <p class="mt-2 text-5xl font-extrabold text-white">{{ $activeContracts }}</p>
    </div>

    {{-- Segera Habis --}}
    <div class="bg-gradient-to-br from-orange-500 to-orange-700 rounded-xl shadow-lg p-6 text-center transform hover:scale-105 transition duration-300">
        <h3 class="text-xl font-bold text-white">Segera Habis</h3>
        <p class="mt-2 text-5xl font-extrabold text-white">{{ $expiringSoonContracts }}</p>
    </div>

    {{-- Kontrak Habis --}}
    <div class="bg-gradient-to-br from-red-500 to-red-700 rounded-xl shadow-lg p-6 text-center transform hover:scale-105 transition duration-300">
        <h3 class="text-xl font-bold text-white">Kontrak Habis</h3>
        <p class="mt-2 text-5xl font-extrabold text-white">{{ $expiredContracts }}</p>
    </div>
</div>
