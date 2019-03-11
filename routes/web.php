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
Route::get('/','PagesController@getIndex');
Route::get('/about','PagesController@getAbout');
Route::get('/contact','PagesController@getContact');


/*    Start of POSTS Routes       */

Route::group(['prefix'=>'posts','as'=>'posts.'],function(){
    Route::get('/','PostController@index')->name('index');
    Route::get('create','PostController@create')->name('create');
    Route::post('update/{id}','PostController@update')->name('update');
    Route::post('store','PostController@store')->name('store');
    Route::get('edit/{id}','PostController@edit')->name('edit');
    Route::get('show/{id}','PostController@show')->name('show');
    Route::delete('destroy/{id}','PostController@destroy')->name('destroy');
});

/*    END of POSTS Routes       */
