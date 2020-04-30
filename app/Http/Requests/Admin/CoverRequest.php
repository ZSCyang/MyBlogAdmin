<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CoverRequest extends FormRequest
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
            'title'      => 'required',
            'subtitle'   => 'required',
            'status'     => 'required:integer',
            'base64Img'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => '主标题不能为空',
            'subtitle.required'    => '副标题不能为空',
            'status.required'      => '状态不能为空',
            'status.integer'       => '参数错误，请刷新重试',
            'base64Img.required'   => '图片不能为空'
        ];
    }
}
