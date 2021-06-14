<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getusers/','chessController@getUsers');
Route::post('/addusers/','chessController@addUsers');
Route::post('/updateusers/','chessController@updateUsers');
Route::delete('/deleteusers/','chessController@deleteUsers');
Route::post('/signup/','chessController@signUp');
Route::post('/login/','chessController@login');
Route::post('/logout/','chessController@logout');