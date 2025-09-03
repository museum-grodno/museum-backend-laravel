<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\DictionariesController;
use App\Http\Controllers\RequestTourInfoController;
use App\Http\Controllers\TimetableLockController;

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
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::get('request-tour-info',[RequestTourInfoController::class,'index']);
Route::get('request-tour-info/{id}',[RequestTourInfoController::class,'show']);
Route::post('request-tour-add',[RequestTourInfoController::class,'create']);
Route::get('request-tour-branch',[RequestTourInfoController::class,'getAllBranch']);
Route::get('request-tour-lock',[TimetableLockController::class,'getAllLock']);
Route::get('date-is-lock/{objectId}/{dateInfo}',[TimetableLockController::class,'DateIslock']);
Route::get('tour-status-update/{id}/{status}',[RequestTourInfoController::class,'UpdateEventInfoStatus']);


Route::middleware('auth:api')->group(function () {
    Route::get('request-tour-full-event',[RequestTourInfoController::class,'viewFullEvent']);
    Route::post('tour-interval-add',[TimetableLockController::class,'AddInterval']);

    //Route::resource('posts', PostController::class);
   //  Route::resource('dictionaries', DictionariesController::class);
   /* Route::post('dictionaries',[DictionariesController::class,'store']);
    Route::get('dictionaries',[DictionariesController::class,'index']);*/
    Route::post('validate', [PassportAuthController::class, 'isValidToken']);
    Route::post('reset', [PassportAuthController::class, 'reset']);
});
