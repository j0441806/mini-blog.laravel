<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class signupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'account/confirm')
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
        return User::$rules;
        // return [
        //     //
        // ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必ず入力してください。',
            'name.alpha-num' => '名前は必ず英数字で入力してください。',
            'name.regex' => '名前は必ず英数字で入力してください。',
            'name.between' => '名前は3～20文字で入力してください。',
            'name.unique' => '入力された名前はすでに登録されています。',
            'email.required' => 'メールアドレスは必ず入力してください。',
            'email.email' => 'メールアドレスが必要です。',
            'email.unique' => '入力されたメールアドレスはすでに登録されています。',
            'password.required' => 'パスワードは必ず入力してください。',
            'password.between' => 'パスワードは8～20文字以下で入力してください。',
            'password.unique' => '入力されたパスワードはすでに登録されています。',
            'password.confirmed' => '確認用のパスワードが違います。',
            'password_confirmation.required' => '確認用のパスワードは必ず入力してください。',
        ];
    }
}
