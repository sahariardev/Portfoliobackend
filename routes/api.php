<?php

use Illuminate\Http\Request;

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



Route::group(['middleware' => ['auth:api']], function () {

   //image controller 
   Route::post('/upload','ImageController@store');
   Route::post('/deleteImage/{id}','ImageController@delete');

   //slide controller
   Route::post('/slider/addnew','SliderController@store');
   Route::post('/deleteslider/{id}','SliderController@delete');
   //Tech Controller 
   Route::post('/technology/addnew','techController@store');
   Route::post('/deletetechnology/{id}','techController@delete');

   //portfolio controller
   Route::post('/page/addnew','portfolioController@store');
   Route::post('/deletepage/{id}','portfolioController@delete');

    //AppointmentController
    Route::post('/deleteappointment/{id}','AppointmentController@delete');
    Route::post('/appointment/addnew','AppointmentController@store');
    Route::post('/appointment/confirm/{id}','AppointmentController@confirm');

    //Menu
    Route::post('/menu/delete/{id}','MenuController@delete');
    Route::post('/menu/addnew','MenuController@store');
    //setting
    Route::post('/home/setting/save','HomeController@update');

});


Route::get('/images','ImageController@Index');



Route::get('/sliders','SliderController@index');
Route::get('/slider/{id}','SliderController@slider');

Route::get('/technologies','techController@index');
Route::get('/technology/{id}','techController@getOne');


Route::get('/page/{id}','portfolioController@portfolio');
Route::get('/pages','portfolioController@index');


Route::post('/appointments','AppointmentController@appointments');




Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
Route::post('/refresh', 'AuthController@refresh');
Route::post('/me', 'AuthController@me');
Route::post('/signup','AuthController@signup');

Route::get('/menus','MenuController@index');
Route::get('/menu/{id}','MenuController@one');

Route::get('/home/setting','HomeController@index');
