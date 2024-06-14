<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\UsuarioController;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $user = User::where('ds_email', $validatedData['email'])->first();

        if ($user) {
            if ($user->ds_senha) {
                Auth::login($user);

                if ($user->ic_email_verificado != 1) { // false
                    return redirect()->route('login')->with('error', 'Email não verificado');
                }
                
                if ($user->sg_tipo == 'ADMIN') {
                    return redirect()->route('admin.dashboard');
                } else {
                    if ($user->ic_precisa_redefinir_senha != 0) {
                        return redirect()->route('redefinir_senha.user')->with('message', 'Por favor, redefina sua senha');
                    }else{
                        return redirect()->route('app.home');
                    }
                }
            } else {
                return redirect()->route('login')->with('error', 'Senha inválida');
            }
        } else {
            return redirect()->route('login')->with('error', 'Usuário não encontrado');
        }
    }
    
    
    
}
