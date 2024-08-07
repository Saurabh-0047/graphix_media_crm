<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'tb_users';

    protected $fillable = [
        'user_id', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
