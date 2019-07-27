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

Route::get('/', "HomeController@index")->name('home');

Auth::routes();

Route::get('/account', 'UserController@index')->name('account');
Route::post('/account', 'UserController@update')->name('account');

Route::post('/comment', 'CommentsController@comment')->name('comment');
