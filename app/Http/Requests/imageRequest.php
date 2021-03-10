<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class imageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() =='account/image')
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
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '画像を選択してください。',
            'image.image' => '画像ファイルを指定してください。',
            'image.mimes' => '画像ファイルはjpeg,jpg,png,gif形式を指定してください。',
        ];
    }
}
