<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Noticia;
use App\Models\Modalidade;
use App\Models\Evento;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\AuthTrait;

class AppController extends Controller
{
    use AuthTrait;

    public function home(){

        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); 

            $user_data = $this->procurar_user_por_id($user_id);

            $list_news = (new NoticiaController)->noticiasRecentes($user_id);

            $list_mod = (new ModalidadeController)->listarModalidades($user_id); 

            $list_event = (new EventoController)->listarEvento($user_id);

            $list_unid = (new UnidadeController)->listarUnidade($user_id);
                 
            return view('app.home', compact('user_data', 'list_news', 'list_mod', 'list_event', 'list_unid'));
        } else {            
            return redirect()->route('login')->with('error', 'Você precisa fazer login como administrador para acessar o painel.');
        }
    }
}
