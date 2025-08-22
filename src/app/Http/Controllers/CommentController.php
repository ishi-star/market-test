<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Product;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Product $product)
    {
        Comment::create([
            'user_id'    => auth()->id(),
            'product_id' => $product->id,
            'comment'    => $request->comment,
        ]);

        return redirect()->route('products.show', $product->id)
                         ->with('success', 'コメントを投稿しました！');
    }
}
