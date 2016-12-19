<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::resource('profiles', 'ProfilesController');
Route::get('blade', function () { return view('page'); });
Route::auth();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::post('/profile/{user}/edit', 'ProfilesController@update')->name('profile.update');
Route::post('/profile/{user}/edit/password', 'ProfilesController@password')->name('profile.password');

Route::get('/profile/{user}/transactions', 'TransactionController@index')->name('transaction.view');
Route::post('/profile/{user}/transactions', 'TransactionController@view')->name('transaction.user');
Route::get('/profile/{user}/transactions/add', 'TransactionController@add')->name('transaction.add');
Route::post('/profile/{user}/transactions/add', 'TransactionController@insert')->name('transaction.insert');

Route::get('/profile/{user}/cart', 'CartController@index')->name('cart.view');
Route::post('/profile/{user}/cart/checkout', 'CartController@submit')->name('cart.submit');
Route::post('/products/{id}/cart', 'CartController@add')->name('product.cart');
Route::post('/products/{id}/cart/delete', 'CartController@delete')->name('cart.delete');

Route::get('/products', 'ProductController@index')->name('product.view');
Route::get('/products/add', 'ProductController@add')->name('product.add');
Route::post('/products/add', 'ProductController@insert')->name('product.insert');
Route::get('/products/{id}', 'HomeController@details')->name('product.details');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('product.edit');
Route::post('/products/{id}/edit', 'ProductController@update')->name('product.update');
Route::post('/products/{id}/delete', 'ProductController@delete')->name('product.delete');


Route::auth();
