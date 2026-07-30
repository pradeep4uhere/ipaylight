<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommissionSetting extends Model
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



    /***
     * validateUserCommissionSettingRow this method validate row
     * Delete if data are present in database table
     */
    public static function validateUserCommissionSettingRow($saveData){
        $result = self::where('user_id', $saveData['user_id'])
        ->where('gateway_id', $saveData['gateway_id'])
        ->where('payment_type', $saveData['payment_type'])
        ->first();
        if($result !== null){
            return $result->delete(); // Delete the found record
        }else{
            return true; //if no record found then proceed to save data
        }
        
    }




    
     /***
     * getGatewayPaymentTypeSettingList this method get the row
     * Get Payment Setting List of the user
     */
    public static function getGatewayPaymentTypeSettingList($filterData){
            $result = self::where('user_id', $filterData['user_id'])
            ->where('gateway_id', $filterData['gateway_id'])
            ->get();
            if($result!== null){
                $paymentTypeSettingArray = [];
                foreach($result as $val){
                    $paymentTypeSettingArray[$val['payment_type']] = [
                        "payment_type" => $val->payment_type,
                        "rate" => $val->rate,
                        "next_day_rate" => $val->next_day_rate,
                        "next_week_rate" => $val->next_week_rate,
                        "rate_type" => $val->rate_type,
                        "is_active" => $val->is_active,  
                    ];
                }
                return $paymentTypeSettingArray;
            }else{
                return [];
            }
    }

}
