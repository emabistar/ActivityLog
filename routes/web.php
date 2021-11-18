<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();
Route::get('/register',function(){
    return redirect('/login');
 });
Route::group(['middleware', 'auth'],function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/projects/{id}', 'ProjectController@show');
    Route::post('/projects/add', 'ProjectController@add');
    Route::post('/projects/{id}', 'ProjectController@destroy');
    Route::post('/projects/update', 'ProjectController@update');
    Route::post('/entry/start','EntryController@start');
    Route::post('/entry/stop','EntryController@stop');
    Route::post('/entry/id', 'EntryController@index');
    Route::get('/projects','ProjectController@index');
    Route::post('/entry/add', 'EntryController@add')->name('entry');
});


