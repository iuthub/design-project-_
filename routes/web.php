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
    try {
        $post = \App\Models\Post::find(2);
        Mail::to('rana@gmail.com')->send(new \App\Mail\NewPostPublished($post));
    }catch (\Exception $e){
        dd($e->getMessage());
    }
});

Route::get('post/{id}','PostsController@show')->name('posts.show');
Route::get('unsubscribe/{code}','PostsController@show')->name('unsubscribe')->middleware('signed');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'DashBoardController')->name('admin.dashboard');
    Route::resource('categories', 'CategoriesController')->names('admin.categories');
    Route::resource('posts', 'PostsController')->names('admin.posts');
    Route::get('posts/{id}/publish', 'PostsController@changeState')->name('admin.posts.publish');
    Route::get('posts/{id}/unpublish', 'PostsController@changeState')->name('admin.posts.unpublish');
});
