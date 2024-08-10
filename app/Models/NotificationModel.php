<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    use HasFactory;
    
    protected $table = 'tb_notifications'; // Link the model to the 'tb_notifications' table

    protected $fillable = [
        'heading',
        'message',
        'project_id',
        'unread_by',
        'read_by',
    ];
}
