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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mensaje/crear', 'MensajeController@crear')->name('crear_mensaje');

Route::post('/mensaje/crear','MensajeController@store')->name('store_mensaje');

Route::delete('/mensaje/{id}','MensajeController@destroy')->name('eliminar_mensaje');
