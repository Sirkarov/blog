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
Auth::routes();


Route::get('blog/{slug}',['as' => 'blog.single','uses'=>'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

Route::get('/','PagesController@getIndex')->name('home');
Route::get('/about','PagesController@getAbout');
Route::get('contact','PagesController@getContact')->name('getContact');
Route::post('contact','PagesController@postContact')->name('postContact');
/*    Start of POSTS Routes       */
Route::resource('posts','PostController');
/*    END of POSTS Routes       */
Route::get('blog',['uses' => 'BlogController@getIndex','as'=>'blog.index']);


//  Categories Routes
Route::resource('categories','CategoryController',['except'=>['create']]);

//  Tags Routes
Route::resource('tags','TagController',['except' => ['create']]);

//  Comments Routes
Route::post('comments/{id}','CommentsController@store')->name('comments.store');
Route::get('comments/edit/{id}','CommentsController@edit')->name('comments.edit');
Route::post('comments/update/{id}','CommentsController@update')->name('comments.update');
Route::post('comments/destroy/{id}','CommentsController@destroy')->name('comments.destroy');