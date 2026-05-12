<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'staff_no';

    protected $fillable = [
        'staff_no',
        'first_name',
        'last_name',
        'address',
        'telephone_no',
        'sex',
        'date_of_birth',
        'nin',
        'job_title',
        'salary',
        'date_joined',
        'end_date',
        'branch_no',
        'supervisor_no',
        'manager_start_date',
        'car_allowance',
        'bonus_payment',
        'typing_speed',
    ];

    protected $casts = [
        'date_of_birth'      => 'date',
        'date_joined'        => 'date',
        'end_date'           => 'date',
        'manager_start_date' => 'date',
        'salary'             => 'decimal:2',
        'car_allowance'      => 'decimal:2',
        'bonus_payment'      => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_no', 'branch_no');
    }

    public function supervisor()
    {
        return $this->belongsTo(Staff::class, 'supervisor_no', 'staff_no');
    }

    public function subordinates()
    {
        return $this->hasMany(Staff::class, 'supervisor_no', 'staff_no');
    }

    public function renters()
    {
        return $this->hasMany(RenterDetails::class, 'staff_no', 'staff_no');
    }
}