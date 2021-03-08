<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Reply;

class replyRequest extends FormRequest
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
        return Reply::$rules;
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
