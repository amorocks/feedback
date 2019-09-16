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

Route::group(['middleware' => 'auth'], function(){
	
	Route::get('/', function () {
	    return view('layouts.app');
	})->name('home');


	Route::resource('courses', 'CourseController');
	Route::resource('courses.lessons', 'LessonController', ['except' => ['index', 'edit', 'update']]);
	Route::post('/courses/{course}/lessons/{lesson}/message', 'MessageController@save')->name('messages.save');
	Route::get('/courses/{course}/overview', 'MessageController@overview')->name('messages.overview');
	Route::get('/courses/{course}/close', 'CourseController@close')->name('courses.close');
});


//AMOlogin routes
Route::get('/login', function(){
	return redirect('/amoclient/redirect');
})->name('login');	

Route::get('/amoclient/ready', function(){
	return redirect()->route('home');
});

Route::get('/logout', function(){
	return redirect('/amoclient/logout');;
})->name('logout');
