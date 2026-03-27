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

    return redirect(LaravelLocalization::getLocalizedURL($locale));
})->name('locale.set');

Route::group([
    'prefix' => LaravelLocalization::setLocale(), // automatically adds /en or /ar
    'middleware' => [
        'web',
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    // Home page
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Fetch endpoints
    Route::post('/fetch/start', [FetchController::class, 'start'])->name('fetch.start');
    Route::get('/fetch/progress/{session}', [FetchController::class, 'progress'])->name('fetch.progress');
    Route::get('/fetch/status/{session}', [FetchController::class, 'status'])->name('fetch.status');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
});

