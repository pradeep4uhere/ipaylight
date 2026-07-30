<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayRate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];




    /**
     * Get the user that owns the login history entry.
     */
    public function Gateway()
    {
        return $this->belongsTo(Gateway::class);
    }
}
