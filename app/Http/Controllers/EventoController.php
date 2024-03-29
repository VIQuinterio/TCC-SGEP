<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evento;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\AuthTrait;

class EventoController extends Controller
{
    use AuthTrait;

    public function index()
    {

        // Verifique se o usuário está autenticado e é um usuário comum
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); // Obtenha o ID do usuário autenticado

            // Obtenha o ID da unidade associada ao usuário autenticado
            $user_evento = User::findOrFail($user_id)->id;

            // Verifique se o usuário tem uma unidade associada
            if ($user_evento) {
                // Obtenha os dados do usuário autenticado
                $user_data = $this->procurar_user_por_id($user_id);

                // Obtenha os dados da unidade
                $event_data = $this->procurar_event_por_id($user_evento);

                // Se o usuário tiver uma unidade, obtenha todas as unidades do usuário
                $list_event = $this->listarEventoUsuario($user_evento);

                $list_unidades = $this->listarUnidadeUsuario($user_id);

                // Renderize a view do dashboard passando os dados necessários
                return view('app.evento.eventos', compact('user_data', 'event_data', 'list_event', 'list_unidades'));
            } else {
                // Se o usuário não tiver uma unidade associada, retorne uma mensagem de erro
                return redirect()->route('login')->with('error', 'Você não tem uma unidade associada.');
            }
        } else {
            // Se o usuário não estiver autenticado ou não for um usuário comum, redirecione para a página de login
            return redirect()->route('login')->with('error', 'Você precisa fazer login como usuário para acessar o painel.');
        }
    }

    protected function listarUnidadeUsuario($idUsuario)
    {
        return Unidade::where('id_usuario', $idUsuario)->get();
    }

    public function listarEventoUsuario($id)
    {
        $sort = request()->input('sort', 'e.id_usuario'); // Especificando a tabela 'evento' para ordenação
        $direction = request()->input('direction', 'asc');
    
        return DB::table('evento as e')
            ->join('unidade as u', 'e.id_unidade', '=', 'u.id_unidade')
            ->select('e.id_evento', 'e.nm_evento', 'e.ds_evento', 'e.dt_evento', 'u.nm_unidade')            
            ->where('e.id_usuario', $id)
            ->orderBy($sort, $direction)
            ->paginate(10);
    }
    
    public function listarEvento($id)
    {
        $evento = DB::table('evento as e')
            ->join('unidade as u', 'e.id_unidade', '=', 'u.id_unidade')
            ->select('e.id_evento', 'e.nm_evento', 'e.ds_evento', 'e.dt_evento', 'u.nm_unidade')            
            ->where('e.id_usuario', $id)
            ->get();
            
        return $evento;
    }

    public function buscarEvento($key, $id)
    {
        return DB::table('evento as e')
                ->join('unidade as u', 'e.id_unidade', '=', 'u.id_unidade')
                ->select('e.id_evento', 'e.nm_evento', 'e.ds_evento', 'e.dt_evento', 'u.nm_unidade')            
                ->where('e.id_usuario', $id)
                ->where('e.nm_evento', 'like', '%' . $key . '%')
                ->orWhere('e.ds_evento', 'like', '%' . $key . '%')
                ->orWhere('e.dt_evento', 'like', '%' .$key . '%')
                ->orWhere('u.nm_unidade', 'like', '%' . $key . '%')
                ->paginate(10);
    }
    
    public function buscar(Request $request)
    {
        $key = $request->input('buscar'); 
        $idUsuario = Auth::id();

        $user_evento = User::findOrFail($idUsuario)->id;

        $resultados_busca = $this->buscarEvento($key, $user_evento);

        $user_data = $this->procurar_user_por_id($user_evento);
        $event_data = $this->procurar_event_por_id($user_evento);
        $list_event = $this->listarEventoUsuario($user_evento);
        $list_unidades = $this->listarUnidadeUsuario($idUsuario);

        // Retorne a view dashboard com os resultados da busca
        return view('app.evento.eventos', compact('resultados_busca', 'user_data', 'event_data', 'list_event', 'list_unidades'));
    }

    public function cadastro(Request $request)
    {
        // Obtenha o ID do usuário autenticado
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'data' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $date = strtotime($value);
                    $minDate = strtotime('2000-01-01');
                    $maxDate = strtotime('2030-12-31');
    
                    if ($date < $minDate || $date > $maxDate) {
                        $fail('A data deve estar entre os anos 2000 e 2030.');
                    }
                },
            ],
            'id_unidade' => 'required',
        ]);

        $check_name = DB::table('evento')
            ->where('nm_evento', $validatedData['nome'])
            ->where('id_usuario', $idUsuario)
            ->where('id_evento', '<>', $request->input('id'))
            ->count();

        if ($check_name > 0) {
            return redirect()->back()->with('error', 'Este nome já está registrado. Tente outro.');
        }

        DB::table('evento')->insert([
            'nm_evento' => $validatedData['nome'],
            'ds_evento' => $validatedData['descricao'],
            'dt_evento' => $validatedData['data'],
            'id_unidade' => $validatedData['id_unidade'],
            'id_usuario' => $idUsuario
        ]);

        // Após o cadastro, redirecione de volta para a mesma página
        return redirect()->back()->with('success', 'evento cadastrada com sucesso.');
    }

    public function atualizar(Request $request)
    {
        // Obtenha o ID do usuário autenticado
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'data' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $date = strtotime($value);
                    $minDate = strtotime('2000-01-01');
                    $maxDate = strtotime('2030-12-31');
    
                    if ($date < $minDate || $date > $maxDate) {
                        $fail('A data deve estar entre os anos 2000 e 2030.');
                    }
                },
            ],
            'id_unidade' => 'required',
        ]);

        // Verifica se já existe outro evento com o mesmo nome, excluindo o evento que está sendo atualizado
        $check_name = DB::table('evento')
            ->where('nm_evento', $validatedData['nome'])
            ->where('id_usuario', $idUsuario)
            ->where('id_evento', '<>', $request->input('id')) // Exclui o evento que está sendo atualizado
            ->count();

        if ($check_name > 0) {
            return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
        }

        // Atualiza o evento com os novos dados
        $updated = DB::table('evento')
            ->where('id_evento', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->update([
                'nm_evento' => $validatedData['nome'],
                'ds_evento' => $validatedData['descricao'],
                'dt_evento' => $validatedData['data'],
                'id_unidade' => $validatedData['id_unidade'],            
            ]);

        if ($updated) {
            return redirect()->route("app.evento.index");
            //return ['successMessage' => 'Informações do evento atualizadas com sucesso'];
        } else {
            return ['errorMessage' => 'Evento não encontrado'];
        }
    }

    
    public function excluir($id)
    {
        $deleted = DB::table('evento')->where('id_evento', $id)->delete();

        if ($deleted) {
            return ['successMessage' => 'evento excluída com sucesso'];
        } else {
            return ['errorMessage' => 'evento não Encontrada'];
        }
    }

    private function procurar_event_por_id($id)
    {
        $unid = DB::table('evento')->where('id_evento', $id)->first();
        return $unid ? $unid : false;
    }

    public function editar(Request $request)
    {
        $id = $request->input('event_id');
        $event = Evento::findOrFail($id);
        return view('app.evento.editar', compact('event'));
    }
}
