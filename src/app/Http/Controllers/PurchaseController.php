<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\SoldProduct;
use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;

class PurchaseController extends Controller
{
    // 表示
    public function show($id)
    {
        $product = Product::with('categories', 'condition')->findOrFail($id);
        $user = Auth::user();
        $profile = $user->profile; // profilesテーブルから住所情報を取得

        // セッションから支払い方法を取得
        $selectedPaymentMethod = session('selected_payment_method', null);

        return view('products.purchase', compact('product', 'user', 'profile', 'selectedPaymentMethod'));
    }

    // 購入処理
    public function submit(PurchaseRequest $request, $id)
    {
        $validated = $request->validated();

        $product = Product::findOrFail($id);
        $user = Auth::user();
        $profile = $user->profile;

        // SoldProduct に購入情報を保存
        SoldProduct::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'sending_zip' => $profile->zip,
            'sending_address' => $profile->address,
            'sending_building' => $profile->building,
            'payment_method'  => $request->payment_method,
        ]);

        return redirect()
    ->route('products.index')
    ->with([
        'success' => '購入が完了しました！',
        'selected_payment_method' => $request->payment_method,
    ]);
    }

        // 住所編集画面表示
    public function edit($item_id)
        {
            $product = Product::findOrFail($item_id);
            $profile = Auth::user()->profile; // profilesテーブルから住所取得
            return view('mypage.address', compact('product', 'profile'));
        }

    // 住所情報の保存・更新
    public function update(Request $request, $item_id)
    {
        $validated = $request->validate([
            'zip'         => 'required|string|max:10',
            'address'     => 'required|string|max:255',
            'building'    => 'nullable|string|max:255',
        ]);

        // ユーザーのプロフィール更新
        Auth::user()->profile()->updateOrCreate(
            ['user_id' => Auth::id()], // 更新条件：ユーザーID
            $validated                 // 更新データ
        );

    return redirect()->route('purchase.show', ['id' => $item_id]);
    }

    public function store(ExhibitionRequest $request)
    {
    // リクエストバリデーション済みデータを取得
    $validated = $request->validated();

    // 画像保存
    $path = $request->file('img_url')->store('images', 'public');

    // 商品登録
    $product = new Product();
    $product->img_url = $path;
    $product->name = $validated['name'];
    $product->brand_name = $validated['brand_name'] ?? null;
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->condition_id = $validated['condition_id'];
    $product->user_id = auth()->id();
    $product->save();

    // カテゴリ保存
    $product->categories()->attach($validated['categories']);

    return redirect()->route('products.index')->with('success', '商品を出品しました');
}

    public function create()
{
    $categories = Category::all();
    $conditions = Condition::all();
    return view('product_create', compact('categories', 'conditions'));
}
}