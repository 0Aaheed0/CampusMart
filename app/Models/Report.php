<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'reported_user_id',
        'report_type',
        'reason',
        'description',
        'status',
        'admin_notes',
        'admin_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who submitted the report
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product being reported
     */
    public function product()
    {
        return $this->belongsTo(PostProduct::class);
    }

    /**
     * Get the user being reported
     */
    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    /**
     * Get the admin who reviewed the report
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
