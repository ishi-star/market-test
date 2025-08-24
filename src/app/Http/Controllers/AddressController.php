<?php
// このコントローラを使用しようとするとエラーが出る
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;

class AddressController extends Controller
{
        // 住所編集画面表示
    public function edit($item_id)
    {
        $product = Product::findOrFail($item_id);
        $profile = Auth::user()->profile;
        return view('mypage.address', compact('product', 'profile'));
    }

    // 住所情報の保存・更新
    public function update(Request $request, $item_id)
    {
        $validated = $request->validated([
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
}
