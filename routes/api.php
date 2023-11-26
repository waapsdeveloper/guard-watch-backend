<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\SpaceController;

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

    Route::get('/list', [ContactController::class, 'list'] );
    Route::get('/by-id/{id}', [ContactController::class, 'byId'] );
    Route::post('/add', [ContactController::class, 'add'] );
    Route::post('/edit/{id}', [ContactController::class, 'edit'] );
    Route::delete('/delete/{id}', [ContactController::class, 'delete'] );

});

Route::group(['prefix' => 'spaces', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [SpaceController::class, 'list'] );
    Route::get('/by-id/{id}', [SpaceController::class, 'byId'] );
    Route::post('/add', [SpaceController::class, 'add'] );
    Route::post('/edit/{id}', [SpaceController::class, 'edit'] );
    Route::delete('/delete/{id}', [SpaceController::class, 'delete'] );

});
