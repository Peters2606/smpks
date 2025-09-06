<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContractController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse
    {
        // Redirect to dashboard as the main contract list is there
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Contract::class);
        return view('contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Livewire component handles the actual store logic
        // This method is just a placeholder for the route
        return redirect()->route('dashboard')->with('message', 'Kontrak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract): RedirectResponse
    {
        // Not explicitly requested, redirect to edit or dashboard
        return redirect()->route('contracts.edit', $contract);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract): View
    {
        $this->authorize('update', $contract);
        return view('contracts.edit', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract): RedirectResponse
    {
        $this->authorize('update', $contract);
        // Livewire component handles the actual update logic
        return redirect()->route('dashboard')->with('message', 'Kontrak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract): RedirectResponse
    {
        $this->authorize('delete', $contract);
        // Delete associated files from storage
        foreach ($contract->contractFiles as $file) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }
        $contract->delete();

        return redirect()->route('dashboard')->with('message', 'Kontrak berhasil dihapus.');
    }
}