<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 表示
    public function show($id)
    {
        $product = Product::with('categories', 'condition')->findOrFail($id);
        $user = Auth::user();
        return view('products.purchase', compact('product', 'user'));
    }

    // 購入処理
    public function submit(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:credit,konbini,bank',
        ]);

        // 本来は購入レコード作成などを行う

        return redirect()->route('mypage')->with('success', '購入が完了しました！');
    }
}