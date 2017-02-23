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

Auth::routes();
Route::get('confirmation/{token}',['uses' => 'Auth\RegisterController@getConfirmation','as' => 'confirmation']);

Route::get('reset-password/{token}',['uses' => 'Auth\ResetPasswordController@reiniciarPassword','as' => 'reset-password']);

Route::group(['middleware' => 'auth'],function(){

    Route::get('/home', 'HomeController@index');

    Route::post('create-grupo',['uses' => 'GruposController@createGrupo','as' => 'grupos.create-grupo']);
    Route::get('find-grupo',['uses' => 'GruposController@findGrupo','as' => 'grupos.find-grupo']);
    Route::resource('grupos','GruposController');

    Route::get('estilos.all',['uses' => 'EstilosController@all','as' => 'estilos.all']);

});

