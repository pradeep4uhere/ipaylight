<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    

    /**
     * Relationship With PaymentLink Model
     */
    public function paymentLinks()
    {
        return $this->hasMany(PaymentLink::class);
    }

    /**
     * Get the login history entries associated with the user.
     */
    public function PaymentGatewayRate()
    {
        return $this->hasMany(PaymentGatewayRate::class);
    }


    /**
     * Get the login history entries associated with the user.
     */
    public function UserCommissionSetting()
    {
        return $this->hasMany(UserCommissionSetting::class);
    }


    /**
     * Get All Active Gateways For User
     * @params user_id
     */
    public static function getAllActiveGatewaysForUser($user_id){

        $userCommissionSettings = UserCommissionSetting::where('user_id', $user_id)->distinct()->pluck('gateway_id');
        $gateways = Gateway::whereIn('id', $userCommissionSettings)->get();
        return $gateways;


    }


    /**
     * Get the transactions associated with the gateway.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


    public function settlementSettings()
    {
        return $this->hasMany(SettlementSetting::class);
    }

}
