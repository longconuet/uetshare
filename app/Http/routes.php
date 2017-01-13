<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// ------------------------ Admin ----------------------------

Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function() {
	Route::group(['prefix'=>'subject'], function() {
		Route::get('list', 'SubjectsController@getList');

		Route::get('add', 'SubjectsController@getAdd');
		Route::post('add', 'SubjectsController@postAdd');

		Route::get('edit/{id}', 'SubjectsController@getEdit');
		Route::post('edit/{id}', 'SubjectsController@postEdit');

		Route::get('delete/{id}', 'SubjectsController@getDelete');
	});

	Route::group(['prefix'=>'document'], function() {
		Route::get('list', 'DocumentsController@getList');

		Route::get('add', 'DocumentsController@getAdd');
		Route::post('add', 'DocumentsController@postAdd');

		Route::get('edit/{id}', 'DocumentsController@getEdit');
		Route::post('edit/{id}', 'DocumentsController@postEdit');

		Route::get('delete/{id}', 'DocumentsController@getDelete');
	});

	Route::group(['prefix'=>'user'], function() {
		Route::get('list', 'UsersController@getList');

		Route::get('edit/{id}', 'UsersController@getEdit');
		Route::post('edit/{id}', 'UsersController@postEdit');
	});
});

// --------------------- Pages ------------------------------

Route::get('/', 'PagesController@home');
Route::get('subject/{id?}/{name?}', 'PagesController@subject');
Route::get('document/{id?}/{name?}', 'PagesController@document');
Route::get('about', 'PagesController@about');
Route::get('download/{id?}', 'PagesController@download');
Route::get('upload-file', 'PagesController@getUpload')->middleware('upload');
Route::post('upload-file', 'PagesController@postUpload');
Route::post('search', 'PagesController@search');
Route::get('profile', 'PagesController@getProfile')->middleware('upload');
Route::post('profile', 'PagesController@postProfile');

Route::post('comment/{id?}/{name?}', 'CommentsController@postComment');
Route::get('delete-comment/{id?}/{id_document?}', 'CommentsController@delComment');

Route::group(['prefix'=>'my-upload'], function() {
	Route::get('list', 'PagesController@myUpload');
	Route::get('edit/{id?}', 'PagesController@myUploadEdit');
	Route::post('edit/{id?}', 'PagesController@postUploadEdit');
	Route::get('delete/{id?}', 'PagesController@myUploadDelete');
});


// ------------------ User -----------------------

Route::get('login', 'UsersController@getLogin');
Route::post('login', 'UsersController@postLogin');
Route::get('logout', 'UsersController@getLogout');
Route::get('signup', 'UsersController@getSignup');
Route::post('signup', 'UsersController@postSignup');
Route::get('active/{code?}', 'UsersController@activeCode');