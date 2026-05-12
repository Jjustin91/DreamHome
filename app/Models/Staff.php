<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $primaryKey = 'staff_no'; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'staff_no',
        'name',
        'email',
        'password',
        'job_title',
        'branch_no',
        'image_path'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
