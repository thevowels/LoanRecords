<?php

use App\Http\Controllers\TransactionApiController;
use App\Http\Controllers\UserInfoApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/transactions', TransactionApiController::class)->name('transactions');
    Route::get('/userinfo', UserInfoApiController::class )->name('users.info');
});
