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
	// $stall = new App\Stall;

	// $stall->fill([
 //        'name' => 'STALLY',
 //        'user_id' => 1,
 //        'server_id' => App\Server::first()->id,
 //    ]);

	// $stallItem = new App\StallItem;

	// $stallItem->fill([
	// 	'ro_item_id' => 500,
	// 	'price' => 200
	// ]);

 //    $stall->stallItems->add($stallItem);

 //    if($stall->save()){
 //    	return $stall;
 //    } else {
 //    	return 'no';
 //    }

	// return $stallItem = App\StallItem::create([
	// 	'stall_id' => 1,
	// 	'ro_item_id' => 500,
	// 	'price' => 200
	// ]);

	// return App\StallItem::with('roItem')->first();
	// return App\RoItem::with('type')->first();
	// return App\RoItemType::with('roItems')->first();
// });

// Home
Route::get('/', function () {
    return view('home');
})->name('index');


// Auth
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// Route::group(['middleware' => 'web'], function() {
// });

// Stalls
Route::group(['middleware' => ['auth']], function () {
	Route::get('stalls/create', 'StallController@create')->name('stalls.create');
});

// Stall views
Route::get('stalls/{stall}', 'StallController@show')->name('stalls.show');

// API
Route::prefix('api')->group(function() {
	Route::prefix('v1')->group(function() {
		// auth middleware
		Route::group(['middleware' => ['auth']], function () {
			Route::post('stalls', 'StallController@store')->name('stalls.store');
		});

		// Search RO items		
		Route::get('ro-items/search', 'RoItemController@search');

		// Stalls
		Route::get('stalls', 'StallController@index')->name('stalls.index');
		Route::get('stalls/search', 'StallController@search');
	});
});
