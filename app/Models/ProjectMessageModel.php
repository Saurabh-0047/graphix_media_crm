<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMessageModel extends Model
{
    use HasFactory;

    protected $table = 'tb_project_messages'; // Link the model to the 'tb_notifications' table

    protected $fillable = [
        'project_id',
        'sent_by_user_id',
        'message',
    ];
}
