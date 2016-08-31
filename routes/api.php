<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('users',              ['as' => 'api.users',              'uses' => 'ScheduleController@groupUsers']);
Route::get('schedule',           ['as' => 'api.schedule.index',     'uses' => 'ScheduleController@index']);
Route::get('schedule/this-week', ['as' => 'api.schedule.this_week', 'uses' => 'ScheduleController@thisWeek']);
Route::get('schedule/next-week', ['as' => 'api.schedule.next_week', 'uses' => 'ScheduleController@nextWeek']);
Route::get('schedule/history',   ['as' => 'api.schedule.history',   'uses' => 'ScheduleController@history']);
Route::get('schedule/upcoming',  ['as' => 'api.schedule.upcoming',  'uses' => 'ScheduleController@upcoming']);
Route::put('schedule/{id}',      ['as' => 'api.schedule.update',    'uses' => 'ScheduleController@update']);
