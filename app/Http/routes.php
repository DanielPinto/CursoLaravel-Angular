<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
Route::post('oauth/access_token', function(){

    return Response::Json(Authorizer::issueAccessToken());
});
*/

Route::get('client' , 'ClientController@index');

Route::get('client/{id}' , 'ClientController@show');

Route::post('client' , 'ClientController@store');

Route::put('client/{id}' , 'ClientController@update');

Route::delete('client/{id}' , 'ClientController@destroy');



Route::get('project' , 'ProjectController@index');

Route::get('project/{id}' , 'ProjectController@show');

Route::post('project' , 'ProjectController@store');

Route::put('project/{id}' , 'ProjectController@update');

Route::delete('project/{id}' , 'ProjectController@destroy');



Route::get('project/{id}/tasks' , 'ProjectTaskController@index');

Route::get('project/{id}/tasks/{noteId}' , 'ProjectTaskController@show');

Route::post('project/tasks' , 'ProjectTaskController@store');

Route::put('project/{id}/tasks/{noteId}' , 'ProjectTaskController@update');

Route::delete('project/{id}/tasks{noteId}' , 'ProjectTaskController@destroy');


Route::get('project/{id}/members' , 'ProjectMembersController@index');

Route::get('project/{id}/members/{memberId}' , 'ProjectMembersController@show');

Route::post('project/{id}/members' , 'ProjectMembersController@store');

Route::delete('project/{id}/members/{memberId}' , 'ProjectMembersController@destroy');

