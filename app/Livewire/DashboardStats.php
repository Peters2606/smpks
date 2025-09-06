<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contract;

class DashboardStats extends Component
{
    public function render()
    {
        $allContracts = Contract::all();

        $totalContracts = $allContracts->count();
        $activeContracts = $allContracts->filter(fn($contract) => $contract->status === 'Aktif')->count();
        $expiringSoonContracts = $allContracts->filter(fn($contract) => $contract->status === 'Segera Habis')->count();
        $expiredContracts = $allContracts->filter(fn($contract) => $contract->status === 'Habis')->count();

        return view('livewire.dashboard-stats', [
            'totalContracts' => $totalContracts,
            'activeContracts' => $activeContracts,
            'expiringSoonContracts' => $expiringSoonContracts,
            'expiredContracts' => $expiredContracts,
        ]);
    }
}