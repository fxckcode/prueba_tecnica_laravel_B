<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUser;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PlacesController;

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
Route::apiResource('register', RegisterUser::class);

Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'loginUser')->name('login');
    Route::get('logout', 'logoutUser');
});

Route::apiResource('categories', CategoriesController::class);
Route::apiResource('places', PlacesController::class);