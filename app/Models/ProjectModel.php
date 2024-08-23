<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
use App\Models\ModuleModel;

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
        'website',
        'packages',
        'remarks',
        'sold_by_id',
        'assigned_to',
    ];

    protected $casts = [
        'packages' => 'array',
        'assigned_to' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'sold_by_id', 'id');
    }

    public function getAssignedUsersAttribute()
    {
    $assignedUserIds = explode(',', $this->assigned_to);
    return UserModel::whereIn('id', $assignedUserIds)->get();
    }

    public function getAssignedUserListAttribute()
    {
        $assignedUserIds = explode(',', $this->assigned_to);
        return UserModel::whereIn('id', $assignedUserIds)->get();
    }

    public function modules()
    {
        return $this->hasMany(ModuleModel::class, 'project_id');
    }

}
