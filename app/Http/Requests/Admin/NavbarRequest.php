<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NavbarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required|between:3,10',
            'url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => '导航栏名称名称不能为空',
            'name.between'    => '导航栏名称长度应该在3~10位之间',
            'url.required'    => '导航栏不能为空',
        ];
    }
}
