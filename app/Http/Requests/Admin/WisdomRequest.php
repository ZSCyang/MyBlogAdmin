<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WisdomRequest extends FormRequest
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
            'start_time'  => 'required',
            'end_time'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => '主语录不能为空',
            'subtitle.required'    => '副语录不能为空',
            'status.required'      => '状态不能为空',
            'status.integer'       => '参数错误，请刷新重试',
            'start_time.required'  => '有效起始时间不能为空',
            'end_time.required'    => '有效结束时间不能为空'
        ];
    }
}
