<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('throttle:4,1')->group(function () {
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('register', [AuthenticationController::class, 'register']);
});

Route::middleware(['auth:sanctum', 'throttle:10,1'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('user', [AuthenticationController::class, 'user']);
        Route::post('logout', [AuthenticationController::class, 'logout']);
        Route::post('update', [AuthenticationController::class, 'update']);
        Route::post('verify/send', [VerificationController::class, 'send'])->name('auth.verify.send')->middleware('throttle:1,1');
        Route::post('verify/check', [VerificationController::class, 'check'])->name('auth.mail.verify');
    });
    Route::middleware('verified', 'throttle:3,1')->group(function () {
        Route::post('withdraw', [UserController::class, 'withdraw']);
        Route::post('deposit', [UserController::class, 'deposit']);
    });
    Route::get('transactions', [UserDashboardController::class, 'transactions']);
    Route::post('support', [SupportController::class, 'store'])->middleware('throttle:3,1');
    Route::get('tickets', [UserController::class, 'tickets']);
});
