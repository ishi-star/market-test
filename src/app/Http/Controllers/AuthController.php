<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // 登録フォームの表示
    public function showRegisterForm()
    {
        return view('auth/register'); // resources/views/register.blade.php を表示
    }

    // 登録処理（必要なら）
    public function register(Request $request)
    {
        // 登録処理を書く（今回は表示のみでOK）
    }

    public function showLoginForm()
    {
        return view('auth.login'); // このパスが `resources/views/auth/login.blade.php`
    }
}
