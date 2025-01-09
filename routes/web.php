<?php

use App\Http\Controllers\AccountsReceivableController;
use App\Http\Controllers\AccountsReceivablePaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(
    function () {
        Route::get('/', [UserController::class, 'login'])->name('auth.index');
        Route::post('/auth', [UserController::class, 'authenticate'])->name('auth.authenticate');
    }
);

Route::middleware('auth')->group(
    function () {
        Route::post('/auth/logout', [UserController::class, 'logout'])->name('auth.logout');
        Route::post('/auth/store', [UserController::class, 'store'])->name('auth.store');
        Route::delete('/auth/destroy', [UserController::class, 'destroy'])->name('auth.destroy');
        Route::get('/auth/register', [UserController::class, 'register'])->name('auth.reg');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/dashboard/overdue', [DashboardController::class, 'overDue'])->name('dashboard.overdue');
        Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('dashboard.users');

        Route::resource('/dashboard/customers', CustomerController::class);

        Route::resource('/dashboard/loan/receivable', AccountsReceivableController::class);
        Route::resource('/dashboard/payment/accounts_receive', AccountsReceivablePaymentController::class);
    }
);
