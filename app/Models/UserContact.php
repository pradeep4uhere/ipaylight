<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContact extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'user_contacts';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'contact_id',
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'address',
        'zipcode',
        'status',
    ];

    /**
     * Contact Must belongs To User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the beneficiary accounts associated with the user contact.
     */
    public function beneficiaryAccounts()
    {
        return $this->hasMany(BeneficiaryAccount::class);
    }
}
