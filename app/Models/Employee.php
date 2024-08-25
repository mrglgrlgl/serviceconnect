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
    

}
