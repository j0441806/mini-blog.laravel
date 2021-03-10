<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;

class postRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if ($this->path() == 'post')
        // {
        //     return true;
        // } else {
        //     return false;
        // }
        return true;
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Post::$rules;
        // return [
        //     //
        // ];
    }

    public function messages()
    {
        return [
            'posts.required' => '投稿文を入力してください。',
            'posts.between' => '投稿文は1～255文字で入力してください。',
            'image.image' => '画像ファイルを指定してください。',
            'image.mimes' => '画像ファイルはjpeg,jpg,png,gif形式を指定してください。',
        ];
    }
}
