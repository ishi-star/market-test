<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    // 商品一覧ページ
public function index(Request $request)
{
    $tab = $request->query('tab');
    $keyword = $request->query('keyword');

    if ($tab === 'mylist' && Auth::check()) {
        $products = Auth::user()->likes();

        if (!empty($keyword)) {
            $products = $products->where('name', 'like', "%{$keyword}%");
        }

        $products = $products->get();
    } else {
        $products = Product::where('user_id', '!=', Auth::id());

        if (!empty($keyword)) {
            $products = $products->where('name', 'like', "%{$keyword}%");
        }

        $products = $products->get();
    }

    return view('index', compact('products', 'keyword'));
}

    public function show($id)
    {
    $product = Product::with(['comments.user', 'categories'])
        ->withCount(['likes', 'comments'])
        ->findOrFail($id);

    $userLiked = false;
    if (Auth::check()) {
        $userLiked = $product->likes()->where('user_id', Auth::id())->exists();
    }

    return view('products.show', compact('product', 'userLiked'));
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
        'name'        => 'required|string|max:255',
        'brand_name'  => 'nullable|string|max:255',
        'description' => 'required|string',
        'price'       => 'required|numeric|min:0',
        'condition_id' => 'required|exists:conditions,id',
        'img_url'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'categories'  => 'required|array',
        'categories.*' => 'exists:categories,id',
    ]);

    // 画像アップロード
    $path = null;
    if ($request->hasFile('img_url')) {
        $path = $request->file('img_url')->store('products', 'public');
    }

    $product = Product::create([
        'user_id'    => Auth::id(),
        'name'       => $request->name,
        'brand_name' => $request->brand_name,
        'description' => $request->description,
        'price'      => $request->price,
        'condition_id' => $request->condition_id,
        'img_url'    => $path ?? null,
    ]);

    // カテゴリ関連づけ（中間テーブル）
    if ($request->has('categories')) {
        $product->categories()->sync($request->categories);
    }
    // 作成後は詳細ページに飛ばす
    return redirect()->route('products.show', $product->id)
                    ->with('success', '商品を出品しました。');
    }
}
