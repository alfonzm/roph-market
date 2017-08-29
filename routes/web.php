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


Route::get('/test', function() {
	return App\Server::first();
});

Route::get('/', function () {
    return view('home');
})->name('index');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'web'], function() {
});

// API
Route::prefix('api')->group(function() {
	Route::prefix('v1')->group(function() {
		Route::resource('stalls', 'StallController');
	});
});

Route::resource('stalls', 'StallController');