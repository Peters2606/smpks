<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <div class="bg-white rounded-xl shadow-md p-6 text-center transform hover:scale-105 transition duration-300">
        <h3 class="text-lg font-semibold text-gray-700">Total Kontrak</h3>
        <p class="mt-2 text-4xl font-extrabold text-gray-900">{{ $totalContracts }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center transform hover:scale-105 transition duration-300">
        <h3 class="text-lg font-semibold text-gray-700">Kontrak Aktif</h3>
        <p class="mt-2 text-4xl font-extrabold text-green-600">{{ $activeContracts }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center transform hover:scale-105 transition duration-300">
        <h3 class="text-lg font-semibold text-gray-700">Segera Habis</h3>
        <p class="mt-2 text-4xl font-extrabold text-orange-500">{{ $expiringSoonContracts }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center transform hover:scale-105 transition duration-300">
        <h3 class="text-lg font-semibold text-gray-700">Kontrak Habis</h3>
        <p class="mt-2 text-4xl font-extrabold text-red-600">{{ $expiredContracts }}</p>
    </div>
</div>
