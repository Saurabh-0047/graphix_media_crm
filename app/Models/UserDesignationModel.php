<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDesignationModel extends Model
{
    use HasFactory;

    protected $table="tb_user_designations";

    protected $fillable =  ['designation'];

   
}
