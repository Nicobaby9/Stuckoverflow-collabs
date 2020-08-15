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

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('layouts.frontweb');
});

Route::get('/register', 'AuthController@register');

Route::post('/welcome', 'AuthController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('question', 'PertanyaanController')->middleware('auth');

Route::resource('thread', 'ThreadController');

Route::resource('jawab', 'JawabController')->middleware('auth');

Route::resource('komentarPertanyaan', 'komentarPertanyaanController')->middleware('auth');

Route::resource('komentarJawaban', 'komentarJawabanController')->middleware('auth');

<<<<<<< HEAD
Route::post('/thread/show', 'LikeController@toggleLike')->name('toggleLike');


=======
>>>>>>> dcf96ccc3b7e6f15b38ff92c620c21c8c55d0679
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
