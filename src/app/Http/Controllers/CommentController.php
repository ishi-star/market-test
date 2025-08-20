<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id'   => auth()->id(),
            'product_id'=> $product->id,
            'comment'      => $request->comment,
        ]);

        return redirect()->route('products.show', $product->id)
                         ->with('success', 'コメントを投稿しました！');
    }
}
