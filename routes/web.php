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
    Route::get('/service/{slug}','NewsController@categoryNews')->name('news.category');
    Route::get('/photo','NewsController@photos')->name('news.photo');
    Route::get('/video','NewsController@videos')->name('news.video');
    Route::get('/sound','NewsController@sounds')->name('news.sound');
    Route::post('news/comment/{id}','CommentController@store')->name('frontend.comment.store');
    Route::post('news/comment', 'CommentController@reply')->name('frontend.comment.reply');
    Route::get('news/{name}', 'NewsController@aboutus')->name('aboutus');
    Route::post('contact', 'HomeController@contact')->name('form.contact');
    Route::get('commercial/{id}', 'HomeController@commercialCounter')->name('commercial.counter');
    Route::get('printNews/{id}', 'NewsController@printNews')->name('printNews');
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
    Route::get('comment/', 'CommentController@index')->name('comment.index');
    Route::get('comment/action/{id}', 'CommentController@action')->name('comment.action');
    Route::get('comment/{id}', 'CommentController@show')->name('comment.show');
    Route::get('contact/{id}', 'ContactController@show')->name('contact.show');
    Route::get('contact', 'ContactController@index')->name('contact.index');
});
