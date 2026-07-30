<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime; // Make sure to include this
use Illuminate\Support\Facades\Auth;





class Transaction extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    /**
     * Get the settlements for the transaction.
     */
    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Gateway model
    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }

    /**
     * All Transaction List
     */
    public static function getAllTransactionList($user_id){
        return Transaction::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
    }


    /**
     * Get Total Amount
     */
    public static function getTotalTransactionList($user_id){
        $transactionSucessList = Transaction::where('user_id', $user_id)
        ->where('status', 'Success')
        ->orderBy('id','DESC')
        ->get();
        return $transactionSucessList->sum('amount');

    }




    /**
     * Get Today Transaction Amount
     */
    public static function getTotalTodayTransactionList($user_id){
        $currentDate = Carbon::now()->toDateString();
        $transactionTodaySucessList = Transaction::where('user_id', $user_id)
        ->where('status', 'Success')
        ->whereDate('created_at', $currentDate)
        ->orderBy('id','DESC')
        ->get();
        return $transactionTodaySucessList->sum('amount');

    }


    /**
     * Get Today Transaction Amount
     */
    public static function getTotalFailedTransactionList($user_id){
        $transactionFailedList = Transaction::where('user_id', $user_id)
        ->where('status', 'Success')
        ->orderBy('id','DESC')
        ->get();
        return $transactionFailedList->sum('amount');
    }



    public static  function getTransactionDetails($transactionId){
        $transactionDetails = Transaction::with('User')->select('transactions.*', 'gateways.gateway_name')
        ->join('gateways', 'transactions.gateway_id', '=', 'gateways.id')
        ->where('transactions.id', $transactionId)
        ->first();
        if($transactionDetails){
        $taxAmount = self::calculateTaxFromAmount($transactionDetails['amount'],$transactionDetails['rate_fee']);
        $gstAmount = self::calculateGstAmount($taxAmount);
        $carddetails = $transactionDetails->card;
        $cardArray = json_decode($carddetails, true);
        //dd($cardArray);
        if ($cardArray !== null && json_last_error() === JSON_ERROR_NONE) {
            if($transactionDetails->gateway_name=='CASHFREE'){
                $nameOnCard = '';
                $last4digitCard = $cardArray['card_number'];
                $cardBankType = $cardArray['card_network'] .' | '. $cardArray['card_bank_name'];
                $cardType = $cardArray['card_type'];
                $cardInternational = false;
            }elseif($transactionDetails->gateway_name=='EASEBUZZ'){
                $nameOnCard = '';
                $last4digitCard = $cardArray['card_number'];
                $cardBankType = $cardArray['card_network'] .' | '. $cardArray['card_bank_name'];
                $cardType = $cardArray['card_type'];
                $cardInternational = false;
            }elseif($transactionDetails->gateway_name=='PHONEPE'){
                $nameOnCard = '';
                $last4digitCard = '-NA-';
                $cardBankType = '-NA-';
                $cardType = '-NA-';
                $cardInternational = false;
            }else{
                $nameOnCard = $cardArray['name'];
                $last4digitCard = $cardArray['last4'];
                $cardBankType = $cardArray['network'];
                $cardType = $cardArray['type'];
                $cardInternational = $cardArray['international'];
            }
        }else{
            $nameOnCard = '-NA-';
            $last4digitCard = '-NA-';
            $cardBankType = '-NA-';
            $cardType = '-NA-';
            $cardInternational = '-NA-';
        }
        //Location Details
        $locationetails = $transactionDetails->location;
        $locationetailsArray = json_decode($locationetails, true);

        //Get Distributor Details
        $parent_user_id = $transactionDetails->User->parent_id; 
        $distibutorDetails = User::findOrFail($parent_user_id)->toArray();
        //dd($transactionDetails);

        $taxAmount = $transactionDetails->amount  * 0.01 * $transactionDetails->rate_fee; 
        $deductionAmount = $transactionDetails->amount - $taxAmount;
        $fee = 0;
        $tax = $taxAmount * 0.18;
        $deductionAmount = $taxAmount - $tax;  


        $resultData = [
            'paymentDate'=>$transactionDetails->created_date,
            'amount'=> $transactionDetails->amount,
            'customer_name'=>$transactionDetails->customer_name,
            'customer_mobile'=>$transactionDetails->customer_mobile,
            'customer_email'=>$transactionDetails->customer_email,
            'company_name'=>env('APP_NAME'),
            'company_address'=>env('APP_ADDRESS'),
            'company_contact'=>env('APP_CONTACT'),
            'payment_reference'=>$transactionDetails->gateway_payment_id,
            'transaction_number'=>$transactionDetails->txn_id,
            'paymentType'=>$transactionDetails->payment_type,
            'order_id'=>$transactionDetails->order_id,
            'payment_method'=>$transactionDetails->method,
            'description'=>$transactionDetails->description,
            'ip_address'=>$transactionDetails->ip_address,
            'user_browser'=>$transactionDetails->user_browser,
            'userAgent'=>$transactionDetails->userAgent,
            'location'=>$transactionDetails->location,
            'tax_amount'=>$taxAmount,
            'gst_amount'=>$gstAmount,
            'rate_fee'=>$transactionDetails->rate_fee,
            'deposite_amount'=>$transactionDetails->deposite_amount,
            'convenience_fee'=>'0.00',
            'totalAmount'=>$transactionDetails->amount,
            'payment_status'=>$transactionDetails->status,
            'card'=>[
                'nameOnCard'=>$nameOnCard,
                'last4digitCard' =>$last4digitCard,
                'cardBankType' => $cardBankType,
                'cardType' => $cardType,
                'cardInternational' => $cardInternational,
            ],
            'location'=>$locationetailsArray,
            'user_browser'=>$transactionDetails->user_browser,
            'user_device'=>$transactionDetails->userAgent,
            'gateway_name'=>$transactionDetails->gateway_name,
            'User'=>$transactionDetails->User->toArray(),
            'Distributor'=>$distibutorDetails,
            'deductionAmount'=>number_format($deductionAmount,2),
            'tax'=>number_format($tax,2)

        ];
        }else{
            $resultData = [];
        }
        return $resultData; 
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
      * Method Name: getTotalAmountList
      * @return  Array : Total Amount List
      * @param $status string
      * @param $filter string
      * all -> this will return list as well as total
      */
      public static function getTransactionList($dateFilter='toady',$status='Success'){
        $endDate = Carbon::now()->toDateString();
        if(Auth::user()->role=='admin'){
            $query = Transaction::with('User')->orderBy('id','DESC');
        }else{
            if(Auth::user()->role=='distributor'){
                $userIds = User::where('parent_id', getAuthValue('id'))->pluck('id');
                $query = Transaction::with('User')->whereIn('user_id',$userIds)->orderBy('id','DESC');
            }else{
                $query = Transaction::with('User')->where('user_id',getAuthValue('id'))->orderBy('id','DESC');
            }
        }
        if($status!='Success'){
            $query->where('status', '!=', 'Success');
        }else{
            $query->where('status', $status);
        }
        if($dateFilter=='today'){
            $query->whereDate('created_at', $endDate);
        }if($dateFilter=='week'){
            $startDate = Carbon::now()->subDays(7)->toDateString();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }if($dateFilter=='month'){
            $startDate = Carbon::now()->subMonth()->toDateString();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        $transactionList = $query->get();
        return $transactionList;
      }




       /**
      * Method Name: getTotalAmountList
      * @return  Array : Total Amount List
      * @param $status string
      * @param $filter string
      * all -> this will return list as well as total
      */
      public static function getRetailerTransactionList($user_id, $dateFilter='toady',$status='Success'){
        $endDate = Carbon::now()->toDateString();
        
        $query = Transaction::with('User')->where('user_id',$user_id)->orderBy('id','DESC');
        
        if($status!='Success'){
            $query->where('status', '!=', 'Success');
        }else{
            $query->where('status', $status);
        }
        if($dateFilter=='today'){
            $query->whereDate('created_at', $endDate);
        }if($dateFilter=='week'){
            $startDate = Carbon::now()->subDays(7)->toDateString();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }if($dateFilter=='month'){
            $startDate = Carbon::now()->subMonth()->toDateString();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        $transactionList = $query->get();
        return $transactionList;
      }






      /**
       * Method Name: Sale Last 30 Days
       */
      public static function getSaleLast30Days(){
        $endDate = Carbon::today(); // Today's date
        $startDate = Carbon::today()->subDays(30); // 30 days ago
        $totals = [];
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $day = $date->toDateString();
            if(Auth::user()->role=='admin'){
                $transactionList = Transaction::whereDate('created_at', $day)->get();
            }else{
                $transactionList = Transaction::where('user_id', getAuthValue('id'))->whereDate('created_at', $day)->get(); 
            }
            $totals[$day] = $transactionList->sum('amount');
        }
        return $totals;
      }
      
}
