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

Route::get('/login', 'UserController@login')->name('login');
Route::post('/login/action', 'UserController@loginAction')->name('loginAction');
Route::get('/logout', 'UserController@logout')->name('logout');

Route::group(['middleware' => ['user_auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/create', 'HomeController@create')->name('create');
    Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
    Route::post('/action/{id?}', 'HomeController@formAction')->name('formAction');
    Route::get('/delete/{id?}', 'HomeController@destroy')->name('delete');
});
