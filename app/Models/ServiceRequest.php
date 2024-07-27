<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'service_requests';

    protected $fillable = [
        'category',
        'subcategory',
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'attach_media',
        'attach_media2',
        'attach_media3',
        'attach_media4',
        'provider_id',
        'user_id',
        'status',
        'skill_tags',
        'provider_gender',
        'job_type',
        'hourly_rate',
        'expected_price',
        'estimated_duration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'service_request_id');
    }

    public function hasAcceptedBid()
    {
        return $this->bids()->where('status', 'accepted')->exists();
    }
    public function isCompleted() {
        // You could have a more complex logic here based on other attributes like `reviewed` or `closed`
        return $this->status === 'completed'; // Assuming 'completed' is a status indicating the request is done
    }
    
}


// FIX try for time update
// public function getStartTimeAttribute($value)
// {
//     return Carbon::createFromFormat('H:i:s', $value)->format('h:i A');
// }

// // Accessor for end_time
// public function getEndTimeAttribute($value)
// {
//     return Carbon::createFromFormat('H:i:s', $value)->format('h:i A');
// }
// }

