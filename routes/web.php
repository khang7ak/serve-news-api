<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Route::get('/', function () {
//    return view('welcome.css');
//});
Auth::routes();

Route::get('/', 'PostController@showMain')->name('home');


// route::get('/', 'PostController@welcome.css');

Route::group(['middleware' => 'CheckLevel'], function(){
    Route::get('post', 'PostController@index')->name('post.index');
    Route::get('post/create', 'PostController@create')->name('post.create.get');
    Route::get('post/{id}/edit', 'PostController@edit')->name('post.edit.get');
    Route::get('/home', 'HomeController@index');
});

// Route::get('post', 'PostController@index')->name('post.index')->middleware('CheckLevel'); // Hiển thị danh sách bài viết

Route::get('post/{id}/detail','PostController@show')->name('post.detail'); //Hiển thị chi tiết 1 bài viết

// Route::get('post/create', 'PostController@create')->name('post.create.get')->middleware('CheckLevel'); // Thêm mới bài viết

Route::post('post/create', 'PostController@store')->name('post.create.post'); // Xử lý thêm mới bài viết

// Route::get('post/{id}/edit', 'PostController@edit')->name('post.edit.get')->middleware('CheckLevel'); // Sửa bài viết

Route::post('post/{id}/update', 'PostController@update')->name('post.edit.post'); // Xử lý sửa bài viết

Route::get('post/{id}/delete', 'PostController@destroy'); // Xóa bài viết

// Route::post('search','PostController@search')->name('');

route::get('post/create-main', 'PostController@create')->name('post.create-main.get');

route::post('post/create-main', 'PostController@store')->name('post.create-main.post');

Route::get('post/{type}', 'PostController@showCategory')->name('post.category');

Route::get('/redis', 'PostController@testRedis')->name('post.redis');

Route::get('/session', 'PostController@getListApi');

// Auth::routes();

Route::get('/login', 'Auth\\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\\LoginController@login');
//
Route::post('/logout', 'Auth\\LoginController@logout')->name('logout');
Route::post('/password/confirm', 'Auth\\ConfirmPasswordController@confirm');

Route::get('/register', 'Auth\\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\\RegisterController@register');

// Route::get('/home', 'HomeController@index')->middleware('CheckLevel');


Route::get('imageform', function()
{
    return View::make('imageform');
});
Route::post('imageform', function()
{
    $rules = array(
        'image' => 'required|mimes:jpeg,jpg|max:10000'
    );

    $validation = Validator::make(Input::all(), $rules);

    if ($validation->fails())
    {
        return Redirect::to('imageform')->withErrors($validation);
    }
    else
    {
        $file = Input::file('image');
        $file_name = $file->getClientOriginalName();
        if ($file->move('images', $file_name))
        {
            return Redirect::to('jcrop')->with('image',$file_name);
        }
        else
        {
            return "Error uploading file";
        }
    }
});

Route::get('jcrop', function()
{
    return View::make('jcrop')->with('image', 'images/'. Session::get('image'));
});
