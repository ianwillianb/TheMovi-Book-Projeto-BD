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
    if (auth()->check()) {
        return redirect('/home');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@index');

Route::post('/search', 'SearchController@searchMovies');
Route::post('/searchUser', 'SearchController@searchUser');

Route::post('/addFriend', 'FriendsController@addFriend');
Route::post('/acceptFriend', 'FriendsController@acceptFriend');
Route::post('/removeFriend', 'FriendsController@removeFriend');
Route::get('/friends', 'FriendsController@index');
Route::post('/rejectFriend', 'FriendsController@rejectFriend');

Route::get('/user/{id}', 'UsersController@profile');

Route::get('teste', 'XmlParserTest@parse');

Route::get('/filme/{id}', 'FilmeController@profile');
Route::post('/curtirFilme', 'FilmeController@curtirFilme');
Route::post('/naoCurtirFilme', 'FilmeController@naoCurtirFilme');
Route::post('/desfazerFilme', 'FilmeController@desfazerFilme');
Route::post('/avaliarFilme', 'FilmeController@avaliarFilme');
Route::post('/deletarComentarioFilme', 'FilmeController@deletarComentario');

Route::get('/serie/{id}', 'SerieController@profile');
Route::post('/curtirSerie', 'SerieController@curtirSerie');
Route::post('/naoCurtirSerie', 'SerieController@naoCurtirSerie');
Route::post('/desfazerSerie', 'SerieController@desfazerSerie');
Route::post('/avaliarSerie', 'SerieController@avaliarSerie');
Route::post('/deletarComentarioSerie', 'SerieController@deletarComentario');