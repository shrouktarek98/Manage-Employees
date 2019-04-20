<?php

use Illuminate\Support\Facades\DB;

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


Route::get('/','personcontroller@veiw');
Route::get('/view','personcontroller@veiw');
Route::post('/insert', 'personcontroller@add');
Route::get('/update/{id}', 'personcontroller@update');
Route::get('/edit', 'personcontroller@edit');
Route::get('/delete', 'personcontroller@delete');

