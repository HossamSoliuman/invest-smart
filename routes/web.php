<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TempFileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\IpUtils;

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
    Route::post('transactions/status', [TransactionController::class, 'changeStatus'])->name('transactions.status');
    Route::apiResource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);
    Route::get('support', [SupportController::class, 'index'])->name('support.index');
    Route::get('support/{support}/{status}', [SupportController::class, 'updateStatus'])->name('support.update-status');
    Route::get('support/{support}', [SupportController::class, 'show'])->name('support.show');
    Route::post('/users/{id}/verify', [UserController::class, 'verify'])->name('users.verify');
});

Route::get('test', function () {

    return view('test');
});

Route::post('test', function (Request $request) {
    $recaptchaToken = $request->input('g-recaptcha-response');

    $contr = new AuthenticationController();
    return $contr->validateRecaptcha($recaptchaToken);
});
