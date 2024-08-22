<?php

use App\Http\Controllers\BallanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});
// Route::middleware('auth:api')->group(function () {
Route::resource('transactions', TransactionController::class);
// });

Route::get('/balance-converted', function() {
    $balance = auth()->user()->transactions()->sum('amount');
    $convertedBalance = convertCurrency($balance, 'USD'); // Example for USD

    return response()->json(['balance' => $convertedBalance]);
});


Route::get('/balance', [BallanceController::class, 'show'])->middleware('auth');
