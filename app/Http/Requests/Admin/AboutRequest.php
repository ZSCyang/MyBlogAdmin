<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'background_base64'   => 'required',
            'chinese_name'        => 'required',
            'english_name'        => 'required',
            'motto'               => 'required',
            'pic_base64'          => 'required',
            'birthday'            => 'required',
            'tags'                => 'required',
            'title'               => 'required',
            'introduction'        => 'required',
            'qr_code_base64'      => 'required',
        ];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'background_base64.required'   => '背景图不能为空',
            'chinese_name.required'        => '中文名不能为空',
            'english_name.required'        => '英文名不能为空',
            'motto.required'               => '座右铭不能为空',
            'pic_base64.required'          => '头像不能为空',
            'birthday.required'            => '生日不能为空',
            'tags.required'                => '任务标签不能为空',
            'title.required'               => '简介标题不合法',
            'introduction.required'        => '关于我不能为空',
            'qr_code_base64.required'      => '二维码不能为空'

        ];
    }
}
