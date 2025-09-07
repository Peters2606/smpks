<?php

namespace App\Livewire;

use App\Models\Contract;
use Livewire\Component;
use Livewire\WithPagination;

class ContractHistoryTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $contracts = Contract::query()
            ->when($this->search, function ($query) {
                $query->where('contract_name', 'like', '%' . $this->search . '%')
                      ->orWhere('pks_number_partner', 'like', '%' . $this->search . '%')
                      ->orWhere('pks_number_hospital', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.contract-history-table', [
            'contracts' => $contracts,
        ]);
    }
}