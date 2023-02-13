<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:6', 'max:20'],
            'price' => ['required'],
            'description' => ['required', 'min:10', 'max:30'],
            'category_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Tên sản phẩm không được để trống!",
            'name.min' => "Tên sản phẩm phải dài hơn 6 ký tự!",
            'name.max' => "Tên sản phẩm không được quá 20 ký tự",
            'price.required' => "Giá sản phẩm không được để trống",
            'description.required' => "Mô tả không được để trống",
            'description.min' => "Mô tả phải dài hơn 10 ký tự",
            'description.max' => "Mô tả không được quá 30 ký tự",
            'category_id' => "Danh mục sản phẩm không được để trống",
        ];
    }
}
