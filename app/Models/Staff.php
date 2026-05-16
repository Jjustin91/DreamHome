<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    // Tell Laravel the primary key is 'staff_no', not 'id'
    protected $primaryKey = 'staff_no';
    public $incrementing = false;
    protected $keyType = 'string';

    // Allow all fields to be mass-assigned for now to speed up development
    protected $guarded = [];
    
    // Create a relationship so we can easily grab the branch name later
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_no', 'branch_no');
    }
}