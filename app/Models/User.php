<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    // 入力ガード
    protected $guarded = array('id', 'description');

    // バリデーションルール
    public static $rules = array(
        'name' => 'required|alpha-num|regex:/^[a-zA-Z0-9-]+$/|between:3,20|unique:users,name',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|between:8,20||unique:users,password|confirmed',
        'password_confirmation' => 'required',
    );
}
