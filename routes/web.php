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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'loginController@login');
Route::post('/verifyUser', 'loginController@authenticate');


Route::get('/register', 'registerController@register');
Route::post('register', 'registerController@store');

Route::get('dashboard', 'dashboardController@dashboard');
Route::get('/nav', 'navController@nav');

Route::post('/SendOtp', 'loginController@SendOtp');
Route::post('/verifyOtp', 'loginController@verifyOtp');

Route::get('/logout', 'loginController@logout');



