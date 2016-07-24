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
    return view('app');
});



Route::post('oauth/access_token', function(){

    return Response::Json(Authorizer::issueAccessToken());
});



//

Route::group(['middleware'=>'oauth'],function(){



    Route::get('user/authenticated' , 'UserController@authenticated');
    Route::get('user' , 'UserController@index');
    Route::get('user/{id}' , 'UserController@show');


    Route::get('client' ,'ClientController@index');
    Route::get('client/{id}' , 'ClientController@show');
    Route::post('client' , 'ClientController@store');
    Route::put('client/{id}' , 'ClientController@update');
    Route::delete('client/{id}' , 'ClientController@destroy');



    Route::get('projects' , 'ProjectController@index');
    Route::get('projects/{id}' , 'ProjectController@show');
    Route::post('projects' , 'ProjectController@store');
    Route::put('projects/{id}' , 'ProjectController@update');
    Route::delete('projects/{id}' , 'ProjectController@destroy');




//    Route::resource('project','ProjectController',['except' => ['create','edit']]);



    Route::group(['middleware'=>'check.project.permission'],function (){


    });

    Route::get('project/{id}/file' , 'ProjectFileController@index');
    Route::get('project/{id}/file/{idFile}/download' , 'ProjectFileController@showFile');
    Route::get('project/{id}/file/{idFile}' , 'ProjectFileController@show');
    Route::post('project/{id}/file' , 'ProjectFileController@store');
    Route::put('project/{id}/file/{idFile}' , 'ProjectFileController@update');
    Route::delete('project/{id}/file/{idFile}' , 'ProjectFileController@destroy');




    Route::get('project/{id}/task' , 'ProjectTaskController@index');
    Route::get('project/{id}/task/{taskId}' , 'ProjectTaskController@show');
    Route::post('project/{id}/task' , 'ProjectTaskController@store');
    Route::put('project/{id}/task/{taskId}' , 'ProjectTaskController@update');
    Route::delete('project/{id}/task/{taskId}' , 'ProjectTaskController@destroy');



    Route::get('project/{id}/note' , 'ProjectNoteController@index');
    Route::get('project/{id}/note/{noteId}' , 'ProjectNoteController@show');
    Route::post('project/{id}/note' , 'ProjectNoteController@store');
    Route::put('project/{id}/note/{noteId}' , 'ProjectNoteController@update');
    Route::delete('project/{id}/note/{noteId}' , 'ProjectNoteController@destroy');




    Route::get('project/{id}/members' , 'ProjectMembersController@index');
    Route::get('project/{id}/members/{memberId}' , 'ProjectMembersController@show');
    Route::post('project/{id}/members' , 'ProjectMembersController@store');
    Route::delete('project/{id}/members/{memberId}' , 'ProjectMembersController@destroy');



/*
    Route::post('project/{id}/file' , 'ProjectFileController@store');
    Route::get('project/{id}/file' , 'ProjectFileController@index');
    Route::get('project/{id}/file/{idfile}' , 'ProjectFileController@show');
    Route::delete('project/{id}/file/{idfile}' , 'ProjectFileController@destroy');
*/


});
