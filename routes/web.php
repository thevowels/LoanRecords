<?php

use App\Models\Consumer;

use App\Http\Resources\ConsumerResource;

use App\Http\Controllers\ConsumerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/people', [ConsumerController::class, 'index'])->name('people.index');
    Route::get('/people/{consumer}', [ConsumerController::class, 'show'])->name('people.show')->where('consumer', '[0-9]+');
    Route::get('/people/create', [ConsumerController::class, 'create'])->name('people.create');
    Route::post('/people', [ConsumerController::class, 'store'])->name('people.store');



});


Route::get('/test', function () {
    return  ConsumerResource::make(Consumer::with('user')->find(1));
});
