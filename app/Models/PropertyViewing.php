<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyViewing extends Model
{
    protected $table = 'property_viewings';
    protected $primaryKey = 'viewing_no';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'viewing_no', 
        'property_no', 
        'renter_no', 
        'staff_no', 
        'viewing_date', 
        'feedback'
    ];

    /**
     * Relationship: A viewing belongs to a Renter.
     * This allows us to use $viewing->renter->first_name
     */
    public function renter() 
    {
        return $this->belongsTo(Renter::class, 'renter_no', 'renter_no');
    }

    /**
     * Relationship: A viewing belongs to a Property.
     * This allows us to use $viewing->property->street
     */
    public function property() 
    {
        return $this->belongsTo(Property::class, 'property_no', 'property_no');
    }
}