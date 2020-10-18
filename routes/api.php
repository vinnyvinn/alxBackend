<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => ['auth:api'],'prefix'=>'v1'],function (){
   Route::resource("jokes","JokesController");
   Route::resource("anime","AnimeController");
});
Route::group(['prefix'=>'v1'],function (){
   Route::post("users","UsersController@store");
   Route::post("login","UsersController@login");
   Route::post("verify","UsersController@verify");
});
