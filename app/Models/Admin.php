<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'tb_admin';

    protected $fillable = [
        'user_id', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
