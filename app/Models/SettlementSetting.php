<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }



    /**
     * Method Name: Get Settalment Setting For Payment Gateway for User
     */
    public static function getSettlementSettingForPaymentGatewayForUser($user_id, $gateway_id){
        $SettlementSetting =  SettlementSetting::where('user_id',$user_id)->where('gateway_id', $gateway_id)->first();
        if(!empty($SettlementSetting)){
            return $SettlementSetting->toArray();
        }else{
            return [];
        }
    }


    /**
     * Method Name: Get Settalment Setting For Payment Gateway for User
     */
    public static function getSettlementSettingForUser($user_id=null){
        if($user_id!=''){
            $SettlementSetting =  SettlementSetting::with('Gateway')->where('user_id',$user_id)->get();
        }else{
            $SettlementSetting =  SettlementSetting::with('Gateway')->get();
        }
        if(!empty($SettlementSetting)){
            return $SettlementSetting->toArray();
        }else{
            return [];
        }
    }



    

}
