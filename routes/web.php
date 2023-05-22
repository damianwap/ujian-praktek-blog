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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('blog/create', 'BlogController@create');
Route::post('blog/add', 'BlogController@store');
Route::get('blog', 'BlogController@index');
Route::get('blog/{id}', 'BlogController@showComment');
Route::get('blog/edit/{id}', 'BlogController@show');
Route::post('blog/save', 'BlogController@update');
Route::delete('blog/delete/{id}', 'BlogController@destroy');

Route::get('comment', 'CommentController@index');
Route::post('comment/add', 'CommentController@store');
Route::delete('comment/delete/{id}', 'CommentController@destroy');
Route::post('comment/save', 'CommentController@update');
