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

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MatchController@index')->name('home');

Route::get('/backend', 'MatchController@backend')->name('backend');
Route::post('/match/store', 'MatchController@store')->name('match.store');
Route::post('/prediction/store', 'PredictionController@store')->name('prediction.store');
Route::post('/match/submitscores', 'MatchController@updateScores')->name('match.scores');
Route::post('/match/resetmatch', 'MatchController@resetMatch')->name('match.reset');
Route::post('/match/cancelmatch', 'MatchController@cancelMatch')->name('match.cancel');
Route::post('/match/updateteams', 'MatchController@updateTeams')->name('match.teams');
Route::post('/match/updatekickoff', 'MatchController@updateKickoff')->name('match.kickoff');
Route::post('match/updateetp', 'MatchController@updateETP')->name('match.etp');
Route::post('match/reversefixture', 'MatchController@reverseFixture')->name('match.reverse');

Route::get('/recalculatetable', 'PredictionController@recalculateScores')->name('recalculate.scores');
Route::get('/lockpredictions', 'PredictionController@lock');
Route::get('/unlockpredictions', 'PredictionController@unlock');

Route::get('/getteams', 'MatchController@create');
Route::get('/getusers', 'LeagueTableController@index');
Route::get('/whoami', 'LeagueTableController@whoAmI');

Route::post('/user/flipsubmissionstatus', 'PredictionController@flipStatus');

Route::post('/vote', 'VoteController@store');
Route::get('/getvotes', 'VoteController@index');
Route::get('/openpolls', 'VoteController@openPolls');
Route::get('/closepolls', 'VoteController@closePolls');
Route::get('/clearpolls', 'VoteController@clear');

Route::post('/user/checkemailexists', 'LeagueTableController@checkEmail');
Route::post('/user/resetpassword', 'LeagueTableController@resetPassword');

route::get('/getupcomingmatches', 'MatchController@upcomingMatches');
route::get('/getresultedmatches', 'MatchController@resultedMatches');
route::get('/getresultedmatches/{counter}', 'MatchController@moreResultedMatches');
route::get('/countresultedmatches', 'MatchController@countResultedMatches');
route::get('/getpredictions/{match_id}', 'MatchController@getMatchPredictions');
route::get('/getunresultedmatches', 'MatchController@unresultedMatches');
route::get('/getunresultedmatchesbackend', 'MatchController@unresultedMatchesBackend');
route::get('/getresultedmatchesbackend', 'MatchController@resultedMatchesBackend');

route::get('resetseason', 'MatchController@resetSeason');
