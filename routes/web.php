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

Route::get('/', 'PagesController@index')->name('welcome');

Route::group(['middleware' => 'auth'], function () {


    Route::get('/users/{user}', 'UserController@index')->name('user.index');


    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/overview', 'PagesController@overview')->name('pages.overview');


    Route::get('/search', 'SearchController@index')->name('pages.search');

    Route::post('/search/result', 'SearchController@selectGenres')->name('pages.search/result');

    Route::post('/search/text', 'SearchController@textSearch')->name('pages.search/text');

    Route::get('/reviews', 'ReviewsController@index')->name('review');

    Route::post('/reviews/comment/{comment}', 'CommentsController@newComment')->name('reviews.store');

    Route::resource('reviews', 'ReviewsController');

    Route::resource('movies', 'MoviesController');



    // Admin Routes
    Route::get('/admin/review_overview', 'AdminController@overview')->name('reviews.overview');

    Route::post('/admin/review_overview/{review}', 'ReviewsController@reviewStatus');

    Route::get('/admin/add_movie', 'AdminController@index')->name('admin.add_movie');
    Route::get('/admin/add_movie/search', 'AdminController@search')->name('admin.search');
    Route::post('/admin/add_movie/search', 'AdminController@search')->name('admin.search');
    Route::post('/admin/add_movie', 'AdminController@movieToDatabase')->name('admin.movie_to_database');


});