<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyServiceUpdate extends Model
{
    use HasFactory;

    // Define the table name (optional, but clear)
    protected $table = 'agency_service_updates';

    // Define the fillable fields
    protected $fillable = [
        'agency_id',
        'service_name',
        'description',
        'submitted_by',
        'reviewed_by',
        'service_id',
        'action',
        'status',
    ];

    // Relationships
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function submittedBy()
    {
        return $this->belongsTo(AgencyUser::class, 'submitted_by');
    }

    public function reviewedBy()
    {
        return $this->belongsTo(AdminUser::class, 'reviewed_by');
    }
}
