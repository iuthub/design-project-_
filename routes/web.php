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

Route::get('/', 'HomeController@index')->name('blog');
Route::get('/about', 'AboutController')->name('about');
Route::get('/contact', 'ContactController@contactForm')->name('contact');
Route::post('/contact', 'ContactController@contact')->name('contact');
Route::get('post/{id}', 'PostController@show')->name('post.show');
Route::post('post/{id}/comment', 'PostController@comment')->name('post.comment');
Route::get('unsubscribe/{code}', 'PostsController@show')->name('unsubscribe')->middleware('signed');

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    Route::group(['middleware' => 'auth', 'namespace' => 'Admin'], function () {
        Route::get('/', 'DashBoardController')->name('admin.dashboard');
        Route::resource('categories', 'CategoriesController')->names('admin.categories');
        Route::resource('posts', 'PostsController')->names('admin.posts');
        Route::get('posts/{id}/publish', 'PostsController@changeState')->name('admin.posts.publish');
        Route::get('posts/{id}/unpublish', 'PostsController@changeState')->name('admin.posts.unpublish');
    });
});



