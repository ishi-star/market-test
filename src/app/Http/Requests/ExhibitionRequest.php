<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|string',
            'brand_name'   => 'nullable|string',
            'description'  => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'condition_id' => 'required|exists:conditions,id',
            'img_url'      => 'required|image|mimes:jpeg,png',
            'categories'   => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => '商品名は必須です。',
            'description.required'  => '商品の説明を入力してください。',
            'price.required'        => '価格を入力してください。',
            'price.numeric'         => '価格は数値で入力してください。',
            'price.min'             => '価格は0円以上で入力してください。',
            'condition_id.required' => '商品の状態を選択してください。',
            'condition_id.exists'   => '選択された状態は無効です。',
            'img_url.image'         => 'アップロードできるのは画像ファイルのみです。',
            "img_url.required"      => '画像を選択してください',
            'img_url.mimes'         => '画像形式は jpeg, png, jpg, のいずれかを指定してください。',
            'categories.required'   => 'カテゴリを1つ以上選択してください。',
            'categories.*.exists'   => '選択されたカテゴリは無効です。',
        ];
    }
}
