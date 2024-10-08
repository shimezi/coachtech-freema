<?php

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
            'name' => 'required|string|max:255',
            'img_url' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'postcode' => 'required|string|max:8',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください。',
            'name.string' => '名前は文字列で入力してください。',
            'name.max' => '名前は255文字以下で入力してください。',
            'img_url.mimes' => '画像はjpeg、png、jpg、gif形式でアップロードしてください。',
            'img_url.max' => '画像のサイズは2MB以下にしてください。',
            'postcode.required' => '郵便番号を入力してください。',
            'postcode.string' => '郵便番号は文字列で入力してください。',
            'postcode.max' => '郵便番号は8文字以内で入力してください。',
            'address.required' => '住所を入力してください。',
            'address.string' => '住所は文字列で入力してください。',
            'address.max' => '住所は255文字以内で入力してください。',
            'building.string' => '建物名は文字列で入力してください。',
            'building.max' => '建物名は255文字以内で入力してください。',
        ];
    }
}
