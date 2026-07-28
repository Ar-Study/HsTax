<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JamaahController as AdminJamaahController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\ProgramBudgetController as AdminProgramBudgetController;
use App\Http\Controllers\Admin\AssistanceApplicationController as AdminAssistanceApplicationController;
use App\Http\Controllers\Admin\DistributionController as AdminDistributionController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Jamaah\DashboardController as JamaahDashboardController;
use App\Http\Controllers\Jamaah\AssistanceApplicationController as JamaahAssistanceApplicationController;
use App\Http\Controllers\Jamaah\ProfileController as JamaahProfileController;

Route::get('/', function () {
    return view('hstax.index');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/jamaah', AdminJamaahController::class);

        Route::resource('/donations', AdminDonationController::class)->except(['show']);

        Route::resource('/programs', AdminProgramController::class)->except(['show']);
        Route::resource('/programs/{program}/budgets', AdminProgramBudgetController::class);

        Route::get('/applications', [AdminAssistanceApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/{application}', [AdminAssistanceApplicationController::class, 'show'])->name('applications.show');
        Route::put('/applications/{application}/verify', [AdminAssistanceApplicationController::class, 'verify'])->name('applications.verify');

        Route::resource('/distributions', AdminDistributionController::class)->except(['edit', 'update', 'destroy']);

        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/program', [AdminReportController::class, 'programReport'])->name('reports.program');
        Route::get('/reports/donation', [AdminReportController::class, 'donationReport'])->name('reports.donation');
        Route::get('/reports/assistance', [AdminReportController::class, 'assistanceReport'])->name('reports.assistance');
        Route::get('/reports/financial', [AdminReportController::class, 'financialReport'])->name('reports.financial');
    });

    Route::middleware(['role:jamaah'])->prefix('jamaah')->name('jamaah.')->group(function () {
        Route::get('/dashboard', [JamaahDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/applications', JamaahAssistanceApplicationController::class)->except(['edit', 'update', 'destroy']);
        Route::get('/profile', [JamaahProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [JamaahProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [JamaahProfileController::class, 'updatePassword'])->name('profile.password');
    });
});

require __DIR__ . '/auth.php';
