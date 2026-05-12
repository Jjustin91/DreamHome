<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenterDetails extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'renter_no';
    protected $table = 'renter_details';

    protected $fillable = [
        'renter_no',
        'branch_no',
        'staff_no',
        'first_name',
        'last_name',
        'address',
        'telephone_no',
        'pref_property',
        'max_rent',
        'date',
        'comments',
    ];

    protected $casts = [
        'date'     => 'date',
        'max_rent' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_no', 'branch_no');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_no', 'staff_no');
    }
}