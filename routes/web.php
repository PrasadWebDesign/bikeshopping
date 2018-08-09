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
Route::get('/create_bike', 'BikesController@create')->name('bikes.create');
Route::post('/bikes', 'BikesController@store')->name('bikes.store');


// End Admin Panel routes ------------------------------------