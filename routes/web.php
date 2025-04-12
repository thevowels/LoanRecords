<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

use App\Http\Resources\ConsumerResource;
use App\Models\Consumer;
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

    Route::middleware(['can:create-user'])->group(function () {

//        TODO: add another middle ware to convert the 403
        Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
        Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    });


    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/admin', AdminDashboardController::class)->name('admin');

    Route::get('/people', [ConsumerController::class, 'index'])->name('people.index');
    Route::get('/people/{consumer}', [ConsumerController::class, 'show'])->name('people.show')->where('consumer', '[0-9]+');
    Route::get('/people/create', [ConsumerController::class, 'create'])->name('people.create');
    Route::post('/people', [ConsumerController::class, 'store'])->name('people.store');
    Route::delete('/people/{consumer}', [ConsumerController::class, 'destroy'])->name('people.destroy');

    Route::resource('people.debts', DebtController::class)->shallow();
    Route::resource('debts.transactions', TransactionController::class)->shallow()->only(['store', 'show', 'update']);

});

