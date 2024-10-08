<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
            'img_url' => 'nullable|image',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'condition_id' => 'required|exists:conditions,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'img_url.image' => '有効な画像ファイルをアップロードしてください。',
            'category_ids.required' => 'カテゴリーを選択してください。',
            'category_ids.array' => 'カテゴリーの形式が正しくありません。',
            'category_ids.*.exists' => '選択したカテゴリーが存在しません。',
            'condition_id.required' => '商品の状態を選択してください。',
            'condition_id.exists' => '選択した商品の状態が存在しません。',
            'name.required' => '商品名を入力してください。',
            'name.string' => '商品名は文字列で入力してください。',
            'description.required' => '商品の説明を入力してください。',
            'description.string' => '商品の説明は文字列で入力してください。',
            'price.required' => '価格を入力してください。',
            'price.numeric' => '価格は数値で入力してください。',
        ];
    }
}
