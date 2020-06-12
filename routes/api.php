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

Route::middleware('auth:api')->get('/user', function (Request $request) {





});


Route::prefix('form')->group(function(){

    Route::get('/', 'FormController@index')->name('form.access');

    Route::post('/', 'FormController@store')->name('form.create');

    Route::prefix('/{form}')->group(function(){

        Route::get('/', 'FormController@show')->name('form.show');

        // Route::get('/sheet', 'SheetController@show')->name('form.show');

        Route::post('/sheet', 'SheetController@store')->name('form.show');

    });




    Route::put('/{form}','FormController@update')->name('form.update');

    Route::delete('/{form}', 'FormController@destroy')->name('form.delete');

});

