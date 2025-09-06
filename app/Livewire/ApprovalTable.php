<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contract;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ApprovalTable extends Component
{
    use WithPagination;

    public $search = '';

    protected $pollingInterval = 30000; // Poll every 30 seconds (30000 ms)

    public function approve($contractId)
    {
        $contract = Contract::find($contractId);
        if (!$contract) {
            session()->flash('error', 'Kontrak tidak ditemukan.');
            return;
        }

        $this->authorize('approve', $contract);

        $userRole = Auth::user()->role;
        $approvalField = "{$userRole}_approved_at";

        if ($contract->$approvalField !== null) {
            session()->flash('error', 'Anda sudah menyetujui kontrak ini.');
            return;
        }

        $contract->update([$approvalField => now()]);
        session()->flash('message', 'Kontrak berhasil disetujui oleh ' . ucfirst($userRole) . '.');
    }

    public function revertApproval($contractId)
    {
        $contract = Contract::find($contractId);
        if (!$contract) {
            session()->flash('error', 'Kontrak tidak ditemukan.');
            return;
        }

        $this->authorize('approve', $contract);

        $userRole = Auth::user()->role;
        $approvalField = "{$userRole}_approved_at";

        if ($contract->$approvalField === null) {
            session()->flash('error', 'Kontrak ini belum disetujui oleh Anda.');
            return;
        }

        // Check if within 20-minute grace period
        $approvedAt = Carbon::parse($contract->$approvalField);
        if ($approvedAt->diffInMinutes(now()) > 20) {
            session()->flash('error', 'Periode pembatalan (20 menit) telah berakhir.');
            return;
        }

        $contract->update([$approvalField => null]);
        session()->flash('message', 'Persetujuan berhasil dibatalkan oleh ' . ucfirst($userRole) . '.');
    }

    public function render()
    {
        $contracts = Contract::query()
            ->with('contractFiles')
            ->where('is_new_contract', true)
            ->where(function ($query) {
                $query->whereNull('admin_approved_at')
                      ->orWhereNull('legal_approved_at')
                      ->orWhereNull('marketing_approved_at');
            })
            ->when($this->search, function ($query) {
                $query->where('pks_number_partner', 'like', '%' . $this->search . '%')
                      ->orWhere('pks_number_hospital', 'like', '%' . $this->search . '%')
                      ->orWhere('contract_name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.approval-table', [
            'contracts' => $contracts,
        ]);
    }
}