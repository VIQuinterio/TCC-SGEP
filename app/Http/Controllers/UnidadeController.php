<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unidade;
use App\Models\Modalidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\AuthTrait;

class UnidadeController extends Controller
{
    use AuthTrait;

    public function index()
    {        
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); 
            
            $user_unidade = User::findOrFail($user_id)->id;
            
            if ($user_unidade) {
            
                $user_data = $this->procurar_user_por_id($user_id);
                
                $unid_data = $this->procurar_unid_por_id($user_unidade);
            
                $list_unid = $this->listarUnidadeUsuario($user_unidade);

                $list_modalidades = $this->listarModalidadeUsuario($user_id);
                
                return view('app.unidade.unidades', compact('user_data', 'unid_data', 'list_unid', 'list_modalidades'));
            } else {                
                return redirect()->route('login')->with('error', 'Você não tem uma unidade associada.');
            }
        } else {            
            return redirect()->route('login')->with('error', 'Você precisa fazer login como usuário para acessar o painel.');
        }
    }
    
    protected function listarModalidadeUsuario($idUsuario)
    {
        return Modalidade::where('id_usuario', $idUsuario)->get();
    }

    public function listarUnidadeUsuario($id)
    {
        $sortMapping = [
            'unidade' => 'nm_unidade',
            'endereco' => 'ds_endereco',
            'contato' => 'ds_contato'
        ];
    
        $sortKey = request()->input('sort', 'id_usuario');
    
        $sortAttribute = $sortMapping[$sortKey] ?? $sortKey;
    
        $direction = request()->input('direction', 'asc');
    
        return Unidade::with('modalidades')
            ->where('id_usuario', $id)
            ->orderBy($sortAttribute, $direction)
            ->paginate(10);
    }

    public function listarUnidade($id)
    {
        $unidade = Unidade::where('id_usuario', $id)            
            ->get();
        return $unidade;
    }

    public function buscarUnidade($key, $id)
    {
        $unid = DB::table('unidade')
            ->where('id_usuario', $id)
            ->where(function ($query) use ($key) {
                $query->where('nm_unidade', 'like', "%$key%")
                    ->orWhere('ds_endereco', 'like', "%$key%")
                    ->orWhere('ds_contato', 'like', "%$key%");
            })            
            ->paginate(10); 

        return $unid;
    }
    
    public function buscar(Request $request)
    {
        $key = $request->input('buscar'); 
        $idUsuario = Auth::id();

        $user_unidade = User::findOrFail($idUsuario)->id;

        $resultados_busca = $this->buscarUnidade($key, $user_unidade);

        $user_data = $this->procurar_user_por_id($user_unidade);
        $unid_data = $this->procurar_unid_por_id($user_unidade);
        $list_unid = $this->listarUnidadeUsuario($user_unidade);

        return view('app.unidade.unidades', compact('resultados_busca', 'user_data', 'unid_data', 'list_unid'));
    }

    public function cadastro(Request $request)
    {
        $idUsuario = Auth::id();

    $validatedData = $request->validate([
        'nome' => 'required',
        'endereco' => 'required',
        'contato' => 'required',
        'modalidades' => 'required|array',
    ]);

    $check_name = DB::table('unidade')
        ->where('nm_unidade', $validatedData['nome'])
        ->where('ds_contato', $validatedData['contato'])
        ->where('id_usuario', $idUsuario)
        ->count();

    if ($check_name > 0) {
        return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
    }

    // Cria a unidade esportiva
    /*O insertGetId() é usado para inserir a nova unidade esportiva e retornar seu ID. 
    Em seguida, para cada ID de modalidade no array modalidades, um novo registro é 
    inserido na tabela unidade_modalidade com o ID da unidade esportiva, 
    o ID da modalidade e o horário da aula*/
    $unidade = DB::table('unidade')->insertGetId([
        'nm_unidade' => $validatedData['nome'],
        'ds_endereco' => $validatedData['endereco'],
        'ds_contato' => $validatedData['contato'],
        'id_usuario' => $idUsuario
    ]);

    // Associa as modalidades à unidade esportiva
    foreach ($validatedData['modalidades'] as $modalidade) {
        DB::table('unidade_modalidade')->insert([
            'id_unidade' => $unidade,
            'id_modalidade' => $modalidade,
            'ds_horario' => $request->input('horario_'.$modalidade),
        ]);
    }

        return redirect()->back()->with('success', 'unidade cadastrada com sucesso.');
    }

    public function atualizar(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'contato' => 'required',
            'modalidades' => 'required|array',
        ]);

        $existingUnid = DB::table('unidade')
            ->where('id_usuario', $idUsuario)
            ->where('nm_unidade', $validatedData['nome'])
            ->where('ds_contato', $validatedData['contato'])
            ->where('id_unidade', '<>', $request->input('id'))
            ->first();

        if ($existingUnid) {
            return ['errorMessage' => 'Este título já está sendo usado em outra unidade. Por favor, escolha um título diferente.'];
        }

        $updated = DB::table('unidade')
            ->where('id_unidade', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->update([
                'nm_unidade' => $validatedData['nome'],
                'ds_endereco' => $validatedData['endereco'],
                'ds_contato' => $validatedData['contato'],
            ]);

        if ($updated) {
            // Remove todas as associações existentes entre a unidade e as modalidades
            DB::table('unidade_modalidade')->where('id_unidade', $request->input('id'))->delete();

            // Reinsere as associações atualizadas entre a unidade e as modalidades
            foreach ($validatedData['modalidades'] as $modalidade) {
                DB::table('unidade_modalidade')->insert([
                    'id_unidade' => $request->input('id'),
                    'id_modalidade' => $modalidade,
                    'ds_horario' => $request->input('horario_'.$modalidade),
                ]);
            }

            return redirect()->route("app.unidade.index");
            /*return ['successMessage' => 'Informações da unidade atualizadas com sucesso'];*/
        } else {
            return ['errorMessage' => 'unidade não encontrada'];
        }
    }
    
    public function excluir($id)
    {
        $deleted = DB::table('unidade')->where('id_unidade', $id)->delete();

        if ($deleted) {
            return redirect()->route("app.unidade.index");
            //return ['successMessage' => 'unidade excluída com sucesso'];
        } else {
            //return ['errorMessage' => 'unidade não Encontrada'];
        }
    }

    private function procurar_unid_por_id($id)
    {
        $unid = DB::table('unidade')->where('id_unidade', $id)->first();
        return $unid ? $unid : false;
    }

    public function editar(Request $request)
    {
        $id = $request->input('unid_id');
        $unid = Unidade::findOrFail($id);
        
        return view('app.unidade.editar', compact('unid'));
    }

    public function mostraUnidade($id)
    {
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $idUsuario = Auth::id();
    
            $user_mod = User::findOrFail($idUsuario)->id;
            if ($user_mod) {                
                $user_data = $this->procurar_user_por_id($user_mod);
                $unid_data = $this->procurar_unid_por_id($id);    
    
                // Busca as modalidades e os horários associados à unidade
                $modalidades = DB::table('unidade_modalidade')
                    ->where('unidade_modalidade.id_unidade', $id)
                    ->join('modalidade', 'unidade_modalidade.id_modalidade', '=', 'modalidade.id_modalidade')
                    ->select('modalidade.*', 'unidade_modalidade.ds_horario')
                    ->get();
    
                return view('app.unidade.show', compact('user_data', 'unid_data', 'modalidades'));  
            }
        }        
    }
    
}
