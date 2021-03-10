<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'account/profile')
        {
            return true;
        } else {
            return false;
        }
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|between:1,255',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => '自己紹介文を入力してください。',
            'description.between' => '自己紹介文は1～255文字で入力してください。',
        ];
    }
}
