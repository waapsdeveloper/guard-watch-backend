<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\SpaceController;
use App\Http\Controllers\API\InvitesController;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\VehiclesController;
use App\Http\Controllers\API\QrcodeController;



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
    Route::get('/details/by-id/{id}', [SpaceController::class, 'getSpaceDetailsById'] );


});


Route::group(['prefix' => 'invites', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [InvitesController::class, 'list'] );
    Route::get('/by-id/{id}', [InvitesController::class, 'byId'] );
    Route::post('/add', [InvitesController::class, 'add'] );
    Route::post('/edit/{id}', [InvitesController::class, 'edit'] );
    Route::delete('/delete/{id}', [InvitesController::class, 'delete'] );

    Route::get('/list/by-space-id/{id}', [InvitesController::class, 'getInvitesBySpaceId'] );

});


Route::group(['prefix' => 'events', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [EventsController::class, 'list'] );
    Route::get('/by-id/{id}', [EventsController::class, 'byId'] );
    Route::post('/add', [EventsController::class, 'add'] );
    Route::post('/edit/{id}', [EventsController::class, 'edit'] );
    Route::delete('/delete/{id}', [EventsController::class, 'delete'] );

});



Route::group(['prefix' => 'vehicles', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [VehiclesController::class, 'list'] );
    Route::get('/by-id/{id}', [VehiclesController::class, 'byId'] );
    Route::post('/add', [VehiclesController::class, 'add'] );
    Route::post('/edit/{id}', [VehiclesController::class, 'edit'] );
    Route::delete('/delete/{id}', [VehiclesController::class, 'delete'] );

});

Route::group(['prefix' => 'qrcode', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [QrcodeController::class, 'list'] );
    Route::get('/by-id/{id}', [QrcodeController::class, 'byId'] );
    Route::post('/add', [QrcodeController::class, 'add'] );
    Route::post('/edit/{id}', [QrcodeController::class, 'edit'] );
    Route::delete('/delete/{id}', [QrcodeController::class, 'delete'] );

});

