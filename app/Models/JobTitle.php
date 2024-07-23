<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $table = 'Job_Title'; // Ensure the table name is correct

    // Specify the fields that are mass assignable
    protected $fillable = [
        'Job_Title', 
        'Occupational_Wage_in_Peso', 
        'Average_Occupational_Wage_2024', 
        'Average_Occupational_Wage_per_Hour'
    ];
}
