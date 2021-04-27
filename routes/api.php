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

        Route::post('/{form}/question', 'QuestionController@store')->name('question.create');

        Route::get('/{form}/answer', 'FormController@answer')->name('answer.view');

        Route::get('/{form}/download', 'FormController@download')->name('form.access');
    });

    Route::prefix('option')->group(function(){

        Route::put('/{option}', 'OptionController@update')->name('option.edit');

        Route::delete('/{option}', 'OptionController@destroy')->name('option.delete');

    });

    Route::prefix('question')->group(function(){

        Route::put('/{question}', 'QuestionController@update')->name('question.edit');

        Route::delete('/{question}', 'QuestionController@destroy')->name('question.delete');

        Route::post('/{question}/option', 'OptionController@store')->name('option.create');

    });

    Route::prefix('user')->group(function(){

        Route::get('/', 'UserController@index');
    });
});
