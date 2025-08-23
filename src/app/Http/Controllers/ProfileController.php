<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SoldProduct;
use App\Http\Requests\ProfileRequest;


class ProfileController extends Controller
{
        public function mypage(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab', 'selling'); // デフォルトは selling

        // 出品した商品
        $sellingProducts = Product::where('user_id', $user->id)->get();

        // 購入した商品（Purchase モデルに user_id, product_id がある前提）
        $purchasedProducts = SoldProduct::with('product')
            ->where('user_id', $user->id)
            ->get();

        // $products = $user->products ?? collect(); Eloquentリレーションがある前提
        return view('mypage.profile', compact('user', 'tab', 'sellingProducts', 'purchasedProducts'));
         // resources/views/profile/index.blade.php
    }

    public function create()
{
    return view('mypage.profile_create'); // 作成したBladeファイル名に合わせる
}

    public function store(ProfileRequest $request)
{

    $validated = $request->validated();


        $user = auth()->user();

    // 画像の保存
    if ($request->hasFile('img_url')) {
        $path = $request->file('img_url')->store('profile', 'public');
        $validated['img_url'] = $path;
    }


    // 既に profile があれば更新、なければ作成
    if ($user->profile) {
        $user->profile->update($validated);
    } else {
        $user->profile()->create($validated);
    }

    // リダイレクト先を存在するルート名に変更
    return redirect()->route('mypage')->with('success', 'プロフィールを登録しました');
}
        public function edit()
    {
        $user = Auth::user(); // 現在ログイン中のユーザー情報
        return view('mypage.profile_create', compact('user'));
    }
}