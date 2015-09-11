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

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('/', [
        'uses'=>'HomeController@index',
        'as' => 'home']
);

// Authentication routes...
Route::get('login', [
    'uses'=>'Auth\AuthController@getLogin',
    'as' => 'login']
);
Route::post('login', [
    'uses'=>'Auth\AuthController@postLogin',
    'as' => 'login']);
Route::get('logout', [
    'uses'=>'Auth\AuthController@getLogout',
    'as' => 'logout']);

// Registration routes...
Route::get('register', [
    'uses'=>'Auth\AuthController@getRegister',
    'as' => 'register']);
Route::post('register', [
    'uses'=>'Auth\AuthController@postRegister',
    'as' => 'register']);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['middleware' => 'auth'], function() {

    Route::resource('products', 'ProductController');
    Route::get('products/{token}/translate', [
        'uses' => 'ProductController@translate',
        'as' => 'products.translate'
    ]);
    Route::post('products/{token}/translated', [
        'uses' => 'ProductController@translateUpdate',
        'as' => 'products.translate.update'
    ]);

    Route::resource('categories', 'CategoryController');
    Route::get('categories/{token}/translate', [
        'uses' => 'CategoryController@translate',
        'as' => 'categories.translate'
    ]);
    Route::post('categories/{token}/translated', [
        'uses' => 'CategoryController@translateUpdate',
        'as' => 'categories.translate.update'
    ]);
    Route::resource('colors', 'ColorController');
    Route::get('colors/{token}/translate', [
        'uses' => 'ColorController@translate',
        'as' => 'colors.translate'
    ]);
    Route::post('colors/{token}/translated', [
        'uses' => 'ColorController@translateUpdate',
        'as' => 'colors.translate.update'
    ]);
    Route::resource('languages', 'LanguageController');
});
