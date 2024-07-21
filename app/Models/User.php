<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'cell_no',
        'password',
        'gender',
        'birth_date',
        'address',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public static function getByRole(int $roleNumber)
    {
        return static::where('role', $roleNumber)->get();
    }
    // User.php (User model)
    public function providerDetails()
    {
        return $this->hasOne(ProviderDetail::class, 'provider_id', 'id');
    }
    
}
