<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyForRent extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'property_no';
    protected $table = 'property_for_rent'; // exact table name from your SQL

    protected $fillable = [
        'property_no',
        'branch_no',
        'owner_no',
        'staff_no',
        'street',
        'area',
        'city',
        'postcode',
        'type_of_property',
        'number_of_rooms',
        'monthly_rent',
        'status',
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