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
}
