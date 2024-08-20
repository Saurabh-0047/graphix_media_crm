<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedProjectModel extends Model
{
    use HasFactory;

    protected $table = 'tb_project_assigned';

    protected $fillable = [
        'project_id',
        'user_id'
    ];
}
