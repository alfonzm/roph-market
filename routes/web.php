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
	// return $stallItem = App\StallItem::create([
	// 	'stall_id' => 1,
	// 	'ro_item_id' => 500,
	// 	'price' => 200
	// ]);

	// return App\StallItem::with('roItem')->first();
	// return App\RoItem::with('type')->first();
	// return App\RoItemType::with('roItems')->first();

    $stall = App\Stall::create([
        'name' => 'nameee',
        'user_id' => Auth::id(),
        'server_id' => App\Server::first()->id,
    ]);

    return $stall;
});

Route::get('/', function () {
    return view('home');
})->name('index');


Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'web'], function() {
});

// Stall views
Route::get('stalls/create', 'StallController@create')->name('stalls.create');
Route::get('stalls/{stall}', 'StallController@show')->name('stalls.show');

// API
Route::prefix('api')->group(function() {
	Route::prefix('v1')->group(function() {
		Route::get('ro-items/search', 'RoItemController@search');

		// Stalls
		Route::get('stalls', 'StallController@index')->name('stalls.index');
		Route::post('stalls', 'StallController@store')->name('stalls.store');
		Route::get('stalls/search', 'StallController@search');
	});
});
