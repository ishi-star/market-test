<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'zip'         => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address'     => 'required|string',
            'building'    => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'zip.required'     => '郵便番号は必須です。',
            'zip.regex'        => '郵便番号は「123-4567」の形式で入力してください。',

            'address.required' => '住所は必須です。',
            'address.string'   => '住所は文字列で入力してください。',

            'building.required'=> '建物名・部屋番号は必須です。',
            'building.string'  => '建物名・部屋番号は文字列で入力してください。',
        ];
    }
}
