<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Route 1e page
Route::get('/', function () {
    return view('welcome');
});

Route::match(array('GET','POST'),'carte', 'APIController@displayRegion')->name('carte');;
Route::match(array('GET','POST'),'departement', 'APIController@displayDepartement')->name('departement');;

