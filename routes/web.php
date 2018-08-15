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

Route::get('/', 'SiteHomeController@index')->name('SiteHome.index');

// Route::get('/about', function () {
//     return view('about');
// });

Route::get('/about', 'AboutController@index')->name('about');
Route::get('/bikes', 'BikesController@index')->name('bikes');

// Route::get('/bikes', function () {
//     return view('bikes');
// });

Route::get('/bike_single', function () {
    return view('bike_single');
});

Route::get('/contact', function () {
    return view('contact');
});

//Auth routes -------------------------------------------- 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// End Auth routes ---------------------------------------

//  /////////////////////////////////////////////////////////////

// Admin panel routes -------------------------------------

// home banner
Route::put('/banner', 'BannersController@update')->name('banner.update');
Route::get('/banner', 'BannersController@create')->name('banner.create');

// about us content
Route::get('/aboutus', 'AboutController@create')->name('about.create');
Route::put('/aboutus', 'AboutController@update')->name('about.update');

// bikes

// get create bike form
Route::get('/create_bike', 'BikesController@create')->name('bikes.create');

// submit create bike form
Route::post('/bikes', 'BikesController@store')->name('bikes.store');

// delete a bike and its associated images
Route::DELETE('/bikes/{id}/delete', 'BikesController@destroy')->name('bikes.destroy');

// get edit bike form
Route::get('/bikes/{id}/edit', 'BikesController@edit')->name('bikes.edit');

// update bike by submiiting edit form
Route::put('/bikes/{id}/edit', 'BikesController@update')->name('bikes.update');

// get list of bikes
Route::get('/all_bikes', 'BikesController@list_bikes')->name('bikes.list_bikes');

// get image partial
Route::post('/bike_images_partial', 'BikesController@get_bike_image_partial')->name('bikes.get_bike_image_partial');
Route::delete('/remove_bike_other_image', 'BikesController@remove_bike_other_image')->name('bikes.remove_bike_other_image');

//bike filter
Route::post('/bike_filter', 'BikesController@get_bike_filter')->name('bikes.get_bike_filter');



// End Admin Panel routes ------------------------------------