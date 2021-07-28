<?php

use SuccessApps\Acl\Acl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();


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

Route::middleware(['auth:sanctum', 'acl'])->group(function() {

    Acl::routes();

    Route::get('init', 'AuthController@init');

    Route::prefix('form')->group(function(){

        Route::get('/', 'FormController@index')->name('acl.form.access');

        Route::post('/', 'FormController@store')->name('acl.form.create');

        Route::put('/{form}','FormController@update')->name('acl.form.update');

        Route::delete('/{form}', 'FormController@destroy')->name('acl.form.delete');

        Route::post('/{form}/question', 'QuestionController@store')->name('acl.question.create');

        Route::get('/{form}/answer', 'FormController@answer')->name('acl.answer.view');

        Route::get('/{form}/download', 'FormController@download')->name('acl.form.access');
    });

    Route::prefix('option')->group(function(){

        Route::put('/{option}', 'OptionController@update')->name('acl.option.edit');

        Route::delete('/{option}', 'OptionController@destroy')->name('acl.option.delete');

    });

    Route::prefix('question')->group(function(){

        Route::put('/{question}', 'QuestionController@update')->name('acl.question.edit');

        Route::delete('/{question}', 'QuestionController@destroy')->name('acl.question.destroy');

        Route::post('/{question}/option', 'OptionController@store')->name('acl.option.create');

    });

    Route::prefix('user')->group(function(){

        Route::get('/', 'UserController@index');
    });
});
