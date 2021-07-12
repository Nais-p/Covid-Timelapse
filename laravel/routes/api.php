<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getall', 'APIController@get_all');

Route::prefix('region')->group(function () {
    Route::get('{date}', 'APIController@get_date');
    Route::get('{region}/{date}', 'APIController@get_region');
    Route::get('closest/{region}/{date}', 'APIController@get_region_closest');
});

Route::prefix('dep')->group(function () {
    Route::get('{date}', 'APIController@get_date_dep');
    Route::get('{region}/{date}', 'APIController@get_dep');
    Route::get('closest/{region}/{date}', 'APIController@get_dep_closest');
    Route::get('deaths/{region}/{date}', 'APIController@get_dep_deaths');
});


Route::prefix('current')->group(function () {
    Route::get('/dep/{dep}', 'APIController@get_current_dep');
    Route::get('/reg/{region}', 'APIController@get_current_reg');
});