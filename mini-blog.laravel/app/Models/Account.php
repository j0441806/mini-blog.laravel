<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    // 入力のガード（idの値を用意しなくてよい）
    protected $guarded = array('id');

    // バリデーションのルール
    public static $rules = array(
        'name' => 'required',
        'mail' => 'required|email',
        'password' => 'required|between:3,20',
    );

    public function getData() {
        return $this->id . ': ' . $this->name . ' (' . $this->created . ')';
    }
}
