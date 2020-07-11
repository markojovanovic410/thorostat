<?php

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

Route::group(['prefix' => 'auth'], function() {
  Route::post('/register', 'API\AuthController@register');
  Route::post('/login', 'API\AuthController@login');
  Route::post('/logout', 'API\AuthController@logout');
});

Route::middleware('auth:api')->group( function () {
  
});

Route::post('/track-colors', 'API\TrackController@track_colors');
Route::post('/track-codes', 'API\TrackController@track_codes');

Route::post('/upload-csv', 'API\UploadController@uploadCSV');

Route::group(['prefix' => 'race'], function() {
  Route::post('/getByParams', 'API\RaceController@getByParams');
});

Route::group(['prefix' => 'entry'], function() {
  Route::post('/getByParams', 'API\HorseController@getByParams');
  Route::post('/getDetails', 'API\HorseController@getDetails');
});

Route::group(['prefix' => 'workout'], function() {
  Route::post('/getByParams', 'API\WorkoutController@getByParams');
});

Route::group(['prefix' => 'past-performance'], function() {
  Route::post('/getByParams', 'API\HorseController@getByParams');
});

Route::group(['prefix' => 'user'], function() {
  Route::post('/add', 'API\UserController@store');
  Route::post('/update', 'API\UserController@update');
  Route::post('/delete', 'API\UserController@delete');
  Route::post('/getByParams', 'API\UserController@getByParams');
  Route::post('/uploadAvatar', 'API\UserController@uploadAvatar');
});