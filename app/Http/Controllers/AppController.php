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

        // Verifique se o usuário está autenticado e é um administrador
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); // Obtenha o ID do usuário autenticado

            // Obtenha o ID da noticia associada ao usuário autenticado
           // $users = User::findOrFail($user_id)->id;

            // Verifique se o usuário tem uma noticia associada
          //  if ($users) {
                // Obtenha os dados do usuário autenticado
                $user_data = $this->procurar_user_por_id($user_id);
 
                // Obtenha os dados da noticia
                $list_news = (new NoticiaController)->noticiasRecentes($user_id);
                 
                // Obtenha os dados da modalidade
                $list_mod = (new ModalidadeController)->listarModalidades($user_id); 
                
                // Obtenha os dados do evento
                $list_event = (new EventoController)->listarEvento($user_id);

                // Obtenha os dados da unidade
                $list_unid = (new UnidadeController)->listarUnidade($user_id);
                 
                // Renderize a view do dashboard passando os dados necessários
                return view('app.home', compact('user_data', 'list_news', 'list_mod', 'list_event', 'list_unid'));
            //} else {
                // Se o usuário não tiver uma noticia associada, retorne uma mensagem de erro
            //    return redirect()->route('login')->with('error', 'Você não tem uma noticia associada.');
           // }

        } else {
            // Se o usuário não estiver autenticado ou não for um administrador, redirecione para a página de login
            return redirect()->route('login')->with('error', 'Você precisa fazer login como administrador para acessar o painel.');
        }
    }
}
