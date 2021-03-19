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

Route::middleware(['auth'])->group(function(){
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/mensaje/crear', 'MensajeController@crear')->name('crear_mensaje');

	Route::post('/mensaje/crear','MensajeController@store')->name('store_mensaje');
	
	Route::get('/mensaje/responder/{id}', 'ResponderController@responder')->name('responder_mensaje');
	
	Route::post('/mensaje/responder/{id}','ResponderController@storeR')->name('store_responder');
	
	Route::get('/mensaje/show/{id}','MensajeController@show')->name('show_mensaje');
	
	Route::get('/mensaje/mandados','MensajeController@mandado')->name('mandado_mensaje');

	Route::get('/mensaje/recibidos','MensajeController@recibido')->name('recibido_mensaje');

	Route::delete('/mensaje/{id}','MensajeController@destroy')->name('eliminar_mensaje');

	Route::get('/post/crear', 'PostController@crear')->name('enviarPost');

	Route::post('/post/crear','PostController@store')->name('storePost');
	
	Route::get('/post/show/{id}','PostController@show')->name('showPost');
	
	Route::get('/post/recibidos','PostController@recibido')->name('recibidoPost');
	
	Route::get('markAsRead',function(){
		auth()->user()->unreadNotifications->markAsRead();
		return redirect()->back();
	})->name('markAsRead');
	
	Route::get('leido/{n_id}',function($n_id){
		$notificacion = auth()->user()->unreadNotifications;
		if(is_numeric($n_id)){
			$notifico = auth()->user()->readNotifications;
			foreach ($notifico as $no){
				if($no->data['mensaje'] == $n_id){
					return redirect(route('show_mensaje',$n_id));}
				}
			foreach ($notificacion as $noti){
				if($noti->data['mensaje'] == $n_id){
					$noti->markAsRead();
					return redirect(route('show_mensaje',$n_id));}
				}
			}
		else{
		foreach ($notificacion as $noti){
			if($noti->id == $n_id){
				$noti->markAsRead();
				return redirect(route('show_mensaje',$noti->data['mensaje']));}
				}
		}
		})->name('leido');
	
	Route::post('/markRead','MensajeController@markMensaje')->name('mark_Mensaje');
});

