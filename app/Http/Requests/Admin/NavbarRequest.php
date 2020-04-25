<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class NavbarRequest extends FormRequest
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

        if (request()->method() == 'POST') {
            return [
                'name'   => 'required|between:3,10',
                'url' => 'required',
            ];
        } else {
            return [
                'name'   => 'required|between:3,10',
                'url' => 'required',
                'navbar_id'  => 'required:integer',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required'   => '导航栏名称名称不能为空',
            'name.between'    => '导航栏名称长度应该在3~10位之间',
            'url.required'    => '导航栏连接不能为空',
            'navbar_id.required'     => '参数错误，请刷新重试',
            'navbar_id.integer'      => '表单不合法',
        ];
    }
}
