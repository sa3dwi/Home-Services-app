<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group( [ 'namespace' => 'Backend', 'middleware' => [  'auth' ] ], function () {

//    Route::get( 'admins', [ 'uses' => 'AdminsController@index', 'as' => 'admins' ] );
//    Route::get( 'admins/create', [ 'uses' => 'AdminsController@create', 'as' => 'admins.create' ] );
//    Route::post( 'admins/store', [ 'uses' => 'AdminsController@store', 'as' => 'admins.store' ] );
//    Route::get( 'admins/edit/{id}', [ 'uses' => 'AdminsController@edit', 'as' => 'admins.edit' ] );
//    Route::post( 'admins/update/{id}', [ 'uses' => 'AdminsController@update', 'as' => 'admins.update' ] );
//    Route::get( 'admins/destroy/{id}', [ 'uses' => 'AdminsController@destroy', 'as' => 'admins.destroy' ] );

    // settings
    //Route::get( 'settings', [ 'uses' => 'SettingsController@edit', 'as' => 'settings' ] );
    //Route::post( 'settings/update', [ 'uses' => 'SettingsController@update', 'as' => 'settings.update' ] );

    // users
    //Route::get( 'users', [ 'uses' => 'UsersController@index', 'as' => 'users' ] );
    Route::auth();
    Route::get('/backend', [ 'uses' =>'AdminController@index', 'as' => 'backend']);

    /* pages */
    Route::get( '/backend/pages', [ 'uses' => 'PagesController@index', 'as' => 'pages' ] );
    Route::get( '/backend/pages/create', [ 'uses' => 'PagesController@create', 'as' => 'pages.create' ] );
    Route::post( '/backend/pages/store', [ 'uses' => 'PagesController@store', 'as' => 'pages.store' ] );
    Route::get( '/backend/pages/edit/{id}', [ 'uses' => 'PagesController@edit', 'as' => 'pages.edit' ] );
    Route::post( '/backend/pages/update/{id}', [ 'uses' => 'PagesController@update', 'as' => 'pages.update' ] );
    Route::get( '/backend/pages/destroy/{id}', [ 'uses' => 'PagesController@destroy', 'as' => 'pages.destroy' ] );

    /* hotels */
    Route::get( '/backend/hotels', [ 'uses' => 'HotelsController@index', 'as' => 'hotels' ] );
    Route::get( '/backend/hotels/create', [ 'uses' => 'HotelsController@create', 'as' => 'hotels.create' ] );
    Route::post( '/backend/hotels/store', [ 'uses' => 'HotelsController@store', 'as' => 'hotels.store' ] );
    Route::get( '/backend/hotels/edit/{id}', [ 'uses' => 'HotelsController@edit', 'as' => 'hotels.edit' ] );
    Route::post( '/backend/hotels/update/{id}', [ 'uses' => 'HotelsController@update', 'as' => 'hotels.update' ] );
    Route::get( '/backend/hotels/destroy/{id}', [ 'uses' => 'HotelsController@destroy', 'as' => 'hotels.destroy' ] );
    Route::get( '/backend/hotels/delete-image/{id}', [ 'uses' => 'HotelsController@deleteImage', 'as' => 'hotels.delete_image' ] );

    /* coupons */
    Route::get( '/backend/coupons', [ 'uses' => 'CouponsController@index', 'as' => 'coupons' ] );
    Route::get( '/backend/coupons/create', [ 'uses' => 'CouponsController@create', 'as' => 'coupons.create' ] );
    Route::post( '/backend/coupons/store', [ 'uses' => 'CouponsController@store', 'as' => 'coupons.store' ] );
    Route::get( '/backend/coupons/edit/{id}', [ 'uses' => 'CouponsController@edit', 'as' => 'coupons.edit' ] );
    Route::post( '/backend/coupons/update/{id}', [ 'uses' => 'CouponsController@update', 'as' => 'coupons.update' ] );
    Route::get( '/backend/coupons/destroy/{id}', [ 'uses' => 'CouponsController@destroy', 'as' => 'coupons.destroy' ] );
    Route::get( '/backend/coupons/delete-image/{id}', [ 'uses' => 'CouponsController@deleteImage', 'as' => 'coupons.delete_image' ] );

    /*roomscategories*/
    Route::get( '/backend/roomscategories', [ 'uses' => 'RoomsCategoriesController@index', 'as' => 'roomscategories' ] );
    Route::get( '/backend/roomscategories/create', [ 'uses' => 'RoomsCategoriesController@create', 'as' => 'roomscategories.create' ] );
    Route::post( '/backend/roomscategories/store', [ 'uses' => 'RoomsCategoriesController@store', 'as' => 'roomscategories.store' ] );
    Route::get( '/backend/roomscategories/edit/{id}', [ 'uses' => 'RoomsCategoriesController@edit', 'as' => 'roomscategories.edit' ] );
    Route::post( '/backend/roomscategories/update/{id}', [ 'uses' => 'RoomsCategoriesController@update', 'as' => 'roomscategories.update' ] );
    Route::get( '/backend/roomscategories/destroy/{id}', [ 'uses' => 'RoomsCategoriesController@destroy', 'as' => 'roomscategories.destroy' ] );
    Route::get( '/backend/roomscategories/delete-image/{id}', [ 'uses' => 'RoomsCategoriesController@deleteImage', 'as' => 'roomscategories.delete_image' ] );

    /* rooms */
    Route::get( '/backend/rooms', [ 'uses' => 'RoomsController@index', 'as' => 'rooms' ] );
    Route::get( '/backend/rooms/create', [ 'uses' => 'RoomsController@create', 'as' => 'rooms.create' ] );
    Route::post( '/backend/rooms/store', [ 'uses' => 'RoomsController@store', 'as' => 'rooms.store' ] );
    Route::get( '/backend/rooms/edit/{id}', [ 'uses' => 'RoomsController@edit', 'as' => 'rooms.edit' ] );
    Route::post( '/backend/rooms/update/{id}', [ 'uses' => 'RoomsController@update', 'as' => 'rooms.update' ] );
    Route::get( '/backend/rooms/destroy/{id}', [ 'uses' => 'RoomsController@destroy', 'as' => 'rooms.destroy' ] );
    Route::get( '/backend/rooms/delete-image/{id}', [ 'uses' => 'RoomsController@deleteImage', 'as' => 'rooms.delete_image' ] );

    /* booking */
    Route::get( '/backend/booking', [ 'uses' => 'BookingController@index', 'as' => 'booking' ] );
    Route::get( '/backend/booking/create', [ 'uses' => 'BookingController@create', 'as' => 'booking.create' ] );
    Route::post( '/backend/booking/store', [ 'uses' => 'BookingController@store', 'as' => 'booking.store' ] );
    Route::get( '/backend/booking/edit/{id}', [ 'uses' => 'BookingController@edit', 'as' => 'booking.edit' ] );
    Route::post( '/backend/booking/update/{id}', [ 'uses' => 'BookingController@update', 'as' => 'booking.update' ] );
    Route::get( '/backend/booking/destroy/{id}', [ 'uses' => 'BookingController@destroy', 'as' => 'booking.destroy' ] );
    Route::get( '/backend/booking/delete-image/{id}', [ 'uses' => 'BookingController@deleteImage', 'as' => 'booking.delete_image' ] );

    Route::auth();
} );
Route::auth();

Route::get('/',[ 'as' => 'home', 'uses' => 'HomeController@index' ]);
Route::get('/page/{slug}', [ 'as' => 'static_page', 'uses' => 'PagesController@staticPage' ] );
Route::match( [ 'get', 'post' ], 'contact-us', [ 'as' => 'contact_us', 'uses' => 'PagesController@contactUs' ] );
//Route::get('/hotels', [ 'as' => 'hotels', 'uses' => 'HotelsController@index' ] );
Route::get('/hotel/{id?}/{start?}/{end?}/{coupon?}', [ 'as' => 'hotel', 'uses' => 'HotelsController@index' ] );
Route::get('/hotel_booking/{id}/{start?}/{end?}/{coupon?}', [ 'as' => 'hotel_booking', 'uses' => 'HotelsController@booking' ] );
Route::post('/hotel_booking_thanks', [ 'as' => 'hotel_booking_save', 'uses' => 'HotelsController@booking_save' ] );
