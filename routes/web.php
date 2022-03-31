<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', [
    'as' => 'form_page',
    'uses' => 'App\Http\Controllers\SymbolController@form'
]);

Route::post('/form', [
    'as' => 'submit_form',
    'uses' => 'App\Http\Controllers\SymbolController@submitForm'
]);

Route::get('/table/{symbol}', [
    'as' => 'table_page',
    'uses' => 'App\Http\Controllers\HistoricalController@table'
]);
