<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    // 入力ガード
    protected $guarded = array('id', 'image');

    // バリデーション
    public static $rules = array(
        'posts' => 'required|between:1,255',
        'image' => 'image|mimes:jpeg,jpg,png,gif',
    );
}
