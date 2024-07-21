<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsaJob extends Model
{
    use HasFactory;

    protected $table = 'psa_jobs';

    protected $fillable = [
        'Job_Title',
        'Occupational_Wage_in_Peso',
        'Average_Occupational_Wage_2024',
        'Average_Occupational_Wage_per_Hour',
    ];

    // Define any relationships or additional methods here as needed
}