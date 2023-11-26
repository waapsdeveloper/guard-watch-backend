<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContactController;

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



Route::group(['prefix' => 'auth'], function () {

    Route::post('/register', [AuthController::class, 'register'] );
    Route::post('/login', [AuthController::class, 'login'] );
    Route::post('/forget-password', [AuthController::class, 'forgetPassword'] );
    Route::post('/verify-forget-password', [AuthController::class, 'verifyForgetPassword'] );

});

Route::group(['prefix' => 'contacts', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [ContactController::class, 'contactList'] );
    Route::get('/by-id/{id}', [ContactController::class, 'contactById'] );
    Route::post('/add', [ContactController::class, 'contactAdd'] );
    Route::post('/edit/{id}', [ContactController::class, 'contactEdit'] );
    Route::delete('/delete/{id}', [ContactController::class, 'contactDelete'] );

});
