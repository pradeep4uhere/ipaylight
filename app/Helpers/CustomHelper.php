<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PaymentLink;
use Illuminate\Support\Facades\Auth;
use App\Models\Settlement;
use App\Models\Announcement;
use App\Models\MasterBank;

class CustomHelper
{
    public static function getCustomHelper($user_id)
    {   
        $settlementList = Settlement::where('user_id',$user_id)
                ->where('is_settled','0')
                ->sum('net_amount');
        
        return  $settlementList;
    }


    public static function getAllSettalmentAmount($user_id)
    {   
        if(Auth::user()->role!='admin'){
        $settlementList = Settlement::where('user_id',$user_id)
                ->where('is_settled','0')
                ->sum('net_amount');
        }else{
            $settlementList = Settlement::where('is_settled',0)->sum('net_amount');
        }
        return  $settlementList;
    }



    /**
     * Get Annoucement For User
     */
    public static function getAnnouncement($user_id){
        $startDateFormatted = date('Y-m-d');
        $endDateFormatted = date('Y-m-d');
        $announcement = Announcement::where('is_active',1)
        ->where(function ($query) use ($startDateFormatted, $endDateFormatted) {
            $query->whereDate('start_date', '<=', $startDateFormatted)
                  ->whereDate('end_date', '>=', $endDateFormatted);
        })
        ->get();
        if(!empty($announcement)){
            return $announcement;
        }
    }



    




    /**
     * Get All Payment Link for Retailers
     * @params UserId
     */
    public static function getRetailerPaymentLinks($user_id){
        $paymentLinks = [];
        $paymentLinks = PaymentLink::where('user_id',$user_id)->where('status','Active')->get();
        if(!empty($paymentLinks)){
            return $paymentLinks;
        }
    }




    /**
     * Get All Master Bank List
     * @return array
     */
    public static function getAllMasterBank(){
        $bankList = [];
        $bankList = MasterBank::where('status','Active')->get();
        if(!empty($bankList)){
            return $bankList;
        }
    }


    

    
}
