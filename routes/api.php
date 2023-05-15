<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use GuzzleHttp\Middleware;
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

Route::group(['middleware' => ['auth:sanctum', 'App\Http\Middleware\AdminAuth']], function(){
    Route::resource('/team',TeamController::class);
    Route::resource('/player',PlayerController::class);
    Route::get('safe', [TeamController::class,'safe']);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'registration']);
Route::get('unauth', [TeamController::class, 'unauthResponse'])->name('login');



/**
 * This Controller can use to operation on Team
 */

/**
 * This Controller can use to get details for player and Team
 */
Route::get('/Player/getDetail',[PlayerController::class,'getTeamName']);
// Route::get('/Player/get',[PlayerController::class,'getData']);

/**
 * This Controller can use to operation on Player
 */














