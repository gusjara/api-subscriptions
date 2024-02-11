<?php

use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\PlanController;
use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Api\V1\SubscriptionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// planes
Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
Route::get('/plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');

// clientes
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

// propiedades
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// suscripcion
Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscriptions.show');
Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');

// pagos
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show.by.id');
Route::get('/payments/code/{code}', [PaymentController::class, 'showByCode'])->name('payments.show.by.code');
Route::get('/payments/{payment}/amounts', [PaymentController::class, 'amountsQuantityById'])->name('payments.amounts.quantity.id');
Route::get('/payments/code/{code}/amounts', [PaymentController::class, 'amountsQuantityByCode'])->name('payments.amounts.quantity.code');
