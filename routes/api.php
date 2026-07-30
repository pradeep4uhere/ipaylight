<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GeneralAPIController;

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




Route::prefix('api')->group(function () {
    Route::get('/test', function(){ return dd("Test API"); } );
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::prefix('v1')->group(function () {
//     Route::get('/inactivestatuslist', [GeneralAPIController::class, 'getInactiveStatusList'])
//     ->name('inactivestatuslist');
// });

// Route::middleware(['auth','role:admin','auth:sanctum'])->prefix('v1')->group(function () {
//     Route::get('/inactivestatuslist', [GeneralAPIController::class, 'getInactiveStatusList'])
//                 ->name('inactivestatuslist');
// });





