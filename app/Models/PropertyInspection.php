<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyInspection extends Model
{
    protected $table = 'property_inspections';
    // Since we have a composite key, we tell Laravel there is no single incrementing ID
    protected $primaryKey = null; 
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'property_no',
        'staff_no',
        'inspection_date',
        'comments'
    ];

    // Relationships to get Names instead of IDs
    public function property() {
        return $this->belongsTo(Property::class, 'property_no', 'property_no');
    }

    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_no', 'staff_no');
    }
}