<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:15'],
            'color' => ['required', 'min:2'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên tag không được để trống!',
            'name.min' => 'Tên tag phải lớn hơn 2 ký tự',
            'name.max' => 'Tên tag không được dài hơn 15 ký tự',
            'color.required' => 'Màu tag không được để trống',
            'color.min' => 'Màu tag phải lớn hơn 2 ký tự',
        ];
    }
}