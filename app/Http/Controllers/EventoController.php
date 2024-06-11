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
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); 

            $user_evento = User::findOrFail($user_id)->id;

            if ($user_evento) {

                $user_data = $this->procurar_user_por_id($user_id);

                $event_data = $this->procurar_event_por_id($user_evento);

                $list_event = $this->listarEventoUsuario($user_evento);

                $list_unidades = $this->listarUnidadeUsuario($user_id);

                return view('app.evento.eventos', compact('user_data', 'event_data', 'list_event', 'list_unidades'));
            } else {
                return redirect()->route('login')->with('error', 'Você não tem uma unidade associada.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Você precisa fazer login como usuário para acessar o painel.');
        }
    }

    protected function listarUnidadeUsuario($idUsuario)
    {
        return Unidade::where('id_usuario', $idUsuario)->get();
    }

    public function listarEventoUsuario($id)
    {
        $sortMapping = [
            'nome' => 'e.nm_evento',
            'dataInicio' => 'e.dt_evento_inicio',
            'dataFim' => 'e.dt_evento_fim',
            'unidade' => 'u.nm_unidade',
            'descricao' => 'e.ds_evento',
        ];

        $sortKey = request()->input('sort', 'e.id_usuario');

        $sortAttribute = $sortMapping[$sortKey] ?? $sortKey;

        $direction = request()->input('direction', 'asc');
    
        return DB::table('evento as e')
            ->join('unidade as u', 'e.id_unidade', '=', 'u.id_unidade')
            ->select('e.id_evento', 'e.nm_evento', 'e.ds_evento', 'e.dt_evento_inicio', 'e.dt_evento_fim', 'u.nm_unidade')            
            ->where('e.id_usuario', $id)
            ->orderBy($sortAttribute, $direction)
           
            ->paginate(10);
    }
    
    public function listarEvento($id)
    {
        $evento = DB::table('evento as e')
            ->join('unidade as u', 'e.id_unidade', '=', 'u.id_unidade')
            ->select('e.id_evento', 'e.nm_evento', 'e.ds_evento', 'e.dt_evento_inicio', 'e.dt_evento_fim', 'u.nm_unidade')            
            ->where('e.id_usuario', $id)
            ->get();
            
        return $evento;
    }

    public function buscarEvento($key, $id)
    {
        return DB::table('evento as e')
                ->join('unidade as u', 'e.id_unidade', '=', 'u.id_unidade')
                ->select('e.id_evento', 'e.nm_evento', 'e.ds_evento', 'e.dt_evento_inicio', 'e.dt_evento_fim', 'u.nm_unidade')            
                ->where('e.id_usuario', $id)
                ->where('e.nm_evento', 'like', '%' . $key . '%')
                ->orWhere('e.ds_evento', 'like', '%' . $key . '%')
                ->orWhere('e.dt_evento_inicio', 'like', '%' .$key . '%')
                ->orWhere('e.dt_evento_fim', 'like', '%' .$key . '%')
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

        return view('app.evento.eventos', compact('resultados_busca', 'user_data', 'event_data', 'list_event', 'list_unidades'));
    }

    public function cadastro(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date|after_or_equal:dataInicio',
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
            'dt_evento_inicio' => $validatedData['dataInicio'],
            'dt_evento_fim' => $validatedData['dataFim'],
            'id_unidade' => $validatedData['id_unidade'],
            'id_usuario' => $idUsuario,
            'created_at' => now()
        ]);

        return redirect()->back()->with('success', 'Evento cadastrada com sucesso.');
    }

    public function atualizar(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date|after_or_equal:dataInicio',
            'id_unidade' => 'required',
        ]);

        $existingEvent = DB::table('evento')
            ->where('id_usuario', $idUsuario)
            ->where('nm_evento', $validatedData['nome'])
            ->where('id_evento', '<>', $request->input('id'))
            ->first();

        if ($existingEvent) {
            return redirect()->back()->with('error', 'Este nome do evento já está sendo usado em outro. Por favor, escolha um título diferente.');
        }

        $updated = DB::table('evento')
            ->where('id_evento', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->update([
                'nm_evento' => $validatedData['nome'],
                'ds_evento' => $validatedData['descricao'],
                'dt_evento_inicio' => $validatedData['dataInicio'],
                'dt_evento_fim' => $validatedData['dataFim'],
                'id_unidade' => $validatedData['id_unidade'],  
                'updated_at' => now()          
            ]);

        if ($updated) {
            return redirect()->route("app.evento.index")->with('success', 'Informações do evento atualizadas com sucesso');
        } else {
            return redirect()->back()->with('error', 'Evento não encontrado');
        }
    }

    
    public function excluir($id)
    {
        $deleted = DB::table('evento')->where('id_evento', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Evento excluída com sucesso');
        } else {
            return redirect()->back()->with('error', 'Evento não Encontrada');
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
