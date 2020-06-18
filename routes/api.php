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
Route::post('login', 'AuthController@login');


// Public APIs

Route::post('form/{form}/sheet', 'SheetController@store');

Route::get('form/{form}', 'FormController@show');


Route::middleware('auth:sanctum')->group(function() {

    Route::get('init', 'AuthController@init');

    Route::prefix('form')->group(function(){

        Route::get('/', 'FormController@index')->name('form.access');

        Route::post('/', 'FormController@store')->name('form.create');

        Route::put('/{form}','FormController@update')->name('form.update');

        Route::delete('/{form}', 'FormController@destroy')->name('form.delete');

    });


    Route::prefix('option')->group(function(){
        Route::put('/{option}', 'OptionController@update')->name('option.edit');

    });

    Route::prefix('question')->group(function(){
        Route::put('/{question}', 'QuestionController@update')->name('question.edit');

    });


});







