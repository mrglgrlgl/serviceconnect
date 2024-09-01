<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    // Define the table name if it's not the default plural form of the model name
    protected $table = 'ratings';

    // Specify which fields are fillable
    protected $fillable = [
        'channel_id',
        'rated_by_id',
        'rated_for_id',
        'communication',
        'fairness',
        'quality_of_service',
        'professionalism',
        'cleanliness_tidiness',
        'value_for_money',
        'additional_feedback',
        'respectfulness',
        'preparation',
        'responsiveness',
    ];

    // Define the relationships
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function ratedBy()
    {
        return $this->belongsTo(User::class, 'rated_by_id');
    }

    public function ratedFor()
    {
        return $this->belongsTo(User::class, 'rated_for_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'rated_by_id');
    }
}
