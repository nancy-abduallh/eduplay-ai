<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\FetchController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('locale/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->to(LaravelLocalization::getLocalizedURL($locale, null, [], true));
})->name('locale.set');

// Routes for Arabic (with prefix)
Route::group([
    'prefix' => 'ar',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.ar');
    Route::post('/fetch/start', [FetchController::class, 'start'])->name('fetch.start.ar');
    Route::get('/fetch/progress/{session}', [FetchController::class, 'progress'])->name('fetch.progress.ar');
    Route::get('/fetch/status/{session}', [FetchController::class, 'status'])->name('fetch.status.ar');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index.ar');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show.ar');
});

// Routes for English (no prefix)
Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/fetch/start', [FetchController::class, 'start'])->name('fetch.start');
    Route::get('/fetch/progress/{session}', [FetchController::class, 'progress'])->name('fetch.progress');
    Route::get('/fetch/status/{session}', [FetchController::class, 'status'])->name('fetch.status');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
});
