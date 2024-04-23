<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('App\\Http\\Controllers')->prefix('/v1')->group(function () {
   Route::prefix('/users/{user}')->group(function () {
       Route::get('/', 'UserController@view');
       Route::post('/toggle', 'UserController@toggleSettings');
       Route::post('/verify', 'VerificationController@verify');
   });
});
