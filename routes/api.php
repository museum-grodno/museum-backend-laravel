<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\DictionariesController;

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

Route::middleware('auth:api')->group(function () {
    //Route::resource('posts', PostController::class);
    Route::resource('dictionaries', DictionariesController::class);
   /* Route::post('dictionaries',[DictionariesController::class,'store']);
    Route::get('dictionaries',[DictionariesController::class,'index']);*/
    Route::post('validate', [PassportAuthController::class, 'isValidToken']);
    Route::post('reset', [PassportAuthController::class, 'reset']);
});
