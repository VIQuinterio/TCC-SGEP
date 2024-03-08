<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// Importe o modelo User no topo do seu arquivo
use App\Models\User;
class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        // Busca o usuário pelo email usando o modelo User
        $user = User::where('ds_email', $validatedData['email'])->first();

        // Verifica se o usuário foi encontrado
        if ($user) {
            // Verifica se a senha está correta
            if ($user->ds_senha) {
                // Autentica o usuário
                Auth::login($user);

                // Verifica o tipo de usuário
                if ($user->sg_tipo == 'ADMIN') {
                    // Se for admin, redireciona para o dashboard admin
                    return redirect()->route('admin.dashboard');
                } else {
                    // Se for usuário normal, redireciona para o dashboard de usuário
                    return redirect()->route('app.home');
                }
            } else {
                // Senha inválida
                return redirect()->route('login')->with('error', 'Senha inválida');
            }
        } else {
            // Usuário não encontrado
            return redirect()->route('login')->with('error', 'Usuário não encontrado');
        }
    }    
}
