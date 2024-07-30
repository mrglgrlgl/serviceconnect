<?php

// Example: RequestDetail model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderDetail extends Model
{
    protected $table = 'provider_details';
    protected $fillable = [
        'profilePicture', // Ensure this is handled correctly if used
        'work_email',
        'contact_number',
        'serviceCategory', // In the database, but 'service_category' in the form
        'subcategory', // Ensure this matches your form if used
        'have_tools', // Expecting 'varchar', should check how data is sent
        'years_of_experience',
        'description',
        'availability_days',
        'availability_time',
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

}
