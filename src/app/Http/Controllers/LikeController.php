<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Like;

class LikeController extends Controller
{
    public function store($productId)
    {
        $product = Product::findOrFail($productId);
        Auth::user()->likes()->attach($product->id);
        return back();
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        Auth::user()->likes()->detach($product->id);
        return back();
    }
}
