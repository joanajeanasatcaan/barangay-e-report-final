<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

// Update this route to use the controller
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
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [ReportController::class, 'adminDashboard'])->middleware(['auth', 'admin']);

// Add new routes for admin to update report status (these were missing)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/report/{id}/status', [ReportController::class, 'updateStatus'])->name('admin.report.status');
});

// Add route for user dashboard (if you want to keep /dashboard but redirect to reports)
// This is optional and can be removed if you consolidate everything into /dashboard
Route::get('/user/dashboard', [ReportController::class, 'userDashboard'])->middleware(['auth', 'verified'])->name('user.dashboard');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
