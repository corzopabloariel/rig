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
    Route::delete('file', ['uses' => 'Auth\BasicController@deleteFile', 'as' => 'deleteFile']);
    Route::post('edit', ['uses' => 'Auth\BasicController@edit', 'as' => 'edit']);
    Route::get('update', ['uses' => 'Auth\BasicController@update', 'as' => 'update.index']);

    /**
     * Helps
     */
    Route::get('helps', ['uses' => 'HelpController@index', 'as' => 'helps.index']);
    Route::get('helps/{helps}', ['uses' => 'HelpController@show', 'as' => 'helps.show']);
    Route::post('helps', ['uses' => 'HelpController@store', 'as' => 'helps.store']);
    Route::post('helps/{helps}', ['uses' => 'HelpController@update', 'as' => 'helps.update']);
    Route::delete('helps/{helps}', ['uses' => 'HelpController@destroy', 'as' => 'helps.destroy']);

    /**
     * Labels
     */
    Route::get('labels', ['uses' => 'LabelController@index', 'as' => 'labels.index']);
    Route::get('labels/{label}', ['uses' => 'LabelController@show', 'as' => 'labels.show']);
    Route::post('labels', ['uses' => 'LabelController@store', 'as' => 'labels.store']);
    Route::post('labels/{label}', ['uses' => 'LabelController@update', 'as' => 'labels.update']);
    Route::delete('labels/{label}', ['uses' => 'LabelController@destroy', 'as' => 'labels.destroy']);

    /**
     * Texts
     */
    Route::get('texts', ['uses' => 'TextController@index', 'as' => 'texts.index']);
    Route::get('texts/{text}', ['uses' => 'TextController@show', 'as' => 'texts.show']);
    Route::post('texts', ['uses' => 'TextController@store', 'as' => 'texts.store']);
    Route::post('texts/{text}', ['uses' => 'TextController@update', 'as' => 'texts.update']);
    Route::delete('texts/{text}', ['uses' => 'TextController@destroy', 'as' => 'texts.destroy']);

    /**
     * Operations
     */
    Route::get('operations', ['uses' => 'OperationController@index', 'as' => 'operations.index']);
    Route::get('operations/{operation}', ['uses' => 'OperationController@show', 'as' => 'operations.show']);
    Route::post('operations', ['uses' => 'OperationController@store', 'as' => 'operations.store']);
    Route::post('operations/{operation}', ['uses' => 'OperationController@update', 'as' => 'operations.update']);
    Route::delete('operations/{operation}', ['uses' => 'OperationController@destroy', 'as' => 'operations.destroy']);
});

Route::group(['middleware' => ['auth', 'role:adm'], 'prefix' => 'adm'], function() {});

Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'client'], function() {});
