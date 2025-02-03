<?php

use App\Http\Controllers\AccumulatedDepreciationController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepreciationController;
use App\Http\Controllers\FixedAssetController;
use App\Http\Controllers\HistoryTransactionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('login', [AuthController::class, 'login']);

    Route::get('register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('locations', LocationController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('fixed_assets', FixedAssetController::class);
    Route::resource('accumulated_depreciations', AccumulatedDepreciationController::class);
    Route::resource('depreciations', DepreciationController::class);
    Route::resource('assets-sagara', AssetController::class);
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('transactions/{id}/depreciate', [TransactionController::class, 'depreciate'])->name('transactions.depreciate');
    Route::get('histories', [HistoryTransactionController::class, 'index'])->name('histories.index');
    Route::get('histories/{id}', [HistoryTransactionController::class, 'show'])->name('histories.show');
});
