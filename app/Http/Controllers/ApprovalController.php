<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('approvals.index');
    }

    /**
     * Handle the approval of a contract. (Mostly handled by Livewire component)
     */
    public function approve(Request $request, Contract $contract): RedirectResponse
    {
        return redirect()->route('approvals.index')->with('message', 'Persetujuan berhasil diproses.');
    }
}