<?php

// Example: RequestDetail model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderDetail extends Model
{
    protected $table = 'provider_details';
    protected $fillable = [
        'request_id', 
        'status', 
        'profilePicture', 
        'work_email', 
        'contact_number',
        'serviceCategory', 
        'subcategory', 
        'have_tools', 
        'years_of_experience',
        'description', 
        'government_id_front', 
        'government_id_back',
        'nbi_clearance', 
        'tesda_certification', 
        'other_credentials',
        
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
