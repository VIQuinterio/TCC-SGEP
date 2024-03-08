<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\AuthTrait;

class AppController extends Controller
{
    use AuthTrait;

    public function home(){

        // Verifique se o usuário está autenticado e é um administrador
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); // Obtenha o ID do usuário autenticado

            // Obtenha os dados do usuário autenticado
            $user_data = $this->procurar_user_por_id($user_id);


            // Renderize a view do dashboard passando os dados necessários
            return view('app.home', compact('user_data'));
        } else {
            // Se o usuário não estiver autenticado ou não for um administrador, redirecione para a página de login
            return redirect()->route('login')->with('error', 'Você precisa fazer login como administrador para acessar o painel.');
        }
    }

}
