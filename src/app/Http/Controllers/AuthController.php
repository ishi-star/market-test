<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    // 登録フォームの表示
    public function showRegisterForm()
    {
        return view('auth/register'); // resources/views/register.blade.php を表示
    }

    // 登録処理（必要なら）
    public function register(RegisterRequest $request)
    {
        // 登録処理を書く（今回は表示のみでOK）
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);
        $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    // 登録後にログイン状態にする
    Auth::login($user);

    // プロフィール作成画面にリダイレクト
    return redirect()->route('profile.create');

    }

    public function showLoginForm()
    {
        return view('auth.login'); // このパスが `resources/views/auth/login.blade.php`
    }

public function login(LoginRequest $request)
{
    // validate移動
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/?tab=mylist');
    }

    return back()->withErrors([
        'email' => 'ログイン情報が登録されていません。',
    ])->withInput();
}
}
