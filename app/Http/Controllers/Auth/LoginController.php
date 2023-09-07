<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * ログインコントローラー
 */
class LoginController extends Controller
{
    /**
     * ログイン
     */
    public function login(Request $request): object
    {
        Log::debug('LoginController::login()');

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            return response()->json(['message' => 'Logged in']);
        }
    }

    /**
     * ログアウト
     */
    public function logout(): object
    {
        Log::debug('LoginController::logout()');

        Auth::logout();
        return response()->json(['message' => 'Logged out']);
    }
}
