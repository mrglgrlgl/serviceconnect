<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyUpdate extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'agency_updates';

    // Define the fillable properties
    protected $fillable = [
        'agency_id',
        'name',
        'email',
        'phone',
        'address',
        'logo_path',
        'submitted_by',
        'status',
        'reviewed_by',
    ];

    // Relationships

    // Each update belongs to an agency
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    // Each update is submitted by an agency user
    public function submittedBy()
    {
        return $this->belongsTo(AgencyUser::class, 'submitted_by');
    }

    // Each update is reviewed by an admin user
    public function reviewedBy()
    {
        return $this->belongsTo(AdminUser::class, 'reviewed_by');
    }
}
