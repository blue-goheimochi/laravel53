<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'IndexController@getIndex')->name('index');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/forgot', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password-forgot');
Route::post('password/forgot', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password-reset');

Route::get('topic/new', 'TopicController@getNewTopic')->middleware('auth')->name('new-topic');
Route::post('topic/new', 'TopicController@postNewTopic')->middleware('auth');

Route::put('topic/like', 'TopicController@createLike');
Route::delete('topic/like', 'TopicController@deleteLike');

Route::get('topic/{id}', 'TopicController@getTopic');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    
    Route::get('/', 'IndexController@getIndex')->name('index');
    
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

});