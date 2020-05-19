<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArchiveRequest extends FormRequest
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
            'title'           => 'required|between:3,100',
            'introduction'    => 'required',
            'type'            => 'required:integer',
            'status'          => 'required:integer',
            'power'           => 'required:integer',
            'test-editormd'   => 'required:integer',
        ];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'         => '用户名不能为空',
            'title.between'          => '用户名长度应该在3~100字之间',
            'introduction.required'  => '简介不能为空',
            'type.integer'           => '表单不合法',
            'type.required'          => '类型不能为空',
            'status.integer'         => '类型不能为空',
            'status.required'        => '状态不能为空',
            'power.integer'          => '表单不合法',
            'power.required'         => '权限不能为空',
            'test-editormd.required' => '博文内容不能为空'

        ];
    }
}
