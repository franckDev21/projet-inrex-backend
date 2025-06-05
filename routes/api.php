<?php

use App\Http\Controllers\Api\Auth\ForgotPasswordCustomerController;
use App\Http\Controllers\Api\Auth\LoginCustomerController;
use App\Http\Controllers\Api\Auth\LogoutCustomerController;
use App\Http\Controllers\Api\Auth\RegisterCustomerController;
use App\Http\Controllers\Api\Auth\ResetPasswordCustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Customer Authentication Routes
Route::post('/customer/register', [RegisterCustomerController::class, 'store'])->name('customer.register');
Route::post('/customer/login', [LoginCustomerController::class, 'store'])->name('customer.login');
Route::post('/customer/forgot-password', [ForgotPasswordCustomerController::class, 'sendResetLinkEmail'])->name('customer.password.email');
Route::post('/customer/reset-password', [ResetPasswordCustomerController::class, 'reset'])->name('customer.password.update');

Route::middleware('auth:customers')->group(function () { // Use 'customers' guard for Customer model
    Route::post('/customer/logout', [LogoutCustomerController::class, 'store'])->name('customer.logout');
    // Example of a protected route for authenticated customers
    Route::get('/customer/profile', function (Request $request) {
        return $request->user('customers'); // Ensure we get the customer user
    })->name('customer.profile');
});

// Default Sanctum user route (can be kept or removed if not used for 'users' model)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
