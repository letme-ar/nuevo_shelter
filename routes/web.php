<?php

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
    return view('welcome');
});

Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getView']);
Auth::routes();
Route::get('confirmation/{token}',['uses' => 'Auth\RegisterController@getConfirmation','as' => 'confirmation']);

Route::get('reset-password/{token}',['uses' => 'Auth\ResetPasswordController@reiniciarPassword','as' => 'reset-password']);

Route::group(['middleware' => 'auth'],function(){

    Route::get('/home', 'HomeController@index');

    Route::get('grupos.getDataGrupo',['uses' => 'GruposController@getDataGrupo','as' => 'grupos.getDataGrupo']);
    Route::get('grupos.listImport',['uses' => 'GruposController@listImport','as' => 'grupos.listImport']);
    Route::post('create-grupo',['uses' => 'GruposController@createGrupo','as' => 'grupos.create-grupo']);
    Route::get('buscar',['uses' => 'GruposController@buscar','as' => 'grupos.buscar']);
    Route::get('find-grupo',['uses' => 'GruposController@findGrupo','as' => 'grupos.find-grupo']);
    Route::resource('grupos','GruposController');

    Route::get('estilos.all',['uses' => 'EstilosController@all','as' => 'estilos.all']);

    Route::get('master/{id}',['uses' => 'Controller@redirect','as' => 'master']);

    Route::get('usersxnegocio',['uses' => 'NegociosController@usersxnegocio','as' => 'usersxnegocio']);
    Route::get('negocio',['uses' => 'NegociosController@showMyNegocio','as' => 'negocio']);
    Route::post('negocio.update',['uses' => 'NegociosController@update','as' => 'negocio.update']);


    Route::get('profile',['uses' => 'AccountController@showMyProfile','as' => 'profile']);
    Route::post('account.update',['uses' => 'AccountController@update','as' => 'account.update']);

    Route::resource('users','UsersController');
});

