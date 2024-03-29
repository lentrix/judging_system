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

Route::get('/', 'SiteController@loginForm')->name('login');
Route::post('/login', 'SiteController@login');

Route::group(['middleware'=>['auth']], function() {
    Route::get('/home', 'SiteController@home')->name('home');
    Route::get('/logout', 'SiteController@logout');
});

Route::group(['middleware'=>['auth','admin']], function(){
    Route::get('/contest/create', 'ContestController@create');

    Route::post('/contest', 'ContestController@store');
    Route::get('/contest/{contest}', 'ContestController@manage');
    Route::post('/round', 'RoundController@store');
    Route::delete('/round', 'RoundController@delete');

    Route::post('/round/reset', 'RoundController@reset');
    Route::get('/round/{round}', 'RoundController@manage');
    Route::get('/round/{round}/up', 'RoundController@moveUp');
    Route::get('/round/{round}/down', 'RoundController@moveDown');
    Route::get('/round/{round}/commence', 'RoundController@commence');
    Route::get('/round/{round}/suspend', 'RoundController@suspend');
    Route::get('/round/{round}/summary', 'RoundController@summary');
    Route::post('/round/{round}/advance', 'RoundController@advance');
    Route::post('/round/{round}/close', 'RoundController@close');

    Route::post('/criteria', 'CriteriaController@store');
    Route::delete('/criteria', 'CriteriaController@delete');
    Route::get('/criteria/{criteria}/up', 'CriteriaController@moveUp');
    Route::get('/criteria/{criteria}/down', 'CriteriaController@moveDown');
    Route::get('/criteria/{criteria}/summary', 'CriteriaController@summary');

    Route::post('/judge', 'JudgeController@store');
    Route::patch('/judge', 'JudgeController@addExisting');
    Route::get('/judge/{contestJudge}/edit', 'JudgeController@edit');
    Route::patch('/judge/{contestJudge}', 'JudgeController@update');
    Route::delete('/judge', 'JudgeController@delete');
    Route::get('/judge/{contestJudge}/up', 'JudgeController@moveUp');
    Route::get('/judge/{contestJudge}/down', 'JudgeController@moveDown');

    Route::post('/contestant','ContestantController@store');
    Route::delete('/contestant','ContestantController@delete');
    Route::post('/contestant/batch','ContestantController@addBatch');
    Route::get('/contestant/{contestant}/up', 'ContestantController@moveUp');
    Route::get('/contestant/{contestant}/down', 'ContestantController@moveDown');

});

Route::group(['middleware'=>['auth','judge']], function(){
    Route::get('/judging/{contest}', 'JudgingController@index');
    Route::post('/judging/{round}', 'JudgingController@saveScores');
});
