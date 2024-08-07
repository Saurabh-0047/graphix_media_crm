<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'tb_users';

    // Add these attributes to allow mass assignment
    protected $fillable = [
        'designation_id',
        'user_name',
        'user_id',
        'user_phone',
        'user_email',
        'password',
    ];
    public function designation()
    {
        return $this->belongsTo(UserDesignationModel::class, 'designation_id', 'id');
    }
}
