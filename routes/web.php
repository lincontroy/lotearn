<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\BotsController;
use App\Http\Controllers\MarketsController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('api/process-card-payment', [PaymentController::class, 'processCardPayment']);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/deposit', [DepositsController::class, 'index'])->name('deposit.create');
    Route::get('/markets', [MarketsController::class, 'index'])->name('markets.create');
    Route::get('/bt-1', [MarketsController::class, 'bt1'])->name('running');
    Route::get('/bt-2', [MarketsController::class, 'bt2'])->name('running2');
    Route::get('/bots', [BotsController::class, 'index'])->name('bots.create');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/withdraw', function () {
        return view('withdraw');
    })->name('withdraw');
    
    Route::post('/withdraw/crypto', [WithdrawalController::class, 'cryptoWithdrawal']);
    Route::post('/withdraw/bank', [WithdrawalController::class, 'bankWithdrawal']);
    Route::post('/withdraw/mpesa', [WithdrawalController::class, 'mpesaWithdrawal']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
    Route::post('/api/update-wallet-balance', [WalletController::class, 'updateBalance']);
    Route::get('/api/wallet-balance', [WalletController::class, 'getBalance']);
});

Route::get('/auth', function () {
    return view('auth.auth');
})->name('custom.auth');

require __DIR__.'/auth.php';
