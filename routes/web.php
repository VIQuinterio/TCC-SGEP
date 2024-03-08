<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ModalidadeController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\NoticiaController;


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

Route::get('/login', function () {
    return view('Login');
})->name('login');

Route::post('auth', [AuthController::class, 'auth'])->name('auth')->middleware('check.user.type');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {    
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('logout', [DashboardController::class, 'logout'])->name('logout');

    Route::get('cadastrar', [DashboardController::class, 'mostrarFormularioCadastro'])->name('cadastrar');
    Route::post('cadastro', [DashboardController::class,'cadastro'])->name('cadastro');

    Route::post('editar/{id}', [DashboardController::class, 'mostrarFormularioEdicao'])->name('editar');
    Route::post('atualizar/{id}', [DashboardController::class, 'atualizar'])->name('atualizar');
    
    Route::post('excluir/{id}', [DashboardController::class, 'excluir'])->name('excluir');

    Route::get('buscar', [DashboardController::class, 'buscar'])->name('buscar');

});

Route::group(['prefix' => 'app', 'as' => 'app.'], function () {    
    Route::get('home', [AppController::class, 'home'])->name('home');

    Route::get('logout', [AppController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'modalidade', 'as' => 'modalidade.'], function () {
        Route::get('/', [ModalidadeController::class, 'index'])->name('index'); // Ajuste o nome da rota para 'index'

        //Route::get('cadastrar', [ModalidadeController::class, 'mostrarFormularioCadastro'])->name('cadastrar');
        Route::post('cadastro', [ModalidadeController::class,'cadastro'])->name('cadastro');
    
        Route::get('editar/{id}', [ModalidadeController::class, 'mostrarFormularioEdicao'])->name('editar');
        Route::post('atualizar/{id}', [ModalidadeController::class, 'atualizar'])->name('atualizar');
        
        Route::post('excluir/{id}', [ModalidadeController::class, 'excluir'])->name('excluir');
    
        Route::get('buscar', [ModalidadeController::class, 'buscar'])->name('buscar');
    });

});
