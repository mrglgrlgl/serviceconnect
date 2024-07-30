<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilID extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'philid_cards';

    // The attributes that are mass assignable.
// Example in PhilID Model
protected $fillable = [
    'provider_id',
    'philid_number',
    'last_name',
    'given_names',  // Correct field name
    'middle_name',
    'date_of_birth',
    'address',
    'gender',
    'blood_type',
    'civil_status',
    'place_of_birth',
    'issue_date',
    'front_image',
    'back_image',
    'status',
];

    // Default values for attributes
    protected $attributes = [
        'status' => 'pending',
    ];

    /**
     * Get the provider associated with the PhilID.
     */
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}
