<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\TeamDirectoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('team.index'));
Route::get('/team', [TeamDirectoryController::class, 'index'])->name('team.index');

Route::middleware(['auth', 'can:manage-sahayata'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/team', [TeamMemberController::class, 'index'])->name('team.index');
        Route::get('/team/create', [TeamMemberController::class, 'create'])->name('team.create');
        Route::post('/team', [TeamMemberController::class, 'store'])->name('team.store');
        Route::get('/team/{id}/edit', [TeamMemberController::class, 'edit'])->name('team.edit');
        Route::put('/team/{id}', [TeamMemberController::class, 'update'])->name('team.update');
        Route::delete('/team/{id}', [TeamMemberController::class, 'destroy'])->name('team.destroy');

        Route::get('/members', [MemberController::class, 'index'])->name('members.index');
        Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
        Route::post('/members', [MemberController::class, 'store'])->name('members.store');
        Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
        Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
    });
