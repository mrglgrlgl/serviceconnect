<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestImages extends Model
{
    use HasFactory;

    // Define the table name if it does not follow Laravel's naming convention
    protected $table = 'service_request_images';

    // Specify the attributes that are mass assignable
    protected $fillable = ['service_request_id', 'file_path'];

    /**
     * Get the service request that owns the image.
     */
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id','id');
    }
}
