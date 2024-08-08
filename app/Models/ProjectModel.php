<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;

    protected $table = "tb_projects";

    protected $fillable = [
        'business_name',
        'client_name',
        'contact_no',
        'email_id',
        'address',
        'webiste',
        'packages',
        'remarks',
        'sold_by_id',
        'sold_by_name'
    ];
}
