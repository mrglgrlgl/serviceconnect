<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTaskAssignment extends Model
{
    protected $table = 'employee_task_assignment'; // Ensure this matches your table name

    protected $fillable = [
        'agency_id', 'employee_id', 'channel_id', 'status', 'assigned_at', 'completed_at', 'assigned_by'
    ];

    // Relationship with the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Relationship with the Channel model
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    // Relationship with the AgencyUser model
    public function assignedBy()
    {
        return $this->belongsTo(AgencyUser::class, 'assigned_by');
    }

    // Relationship with the Agency model
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
