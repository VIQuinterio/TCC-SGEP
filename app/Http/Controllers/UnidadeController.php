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
            
                $list_unid = $this->listarUnidadeUsuario($user_id);

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
    
        $direction = request()->input('direction', 'desc');
    
        return Unidade::with('modalidades')
            ->where('id_usuario', $id)
            ->orderBy($sortAttribute, $direction)
            ->orderByRaw('GREATEST(created_at, updated_at) ' . $direction) // o greatest compara as variaveis para obter a data mais recente entre elas
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
        return Unidade::with('modalidades')
        ->where('id_usuario', $id)
        ->where(function ($query) use ($key) {
            $query->where('nm_unidade', 'like', '%' . $key . '%')
                ->orWhere('ds_endereco', 'like', '%' . $key . '%')
                ->orWhere('ds_contato', 'like', '%' . $key . '%');
        })
        ->paginate(10); 
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
        $list_modalidades = $this->listarModalidadeUsuario($idUsuario);

        return view('app.unidade.unidades', compact('resultados_busca', 'user_data', 'unid_data', 'list_unid', 'list_modalidades'));
    }

    public function cadastro(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'contato' => 'required',
            'secretaria' => 'required',
            'modalidades' => 'required|array',
        ]);

        // Verificar se o nome já está registrado
        $checkName = DB::table('unidade')
            ->where('nm_unidade', $validatedData['nome'])
            ->where('id_usuario', $idUsuario)
            ->count();

        if ($checkName > 0) {
            return redirect()->back()->with('error', 'Este nome já está registrado. Tente outro.');
        }

        // Verificar se o endereço já está registrado
        $checkEndereco = DB::table('unidade')
            ->where('ds_endereco', $validatedData['endereco'])
            ->where('id_usuario', $idUsuario)
            ->count();

        if ($checkEndereco > 0) {
            return redirect()->back()->with('error', 'Este endereço já está registrado. Tente outro.');
        }

        // Verificar se o contato já está registrado
        $checkContato = DB::table('unidade')
            ->where('ds_contato', $validatedData['contato'])
            ->where('id_usuario', $idUsuario)
            ->count();

        if ($checkContato > 0) {
            return redirect()->back()->with('error', 'Este contato já está registrado. Tente outro.');
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
            'ds_secretaria' => $validatedData['secretaria'],
            'id_usuario' => $idUsuario,
            'created_at' => now()
        ]);

        // Associa as modalidades à unidade esportiva
        foreach ($validatedData['modalidades'] as $modalidadeId) {
            $dias_semana = $request->input('dia_semana_' . $modalidadeId, []);
            foreach ($dias_semana as $dia) {
                $horario = $request->input('horario_' . $modalidadeId . '_' . $dia);
                DB::table('unidade_modalidade')->insert([
                    'id_unidade' => $unidade,
                    'id_modalidade' => $modalidadeId,
                    'ds_dia_semana' => $dia,
                    'ds_horario' => $horario,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Unidade cadastrada com sucesso.');
    }

    public function atualizar(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'endereco' => 'required|string',
            'contato' => 'required|string',
            'secretaria' => 'required',
            'modalidades' => 'required|array',
        ]);
    
        $idUsuario = Auth::id();

        // Verifica se os campos nome, endereço e contato foram alterados
        $unidade = DB::table('unidade')
            ->where('id_unidade', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->first();

        $camposAlterados = false;

        if ($unidade) {
            if ($unidade->nm_unidade != $validatedData['nome'] ||
                $unidade->ds_endereco != $validatedData['endereco'] ||
                $unidade->ds_contato != $validatedData['contato']) {
                $camposAlterados = true;
            }
        } else {
            return redirect()->back()->with('error', 'Unidade não encontrada');
        }

        // Atualiza a unidade apenas se os campos nome, endereço ou contato foram alterados
        if ($camposAlterados) {
            $updated = DB::table('unidade')
                ->where('id_unidade', $request->input('id'))
                ->where('id_usuario', $idUsuario)
                ->update([
                    'nm_unidade' => $validatedData['nome'],
                    'ds_endereco' => $validatedData['endereco'],
                    'ds_contato' => $validatedData['contato'],
                    'ds_secretaria' => $validatedData['secretaria'],
                    'updated_at' => now()
                ]);

            if (!$updated) {
                return redirect()->back()->with('error', 'Erro ao atualizar informações da unidade');
            }
        }

        // Atualiza as modalidades
        foreach ($validatedData['modalidades'] as $modalidadeId) {
            $dias_semana = $request->input('edit_dia_semana_' . $modalidadeId, []);
            foreach ($dias_semana as $dia) {
                $horario = $request->input('edit_horario_' . $modalidadeId . '_' . $dia);

                // Verifica se a associação já existe
                $exists = DB::table('unidade_modalidade')
                    ->where('id_unidade', $request->input('id'))
                    ->where('id_modalidade', $modalidadeId)
                    ->where('ds_dia_semana', $dia)
                    ->exists();

                if ($exists) {
                    // Atualiza a associação existente
                    DB::table('unidade_modalidade')
                        ->where('id_unidade',$request->input('id'))
                        ->where('id_modalidade', $modalidadeId)
                        ->where('ds_dia_semana', $dia)
                        ->update([
                            'ds_horario' => $horario,
                        ]);
                } else {
                    // Insere uma nova associação
                    DB::table('unidade_modalidade')->insert([
                        'id_unidade' => $request->input('id'),
                        'id_modalidade' => $modalidadeId,
                        'ds_dia_semana' => $dia,
                        'ds_horario' => $horario,
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Informações da unidade atualizadas com sucesso');
        
    }
    
    public function excluir($id)
    {
        $deletedAssociation = DB::table('unidade_modalidade')->where('id_unidade', $id)->delete();
        $deleted = DB::table('unidade')->where('id_unidade', $id)->delete();

        if ($deletedAssociation &&  $deleted) {
            return redirect()->route("app.unidade.index")->with('success', 'Unidade excluída com sucesso');
        } else {
            return redirect()->back()->with('error', 'Unidade não Encontrada');
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
        $mod_list = Modalidade::all(); 
        return view('app.unidade.editar', compact('unid', 'mod_list'));
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
                    ->select('modalidade.*', 'unidade_modalidade.ds_horario', 'unidade_modalidade.ds_dia_semana')
                    ->get();
                $groupedModalidades = [];
                foreach ($modalidades as $modalidade) {
                    $groupedModalidades[$modalidade->nm_modalidade][] = $modalidade;
                }
                return view('app.unidade.show', compact('user_data', 'unid_data', 'modalidades', 'groupedModalidades'));  
            }
        }        
    }
    
}
