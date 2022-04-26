<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::group([
    'middleware' => 'api',
], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);


    // REGISTERS ROUTES
    Route::group(['middleware' => ['jwt.verify']], function() {
        // registers
        Route::get('registers', [RegistersController::class, 'getAll']);
        Route::get('register/{id}', [RegistersController::class, 'getOne']);
        Route::delete('register/{id}', [RegistersController::class, 'delete']);
        Route::post('register/valid/{id}', [RegistersController::class, 'valid']);
    });
        Route::post('register', [RegistersController::class, 'create']);

});


