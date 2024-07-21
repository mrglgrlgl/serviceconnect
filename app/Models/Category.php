<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'psa_jobs'; // Change 'categories' if your table name is different.

    // The attributes that are mass assignable.
    protected $fillable = [
        'Job_Title',
        'Occupational_Wage_in_Peso',
        'Average_Occupational_Wage_2024',
        'Average_Occupational_Wage_per_Hour',
    ];

    // Optionally, specify if your primary key is not an incrementing integer.
    // protected $primaryKey = 'id'; // Only if you have a custom primary key.
    // public $incrementing = false;
    // protected $keyType = 'string'; // Only if your primary key is a string.
}
