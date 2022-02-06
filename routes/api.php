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
//die("hoa");
Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login')->name('login');
Route::get('login', 'AuthController@login');

/*Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'Auth\PassportController@logout');
    Route::middleware('auth:api')->get('user', 'Auth\PassportController@user');
  });

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'AuthController@user');
    Route::get('logout', 'AuthController@logout');
});
*/

Route::fallback(function () {
    return response()->json(['message' => 'Not Found.123'], 404);
})->name('api.fallback.404');
