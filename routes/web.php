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

Route::get('/bike_single/{bike_id}','BikesController@show_single_bike')->name('bikes.show_single_bike');

Route::post('/booking_request','BikesController@booking_request')->name('bikes.booking_request');

Route::get('/contact', function () {
    return view('contact');
});

//Auth routes -------------------------------------------- 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// End Auth routes ---------------------------------------

//  /////////////////////////////////////////////////////////////

// Shopping Cart routes
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::get('/empty', 'CartController@emptyCart')->name('cart.emptyCart');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');


// Shopping Wishlist routes
Route::get('/wishlist', 'CartController@wishlist_index')->name('wishlist.index');
Route::post('/wishlist', 'CartController@wishliststore')->name('wishlist.store');
Route::delete('/wishlist/{product}', 'CartController@wishlistdestroy')->name('wishlist.destroy');

// checkout routes
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

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

// Teams
// get create team form
Route::get('/create_team', 'TeamController@create')->name('team.create');
Route::post('/team', 'TeamController@store')->name('team.store');
Route::get('/all_team', 'TeamController@list_teams')->name('team.list_teams');
// get edit team form
Route::get('/team/{id}/edit', 'TeamController@edit')->name('team.edit');
Route::put('/team/{id}/edit', 'TeamController@update')->name('team.update');

Route::DELETE('/team/{id}/delete', 'TeamController@destroy')->name('team.destroy');


 //bike filter sort by rates
Route::get('/bike_filter', 'BikesController@get_bike_filter')->name('bikes.get_bike_filter');

//bike filter price range slider
Route::post('/bike_price_filter', 'BikesController@get_bike_price_filter')->name('bikes.bike_price_filter');

// End Admin Panel routes ------------------------------------