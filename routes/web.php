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

Route::get('/', 'PagesController@root')->name('root');

Auth::routes();

// Enable force email verification for register
Auth::routes(['verify' => true]);

// Create resource route for user profile management
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');

/**
 * Topic routers
 */
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

/**
 * Topic category routers
 */
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

/**
 * Reply routers
 */
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);