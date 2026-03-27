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

    return redirect()->to(
        LaravelLocalization::getLocalizedURL($locale, null, [], true)
    );
})->name('locale.set');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'web',
        'localize',
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('/fetch/start', [FetchController::class, 'start'])->name('fetch.start');
    Route::get('/fetch/progress/{session}', [FetchController::class, 'progress'])->name('fetch.progress');
    Route::get('/fetch/status/{session}', [FetchController::class, 'status'])->name('fetch.status');

    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
});


Route::get('/debug-routes', function () {
    $routes = Route::getRoutes();
    $uris = collect($routes->getRoutes())->map(fn($r) => $r->uri());
    return response()->json($uris);
});
