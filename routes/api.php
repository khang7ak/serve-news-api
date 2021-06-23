<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::namespace('Api')->prefix('v1')->group(function() {
//     Route::resource('exams', 'TestController')->except('create', 'edit');
//     Route::get('post', 'TestController@showMain');
//     Route::get('category/{category}', 'TestController@showCategory');
    
// });

Route::namespace('Api')->prefix('v1')->group(function() {
    // Route::resource('exams', 'ApiPostController');

    Route::patch('exams/{id}', 'ApiPostController@getFirstByIdViewCount');
    Route::get('exams/{id}', 'ApiPostController@getFirstByIdViewCount');

    Route::post('exams/update/{id}', 'ApiPostController@SessionViewCount');
    Route::get('exams/update/{id}', 'ApiPostController@SessionViewCount');

    Route::get('post', 'ApiPostController@showMain');
    Route::post('post', 'ApiPostController@showMain');

    Route::get('category/{category}', 'ApiPostController@showCategory');


    //Route api đăng nhập cho news.local
    // Route::get('login', 'LoginController@__contruct');
    // Route::post('login', 'ConfirmPasswordController@__contruct');


});

