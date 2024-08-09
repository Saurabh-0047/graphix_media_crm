<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectMessageModel extends Model
{
    use HasFactory;

    protected $table = 'tb_project_messages';

    // Define the relationship to the UserModel
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'sent_by_user_id', 'user_id');
    }

    // Custom accessor to get the sender's name from either tb_users or tb_admin
    public function getSenderNameAttribute()
    {
        // First, attempt to get the user from tb_users using the relationship
        $user = $this->user; // Eager-loaded relationship
        if ($user) {
            return $user->user_name;
        }

        // Fallback to tb_admin if not found in tb_users
        $admin = DB::table('tb_admin')
            ->where('user_id', $this->sent_by_user_id)
            ->first();

        return $admin ? $admin->user_name : 'Unknown'; // Provide a default value
    }
}

