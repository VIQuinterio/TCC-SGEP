<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard(){

        // Verifique se o usuário está autenticado e é um administrador
        if (Auth::check() && Auth::user()->sg_tipo == 'ADMIN') {
            $user_id = Auth::id(); // Obtenha o ID do usuário autenticado

            // Obtenha os dados do usuário autenticado
            $user_data = $this->procurar_user_por_id($user_id);

            // Se o usuário for admin, obtenha todos os usuários
            $list_users = $this->todosUsuarios($user_id);

            // Renderize a view do dashboard passando os dados necessários
        return view('admin.dashboard', compact('user_data', 'list_users'));
        } else {
            // Se o usuário não estiver autenticado ou não for um administrador, redirecione para a página de login
            return redirect()->route('login')->with('error', 'Você precisa fazer login como administrador para acessar o painel.');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route("login");
    }

    public function buscarUsuario($key)
    {
        $users = DB::table('usuario')
            ->where('nm_usuario', 'like', "%{$key}%")
            ->orWhere('cd_usuario', 'like', "%{$key}%")
            ->paginate(10); 
    
        return $users; // Isso retorna uma coleção de objetos stdClass
    }
    
    public function buscar(Request $request)
    {
        $key = $request->input('nome'); // ou qualquer outro nome de parâmetro que você esteja usando

        $resultados_busca = $this->buscarUsuario($key);

        // Obtenha outros dados necessários, como o usuário logado
        $user_id = Auth::id();
        $user_data = $this->procurar_user_por_id($user_id);
        $list_users = $this->todosUsuarios($user_id);

        // Retorne a view dashboard com os resultados da busca
        return view('admin.dashboard', compact('resultados_busca', 'user_data', 'list_users'));
    }

    // Função para procurar o usuário por ID
    private function procurar_user_por_id($id)
    {
        $user = User::find($id);
        return $user ? $user : null;
    }

    // Função para obter todos os usuários (exceto o usuário atual)
    private function todosUsuarios($id)
    {
        $sort = request()->input('sort', 'id');
        $direction = request()->input('direction', 'asc');
    
        return User::where('id', '!=', $id)
                   ->orderBy($sort, $direction)
                   ->paginate(10);
    }
      

    public function mostrarFormularioEdicao($id)
    {
        // Verifique se o usuário está autenticado e é um administrador
        if (Auth::check() && Auth::user()->sg_tipo == 'ADMIN') {
 
            $user_id = Auth::id();         
            $user_data = $this->procurar_user_por_id($user_id);

            // Obtenha os dados do usuário a ser editado
            $find_user_data = User::find($id);
            return view('admin.edicao', compact('find_user_data', 'user_data'));
        }    
    }

    public function mostrarFormularioCadastro()
    {
        // Verifique se o usuário está autenticado e é um administrador
        if (Auth::check() && Auth::user()->sg_tipo == 'ADMIN') {
            $user_id = Auth::id(); // Obtenha o ID do usuário autenticado

            // Obtenha os dados do usuário autenticado
            $user_data = $this->procurar_user_por_id($user_id);

            // Se o usuário for admin, obtenha todos os usuários
            $list_users = $this->todosUsuarios($user_id);

            // Renderize a view do dashboard passando os dados necessários
            return view('admin.cadastro', compact('user_data'));
        }
    }

    public function cadastro(Request $request)
    {       
        $validatedData = $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:usuario,ds_email',
            'senha' => 'required',
            'idUsuario' => 'required',
        ]);

        $hash_pass = Hash::make($validatedData['senha']);

        DB::table('usuario')->insert([
            'ds_email' => $validatedData['email'],
            'nm_usuario' => $validatedData['nome'],
            'ds_senha' => $hash_pass,
            'cd_usuario' => $validatedData['idUsuario']
        ]);

        return redirect()->route("admin.dashboard");
    }

    public function atualizar(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'senha' => 'required',
            'idUsuario' => 'required',
        ]);

        $hash_pass = Hash::make($validatedData['senha']);

        $updated = DB::table('usuario')
            ->where('id', $id)
            ->update([
                'nm_usuario' => $validatedData['nome'],
                'ds_email' => $validatedData['email'],
                'ds_senha' => $hash_pass,
                'cd_usuario' => $validatedData['idUsuario']
            ]);

        if ($updated) {
            return redirect()->route("admin.dashboard");
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Usuário não encontrado');
        }
    }

    public function excluir($user_id)
    {
        $deleted = DB::table('usuario')->where('id', $user_id)->delete();

        if ($deleted) {
            return redirect()->route("admin.dashboard");
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Usuário não encontrado');
        }
    }
}
