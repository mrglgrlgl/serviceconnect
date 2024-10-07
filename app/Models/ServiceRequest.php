<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'service_requests';

    protected $fillable = [
        'category',
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        //'start_time',
        //'end_time',
        'provider_gender',
        'job_type',
        'min_price',
        'max_price',
        //'estimated_duration',
        'status',
        'user_id',
        'provider_id',
        'is_direct_hire',
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
    public function images()
    {
        return $this->hasMany(ServiceRequestImages::class, 'service_request_id');
    }
    public function reports()
{
    return $this->hasMany(Report::class, 'service_request_id');
}
    
public function agencyUser()
{
    return $this->belongsTo(AgencyUser::class, 'provider_id');
}
}

