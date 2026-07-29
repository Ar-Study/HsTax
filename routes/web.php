<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HstaxController as AdminHstaxController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;

Route::get('/', [FrontController::class, 'index']);
Route::get('/berita/{slug}', [FrontController::class, 'showNews'])->name('news.detail');
Route::post('/berita/{newsId}/komentar', [FrontController::class, 'storeComment'])->name('news.comment');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CMS - Halaman Depan
        Route::prefix('cms')->name('cms.')->group(function () {
            Route::get('/', [AdminHstaxController::class, 'index'])->name('index');
            Route::get('/company', [AdminHstaxController::class, 'company'])->name('company');
            Route::post('/company', [AdminHstaxController::class, 'updateCompany'])->name('update-company');
            Route::get('/contact', [AdminHstaxController::class, 'contact'])->name('contact');
            Route::post('/contact', [AdminHstaxController::class, 'updateContact'])->name('update-contact');
            Route::get('/social', [AdminHstaxController::class, 'social'])->name('social');
            Route::post('/social', [AdminHstaxController::class, 'updateSocial'])->name('update-social');
            Route::get('/services', [AdminHstaxController::class, 'services'])->name('services');
            Route::post('/services', [AdminHstaxController::class, 'updateServices'])->name('update-services');
        });

        // Packages
        Route::resource('/packages', AdminPackageController::class);

        // Testimonials
        Route::resource('/testimonials', AdminTestimonialController::class);

        // FAQs
        Route::resource('/faqs', AdminFaqController::class);

        // News
        Route::resource('/news', AdminNewsController::class)->except(['show']);

        // Comments
        Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
        Route::get('/comments/{comment}', [AdminCommentController::class, 'show'])->name('comments.show');
        Route::put('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
        Route::put('/comments/{comment}/reject', [AdminCommentController::class, 'reject'])->name('comments.reject');
        Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
    });
});

require __DIR__ . '/auth.php';
