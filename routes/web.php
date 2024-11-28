<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiscController;
use App\Http\Controllers\HollandTestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScaleController;
use App\Http\Controllers\ThakaatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//create route get to scalecontroller holland
Route::get('/scale/holland', [ScaleController::class, 'holland'])->name('scale.holland');
Route::post('/holland-test', [HollandTestController::class, 'store'])->name('holland-test.store');

Route::get('/thakaat-test', [ThakaatController::class, 'index']);

Route::post('/thakaat-answers-store', [ThakaatController::class, 'storeAnswers'])->name('thakaat.answers.store');
Route::post('/store-thakaat-results', [ThakaatController::class, 'storeResults'])->name('thakaat.results.store');




Route::get('/disc-test', [DiscController::class, 'index']);

Route::post('/disc-store-result', [DiscController::class, 'discStoreResult'])->name('disc.store.result');
Route::post('/disc-store-answers', [DiscController::class, 'submitDiscAnswers'])->name('disc.store.answers');



Route::get('/admin/users', [AdminController::class, 'users']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
