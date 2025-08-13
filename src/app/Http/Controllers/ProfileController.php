<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;


class ProfileController extends Controller
{
    //

        public function index()
    {
        $user = Auth::user();
        $products = $user->products ?? collect();// Eloquentリレーションがある前提
        return view('mypage.profile', compact('user','products'));
         // resources/views/profile/index.blade.php
    }

    public function create()
{
    return view('mypage.profile_create'); // 作成したBladeファイル名に合わせて変更
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'avatar'   => 'nullable|image|max:2048',
        'name' => 'required|string|max:255',
        'zip' => 'required|string|max:20', // DBカラムに合わせる
        'address'  => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
    ]);

    // 画像の保存
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $validated['avatar'] = $path;
    }

    $user = auth()->user();

    // 既に profile があれば更新、なければ作成
    if ($user->profile) {
        $user->profile->update($validated);
    } else {
        $user->profile()->create($validated);
    }

    // リダイレクト先を存在するルート名に変更
    return redirect()->route('profile.index')->with('success', 'プロフィールを登録しました');
}
        public function edit()
    {
        $user = Auth::user(); // 現在ログイン中のユーザー情報
        return view('mypage.profile_create', compact('user'));
    }
}