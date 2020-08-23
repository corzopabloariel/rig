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

Route::get('/', function () {
    return view('access');
});

Auth::routes();
Route::get('logout', ['uses' => 'Auth\LoginController@logout' , 'as' => 'logout']);
Route::group(['middleware' => ['auth', 'role:root'], 'prefix' => 'root'], function() {
    Route::get('/', ['uses' => 'HomeController@index' , 'as' => 'root']);

    /**
     * Helps
     */
    Route::get('helps', ['uses' => 'HelpController@index', 'as' => 'helps.index']);
    Route::get('helps/{helps}', ['uses' => 'HelpController@show', 'as' => 'helps.show']);
    Route::post('helps', ['uses' => 'HelpController@store', 'as' => 'helps.store']);
    Route::post('helps/{helps}', ['uses' => 'HelpController@update', 'as' => 'helps.update']);
    Route::delete('helps/{helps}', ['uses' => 'HelpController@destroy', 'as' => 'helps.destroy']);
});

Route::group(['middleware' => ['auth', 'role:adm'], 'prefix' => 'adm'], function() {});

Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'client'], function() {});
