<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contract;
use App\Models\ContractFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ContractForm extends Component
{
    use WithFileUploads;

    public $contractId;
    public $pks_number_partner;
    public $pks_number_hospital;
    public $contract_name;
    public $start_date;
    public $end_date;
    public $is_new_contract = true;
    public $tariff_year; // Add this property
    public $files = [];
    public $existingFiles = []; // To display and manage already uploaded files

    protected $rules = [
        'pks_number_partner' => 'required|string|max:255',
        'pks_number_hospital' => 'required|string|max:255',
        'contract_name' => 'required|string|max:255',
        'start_date' => 'required|string',
        'end_date' => 'required|string',
        'is_new_contract' => 'boolean',
        'tariff_year' => 'nullable|integer|min:1900|max:2100', // Add validation rule
        'files.*' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max per file
    ];

    public function mount($contract = null)
    {
        if ($contract) {
            $this->contractId = $contract->id;
            $this->pks_number_partner = $contract->pks_number_partner;
            $this->pks_number_hospital = $contract->pks_number_hospital;
            $this->contract_name = $contract->contract_name;
            $this->start_date = $contract->start_date->format('Y-m-d');
            $this->end_date = $contract->end_date->format('Y-m-d');
            $this->is_new_contract = $contract->is_new_contract;
            $this->tariff_year = $contract->tariff_year; // Load tariff_year
            $this->existingFiles = $contract->contractFiles->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        // Manually validate date format and convert to Carbon instances
        try {
            $startDate = Carbon::parse($this->start_date);
            $endDate = Carbon::parse($this->end_date);
        } catch (\Exception $e) {
            $this->addError('start_date', 'Format tanggal mulai tidak valid.');
            $this->addError('end_date', 'Format tanggal berakhir tidak valid.');
            return;
        }

        // Add custom validation for after_or_equal
        if ($endDate->lessThan($startDate)) {
            $this->addError('end_date', 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.');
            return;
        }

        $data = [
            'pks_number_partner' => $this->pks_number_partner,
            'pks_number_hospital' => $this->pks_number_hospital,
            'contract_name' => $this->contract_name,
            'start_date' => $startDate, // Use Carbon instance
            'end_date' => $endDate,     // Use Carbon instance
            'is_new_contract' => $this->is_new_contract,
            'tariff_year' => $this->tariff_year, // Save tariff_year
            'user_id' => Auth::id(), // Assign current user as creator
        ];

        if ($this->contractId) {
            $contract = Contract::find($this->contractId);
            $contract->update($data);
            session()->flash('message', 'Kontrak berhasil diperbarui.');
        } else {
            $contract = Contract::create($data);
            session()->flash('message', 'Kontrak berhasil ditambahkan.');
        }

        // Handle file uploads
        foreach ($this->files as $file) {
            $path = $file->store('contract_files', 'public'); // Store in storage/app/public/contract_files
            $contract->contractFiles()->create([
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
            ]);
        }

        $this->files = []; // Clear uploaded files after saving

        return redirect()->route('dashboard'); // Redirect to dashboard after save
    }

    public function deleteFile($fileId)
    {
        $contractFile = ContractFile::find($fileId);
        if ($contractFile) {
            Storage::disk('public')->delete($contractFile->file_path);
            $contractFile->delete();
            $this->existingFiles = array_filter($this->existingFiles, fn($file) => $file['id'] !== $fileId);
            session()->flash('message', 'File berhasil dihapus.');
        }
    }

    public function render()
    {
        return view('livewire.contract-form');
    }
}