<?php

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/',                   ['as' => 'home',                     'uses' => 'ScheduleController@index']);
    Route::get('schedule/edit',       ['as' => 'schedule.edit',            'uses' => 'ScheduleController@edit']);
    Route::get('schedule/{id}/edit',  ['as' => 'schedule.assignment.edit', 'uses' => 'ScheduleController@editAssignment']);
    Route::put('schedule/{id}/notes', ['as' => 'schedule.notes.update',    'uses' => 'ScheduleController@updateNotes']);
});

// All auth routes
Auth::routes();
Route::get('logout',                    ['as' => 'logout',         'uses' => 'Auth\LoginController@logout']);
Route::get('oauth/{provider}',          ['as' => 'oauth',          'uses' => 'Auth\OauthController@redirectToProvider']);
Route::get('oauth/{provider}/callback', ['as' => 'oauth.callback', 'uses' => 'Auth\OauthController@handleProviderCallback']);
