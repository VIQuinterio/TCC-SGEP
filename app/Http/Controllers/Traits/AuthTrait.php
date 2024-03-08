<?php

namespace App\Http\Controllers\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuthTrait
{
    protected function procurar_user_por_id($id)
    {
        $user = User::find($id);
        return $user ? $user : null;
    }

    protected function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route("login");
    }
}