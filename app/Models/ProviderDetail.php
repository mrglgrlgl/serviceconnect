<?php

// Example: RequestDetail model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderDetail extends Model
{
    protected $table = 'provider_details';
    protected $fillable = [
        'work_email',
        'contact_number',
        'serviceCategory', 
        'have_tools', 
        'years_of_experience',
        'description',
        'availability_days',
        // 'availability_time',
        'provider_id',
        // Additional fields as necessary
    ];
    
    public function requestList()
    {
        return $this->belongsTo(RequestList::class, 'request_id', 'id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'provider_id', 'id');
}

public function serviceRequests()
{
    return $this->hasMany(ServiceRequest::class, 'provider_id', 'id');
}
public function ratings()
{
    return $this->hasMany(Rating::class, 'rated_for_id', 'user_id');
}
}
