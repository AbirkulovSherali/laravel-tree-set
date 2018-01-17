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

Route::group(['middleware' => ['web']], function(){

    Route::get('/', function(){
        View::share('link', 'home');
        return view('welcome');
    });

    Route::get('/categories', 'CategoriesController@list');
    Route::get('/categories/{id}', 'CategoriesController@list');
    Route::post('/categories/create', 'CategoriesController@create');
    Route::get('/category/{id}', 'CategoriesController@view');

    Route::match(['get', 'post'], '/posts', 'PostsController@list');
    Route::match(['get', 'post'], '/post/{id}', 'PostsController@view');

    Route::match(['get', 'post'], '/login', 'UserController@login');
    Route::match(['get', 'post'], '/registration', 'UserController@registration');
    Route::get('/logout', 'UserController@logout');

    Route::get('/chat', 'ChatController@list');
    Route::get('/chat/chat-with/{id}', 'ChatController@chatWith');
    Route::post('/chat/send-message', 'ChatController@sendMessage');
    Route::get('/chat/get-messages/{from}/{to}', 'ChatController@getMessages');

});
