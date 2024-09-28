<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:email|string|max:191',
            'password' => 'required|min:8|max:191',
        ];
    }

    public function massages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレス形式で入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードを8文字以上で入力してください。',
        ];
    }
}
