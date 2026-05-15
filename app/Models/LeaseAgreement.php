<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseAgreement extends Model
{
    use HasFactory;

    protected $table = 'lease_agreements'; // Explicitly naming the table for PostgreSQL
    protected $primaryKey = 'lease_no';
    public $incrementing = false; // Primary key is a VARCHAR (L101), not an integer
    protected $keyType = 'string';

    // Disable timestamps if your migration doesn't have created_at/updated_at
    public $timestamps = false; 

    protected $fillable = [
        'lease_no', 
        'property_no', 
        'renter_no', 
        'staff_no',
        'monthly_rent', 
        'payment_method', 
        'deposit_amount',
        'deposit_paid', 
        'rent_start', 
        'rent_finish'
    ];

    /**
     * The attributes that should be cast.
     * This ensures data types are consistent (e.g., money stays numeric, dates are Carbon objects).
     */
    protected $casts = [
        'monthly_rent'   => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'deposit_paid'   => 'boolean',
        'rent_start'     => 'date',
        'rent_finish'    => 'date', // Allows for NULL values (Ongoing leases)
    ];

    // --- Relationships ---

    /**
     * Get the property associated with the lease.
     */
    public function property() 
    {
        return $this->belongsTo(Property::class, 'property_no', 'property_no');
    }

    /**
     * Get the renter (client) associated with the lease.
     */
    public function renter() 
    {
        return $this->belongsTo(Renter::class, 'renter_no', 'renter_no');
    }

    /**
     * Get the staff member who facilitated the lease.
     */
    public function staff() 
    {
        return $this->belongsTo(Staff::class, 'staff_no', 'staff_no');
    }
}