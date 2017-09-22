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


// Route::get('/test', function() {
// });

// Auth
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// Pages ===============

Route::group(['middleware' => ['auth']], function () {
	// Stalls
	Route::get('stalls/create', 'StallController@create')->name('stalls.create');
	Route::get('stalls/{stall}/edit', 'StallController@edit')->name('stalls.edit');

	// Edit profile
	Route::get('user/edit', 'UserController@edit')->name('users.edit');
});

// View user profile
Route::get('user/{name}', 'UserController@show')->name('users.show');

// Home
Route::get('/', function () {
    return view('home');
})->name('index');

// Search
Route::get('search', 'SearchController@index')->name('search.index');

// Stall page
Route::get('stalls/{stall}', 'StallController@show')->name('stalls.show');
Route::delete('stalls/{stall}/delete', 'StallController@destroy')->name('stalls.destroy');

// API ===============

Route::prefix('api')->group(function() {
	Route::prefix('v1')->group(function() {
		// StallItem
		Route::get('stall-items/search', 'StallItemController@search');

		// auth middleware
		Route::group(['middleware' => ['auth']], function () {
			// Stalls
			Route::post('stalls', 'StallController@store')->name('stalls.store');
			Route::put('stalls/{stall}', 'StallController@update')->name('stalls.update');

			// Users
			Route::post('users/{id}', 'UserController@update')->name('users.update');
			Route::post('users/{id}/igns', 'UserController@storeIgn')->name('users.storeIgn');
			Route::delete('users/{id}/igns/{ignId}', 'UserController@deleteIgn')->name('users.deleteIgn');

			// Stall Items
			Route::delete('stall-items/{stallItemId}', 'StallItemController@destroy')->name('stall_items.destroy');
		});

		// Search RO items		
		Route::get('ro-items/search', 'RoItemController@search');

		// Stalls
		Route::get('stalls', 'StallController@index')->name('stalls.index');
		Route::get('stalls/search', 'StallController@search');
	});
});
