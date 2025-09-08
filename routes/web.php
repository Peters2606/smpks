<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailboxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::post('/approvals/{contract}', [ApprovalController::class, 'approve'])->name('approvals.approve');

    Route::get('/mailbox', [MailboxController::class, 'index'])->name('mailbox.index');

    Route::get('/contracts/history', function () {
        return view('contracts.history');
    })->name('contracts.history');

    // Contract resource routes (index, create, store, edit, update, destroy)
    Route::resource('contracts', ContractController::class);

    // Profile routes from Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', function () {
        return view('admin.users.index');
    })->name('admin.users.index');
});

require __DIR__.'/auth.php';

Route::get('/livewire-config-check', function () {
    dd(config('livewire.temporary_file_upload'));
});
