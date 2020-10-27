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


Route::name('front.')->group(function () {
    Route::get('/', 'FrontController@index')->name('home');

    Route::get('aboutUs', function () {
        return view('front::about');
    })->name('about');

    Route::get('team', function () {
        return view('front::team');
    })->name('team');


    Route::get('service', function () {
        return view('front::service');
    })->name('service');

    Route::get('pricing', function () {
        return view('front::pricing');
    })->name('pricing');

    Route::get('contact', function () {
        return view('front::contact');
    })->name('contact');

    Route::get('contact', function () {
        return view('front::contact');
    })->name('contact');

    Route::get('register', 'RegisterController@index')->name('register');
    Route::post('register/store', 'RegisterController@store')->name('register.store');
});
