<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', // Add 'user_id' here if it's not already present
        'ip_address',
        'browser',
        'device',
        'location',
    ];


    /**
     * Get the user that owns the login history entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
