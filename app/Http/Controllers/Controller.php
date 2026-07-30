<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCommissionSetting;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\SettlementSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use DateInterval;
use DatePeriod;
use DateTime;


use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function getAuthUserId(){
        return Auth::user()->id;
    }



    /***
     * Get Random String
     */
    public function getRandomString($len=6){
        return $randomString = Str::random($len);
    }



    /**
     * Get Gatway List and Permission for Retailer
     */
    public static function getRetailerGateways($userObj=null){
        if(!empty($userObj)){
            $user = $userObj;
        }else{
            $user = Auth::user();
        }
        //Get All Gateway List for Distributor
        $viewPage = 'blankPage';
        $userCommissionList = [];
        // Step 1: Get the distinct gateway IDs
       //$gatewayIds = UserCommissionSetting::with('Gateway')->where('user_id', $user->id)->pluck('gateway_id','Gateway.gateway_name')->toArray();
        //dd($gatewayIds);
        $gatewayIds = UserCommissionSetting::with('Gateway')
        ->where('user_id', $user->id)
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->Gateway->gateway_name => $item->gateway_id];
        })
        ->toArray();
       // dd($gatewayIds);
        // Iterate over each gateway ID
        foreach ($gatewayIds as $name=>$gatewayId) {
            // Get the UserCommissionSetting records for the current gateway ID
            $userCommissionList[$name] = UserCommissionSetting::with('Gateway')
                ->where('user_id', $user->id)
                ->where('gateway_id', $gatewayId)
                ->get();
        }
        if(!empty($userCommissionList)){
            return $userCommissionList;
        }else{
            return $userCommissionList;
        }
    }




     /**
     * Get Gatway List and Permission for Retailer
     * With Settalment Information
     */
    public static function getRetailerPaymentGatewaysList($userObj=null){
        if(!empty($userObj)){
            $user = $userObj;
        }else{
            $user = Auth::user();
        }
        //Get All Gateway List for Distributor
        $viewPage = 'blankPage';
        $userCommissionList = [];
        // Step 1: Get the distinct gateway IDs
       //$gatewayIds = UserCommissionSetting::with('Gateway')->where('user_id', $user->id)->pluck('gateway_id','Gateway.gateway_name')->toArray();
        //dd($gatewayIds);
        $gatewayIds = UserCommissionSetting::with('Gateway')
        ->where('user_id', $user->id)
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->Gateway->gateway_name => $item->gateway_id];
        })
        ->toArray();
       // dd($gatewayIds);
        // Iterate over each gateway ID
        if(!empty($gatewayIds)){
            foreach ($gatewayIds as $name=>$gatewayId) {
                // Get the UserCommissionSetting records for the current gateway ID
                $userCommissionList[$name] = array(
                        "name"=>$name, 
                        "gateway_id"=>$gatewayId, 
                        "user_id"=>$user->id, 
                        "settalment"=> SettlementSetting::getSettlementSettingForPaymentGatewayForUser($user->id, $gatewayId)
                );
            }
        }
        if(!empty($userCommissionList)){
            return $userCommissionList;
        }else{
            return $userCommissionList;
        }
    }



    /**
     * Write Error Log Globally
     */
    public static function writeErrorLog($message){
        Log::error($message);
    }


    /**
     * Write debug Log Globally
     */
    public static function writeDebugLog($message){
        Log::debug($message);
    }



    /**
     * Write Info Log Globally
     */
    public static function writeInfoLog($message){
        Log::info($message);
    }


    /**
     * Method Name: Calculate Deposite amount based on rate
     */
    public static function getDepositeAmount($paymentAmount, $rate , $rateType){
        $depositeamount = '0.00';
        if($paymentAmount!='' && $rate!='' && $rateType!=''){
            if(strtolower($rateType)=='percentage'){
                $depositeamount = (float)$paymentAmount - ((float)$paymentAmount * $rate / 100);
            }else{
                $depositeamount = (float)$paymentAmount - (float) $rate;
            }
        }
        return $depositeamount;
    }



    /**
     * Method Name: Tax Amount Calculate From Amount
     * @param Amount and Rate in %
     * @return  Float : Tax Amount
     */
    public static function calculateTaxFromAmount($total_amount,$taxRate){
       // dd('here',$total_amount,$taxRate);
        $netAmount=round((double)$total_amount/(1+(double)$taxRate/100),2);
        $taxAmount=(double)$total_amount-(double)$netAmount;
        return round($taxAmount,2);
    }



    /**
     * Method Name calculateGstAmount
     * @param Amount  and GST Rate in %
     * @return  Float : GST Amount
     */
    public static function calculateGstAmount($total_amount,$gstRate=18){
      //  dd('here',$total_amount,$gstRate);
        $gstAmount = round((double)$total_amount*($gstRate/2)/100,2);
        return $gstAmount;
    }


      /**
     * Method Name: getSettalmentTime()
     * @param PaymentType
     * @return DateTime
     */
    public function getSettalmentTime($created_date, $paymentType='NextDay'){
        if($paymentType=='SameDay'){
            return date("d M, Y, H:i:s a", strtotime('+6 hours', strtotime($created_date)));
        }else if($paymentType=='NextDay'){
            return date("d M, Y, H:i:s a", strtotime('tomorrow',strtotime($created_date)));
        }else if($paymentType=='NextWeek'){
            return date("d M, Y, H:i:s a", strtotime('+1 week',strtotime($created_date)));
        }else{
            return date("d M, Y, H:i:s a", strtotime('tomorrow',strtotime($created_date)));
        }
    }



    public function getLastTenDays(){
        $endDate = new DateTime();
        $startDate = clone $endDate;
        $startDate->modify('-30 days');

        // Generate the date range
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($startDate, $interval, $endDate);

        // Convert dates to the desired format
        $categories = [""]; // Start with an empty string
        foreach ($dateRange as $date) {
            $categories[] = $date->format('M d');
        }
        $categories[] = ""; // End with an empty string

        // Convert PHP array to JavaScript array
        $jsCategories = json_encode($categories);
        return $jsCategories;
    }




    /**
     * Method Name: getUserPermissionSettingDetails()
     * @param $user_id
     * @return PermissionSettingArray
     */
    public function getUserPermissionSettingDetails($user_id){
        $user = User::find($user_id);
        $profilePermission = $user->permissions;
        $userPermissionArr = [];
        if($profilePermission!=null){ 
            $userPermissionArr['PermissionSetting']['Status'] = true;
            $PermissionArr = json_decode($profilePermission,true);
            if(!empty($PermissionArr) && array_key_exists('ACTION',$PermissionArr)){
                $userPermissionArr['PermissionSetting']['Permission_Action'] = $PermissionArr['ACTION'];
            }else{
                $userPermissionArr['PermissionSetting']['Permission_Action'] = [];
            }
            if(!empty($PermissionArr) && array_key_exists('EMAIL',$PermissionArr)){
                $userPermissionArr['PermissionSetting']['Permission_Email'] = $PermissionArr['EMAIL'];
            }else{
                $userPermissionArr['PermissionSetting']['Permission_Email']= [];
            }
        }else{
            $userPermissionArr['PermissionSetting']['Status'] = true;
            $userPermissionArr['PermissionSetting']['Permission_Action'] = [];
            $userPermissionArr['PermissionSetting']['Permission_Action'] = [];
        }

        //Get Payment Gateway Configuration Setting
        $gatewayCount = User::isUserCommissionConfigured($user_id);
        if($gatewayCount!=null){
            $userPermissionArr['GatewayConfigured'] = true;
        }else{
            $userPermissionArr['GatewayConfigured'] = false;
        }
        return $userPermissionArr;
    }
    


    /**
     * Method Name :: isPermittedAction
     * @param $user_id
     * @param $action
     * @return bool
     */
    public function isPermittedAction($actionName=null){
        $user = Auth::user();
        $profilePermission = $user->permissions;
        //dd($profilePermission);
        if($profilePermission!="null"){ 
            $userPermissionArr['PermissionSetting']['Status'] = true;
            $PermissionArr = json_decode($profilePermission,true);
            //dd($PermissionArr);
            if(is_array($PermissionArr)){
                if(array_key_exists('ACTION',$PermissionArr)){
                    $userPermissionArr['PermissionSetting']['Permission_Action'] = $PermissionArr['ACTION'];
                }else{
                    $userPermissionArr['PermissionSetting']['Permission_Action'] = [];
                }
                if(array_key_exists('EMAIL',$PermissionArr)){
                    $userPermissionArr['PermissionSetting']['Permission_Email'] = $PermissionArr['EMAIL'];
                }else{
                    $userPermissionArr['PermissionSetting']['Permission_Email']= [];
                }
            }else{
                $userPermissionArr['PermissionSetting']['Status'] = true;
                $userPermissionArr['PermissionSetting']['Permission_Action'] = [];
                $userPermissionArr['PermissionSetting']['Permission_Action'] = [];
            }
        }else{
            $userPermissionArr['PermissionSetting']['Status'] = true;
            $userPermissionArr['PermissionSetting']['Permission_Action'] = [];
            $userPermissionArr['PermissionSetting']['Permission_Action'] = [];
        }
        //dd($userPermissionArr['PermissionSetting']['Permission_Action']);
        if(array_key_exists($actionName,$userPermissionArr['PermissionSetting']['Permission_Action'])){
            if($userPermissionArr['PermissionSetting']['Permission_Action'][$actionName]){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }




    /**
     * Method Name :: getUserGatewayPermissionAction
     * @param $user_id
     * @param gatway_name and permission action_type
     * @return bool
     */
    public function getUserGatewayPermissionAction($gateway_name, $action_name, $userObj=null){
         if($userObj!=''){
            $user = $userObj;
         }else{
            $user = Auth::user();
         }
         $profilePermission = $user->permissions;
         //dd($gateway_name);
         if($profilePermission!="null"){ 
            $userPermissionArr['PermissionSetting']['Status'] = true;
            $PermissionArr = json_decode($profilePermission,true);
            if(array_key_exists('GATEWAY',$PermissionArr)){
                foreach($PermissionArr['GATEWAY'] as $key=>$item){
                    if($key==$gateway_name){
                        return $item[$action_name];
                    }
                }
            }else{
                return false;
            }
         }else{
            return false;
         }
    }







    /**
     * Method Name: getParentUserCommissionBaseRate()
     * This Method Will Help Tp Get the Parent User Gateway Commission Rate
     * @param User $user Object
     * @return Array of Assigned Payment Base Rate
     */
    public function getParentUserCommissionBaseRate(User $user, $gateway_id){
    if (!$user || $gateway_id== '') {
        return [];
    }
    // Initialize the result array
    $superDistributorUserCommissionList = [];
    //Get SuperDistributor Commission Details
    if($user->parent_id > 0){
       
            $parentUserCommissionList = UserCommissionSetting::with('Gateway')
            ->where('user_id', $user->parent_id)
            ->where('gateway_id', $gateway_id)
            ->get();
                if($parentUserCommissionList){
                    foreach($parentUserCommissionList as $item){
                        $superDistributorUserCommissionList[$item['payment_type']] = array(
                            'rate'=>$item['rate'],
                            'next_day_rate'=>$item['next_day_rate'],
                            'next_week_rate'=>$item['next_week_rate'],
                            'rate_type'=>$item['rate_type'],
                            'is_active'=>$item['is_active']
                    ); 
                }
            }
        }
    return $superDistributorUserCommissionList;

    }
    
    




    /**
     * Get All Retailer Ids
     * @param SuperDistributorid
     * @return Retailerids in array
     */
    public  function getAllRetailerIdsOfSuperDistributor($user_id){
        $retailerIds = [];
        $distributorIds = User::where('parent_id',$user_id)->pluck('id');
        if(!empty($distributorIds)){
            $retailerIds = User::whereIn('parent_id',$distributorIds)->pluck('id');
            if(!empty($retailerIds)){
                return $retailerIds;
            }
        }
    }
















}
