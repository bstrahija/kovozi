<?php

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/',                   ['as' => 'home',                  'uses' => 'ScheduleController@index']);
    Route::put('schedule/{id}/notes', ['as' => 'schedule.notes.update', 'uses' => 'ScheduleController@updateNotes']);
});

// All auth routes
Auth::routes();
Route::get('logout',                    ['as' => 'logout',         'uses' => 'Auth\LoginController@logout']);
Route::get('oauth/{provider}',          ['as' => 'oauth',          'uses' => 'Auth\OauthController@redirectToProvider']);
Route::get('oauth/{provider}/callback', ['as' => 'oauth.callback', 'uses' => 'Auth\OauthController@handleProviderCallback']);
