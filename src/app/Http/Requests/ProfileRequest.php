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
            'name.required' => '',
            'name.string' => '',
            'name.max' => '',
            'img_url.mimes' => '',
            'img_url.max' => '',
            'postcode.required' => '',
            'postcode.string' => '',
            'postcode.max' => '',
            'address.required' => '',
            'address.string' => '',
            'address.max' => '',
            'building.string' => '',
            'building.max' => '',
        ];
    }
}
