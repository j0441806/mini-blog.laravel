<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;

    // protected $guarded = array();

    // バリデーション
    public static $rules = array(
        'user_id' => 'required',
        'following_id' => 'required',
    );
}
