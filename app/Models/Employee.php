<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'name',
        'email',
        'phone',
        'position',
        'gender',
        'birthdate',
        'availability',
        'photo',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    
    public function services()
    {
        return $this->belongsToMany(AgencyService::class, 'employee_service_assignments', 'employee_id', 'service_id')
                    ->withPivot('agency_id', 'assigned_at')
                    ->withTimestamps();
    }
    public function taskAssignments()
{
    return $this->hasMany(EmployeeTaskAssignment::class);
}
public function channels()
{
    // Define the relationship, assuming a many-to-many relationship
    return $this->belongsToMany(Channel::class, 'employee_channel', 'employee_id', 'channel_id');
}

public function ratings()
{
    return $this->hasManyThrough(Rating::class, EmployeeTaskAssignment::class, 'employee_id', 'channel_id', 'id', 'channel_id');
}



}
