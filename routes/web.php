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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MatchController@index')->name('home');

Route::get('/backend', 'MatchController@backend')->name('backend');
Route::post('/match/store', 'MatchController@store')->name('match.store');
Route::post('/prediction/store', 'PredictionController@store')->name('prediction.store');


Route::get('/updatetable', 'PredictionController@updateScores')->name('update.scores');

Route::get('/getteams', 'MatchController@create');
Route::get('/getusers', 'LeagueTableController@index');
route::get('/getupcomingmatches', 'MatchController@upcomingMatches');
route::get('/getresultedmatches', 'MatchController@resultedMatches');
route::get('/getunresultedmatches', 'MatchController@unresultedMatches');
