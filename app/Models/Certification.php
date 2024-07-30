<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'certifications';

    protected $fillable = [
        'provider_id',
        'name',
        'issuing_organization',
        'date_attained',
        'expiry_date',
        'description',
        'file_path',
    ];

    public function provider()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
