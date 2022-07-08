<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RegisterClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class ,'login']);
    Route::post('signup', [AuthController::class,'signUp']);

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class ,'logout']);
        Route::get('user', [AuthController::class ,'user']);

        /**********  Vehicle Type ************/
        Route::post('vehicletype_store', [VehicleTypeController::class ,'store']);
        Route::get('vehicletype_list', [VehicleTypeController::class ,'index']);

        /**********  Client ************/
          Route::post('clients', [ClientController::class ,'store']);
          Route::get('clients', [ClientController::class ,'index']);
          Route::put('clients/{id}', [ClientController::class ,'update']);
          Route::delete('clients/{id}', [ClientController::class ,'update']);

        /**********  Vehicles ************/
        Route::post('vehicles', [VehicleController::class ,'store']);
        Route::get('vehicles', [VehicleController::class ,'index']);
        Route::put('vehicles/{id}', [VehicleController::class ,'update']);
        Route::delete('vehicles/{id}', [VehicleController::class ,'update']);

        /**********  Registers ************/
        Route::post('registers', [RegisterClientController::class ,'store']);
        Route::get('registers', [RegisterClientController::class ,'index']);
        Route::put('registers/{id}', [RegisterClientController::class ,'update']);
    });
});