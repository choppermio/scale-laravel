<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScaleController;
use App\Http\Controllers\HollandTestController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//create route get to scalecontroller holland
Route::get('/scale/holland', [ScaleController::class, 'holland'])->name('scale.holland');
Route::post('/holland-test', [HollandTestController::class, 'store']);
