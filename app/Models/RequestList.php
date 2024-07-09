<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestList extends Model
{
    use HasFactory;

    protected $table = 'request_lists';

    protected $fillable = [
        'user_id',
        'status',
    ];
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    
    public static function hasUserSentRequest($userId)
    {
        return static::byUser($userId)->exists();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function providerDetail()
    {
        return $this->hasOne(ProviderDetail::class, 'request_id', 'id');
    }

}

