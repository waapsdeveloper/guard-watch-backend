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
use App\Http\Controllers\API\InviteRequestController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\PackageUserController;
use App\Http\Controllers\API\PackageFacilityController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\Controller;

use App\Http\Controllers\API\InviteScanHistoryController;
// include ('Helper.php');
use App\Helpers\Helper;


Route::get('/generate-random-code', function () {
    $apiCode = Helper::generateRandomCode();
    return response()->json(['api_code' => $apiCode]);
});




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

    Route::get('/get-space-roles', [SpaceController::class, 'getSpaceRoles'] );
    Route::get('/get-space-admins/{id}', [SpaceController::class, 'getSpaceAdmins'] );
    Route::post('/add-space-admin', [SpaceController::class, 'addSpaceAdmin'] );
    Route::delete('/delete-space-admin/{id}', [SpaceController::class, 'deleteSpaceAdmin'] );
    Route::get('/get-my-moderation-spaces-by-user-id', [SpaceController::class, 'getMyModerationSpacesByUserId'] );

    Route::get('/get-global-spaces', [SpaceController::class, 'getGlobalSpaces'] );


});


Route::group(['prefix' => 'invites', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [InvitesController::class, 'list'] );
    Route::get('/received', [InvitesController::class, 'received'] );



    Route::get('/by-id/{id}', [InvitesController::class, 'byId'] );
    Route::post('/add', [InvitesController::class, 'add'] );
    Route::post('/scan-qrcode', [InvitesController::class, 'scanQrcode'] );
    Route::get('/by-id/{id}/scan-qr-code-with-contacts', [InvitesController::class, 'getScanQrcodeWithContacts'] );

    Route::post('/edit/{id}', [InvitesController::class, 'edit'] );
    Route::delete('/delete/{id}', [InvitesController::class, 'delete'] );
    Route::get('/by-id/{id}/with-contacts', [InvitesController::class, 'getInviteWithContacts'] );

    Route::get('/list/by-space-id/{id}', [InvitesController::class, 'getInvitesBySpaceId'] );
    Route::post('/delete-invite-contacts', [InvitesController::class, 'inviteContactsDelete'] );

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



Route::group(['prefix' => 'invite-scan-history', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [InviteScanHistoryController::class, 'list'] );
    Route::get('/by-id/{id}', [InviteScanHistoryController::class, 'byId'] );
    Route::post('/add', [InviteScanHistoryController::class, 'add'] );
    Route::post('/edit/{id}', [InviteScanHistoryController::class, 'edit'] );
    Route::delete('/delete/{id}', [InviteScanHistoryController::class, 'delete'] );

});




Route::group(['prefix' => 'invite-requests', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [InviteRequestController::class, 'list'] );
    Route::get('/by-id/{id}', [InviteRequestController::class, 'byId'] );
    Route::post('/add', [InviteRequestController::class, 'add'] );
    Route::post('/edit/{id}', [InviteRequestController::class, 'edit'] );
    Route::delete('/delete/{id}', [InviteRequestController::class, 'delete'] );
    Route::get('/list/space-invites/{id}', [InviteRequestController::class, 'getSpaceInvitesById'] );
    Route::post('/update-invite', [InviteRequestController::class, 'updateInviteRequest']);


});



Route::group(['prefix' => 'notifications', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [NotificationController::class, 'list'] );
    Route::post('/add', [NotificationController::class, 'add'] );
    Route::post('/edit/{id}', [NotificationController::class, 'edit'] );
    Route::delete('/delete/{id}', [NotificationController::class, 'delete'] );

});

Route::group(['prefix' => 'packages', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [PackageController::class, 'list'] );
    Route::post('/add', [PackageController::class, 'add'] );
    Route::post('/edit/{id}', [PackageController::class, 'edit'] );
    Route::delete('/delete/{id}', [PackageController::class, 'delete'] );
    Route::get('/list/get-bought-package', [PackageController::class, 'getBoughtPackage'] );

});



Route::group(['prefix' => 'package-users', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [PackageUserController::class, 'list'] );
    Route::post('/add', [PackageUserController::class, 'add'] );
    Route::post('/edit/{id}', [PackageUserController::class, 'edit'] );
    Route::delete('/delete/{id}', [PackageUserController::class, 'delete'] );

});



Route::group(['prefix' => 'package-facilities', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [PackageFacilityController::class, 'list'] );
    Route::post('/add', [PackageFacilityController::class, 'add'] );
    Route::post('/edit/{id}', [PackageFacilityController::class, 'edit'] );
    Route::delete('/delete/{id}', [PackageFacilityController::class, 'delete'] );

});




Route::group(['prefix' => 'profiles', 'middleware' => ['auth:api']], function () {

    Route::get('/list', [PackageFacilityController::class, 'list'] );
    Route::post('/add', [PackageFacilityController::class, 'add'] );
    Route::post('/edit/{id}', [PackageFacilityController::class, 'edit'] );
    Route::delete('/delete/{id}', [PackageFacilityController::class, 'delete'] );

});




