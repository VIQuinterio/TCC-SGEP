<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

class DashboardController extends Controller
{
    public function dashboard(){
    
        if (Auth::check() && Auth::user()->sg_tipo == 'ADMIN') {
            $user_id = Auth::id(); 
            
            $user_data = $this->procurar_user_por_id($user_id);
            
            $list_users = $this->todosUsuarios($user_id);
            
            return view('admin.dashboard', compact('user_data', 'list_users'));
        } else {            
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
    
        return $users; 
    }
    
    public function buscar(Request $request)
    {
        $key = $request->input('nome'); 

        $resultados_busca = $this->buscarUsuario($key);
        
        $user_id = Auth::id();
        $user_data = $this->procurar_user_por_id($user_id);
        $list_users = $this->todosUsuarios($user_id);
        
        return view('admin.dashboard', compact('resultados_busca', 'user_data', 'list_users'));
    }
    
    private function procurar_user_por_id($id)
    {
        $user = User::find($id);
        return $user ? $user : null;
    }

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
        if (Auth::check() && Auth::user()->sg_tipo == 'ADMIN') {
 
            $user_id = Auth::id();         
            $user_data = $this->procurar_user_por_id($user_id);
            
            $find_user_data = User::find($id);
            return view('admin.edicao', compact('find_user_data', 'user_data'));
        }    
    }

    public function mostrarFormularioCadastro()
    {  
        if (Auth::check() && Auth::user()->sg_tipo == 'ADMIN') {
            $user_id = Auth::id(); 
            
            $user_data = $this->procurar_user_por_id($user_id);
            
            $list_users = $this->todosUsuarios($user_id);
            
            return view('admin.cadastro', compact('user_data'));
        }
    }

    public function cadastro(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'idUsuario' => 'required',
        ]);

        // Gera uma senha aleatória de 6 caracteres
        $randomPassword = $this->generateRandomPassword(6);
        
        // Hash da senha aleatória gerada
        $hash_pass = Hash::make($randomPassword);

        // Insere o novo usuário e obtém o ID do registro inserido
        $userId = DB::table('usuario')->insertGetId([
            'ds_email' => $validatedData['email'],
            'nm_usuario' => $validatedData['nome'],
            'ds_senha' => $hash_pass,
            'cd_usuario' => $validatedData['idUsuario']
        ]);

        // Filtre os dados que deseja enviar no e-mail
        $userData = [
            'email' => $validatedData['email'],
            'senha' => $randomPassword, // Use a senha aleatória gerada
            'id' => $userId, // Use o ID do banco de dados aqui
            'cd_usuario' => $validatedData['idUsuario']
        ];
        
        // Envie o e-mail de boas-vindas
        Mail::to($validatedData['email'])->send(new UserRegistered($userData, $validatedData['email']));

        return redirect()->route("admin.dashboard")->with('success', 'Usuário cadastrado e email enviado com sucesso');
    }

    // Função para gerar uma senha aleatória
    private function generateRandomPassword($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $charactersLength = strlen($characters);
        $randomPassword = '';
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomPassword;
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
            return redirect()->route("admin.dashboard")->with('success', 'Informações do usuário atualizadas com sucesso');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Usuário não encontrado');
        }
    }

    public function excluir($user_id)
    {
        $deleted = DB::table('usuario')->where('id', $user_id)->delete();

        if ($deleted) {
            return redirect()->route("admin.dashboard")->with('success', 'Usuário excluído com sucesso');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Usuário não encontrado');
        }
    }
}
