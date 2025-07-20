<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // 商品一覧ページ
    public function index()
    {
    // 商品全取得
    $products = Product::all();

    return view('index', compact('products'));
    }

    public function show($id)
    {
    $product = Product::with(['comments.user', 'categories'])
    // リレーション
                ->withCount(['likes', 'comments']) // いいね数・コメント数
                ->findOrFail($id);

    return view('products.show', compact('product'));
    }

    public function create()
    {
    $categories = Category::all();
    $conditions = Condition::all();

    return view('products.product_create', compact('categories', 'conditions'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'brand_name' => 'nullable|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'condition_id' => 'required|exists:conditions,id',
        'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 画像アップロード
    if ($request->hasFile('img_url')) {
        $path = $request->file('img_url')->store('products', 'public');
    }

    $product = Product::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'brand_name' => $request->brand_name,
        'description' => $request->description,
        'price' => $request->price,
        'condition_id' => $request->condition_id,
        'img_url' => $path ?? null,
    ]);

    // カテゴリ関連づけ（中間テーブル）
    if ($request->has('category_ids')) {
        $product->categories()->sync($request->category_ids);
    }

    return redirect()->route('products.create')->with('success', '商品を出品しました。');
}
}
