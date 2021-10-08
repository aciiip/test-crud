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

    Route::group(['prefix' => 'item'], function () {
        Route::get('/', 'ItemController@index')->name('item');
        Route::get('/create', 'ItemController@create')->name('item_create');
        Route::get('/edit/{id}', 'ItemController@edit')->name('item_edit');
        Route::post('/action/{id?}', 'ItemController@formAction')->name('item_action');
        Route::get('/delete/{id?}', 'ItemController@destroy')->name('item_delete');
    });

    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/', 'UserTransactionController@index')->name('user_transaction');
        Route::get('/{id}/print', 'UserTransactionController@print')->name('print_transaction');
        Route::get('/{id}/download', 'UserTransactionController@download')->name('user_transaction_download');
    });

});
