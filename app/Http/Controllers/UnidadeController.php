<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\AuthTrait;

class UnidadeController extends Controller
{
    use AuthTrait;

    public function index()
    {

        // Verifique se o usuário está autenticado e é um usuário comum
        if (Auth::check() && Auth::user()->sg_tipo == 'USER') {
            $user_id = Auth::id(); // Obtenha o ID do usuário autenticado

            // Obtenha o ID da unidade associada ao usuário autenticado
            $user_unidade = User::findOrFail($user_id)->id;

            // Verifique se o usuário tem uma unidade associada
            if ($user_unidade) {
                // Obtenha os dados do usuário autenticado
                $user_data = $this->procurar_user_por_id($user_id);

                // Obtenha os dados da unidade
                $unid_data = $this->procurar_unid_por_id($user_unidade);

                // Se o usuário tiver uma unidade, obtenha todas as unidades do usuário
                $list_unid = $this->listarUnidadeUsuario($user_unidade);

                // Renderize a view do dashboard passando os dados necessários
                return view('app.unidade.unidades', compact('user_data', 'unid_data', 'list_unid'));
            } else {
                // Se o usuário não tiver uma unidade associada, retorne uma mensagem de erro
                return redirect()->route('login')->with('error', 'Você não tem uma unidade associada.');
            }
        } else {
            // Se o usuário não estiver autenticado ou não for um usuário comum, redirecione para a página de login
            return redirect()->route('login')->with('error', 'Você precisa fazer login como usuário para acessar o painel.');
        }
    }

    public function listarUnidadeUsuario($id)
    {
        $sort = request()->input('sort', 'id_usuario');
        $direction = request()->input('direction', 'asc');

        return Unidade::where('id_usuario', $id)
            ->orderBy($sort, $direction)
            ->paginate(10);
    }

    public function buscarUnidade($key, $id)
    {
        $unid = DB::table('unidade')
            ->where('id_usuario', $id)
            ->where(function ($query) use ($key) {
                $query->where('nm_unidade', 'like', "%$key%")
                    ->orWhere('ds_endereco', 'like', "%$key%");
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

        // Retorne a view dashboard com os resultados da busca
        return view('app.unidade.unidades', compact('resultados_busca', 'user_data', 'unid_data', 'list_unid'));
    }

    public function cadastro(Request $request)
    {
        // Obtenha o ID do usuário autenticado
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
        ]);

        $check_name = DB::table('unidade')
            ->where('nm_unidade', $validatedData['nome'])
            ->where('id_usuario', $idUsuario)
            ->count();

        if ($check_name > 0) {
            return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
        }

        DB::table('unidade')->insert([
            'nm_unidade' => $validatedData['nome'],
            'ds_endereco' => $validatedData['endereco'],
            'id_usuario' => $idUsuario
        ]);

        // Após o cadastro, redirecione de volta para a mesma página
        return redirect()->back()->with('success', 'unidade cadastrada com sucesso.');
    }

    public function atualizar(Request $request)
    {
        // Obtenha o ID do usuário autenticado
        $idUsuario = Auth::id();

        $validatedData = $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
        ]);

        $check_name = DB::table('unidade')
            ->where('nm_unidade', $validatedData['nome'])
            ->where('id_unidade', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->count();
 
        if ($check_name > 0) {
            return ['errorMessage' => 'Este nome já está registrado. Tente outro.'];
        }
 
        $updated = DB::table('unidade')
            ->where('id_unidade', $request->input('id'))
            ->where('id_usuario', $idUsuario)
            ->update([
                'nm_unidade' => $validatedData['nome'],
                'ds_endereco' => $validatedData['endereco']
            ]);
 
        if ($updated) {
            return redirect()->route("app.unidade.index");
            //return ['successMessage' => 'Informações da unidade atualizadas com sucesso'];
        } else {
             return ['errorMessage' => 'unidade não encontrada'];
        }
        
    }
    
    public function excluir($id)
    {
        $deleted = DB::table('unidade')->where('id_unidade', $id)->delete();

        if ($deleted) {
            return ['successMessage' => 'unidade excluída com sucesso'];
        } else {
            return ['errorMessage' => 'unidade não Encontrada'];
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
}
