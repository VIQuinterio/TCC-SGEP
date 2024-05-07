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

                $list_unidades = $this->listarUnidadeUsuario($user_id);
                
                return view('app.modalidade.modalidades', compact('user_data', 'mod_data', 'list_mods', 'list_unidades'));
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

        $mod = DB::table('modalidade as m')
            ->join('unidade as u', 'm.id_unidade', '=', 'u.id_unidade')
            ->select('m.id_modalidade', 'm.nm_modalidade', 'm.ds_modalidade', 'u.nm_unidade')
            ->where('m.id_usuario', $id)
            ->get();
        
        return $mod;
        
    }
    
    public function listarModalidadeUsuario($id)
    {
        $sortMapping = [
            'nome' => 'm.nm_modalidade',
            'descricao' => 'm.ds_modalidade',
            'unidade' => 'u.nm_unidade',
        ];

        $sortKey = request()->input('sort', 'm.id_usuario');

        $sortAttribute = $sortMapping[$sortKey] ?? $sortKey;

        $direction = request()->input('direction', 'asc');

        return DB::table('modalidade as m')
            ->join('unidade as u', 'm.id_unidade', '=', 'u.id_unidade')
            ->select('m.id_modalidade', 'm.nm_modalidade', 'm.ds_modalidade', 'u.nm_unidade')
            ->where('m.id_usuario', $id)
            ->orderBy($sortAttribute, $direction)
            ->paginate(10);
    }

    public function buscarModalidade($key, $id)
    {
        $mod = DB::table('modalidade as m')
            ->join('unidade as u', 'm.id_unidade', '=', 'u.id_unidade')
            ->select('m.id_modalidade', 'm.nm_modalidade', 'm.ds_modalidade', 'u.nm_unidade')
            ->where('m.id_usuario', $id)
            ->orWhere('m.nm_modalidade', 'like', '%' . $key . '%')
            ->orWhere('m.ds_modalidade', 'like', '%' . $key . '%')
            ->orWhere('u.nm_unidade', 'like', '%' . $key . '%')
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
        $list_unidades = $this->listarUnidadeUsuario($idUsuario);

        return view('app.modalidade.modalidades', compact('resultados_busca', 'user_data', 'mod_data', 'list_mods', 'list_unidades'));
    }

    public function cadastro(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'id_unidade' => 'required',
        ]);

        $check_name = DB::table('modalidade')
            ->where('nm_modalidade', $validatedData['nome'])
            ->where('id_usuario', $idUsuario)
            ->where('id_unidade', '<>', $request->input('id'))
            ->count();

        if ($check_name > 0) {
            return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
        }

        DB::table('modalidade')->insert([
            'nm_modalidade' => $validatedData['nome'],
            'ds_modalidade' => $validatedData['descricao'],
            'id_unidade' => $validatedData['id_unidade'],
            'id_usuario' => $idUsuario
        ]);

        return redirect()->back()->with('success', 'Modalidade cadastrada com sucesso.');
    }

    public function atualizar(Request $request)
    {
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'id_unidade' => 'required',
        ]);

        $existingMod = DB::table('modalidade')
            ->where('id_usuario', $idUsuario)
            ->where('nm_modalidade', $validatedData['nome'])
            ->where('id_unidade', '<>', $request->input('id'))
            ->first();
    
        if ($existingMod) {
            return ['errorMessage' => 'Este nome já está sendo usado em outro notícia. Por favor, escolha um título diferente.'];
        }
        
        $updated = DB::table('modalidade')
            ->where('id_modalidade', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->update([
                'nm_modalidade' => $validatedData['nome'],
                'ds_modalidade' => $validatedData['descricao'],
                'id_unidade' => $validatedData['id_unidade'],   
            ]);
 
        if ($updated) {
            return redirect()->route("app.modalidade.index");
            /*return ['successMessage' => 'Informações da Modalidade atualizadas com sucesso'];*/
        } else {
            return ['errorMessage' => 'Modalidade não encontrada'];
        }
        
    }
    
    public function excluir($id)
    {
        $deleted = DB::table('modalidade')->where('id_modalidade', $id)->delete();

        if ($deleted) {
            return ['successMessage' => 'Modalidade excluída com sucesso'];
        } else {
            return ['errorMessage' => 'Modalidade não Encontrada'];
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
}
