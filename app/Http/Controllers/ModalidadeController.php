<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Modalidade;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\AuthTrait;

class ModalidadeController extends Controller
{
    use AuthTrait;

    public function index()
    {        
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); 
            
            $user_modalidade = User::findOrFail($user_id)->id;
            
            if ($user_modalidade) {
                
                $user_data = $this->procurar_user_por_id($user_id);
                
                $mod_data = $this->procurar_mod_por_id($user_modalidade);
                
                $list_mods = $this->listarModalidadeUsuario($user_modalidade);
                
                return view('app.modalidade.modalidades', compact('user_data', 'mod_data', 'list_mods'));
            } else {                
                return redirect()->route('login')->with('error', 'Você não tem uma modalidade associada.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Você precisa fazer login como usuário para acessar o painel.');
        }
    }

    protected function listarUnidadeUsuario($idUsuario)
    {
        return Unidade::where('id_usuario', $idUsuario)->get();
    }

    public function listarModalidades($id){
        $mod = DB::table('modalidade')->where('id_usuario', $id)->get();
        return $mod;
    }
    
    public function listarModalidadeUsuario($id)
    {
        $sortMapping = [
            'nome' => 'nm_modalidade',
            'descricao' => 'ds_modalidade'
        ];
    
        $sortKey = request()->input('sort', 'id_usuario');
    
        $sortAttribute = $sortMapping[$sortKey] ?? $sortKey;
    
        $direction = request()->input('direction', 'desc');

        return Modalidade::where('id_usuario', $id)
            ->orderBy($sortAttribute, $direction)
            ->orderByRaw('GREATEST(created_at, updated_at) ' . $direction)
            ->paginate(10);
    }

    public function buscarModalidade($key, $id)
    {
        $mod = DB::table('modalidade')
            ->where('id_usuario', $id)
            ->where(function ($query) use ($key) {
                $query->where('nm_modalidade', 'like', "%$key%")
                    ->orWhere('ds_modalidade', 'like', "%$key%");
            })            
            ->paginate(10); 

        return $mod;
    }
    
    public function buscar(Request $request)
    {
        $key = $request->input('buscar'); 
        $idUsuario = Auth::id();

        $user_modalidade = User::findOrFail($idUsuario)->id;

        $resultados_busca = $this->buscarModalidade($key, $user_modalidade);

        $user_data = $this->procurar_user_por_id($user_modalidade);
        $mod_data = $this->procurar_mod_por_id($user_modalidade);
        $list_mods = $this->listarModalidadeUsuario($user_modalidade);

        return view('app.modalidade.modalidades', compact('resultados_busca', 'user_data', 'mod_data', 'list_mods'));
    }

    public function cadastro(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
        ]);

        $check_name = DB::table('modalidade')
            ->where('nm_modalidade', $validatedData['nome'])
            ->where('id_usuario', $idUsuario)
            ->count();

        if ($check_name > 0) {
            return redirect()->back()->with('error', 'Este nome já está registrado. Por favor, escolha um nome diferente.');
        }

        DB::table('modalidade')->insert([
            'nm_modalidade' => $validatedData['nome'],
            'ds_modalidade' => $validatedData['descricao'],
            'id_usuario' => $idUsuario,
            'created_at' => now()
        ]);

        return redirect()->back()->with('success', 'Modalidade cadastrada com sucesso.');
    }

    public function atualizar(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required|string',
            'descricao' => 'required|string',
        ]);

        $existingMod = DB::table('modalidade')
            ->where('id_usuario', $idUsuario)
            ->where('nm_modalidade', $validatedData['nome'])
            ->where('id_modalidade', '<>', $request->input('id'))
            ->first();
    
        if ($existingMod) {
            return redirect()->back()->with('error', 'Este nome já está registrado. Por favor, escolha um nome diferente.');
        }
        
        $updated = DB::table('modalidade')
            ->where('id_modalidade', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->update([
                'nm_modalidade' => $validatedData['nome'],
                'ds_modalidade' => $validatedData['descricao'],
                'updated_at' => now()
            ]);
 
        if ($updated) {
            return redirect()->back()->with('success', 'Informações da modalidade atualizadas com sucesso');
        } else {
            return redirect()->back()->with('error', 'Modalidade não encontrada');
        }
        
    }
    
    public function excluir($id)
    {
        $deleted = DB::table('modalidade')->where('id_modalidade', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Modalidade excluída com sucesso');
        } else {
            return redirect()->back()->with('error', 'Modalidade não Encontrada');
        }
    }

    private function procurar_mod_por_id($id)
    {
        $mod = DB::table('modalidade')->where('id_modalidade', $id)->first();
        return $mod ? $mod : false;
    }

    public function editar(Request $request)
    {
        $id = $request->input('mod_id');
        $mod = Modalidade::findOrFail($id);
        return view('app.modalidade.editar', compact('mod'));
    }

    public function mostraModalidadeUnidade($id)
    {
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $idUsuario = Auth::id();
            
            $user_mod = User::findOrFail($idUsuario)->id;
            if ($user_mod) {                
                $user_data = $this->procurar_user_por_id($user_mod);
                $mod_data = $this->procurar_mod_por_id($id);    
                $list_mod = $this->listarModalidadeUsuario($user_mod);

                // Busca as unidades que oferecem a modalidade selecionada e agrupa por unidade
                $modalidades = DB::table('unidade_modalidade')
                    ->where('unidade_modalidade.id_modalidade', $id)
                    ->join('unidade', 'unidade_modalidade.id_unidade', '=', 'unidade.id_unidade')
                    ->select('unidade.id_unidade', 'unidade.nm_unidade', 'unidade.ds_endereco', 'unidade.ds_contato', 'unidade_modalidade.ds_horario', 'unidade_modalidade.ds_dia_semana')
                    ->get();

                $unidades = [];
                foreach ($modalidades as $modalidade) {
                    $unidades[$modalidade->nm_unidade][] = $modalidade;
                }

                return view('app.modalidade.show', compact('user_data', 'mod_data', 'list_mod', 'unidades'));  
            }
        }        
    }
}
