<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
        'logo_path',
    ];
    
    public function users()
    {
        return $this->hasMany(AgencyUser::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function pendingUpdates()
    {
        return $this->hasMany(AgencyUpdate::class)->where('status', 'pending');
    }
    public function services()
    {
        return $this->hasMany(AgencyService::class);
    }
}
