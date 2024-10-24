<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TempFileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false
]);

Route::post('temp/store', [TempFileController::class, 'store'])->name('upload');
Route::middleware('auth', 'admin')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::apiResource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);
});
