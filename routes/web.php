<?php

use App\Http\Controllers\SubscriptionController;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/',function(){

        return view('dashboard');
    })->name('dashboard');

    // subscription routes
    Route::get('/subscriptions/{id}',[SubscriptionController::class,"checkout"])->name('checkout.subscription');
    Route::get('/success', [SubscriptionController::class,'success'])->name('checkout.success');
    Route::get('/cancel', [SubscriptionController::class,'cancel'])->name('checkout.cancel');
});
