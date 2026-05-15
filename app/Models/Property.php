<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'property_for_rent';
    protected $primaryKey = 'property_no';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

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
    'status'
    ];
}