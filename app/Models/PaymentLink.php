<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentLink extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'gateway_id',
        'link_title',
        'description',
        'max_amount',
        'expiry_date',
        'status',
        'user_id',
        'payment_link',
    ];


    /**
     * Relationship With User Table
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Gateway Model
     */
    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }
}
