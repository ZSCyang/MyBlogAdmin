<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebInfoRequest extends FormRequest
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
            'web_name'        => 'required',
            'bottom'          => 'required',
            'webInfo_id'      => 'required:integer'
        ];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'web_name.required'        => '网站名称不能为空',
            'bottom.required'          => '网站底部内容不能为空',
            'webInfo_id.required'      => '表单不合法',
            'webInfo_id.integer'       => '参数错误，请刷新重试'
        ];
    }
}
