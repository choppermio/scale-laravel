<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScaleController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ThakaatController;
use App\Http\Controllers\HollandTestController;
use App\Http\Controllers\SchoolGroupController;



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



Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'users']);

    Route::get('schoolstoreing', [SchoolController::class, 'storeing'])->name('admin.schoolgroups.storing');
    Route::get('admin/schoolgroups', [SchoolGroupController::class, 'index'])->name('admin.schoolgroups.index');
    Route::get('admin/schoolgroups/create', [SchoolGroupController::class, 'create'])->name('admin.schoolgroups.create');
    Route::post('admin/schoolgroups', [SchoolGroupController::class, 'store'])->name('admin.schoolgroups.store');
    Route::get('admin/schoolgroups/{schoolgroup}', [SchoolGroupController::class, 'show'])->name('admin.schoolgroups.show');
    Route::get('admin/schoolgroups/{schoolgroup}/edit', [SchoolGroupController::class, 'edit'])->name('admin.schoolgroups.edit');
    Route::put('admin/schoolgroups/{schoolgroup}', [SchoolGroupController::class, 'update'])->name('admin.schoolgroups.update');
    Route::delete('admin/schoolgroups/{schoolgroup}', [SchoolGroupController::class, 'destroy'])->name('admin.schoolgroups.destroy');

    Route::resource('schools', SchoolController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
