<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DictionarieRequest extends FormRequest
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
            'name'        => 'required',
            'status'      => 'required',
            'type'        => 'required',
            'base64Img'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'       => '类型名称不能为空',
            'status.required'     => '状态不能为空',
            'type.required'       => '类型不能为空',
            'base64Img.required'  => '图片不能为空'
        ];
    }
}
