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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cv', 'HomeController@cv')->name('cv');

// Route::get('/cv/create/{step}', 'ResumeController@create')->name('resume.create');
Route::get('/cv/create', 'ResumeController@create')->name('resume.create');
// Route::get('/cv/create/{step}', ['uses' => 'ResumeController@create', 'as' => 'resume.create']);
Route::post('/cvmake', 'ResumeController@makeResume')->name('cvmake');
