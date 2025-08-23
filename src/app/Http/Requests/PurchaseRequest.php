<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'payment_method' => ['required', 'in:credit,konbini'],
            'address_id'     => ['required', 'exists:profiles,id'], 
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method.required' => '支払い方法を選択してください。',
            'address_id.required'     => '配送先を選択してください。',
            'address_id.exists' => '選択された配送先が存在しません。',
        ];
    }
}
