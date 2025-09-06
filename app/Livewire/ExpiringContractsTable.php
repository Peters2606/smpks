<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contract;
use Livewire\WithPagination;

class ExpiringContractsTable extends Component
{
    use WithPagination;

    public $filterDays = 90; // Default to 90 days

    public function render()
    {
        $contracts = Contract::query()
            ->where('end_date', '>=', now()) // Only future contracts
            ->where('end_date', '<=', now()->addDays((int)$this->filterDays))
            ->orderBy('end_date', 'asc')
            ->paginate(10);

        return view('livewire.expiring-contracts-table', [
            'contracts' => $contracts,
        ]);
    }
}