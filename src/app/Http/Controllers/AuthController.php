<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // セッション再生成（セキュリティ対策）
        return redirect()->intended('/'); // ログイン後にリダイレクト
    }

    return back()->withErrors([
        'email' => 'メールアドレスまたはパスワードが正しくありません。',
    ])->withInput();
}
}
