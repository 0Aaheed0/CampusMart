<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_name',
        'product_type',
        'price',
        'used_for',
        'condition',
        'description',
        'contact_number',
        'product_image',
        'status',
    ];

    protected $attributes = [
        'status' => 'available',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wishlistedBy()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function paymentItems()
    {
        return $this->hasMany(PaymentItem::class);
    }
}
