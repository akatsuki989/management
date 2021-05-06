<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class User extends Model
{
    // テーブル名
    protected $table = 'users';

    // 可変項目
    protected $fillable = [

        'user_name',
        'email',
        'password'
    ];
 }