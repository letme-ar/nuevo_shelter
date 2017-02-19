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

Route::get('/home', 'HomeController@index');


Route::get('confirmation/{token}',['uses' => 'Auth\RegisterController@getConfirmation','as' => 'confirmation']);

Route::get('reset-password/{token}',['uses' => 'Auth\ResetPasswordController@reiniciarPassword','as' => 'reset-password']);
