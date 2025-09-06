<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contract;
use Livewire\WithPagination;

class ContractsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $filterTariffYear = ''; // Add this property

    protected $queryString = ['search', 'sortField', 'sortDirection', 'filterTariffYear'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        $contracts = Contract::query()
            ->with('contractFiles') // Eager load contractFiles
            ->when($this->search, function ($query) {
                $query->where('pks_number_partner', 'like', '%' . $this->search . '%')
                      ->orWhere('pks_number_hospital', 'like', '%' . $this->search . '%')
                      ->orWhere('contract_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterTariffYear, function ($query) {
                $query->where('tariff_year', $this->filterTariffYear);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10); // 10 items per page

        $availableTariffYears = Contract::select('tariff_year')
                                        ->distinct()
                                        ->orderBy('tariff_year', 'desc')
                                        ->pluck('tariff_year')
                                        ->filter() // Remove null values
                                        ->toArray();

        return view('livewire.contracts-table', [
            'contracts' => $contracts,
            'availableTariffYears' => $availableTariffYears,
        ]);
    }
}