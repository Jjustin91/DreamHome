<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff'; 
    protected $primaryKey = 'staff_no';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}