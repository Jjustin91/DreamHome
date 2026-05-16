<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // 1. Tell Laravel the primary key is NOT 'id'
    protected $primaryKey = 'branch_no';

    // 2. Tell Laravel the primary key does NOT auto-increment (1, 2, 3)
    public $incrementing = false;

    // 3. Tell Laravel the primary key is a string ('B001')
    protected $keyType = 'string';

    // 4. Allow these fields to be mass-assigned
    protected $fillable = [
        'branch_no',
        'street',
        'area',
        'city',
        'postcode',
        'telephone_no',
        'fax_no',
    ];
}