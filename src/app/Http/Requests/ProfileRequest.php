<?php
// profile_create.blade.phpに表示される内容
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProfileRequest extends FormRequest
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
            'img_url'  => 'nullable|image|mimes:jpeg,png',
            'name'     => 'required|string|max:20',
            'zip'      => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address'  => 'required|string',
            'building' => 'nullable|string',
        ];
    }

    public function messages()
    {
    return [
        'img_url.image'   => 'アップロードできるのは画像ファイルのみです。',
        'img_url.mimes'   => '画像形式は jpeg または png を指定してください。',

        'name.required'   => '名前は必須です。',
        'name.string'     => '名前は文字列で入力してください。',
        'name.max'        => '名前は20文字以内で入力してください。',

        'zip.required'    => '郵便番号は必須です。',
        'zip.regex'       => '郵便番号は「123-4567」の形式で入力してください。',

        'address.required'=> '住所は必須です。',
        'address.string'  => '住所は文字列で入力してください。',

        'building.string'   => '建物名・部屋番号は文字列で入力してください。',
    ];
}
}
