<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function showRedefinirSenhaForm()
    {
        return view('redefinir_senha');
    }

    public function redefinirSenha(Request $request)
    {
        $validatedData = $request->validate([
            'senha' => 'required|confirmed',
        ]);

        $userId = Auth::id();
        DB::table('usuario')
            ->where('id', $userId)
            ->update([
                'ds_senha' => Hash::make($validatedData['senha']),
                'ic_precisa_redefinir_senha' => 0,
            ]);

        return redirect()->route('app.home')->with('message', 'Senha redefinida com sucesso!');
    }

    public function verificarEmail($id)
    {
        $usuario = DB::table('usuario')->where('cd_usuario', $id)->first();

        if ($usuario) {
            DB::table('usuario')
                ->where('cd_usuario', $id)
                ->update([
                    'ic_email_verificado' => 1,
                    'ic_precisa_redefinir_senha' => 1
                ]);

            return view('emails.verificado')->with('message', 'Email verificado com sucesso! Sua conta foi ativada. Você pode agora fazer login e acessar todos os recursos do sistema.');
        } else {
            return view('emails.verificado')->with('error', 'Usuário não encontrado.');
        }
    }
}
