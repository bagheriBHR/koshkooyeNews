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
    Route::post('user/{id}/articleList', 'ArticleController@articleList');
    Route::post('category/{id}/articleList', 'ArticleController@articleList');
    Route::post('tag/{id}/articleList', 'ArticleController@articleList');
    Route::post('user/search', 'UserController@search')->name('user.search');
    Route::get('resetForm','ResetPasswordController@showResetForm')->name('user.password.index');
    Route::post('resetPassword','ResetPasswordController@reset')->name('user.password.update');
    Route::post('upload', 'PhotoController@upload')->name('photo.upload');
    Route::post('uploadThumbnail', 'PhotoController@uploadThumbnail')->name('thumbnail.upload');
    Route::post('uploadGallery', 'PhotoController@uploadGallery')->name('gallery.upload');
    Route::post('uploadVideo', 'VideoController@upload')->name('video.upload');
    Route::post('ck_upload', 'PhotoController@ck_upload')->name('photo.ck_upload');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');
    Route::post('article/search', 'ArticleController@search')->name('article.search');
    Route::get('article/action/{id}', 'ArticleController@action')->name('article.action');
    Route::resource('setting','SettingController');
    Route::get('tag', 'TagController@index')->name('tag.index');
});
