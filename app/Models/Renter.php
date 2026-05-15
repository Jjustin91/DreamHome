<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $table = 'renter_details'; // Matches your SQL
    protected $primaryKey = 'renter_no';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'renter_no', 'branch_no', 'staff_no', 'first_name', 
        'last_name', 'address', 'telephone_no', 'pref_property', 
        'max_rent', 'date', 'comments'
    ];
}