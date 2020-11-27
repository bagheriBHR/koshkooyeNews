<?php

use Illuminate\Support\Facades\Route;

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


Route::middleware('auth')->prefix('/admin')->namespace('backend')->group(function (){
    Route::get('/','HomeController@index')->name('admin.home');
    Route::resource('user', 'UserController');
    Route::post('user/filter', 'UserController@filter')->name('user.filter');
    Route::post('user/search', 'UserController@search')->name('user.search');
    Route::get('resetForm','ResetPasswordController@showResetForm')->name('user.password.index');
    Route::post('resetPassword','ResetPasswordController@reset')->name('user.password.update');
    Route::post('upload', 'PhotoController@upload')->name('photo.upload');
});
