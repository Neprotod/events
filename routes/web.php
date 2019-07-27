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


Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    Route::namespace('Auth')->group(function(){
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');
    });

    Route::middleware("admin_auth")->group(function(){
        Route::get('/','HomeController@index')->name('home');

        Route::get('/users','UserController@index')->name('users');
        Route::get('/users/{id}','UserController@user')->name('user');
        Route::get('/drop/{id}','UserController@drop')->name('user_drop');
        Route::post('/update/{id}','UserController@update')->name('user_update');

        Route::get('/comment','CommentsController@index')->name('comment');
        Route::post('/comment','CommentsController@edit');
        Route::get('/comment/drop/{id}','CommentsController@drop')->name('comment_drop');
    });


});
