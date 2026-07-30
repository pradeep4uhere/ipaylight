<?php namespace App\Checkout\Gateways;
use App\Checkout\PaymentGateWayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestNew;
use App\Models\Gateway;
use App\Models\Transaction;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Facades\Agent;
use Config;
use Illuminate\Support\Facades\DB;
use App\Libraries\EasebuzzLib\Easebuzz;
require_once(app_path('Libraries/EasebuzzLib/easebuzz_payment_gateway.php'));
/**
 * Created by Pradeep Kumar.
 * User: Pradeep
 * Date:01/01/24
 * Time: 08:37
 */

 class EasebuzzGateway implements  PaymentGateWayInterface  {
  
  

     
     
     /**
     * Get Configuration For Payment Gateway 
     * Arrage Data for Checkout for payment Gateway
     */
    public function getGatewayConfigurtionMode($gateway_id){
        $gatewayDetails =  Gateway::find($gateway_id);
        if($gatewayDetails['mode']=='Prod'){
            return 'production';
        }else{
            return 'sandbox';
        }
    }



     /**
     * Get Configuration For Payment Gateway 
     * Arrage Data for Checkout for payment Gateway
     */
    public function getGatewayConfigurtion($gateway_id){
        return Gateway::find($gateway_id);
    }


    /**
     * Curl Method For Creating New Order At Server end
     * @param Illuminate\Http\Request;
     */
    private function createOrderDetails($request,$nextId){
       // dd($request->all());
        $amount       = $request->get('amount');
        $payemnt_type = $request->get('payemnt_type');
        $urlText      = $request->get('urlText');
        $user_id      = $request->get('user_id');
        $gateway_id   = $request->get('gateway_id');
        $mobile       = $request->get('mobile');
        $name       = $request->get('name');
        $email      = $request->get('email');
        $last_transaction_id = $nextId;
        //Get Gateway Configuration
        $gatewaydsDetails = Gateway::find($gateway_id);
        //dd($gatewaydsDetails);
        //dd($gatewaydsDetails );
        $key_id = $gatewaydsDetails['pg_client_key'];
        $secret = $gatewaydsDetails['pg_seceret_key'];
        // Set your Razorpay API key and secret
        $keyId  = $key_id;
        $keySecret = $secret;
       
        //dd('dasd');
        $easebuzzObj = new Easebuzz($key_id, $secret, strtolower($gatewaydsDetails['mode']));
        $returnUrl = 'payemnt_status?ltid='.encryptString($last_transaction_id).'&uid='.encryptString($user_id).'&gateway=Easebuzz';

        $postData = array ( 
            "txnid" => 'pay_'.generateRandomAlphabetString(10), 
            "amount" => (float)$amount.'.00', 
            "firstname" => $name, 
            "email" => $email, 
            "phone" => $mobile, 
            "productinfo" => "Express Checkout Payment", 
            "surl" => url($returnUrl), 
            "furl" => url($returnUrl), 
            "udf1" => $user_id, 
            "udf2" => "", 
            "udf3" => "", 
            "udf4" => "", 
            "udf5" => "", 
            "address1" => "", 
            "address2" => "", 
            "city" => "", 
            "state" => "", 
            "country" => "", 
            "zipcode" => "" 
          );
          $easebuzzObj->initiatePaymentAPI($postData);
    }


    
    /**
     * PreProcess For Payment Gateway 
     * Arrage Data for Checkout for payment Gateway
     */
    public function process(Request $request){
        DB::beginTransaction();
        try {
            // Lock the transactions table
            DB::table('transactions')->lockForUpdate()->get();
            // Fetch the next auto-increment ID
            // Create a new transaction record with the fetched ID
            $nextId = DB::table('transactions')->max('id') + 1;
            DB::commit();
            if(true){
                // Get user's IP address
                $ipAddress = RequestNew::ip();
                // Get user's browser information
                $browser = Agent::browser();
                // Retrieve user's location using the Location facade
                if(env('APP_ENV')=='local'){
                    //$location = generateRandomIPAddress();
                    $location = Location::get('223.233.76.20');
                }else{
                    $location = Location::get(Request::ip());
                }
                // Get user's device information
                $device = Agent::device();
                if($request->get('payemnt_type')=='IN'){ $paymentType = 'SameDay';}
                else if($request->get('payemnt_type')=='ND'){ $paymentType = 'NextDay';}
                else if($request->get('payemnt_type')=='NW'){ $paymentType = 'NextWeek';}
                else { $paymentType = 'OtherPayment'; }
                $orderDetailsArr = [];
                //dd($orderDetailsArr);
                // Assuming you have the necessary data to create a transaction
                $transactionData = [
                    'user_id' => $request->get('user_id'),
                    'entity'=>'payment',
                    'gateway_id' => $request->get('gateway_id'),
                    'amount' => $request->get('amount'),
                    'customer_name' => $request->get('name'),
                    'customer_email' => $request->get('email'),
                    'customer_mobile' => $request->get('mobile'),
                    'txn_id' => 'pay_'.generateRandomAlphabetString(10),
                    'rate_fee' => '0.00',
                    'payment_type'=>$paymentType,
                    'status' => 'created',
                    'description'=>$request->get('descriptions'),
                    'order_id' => 'order_'.time(),
                    'ip_address'=>$ipAddress,
                    'user_browser'=>$browser,
                    'userAgent'=>$device,
                    'location'=>json_encode(isset($location)?$location:null)
                    // Add other fields as needed
                ];

                //dd($transactionData);
                // Create a new transaction record
                $transaction = Transaction::create($transactionData);
                if($transaction->id > 0 ){
                    $orderDetails = $this->createOrderDetails($request,$transaction->id);
                    $result = ['status'=>true, 'transaction_id'=>$transaction->id, 'orderDetails'=>$orderDetails];
                    return  $result;
                }else{
                    $result = ['status'=>false, 'transaction_id'=>null, 'orderDetails'=>$orderDetails];
                    return  $result;
                }
            }else{
              
                $result = ['status'=>false, 'transaction_id'=>null, 'orderDetails'=>null];
                return  $result;
            }
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();
            $result = ['status'=>false, 'transaction_id'=>null, 'orderDetails'=>null];
            // Handle the exception
            // For example: Log the error, display a message to the user, etc.
        }
    }

    /***
     * Final Checkout for Payment  Processing
     * @param Request $request
     * @return bool|PaymentResponse
     */
    public function checkout($res){

    }



     /**
     * Payment Return Status
     * Check the Payment Status after Payment Done by the user
     * @param Request $request
     * 
     */
    public function  paymentReturnStatus($request){
       // dd($request->all());
        $response_from_pg = $request->all();
        $transaction_id = \Crypt::decryptString($request->get('ltid'));
        if($transaction_id > 0){
           $transactionDetails = Transaction::with('Gateway')->find($transaction_id);
           //dd($transactionDetails);
           $orderId = $transactionDetails->order_id;
           if(!empty($transactionDetails)){
                //$response = $this->getOrderDetails($response_from_pg);
                //dd($response_from_pg);
                $responseArr = $response_from_pg;
                if(is_array(($responseArr))){
                    $paymentDetails = $responseArr;
                    $transactionTable = $this->updateTransactionTable($paymentDetails, $transaction_id);
                    //dd($transactionTable);
                    if($transactionTable->status=='Success'){
                        return array('status'=>true, 'transactionTable'=>$transactionTable, 'message'=>'Transaction Completed.');
                    }else{
                        return array('status'=>false, 'transactionTable'=>$transactionTable, 'message'=>'Transaction Not Completed.');
                    }
                }else{
                    return array('status'=>false, 'transactionTable'=>[],'message'=>'Transaction Not Found.');
                }
                }else{
                    return array('status'=>false, 'transactionTable'=>[],'message'=>'Transaction Not Found.');
                }
        }else{
            return array('status'=>false, 'transactionTable'=>[],'message'=>'Transaction Not Found.');
        }
    }



     /**
     * Update  the transaction table with the response from Razorpay Server
     * If any error occured then send a mail to admin for further investigation
     */
    private function updateTransactionTable($paymentDetails, $transactionId){
       
        //dd($paymentDetails);
        $transactionObj = Transaction::find($transactionId);
        if($paymentDetails['status'] === 'success'){
            $cardArray = array(
                "channel"=>"",
                "card_number"=>$paymentDetails['cardnum'],
                "card_network"=>$paymentDetails['bankcode'],
                "card_type"=>$paymentDetails['card_type'],
                "card_country"=>"IN",
                "card_bank_name"=>$paymentDetails['issuing_bank'],
                "card_network_reference_id"=>null,
                "card_sub_type"=>$paymentDetails['mode']
            );
            $cardDetails = json_encode($cardArray);
            $paymentMethod = self::getPaymentTypeMethod($paymentDetails);
            if($paymentMethod!=''){ $method_name = $paymentMethod; }else{ $method_name = 'CREDIT_CARD';};
            $updateData = [
                            "entity"=>"",
                            "gateway_payment_id" => $paymentDetails['easepayid'],
                            "payment_ref_key" => $paymentDetails['bank_ref_num'],
                            "rate_fee" => "0.00",
                            "deposite_amount" => "0.00",
                            "status" => ucfirst(strtolower($paymentDetails['status'])),
                            "captured"=>true,
                            "method" => $method_name,
                            "payment_mode" => $paymentDetails['mode'],
                            "amount_refunded" => "0.00",
                            "refund_status" => null,
                            "captured" => ($paymentDetails['status']=='success') ? true: false,
                            "link_text" => null,
                            "card_id" => "",
                            "card" => $cardDetails,
                            "bank" => $paymentDetails['bank_name'],
                            "wallet" => null,
                            "vpa" => null,
                            "fee" => '0.00',
                            "tax" => '0.00',
                            "error_code" => null,
                            "error_description" => null,
                            "error_source" => null,
                            "error_step" => null,
                            "error_reason" => $paymentDetails['error_Message'],
                            "notes" => null,
                            "more_details"=>json_encode($paymentDetails),
                            "created_date" => date("Y-m-d h:i:s", strtotime($paymentDetails['addedon'])),
                            "more_details" => null
                        ];
                    //dd($updateData);
                    if ($transactionObj) {
                        // Update the transaction record
                        $transactionObj->update($updateData);
                        // Optionally, you can retrieve the updated transaction
                        $updatedTransaction = Transaction::find($transactionId);
                        // Return the updated transaction or handle it as needed
                        return $updatedTransaction;
                    }else {
                        // Transaction not found, handle error accordingly
                        return response()->json(['error' => 'Transaction not found'], 404);
                    }
        }elseif($paymentDetails['status'] === 'failure'){
            $error_description="";
            $error_code_raw ="";
            $error_source ="";
            $payment_status = 'Failed';
            $cardArray = array(
                "channel"=>"",
                "card_number"=>$paymentDetails['cardnum'],
                "card_network"=>$paymentDetails['bankcode'],
                "card_type"=>$paymentDetails['card_type'],
                "card_country"=>"IN",
                "card_bank_name"=>$paymentDetails['issuing_bank'],
                "card_network_reference_id"=>null,
                "card_sub_type"=>$paymentDetails['mode']
            );
            $cardDetails = json_encode($cardArray);
            $paymentMethod = self::getPaymentTypeMethod($paymentDetails);
            if($paymentMethod!=''){ $method_name = $paymentMethod; }else{ $method_name = 'CREDIT_CARD';};
            $updateData = [
                            "entity"=>"",
                            "gateway_payment_id" => $paymentDetails['easepayid'],
                            "payment_ref_key" => $paymentDetails['bank_ref_num'],
                            "rate_fee" => "0.00",
                            "deposite_amount" => "0.00",
                            "status" => $payment_status,
                            "captured"=>false,
                            "method" => $method_name,
                            "payment_mode" => $paymentDetails['mode'],
                            "amount_refunded" => "0.00",
                            "refund_status" => null,
                            "captured" =>  false,
                            "link_text" => null,
                            "card_id" => "",
                            "card" => $cardDetails,
                            "bank" => $paymentDetails['bank_name'],
                            "wallet" => null,
                            "vpa" => null,
                            "fee" => '0.00',
                            "tax" => '0.00',
                            "error_code" => $error_code_raw,
                            "error_description" => $error_description,
                            "error_source" => $error_source,
                            "error_step" => null,
                            "error_reason" => $paymentDetails['error_Message'],
                            "notes" => null,
                            "more_details"=>json_encode($paymentDetails),
                            "created_date" => date("Y-m-d h:i:s", strtotime($paymentDetails['addedon']))
                        ];
                    if ($transactionObj) {
                        // Update the transaction record
                        $transactionObj->update($updateData);
                        // Optionally, you can retrieve the updated transaction
                        $updatedTransaction = Transaction::find($transactionId);
                        // Return the updated transaction or handle it as needed
                        return $updatedTransaction;
                    }else {
                        // Transaction not found, handle error accordingly
                        return response()->json(['error' => 'Transaction not found'], 404);
                    }
        }else{
            return response()->json(['error' => 'Transaction not updated'], 404);
        }

    }




    /**
     * Method Name: getPaymentTypeMethod()
     * Get Payment Method Type After Response By Easebuzz
     * @param PaymentDetailsResponse
     * @return String
     */
    private static function getPaymentTypeMethod($paymentDetails){
        $method_type = 'CREDIT_CARD';
        if($paymentDetails['status']=='success'){
            if($paymentDetails['mode']=='CC'){
                if($paymentDetails['card_type']=='Credit Card'){
                    return $method_type;
                }
            }else{
                return $method_type;
            }
        }else{
            return $method_type;
        }
    }



    /**
     * Get Order Details  and Update in Transactions Table
     * @param Order_id  
     * @return PaymentDetails in array
     */

    // private function getOrderDetails($transactionDetails) {

    //         //Get Gateway Configuration
    //         $gateway_id = $transactionDetails->gateway_id;
    //         $orderId = $transactionDetails->order_id;
    //         $gatewaydsDetails = Gateway::find($gateway_id);
    //         //dd($gatewaydsDetails );
    //         $key_id = $gatewaydsDetails['pg_client_key'];
    //         $secret = $gatewaydsDetails['pg_seceret_key'];
    //         // Set your Razorpay API key and secret
    //         $keyId  = $key_id;
    //         $keySecret = $secret;
    //         // Set the API endpoint URL
    //         $cashfreeGlobalArr = Config::get('global.GATWAYS_URL.CASHFREE');
    //         if(env('PAYMENT_MODE')=='Prod'){
    //             $apiUrl = $cashfreeGlobalArr['PROD_API_ENDPOINT'].'/orders/';
    //         }else{
    //             $apiUrl = $cashfreeGlobalArr['TEST_API_ENDPOINT'].'/orders/';
    //         }
    //         $url = $apiUrl . $orderId.'/payments';

          
    //           // Headers for the request
    //         $headers = [
    //             'X-Client-Secret: '.$keySecret.'',
    //             'X-Client-Id: '.$keyId.'',
    //             'x-api-version: 2023-08-01',
    //             'Content-Type: application/json',
    //             'Accept: application/json'
    //         ];

    //         // Initialize cURL session
    //         $ch = curl_init($url);

    //         // Set cURL options
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //         // Execute cURL session
    //         $response = curl_exec($ch);

    //         // Check for errors
    //         if (curl_errno($ch)) {
    //             return 'Error: ' . curl_error($ch);
    //         }

    //         // Close cURL session
    //         curl_close($ch);

    //         // Return the response
    //         return $response;
    //     }





    /**
     * Method Name: getCommissionRateForCurrentPaymentType
     * This method help to find the ROI of the Payment Type
     * Current Transaction Table Row Result passed as paramter
     * @param Transaction  $transaction, Current Transaction
     * @return float|int
     */
    public function getCurrentPaymentType($transactionRow){
        //Get All Payment Type Globally  Defined in Helpers/helper.php
        $paymentTypeList = getPaymentTypeList();
        $paymentTypeKeys = array_keys($paymentTypeList);
        //dd($transactionRow);
        if(!empty($transactionRow)){
            $cardDetails = json_decode($transactionRow['card'],true);
           
            if($transactionRow['method'] == 'debit_card'){
                if($cardDetails['card_type']=='debit_card'){
                    if($cardDetails['card_network']==('master_card')){
                        $paymentMethodType = 'DEBIT_CARD';
                    }else if($cardDetails['card_network']==('visa')){
                        $paymentMethodType = 'DEBIT_CARD';
                    }else{
                        $paymentMethodType = 'DEBIT_CARD';
                    }
                }
            }else if($transactionRow['method'] == 'credit_card'){
                if($cardDetails['card_type']=='credit_card'){
                    if($cardDetails['card_network']==('master_card')){
                        $paymentMethodType = 'CREDIT_CARD';
                    }else if($cardDetails['card_network']==('visa')){
                        $paymentMethodType = 'CREDIT_CARD';
                    }else{
                        $paymentMethodType = 'CREDIT_CARD';
                    }
                }
            }else if($transactionRow['method'] == 'Credit Card'){
                if(($cardDetails['card_type']=='Credit Card') && ($cardDetails['card_sub_type']=='CC')){
                    if($cardDetails['card_network']==('master_card')){
                        $paymentMethodType = 'CREDIT_CARD';
                    }else if($cardDetails['card_network']==('visa')){
                        $paymentMethodType = 'CREDIT_CARD';
                    }else if($cardDetails['card_network']=='NA'){
                        $paymentMethodType = 'CREDIT_CARD';
                    }else{
                        $paymentMethodType = 'CREDIT_CARD';
                    }
                }
            }else{
                $paymentMethodType = 'CREDIT_CARD';
            }
        }else{
            $paymentMethodType = 'CREDIT_CARD';
        }
        return $paymentMethodType;
    }


}