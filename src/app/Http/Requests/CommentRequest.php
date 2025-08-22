<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check(); // ログインユーザーのみ true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => 'コメントは必須です。',
            'comment.max' => 'コメントは255文字以内で入力してください。',
        ];
    }
}
