<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController ;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])
  ->middleware('auth:sanctum');
  Route::post('discresultstore',[UserAuthController::class,'discStoreResult']);
  Route::post('storeHolland',[UserAuthController::class,'storeHolland']);
  Route::post('storeThakaatResults',[UserAuthController::class,'storeThakaatResults']);
  Route::get('getLastDiscResult/{user_id}',[UserAuthController::class,'getLastDiscResult']);
  Route::get('getHollandResults/{user_id}',[UserAuthController::class,'getHollandResults']);
  Route::get('getThakaatResults/{user_id}',[UserAuthController::class,'getThakaatResults']);
