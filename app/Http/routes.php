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

Route::get('/', 'WelcomeController@index');

// ユーザ登録
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');

Route::group(['middleware' => 'auth'], function () {
    
    Route::resource('users', 'UsersController');
    Route::get('users/{id}/new_availability', 'AvailabilitiesController@newAvailability')->name('newAvailability.get');
    Route::get('users/{id}/new_shift', 'ShiftsController@newShift')->name('newShift.get');
    
    Route::get('availabilities/{id}/edit', 'AvailabilitiesController@edit')->name('editAvailability.get');
    
    Route::resource('offices', 'OfficesController', ['only' => ['index', 'show', 'edit', 'update']]);
    Route::resource('availabilities', 'AvailabilitiesController', ['only' => ['create','store', 'show', 'update', 'destroy']]);

    Route::post('shifts/store', 'ShiftsController@store')->name('shifts_store.post');
    Route::get('shifts/{id}/edit', 'ShiftsController@edit')->name('shift_edit.get');
    
    Route::put('shifts/{id}/update', 'ShiftsController@update')->name('shifts_update.put');
    Route::delete('shifts/{id}/destroy', 'ShiftsController@destroy')->name('shifts_destroy.delete');
    Route::get('shifts/{year}/{month}', 'ShiftsController@shifts_year_month')->name('shifts_year_month.get');
    Route::get('shifts/{year}/{month}/generate', 'ShiftsController@shifts_year_month_generate')->name('shifts_year_month_generate.get');
    Route::get('shifts/{year}/{month}/edit', 'ShiftsController@shifts_year_month_edit')->name('shifts_year_month_edit.get');
    Route::get('shifts/{year}/{month}/{day}', 'ShiftsController@shifts_year_month_day')->name('shifts_year_month_day.get');
    
    
    Route::get('shifts/{year}/{month}/update', 'ShiftsController@shifts_year_month_update')->name('shifts_year_month_update.put');
    
    //Route::get('shifts/{year}/{month}/{day}', 'ShiftsController@shifts_year_month_day')->name('shiftsymd.get');
});
