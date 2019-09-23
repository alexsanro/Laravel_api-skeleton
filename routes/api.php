<?php

use Illuminate\Http\Request;

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

Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'AuthController@user');
    Route::get('logout', 'AuthController@logout');
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');
