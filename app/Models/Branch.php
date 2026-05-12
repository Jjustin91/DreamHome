<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'branch_no';

    protected $table = 'branch';
    
    protected $fillable = [
        'branch_no',
        'street',
        'area',
        'city',
        'postcode',
        'telephone_no',
        'fax_no',
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'branch_no', 'branch_no');
    }

    public function renters()
    {
        return $this->hasMany(RenterDetail::class, 'branch_no', 'branch_no');
    }
}