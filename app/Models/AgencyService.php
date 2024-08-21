<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyService extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'service_name',
        'description',
        'created_by',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function creator()
    {
        return $this->belongsTo(AgencyUser::class, 'created_by');
    }
}
