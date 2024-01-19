<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Home');
});

// Rota para o painel de usuário
Route::get('/user', 'UserController@index')->middleware('auth', 'checkRole:user');

// Rota para o painel de admin
Route::get('/admin', 'AdminController@index')->middleware('auth', 'checkRole:admin');
