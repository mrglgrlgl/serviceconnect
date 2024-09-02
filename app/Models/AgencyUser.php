<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AgencyUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'agency_id', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function taskAssignments()
{
    return $this->hasMany(EmployeeTaskAssignment::class, 'assigned_by');
}
}
