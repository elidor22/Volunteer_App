<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\mails;
use App\Http\Controllers\adminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::get('/mail','mails@sendEmailReminder');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/posts/all', 'postsController@approved');
    Route::post('/posts/create','postsController@store');
    Route::put('/posts/update','postsController@update');
    Route::delete("/posts/delete",'postsController@delete');

    //Profile routes
    Route::get('/profile', 'ProfileController@show');
    Route::post('/profile/create', 'ProfileController@create');

    //Admin routes
    Route::post('/admin/approve', 'adminController@approvePost');
    Route::post('/admin/approve_user', 'adminController@approveAccount');

    //Tags routes
    Route::get('/recommendations', 'tagsManager@returnPosts');



});
