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

Route::middleware(['auth'])->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/mensaje/crear', 'MensajeController@crear')
		->name('crear_mensaje')->middleware('permission:create message');

	Route::post('/mensaje/crear', 'MensajeController@store')
		->name('store_mensaje')->middleware('permission:create message');

	Route::get('/mensaje/responder/{id}', 'ResponderController@responder')
		->name('responder_mensaje')->middleware('permission:create message');

	Route::post('/mensaje/responder/{id}', 'ResponderController@storeR')
		->name('store_responder')->middleware('permission:create message');

	Route::get('/mensaje/show/{id}', 'MensajeController@show')
		->name('show_mensaje')->middleware('permission:read message');

	Route::get('/mensaje/mandados', 'MensajeController@mandado')
		->name('mandado_mensaje')->middleware('permission:create message');

	Route::get('/mensaje/recibidos', 'MensajeController@recibido')
		->name('recibido_mensaje');

	Route::get('/mensaje/todo', 'MensajeController@todo')
		->name('all_mensaje')->middleware('role:admin');

	Route::delete('/mensaje/{id}', 'MensajeController@delete')
		->name('eliminar_mensaje');

	Route::delete('/mensaje/destroy/{id}', 'MensajeController@destroy')
		->name('destroy_mensaje')->middleware('permission:delete message');

	Route::get('/post/crear', 'PostController@crear')
		->name('enviarPost')->middleware('permission:create post');

	Route::post('/post/crear', 'PostController@store')
		->name('storePost')->middleware('permission:create post');

	Route::get('/post/show/{id}', 'PostController@show')
		->name('showPost')->middleware('permission:read post');

	Route::get('/post/destroy/{id}', 'PostController@destroy')
		->name('destroyPost')->middleware('permission:delete post');

	Route::get('/post/recibidos', 'PostController@recibido')
		->name('recibidoPost')->middleware('permission:read post');

	Route::get('/archivo/show/{id}', 'ArchivoController@show')
		->name('show_archivo')->middleware('permission:read message');

	Route::get('markAsRead', function () {
		auth()->user()->unreadNotifications->markAsRead();
		return redirect()->back();
	})->name('markAsRead');

	Route::get('leido/{n_id}', function ($n_id) {
		$notificacion = auth()->user()->unreadNotifications;
		if (is_numeric($n_id)) {
			$notifico = auth()->user()->readNotifications;
			foreach ($notifico as $no) {
				if ($no->data['mensaje'] == $n_id) {
					return redirect(route('show_mensaje', $n_id));
				}
			}
			foreach ($notificacion as $noti) {
				if ($noti->data['mensaje'] == $n_id) {
					$noti->markAsRead();
					return redirect(route('show_mensaje', $n_id));
				}
			}
			return redirect(route('show_mensaje', $n_id));
		} else {
			foreach ($notificacion as $noti) {
				if ($noti->id == $n_id) {
					$noti->markAsRead();
					return redirect(route('show_mensaje', $noti->data['mensaje']));
				}
			}
		}
	})->name('leido')->middleware('permission:read message');

	Route::post('/markRead', 'MensajeController@markMensaje')->name('mark_Mensaje');
});
