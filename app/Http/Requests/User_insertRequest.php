<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User_insertRequest extends FormRequest
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
            'user_name' => 'required',
            'email' => 'required',
            //パスワード英数字8文字以上100文字以下
            'password' => 'required|regex:/\A[a-z\d]{8,100}+\z/i'
        ];
    }
}
