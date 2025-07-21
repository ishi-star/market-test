<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function create()
{
    return view('profile.create'); // 作成したBladeファイル名に合わせて変更
}

public function store(Request $request)
{
    $validated = $request->validate([
        'avatar' => 'nullable|image|max:2048',
        'username' => 'required|string|max:255',
        'postcode' => 'required|string|max:10',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
    ]);

    // 画像の保存処理（オプション）
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $validated['avatar'] = $path;
    }

    // プロフィール保存処理（モデルに応じて変更）
    auth()->user()->profile()->create($validated);

    return redirect()->route('dashboard')->with('success', 'プロフィールを登録しました');
}

}
