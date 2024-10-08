<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        // 'employee_id',
        'seeker_id',
        'channel_id',
        'communication',
        'fairness',
        'quality_of_service',
        'professionalism',
        'cleanliness_tidiness',
        'value_for_money',
        'additional_feedback',
        'respectfulness',
        'preparation',
        'responsiveness',
    ];

    // Define relationships
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id'); // Assuming 'service_request_id' is the foreign key
    }
}

