<?php

use App\Http\Controllers\ApiGiveController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('/user_login', [ApiGiveController::class, 'login']);
    Route::post('/user_logout', [ApiGiveController::class, 'logout']);
    Route::post('/user_login_check', [ApiGiveController::class, 'login_session_check']);
    Route::post('/user_register', [ApiGiveController::class, 'register']);
    Route::post('/allbus', [ApiGiveController::class, 'allbus']);
    Route::post('/bus_reasult', [ApiGiveController::class, 'busresult']);
