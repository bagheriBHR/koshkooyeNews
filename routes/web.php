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

Route::namespace('frontend')->group(function (){
    Route::get('/','HomeController@index')->name('home');
    Route::get('/news/{id}/{slug}','NewsController@show')->name('news.show');
    Route::get('/tag/{slug}','NewsController@tagNews')->name('news.tag');
});

Route::middleware('auth')->prefix('/admin')->namespace('backend')->group(function (){
    Route::get('/','HomeController@index')->name('admin.home');
    Route::resource('user', 'UserController');
    Route::post('user/filter', 'UserController@filter')->name('user.filter');
    Route::post('user/search', 'UserController@search')->name('user.search');
    Route::post('user/{id}/articleList', 'ArticleController@articleList');
    Route::post('category/{id}/articleList', 'ArticleController@articleList');
    Route::post('tag/{id}/articleList', 'ArticleController@articleList');
    Route::get('resetForm','ResetPasswordController@showResetForm')->name('user.password.index');
    Route::post('resetPassword','ResetPasswordController@reset')->name('user.password.update');
    Route::post('upload', 'PhotoController@upload')->name('photo.upload');
    Route::post('uploadBanner', 'PhotoController@uploadBanner')->name('banner.upload');
    Route::post('uploadThumbnail', 'PhotoController@uploadThumbnail')->name('thumbnail.upload');
    Route::post('uploadGallery', 'PhotoController@uploadGallery')->name('gallery.upload');
    Route::post('uploadVideo', 'VideoController@upload')->name('video.upload');
    Route::post('ck_upload', 'PhotoController@ck_upload')->name('photo.ck_upload');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');
    Route::post('article/search', 'ArticleController@search')->name('article.search');
    Route::get('article/action/{id}', 'ArticleController@action')->name('article.action');
    Route::post('article/filter', 'ArticleController@filter')->name('article.filter');
    Route::resource('setting','SettingController');
    Route::get('tag', 'TagController@index')->name('tag.index');
    Route::resource('commercial', 'CommercialController');
    Route::post('commercial/filter', 'CommercialController@filter')->name('commercial.filter');
    Route::post('commercial/search', 'CommercialController@search')->name('commercial.search');
    Route::get('commercial/action/{id}', 'CommercialController@action')->name('commercial.action');

});
