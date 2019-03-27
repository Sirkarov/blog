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
Route::get('blog/{slug}',['as' => 'blog.single','uses'=>'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

Route::get('/','PagesController@getIndex');
Route::get('/about','PagesController@getAbout');
Route::get('/contact','PagesController@getContact');
/*    Start of POSTS Routes       */
Route::resource('posts','PostController');
/*    END of POSTS Routes       */
Route::get('blog',['uses' => 'BlogController@getIndex','as'=>'blog.index']);

Auth::routes();

Route::resource('categories','CategoryController',['except'=>['create']]);