<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // app/Models/User.php

    public function profile()
    {
        // This connects the User to the Profile table
        return $this->hasOne(Profile::class);
    }

    public function products()
    {
        return $this->hasMany(PostProduct::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'buyer_id');
    }

    public function soldItems()
    {
        return $this->hasMany(PaymentItem::class, 'seller_id');
    }
}