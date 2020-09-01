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

Route::get('/', ['uses' => 'FormController@home', 'as' => 'home']);
Route::post('/', ['uses' => 'FormController@access', 'as' => 'access.post']);
Route::post('password', ['uses' => 'FormController@password', 'as' => 'password']);

Auth::routes();
Route::get('logout', ['uses' => 'Auth\LoginController@logout' , 'as' => 'logout']);
Route::group(['middleware' => ['auth', 'role:root'], 'prefix' => 'root'], function() {
    Route::get('/', ['uses' => 'HomeController@index' , 'as' => 'root']);
    Route::match(['post', 'get'], 'forms', ['uses' => 'HomeController@forms' , 'as' => 'forms']);
    Route::match(['post', 'get'], 'statements', ['uses' => 'HomeController@statements' , 'as' => 'statements']);
    Route::match(['post', 'get'], 'datos', ['uses' => 'HomeController@datos' , 'as' => 'datos']);
    Route::delete('file', ['uses' => 'Auth\BasicController@deleteFile', 'as' => 'deleteFile']);
    Route::post('edit', ['uses' => 'Auth\BasicController@edit', 'as' => 'edit']);
    Route::get('update', ['uses' => 'Auth\BasicController@update', 'as' => 'update.index']);
    Route::get('logs', ['uses' => 'HomeController@logs', 'as' => 'logs']);

    /**
     * Parameters
     */
    Route::get('parameters', ['uses' => 'ParameterController@index', 'as' => 'parameters.index']);
    Route::get('parameters/{parameter}', ['uses' => 'ParameterController@show', 'as' => 'parameters.show']);
    Route::post('parameters', ['uses' => 'ParameterController@store', 'as' => 'parameters.store']);
    Route::post('parameters/{parameter}', ['uses' => 'ParameterController@update', 'as' => 'parameters.update']);
    Route::delete('parameters/{parameter}', ['uses' => 'ParameterController@destroy', 'as' => 'parameters.destroy']);

    /**
     * Images
     */
    Route::get('images', ['uses' => 'ImageController@index', 'as' => 'images.index']);
    Route::get('images/{image}', ['uses' => 'ImageController@show', 'as' => 'images.show']);
    Route::post('images', ['uses' => 'ImageController@store', 'as' => 'images.store']);
    Route::post('images/{image}', ['uses' => 'ImageController@update', 'as' => 'images.update']);
    Route::delete('images/{image}', ['uses' => 'ImageController@destroy', 'as' => 'images.destroy']);

    /**
     * Users
     */
    Route::get('users', ['uses' => 'UserController@index', 'as' => 'users.index']);
    Route::get('clients', ['uses' => 'UserController@clients', 'as' => 'clients.index']);
    Route::get('users/{user}', ['uses' => 'UserController@show', 'as' => 'users.show']);
    Route::post('users', ['uses' => 'UserController@store', 'as' => 'users.store']);
    Route::post('users/{user}', ['uses' => 'UserController@update', 'as' => 'users.update']);
    Route::delete('users/{user}', ['uses' => 'UserController@destroy', 'as' => 'users.destroy']);
    Route::get('mis-datos', ['uses' => 'UserController@datos', 'as' => 'user.datos']);

    Route::post('user/change-password/{user}', ['uses' => 'UserController@password', 'as' => 'users.password']);
    /**
     * Helps
     */
    Route::get('helps', ['uses' => 'HelpController@index', 'as' => 'helps.index']);
    Route::get('helps/{help}', ['uses' => 'HelpController@show', 'as' => 'helps.show']);
    Route::post('helps', ['uses' => 'HelpController@store', 'as' => 'helps.store']);
    Route::post('helps/{help}', ['uses' => 'HelpController@update', 'as' => 'helps.update']);
    Route::delete('helps/{help}', ['uses' => 'HelpController@destroy', 'as' => 'helps.destroy']);

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

Route::group(['middleware' => ['auth', 'role:adm'], 'prefix' => 'adm'], function() {
    Route::get('/', ['uses' => 'HomeController@index' , 'as' => 'adm']);
});

Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'client'], function() {
    Route::get('/', ['uses' => 'HomeController@client' , 'as' => 'client']);

    Route::post('statements', ['uses' => 'FormController@statements' , 'as' => 'client.statements']);
});
