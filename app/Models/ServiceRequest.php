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
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
