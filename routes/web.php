<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ReportController::class, 'userDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/store', [ReportController::class, 'store'])->name('reports.store');

    Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
    Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
});

require __DIR__.'/auth.php';

Route::get('/admin/dashboard', [ReportController::class, 'adminIndex'])->middleware(['auth', 'admin'])->name('admin.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [ReportController::class, 'adminIndex'])->name('admin.index');
    Route::post('/admin/report/{id}/status', [ReportController::class, 'updateStatus'])->name('admin.report.status');
});


Route::get('/user/dashboard', [ReportController::class, 'userDashboard'])->middleware(['auth', 'verified'])->name('user.dashboard');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
