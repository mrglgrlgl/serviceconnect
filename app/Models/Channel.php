<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $table = 'channel'; // Specify the correct table name

    protected $fillable = [
        'seeker_id', 
        'provider_id', 
        'service_request_id', 
        'bid_id',
        'status', 
        'start_time', 
        'completion_time', 
        'amount_paid',
    ];
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function seeker()
    {
        return $this->belongsTo(User::class, 'seeker_id');
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class, 'bid_id');
    }
}

