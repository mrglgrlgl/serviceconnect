<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = 
    [
        'service_request_id', 
        'issue_type', 
        'details', 
        'reported_by',
        'agency_id',  // Ensure agency_id is included
        
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }

    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by','id');
    }
      public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id','id');
    }
}


