<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Kontrak') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Stats Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <livewire:dashboard-stats />
            </div>

            <!-- Contracts Table Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Daftar Kontrak</h3>
                    <livewire:contracts-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>