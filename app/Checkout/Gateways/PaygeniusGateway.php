<?php namespace App\Checkout\Gateways;
use App\Checkout\PaymentGateWayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestNew;
use App\Models\Gateway;
use App\Models\Transaction;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Facades\Agent;
use Razorpay\Api\Api;
use Config;
use Illuminate\Support\Facades\Log;



/**
 * Created by Pradeep Kumar.
 * User: Pradeep
 * Date:01/01/24
 * Time: 08:37
 */

 class PaygeniusGateway implements  PaymentGateWayInterface  {
 
    
     
     /**
     * Get Configuration For Payment Gateway 
     * Arrage Data for Checkout for payment Gateway
     */
    public function getGatewayConfigurtionMode($gateway_id){
        $gatewayDetails =  Gateway::find($gateway_id);
        if($gatewayDetails['mode']=='Prod'){
            return 'UAT';
        }else{
            return 'PROD';
        }
    }
    
    
    /**
     * Get Configuration For Payment Gateway 
     * Arrage Data for Checkout for payment Gateway
     */
    public function getGatewayConfigurtion($gateway_id){
        return Gateway::find($gateway_id);
    }
    


    private function getGlobalConfig($gateway_id){
        $paymentMode = 'Test';
        $pgGlobalArr = Config::get('global.GATWAYS_URL.PAYGENIUS');
        $gatewaydsDetails = Gateway::find($gateway_id);
        if($gatewaydsDetails['mode']=='Prod'){
            $paymentMode = 'Prod';
            $client_id = $pgGlobalArr['PROD']['CLIENT_ID'];
            $tokenApiUrl  = $pgGlobalArr['PROD']['TOKEN'];
            $orderApiUrl  = $pgGlobalArr['PROD']['ORDER'];
            $orderStatusApiUrl  = $pgGlobalArr['PROD']['ORDER_STATUS'];
            $merchantIdFromConfig = $gatewaydsDetails;
        }else{
            $paymentMode = 'Test';
            $client_id = $pgGlobalArr['PROD']['CLIENT_ID'];
            $tokenApiUrl  = $pgGlobalArr['UAT']['TOKEN'];
            $orderApiUrl  = $pgGlobalArr['UAT']['ORDER'];
            $orderStatusApiUrl  = $pgGlobalArr['UAT']['ORDER_STATUS'];
            $merchantIdFromConfig = $gatewaydsDetails;
        }
        return [$client_id, $paymentMode, $tokenApiUrl, $orderApiUrl, $orderStatusApiUrl, $merchantIdFromConfig];
    }




    private function createTokenDetails($request){
       $gateway_id = $request->get('gateway_id');
       list($client_id, $paymentMode, $tokenApiUrl, $orderApiUrl, $orderStatusApiUrl, $merchantIdFromConfig) = $this->getGlobalConfig($gateway_id);
        $headers = [
            'Content-Type: application/json',
            'client_id: ' . $client_id,
            'username: ' . $merchantIdFromConfig['pg_client_key'],
            'password: ' . $merchantIdFromConfig['pg_seceret_key'],
        ];
        //dd($tokenApiUrl);
        //dd($headers);
        $ch = curl_init();
        // Set curl options
        curl_setopt($ch, CURLOPT_URL, $tokenApiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180); // 180 seconds timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // 120 seconds connect timeout
        
        // Disable SSL verification for testing purposes
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        // Enable verbose output for debugging
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        
        // Execute curl request
        $response = curl_exec($ch);
        
        // Get information about the request
        $info = curl_getinfo($ch);
        
        // Check for curl errors
        if (curl_errno($ch)) {
            $responseArr = [
                "status" => false,
                "message" => curl_error($ch)
            ];
            curl_close($ch);
            return $responseArr;
        }
        
        // Close curl session
        curl_close($ch);
        
        // Check if the response is empty
        if ($response == '') {
            $responseArr = [
                "status" => false,
                "message" => "Server Down, Please try after sometime"
            ];
            return $responseArr;
        }
        
        // Decode the response
        $result = json_decode($response, true);
        
        // Return the result
        return $result;
    }



    
    /**
     * PreProcess For Payment Gateway 
     * Arrage Data for Checkout for payment Gateway
     */
    public function process(Request $request){
       
        $orderDetails = $this->createOrderDetails($request);
        //dd($request->all());
        //dd($orderDetails);
        //save Transaction Initiation Records into Database Table
        if($orderDetails['status']){
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
            $orderDetailsArr = json_decode($orderDetails['response'],true);
            if($orderDetailsArr['status']=='SUCCESS'){
                // Assuming you have the necessary data to create a transaction
                $transactionData = [
                    'user_id' => $request->get('user_id'),
                    'gateway_id' => $request->get('gateway_id'),
                    'amount' => $request->get('amount'),
                    'customer_name' => $request->get('name'),
                    'customer_email' => $request->get('email'),
                    'customer_mobile' => $request->get('mobile'),
                    'txn_id' => $orderDetails['merc_unq_ref'],
                    'rate_fee' => '0.00',
                    'payment_type'=>$paymentType,
                    'status' => 'created',
                    'description'=>$request->get('descriptions'),
                    'link_text'=>$request->get('urlText'),
                    'order_id' => $orderDetails['order_id'],
                    'ip_address'=>$ipAddress,
                    'user_browser'=>$browser,
                    'userAgent'=>$device,
                    'location'=>json_encode(isset($location)?$location:null)
                    // Add other fields as needed
                ];
                // Create a new transaction record
                $transaction = Transaction::create($transactionData);
                //dd($transaction);
                if($transaction->id > 0 ){
                    $result = ['status'=>true, 'transaction_id'=>$transaction->id, 'orderDetails'=>$orderDetails];
                    return  $result;
                }else{
                    $result = ['status'=>false, 'transaction_id'=>null, 'orderDetails'=>$orderDetails];
                    return  $result;
                }
            }else{
                $result = ['status'=>false, 'transaction_id'=>null, 'orderDetails'=>$orderDetails,'message'=>"Order not Created, Please try after sometime."];
                return  $result;
            }
        }else{
            $result = ['status'=>false, 'transaction_id'=>null, 'orderDetails'=>$orderDetails];
            return  $result;
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
     * Curl Method For Creating New Order At Server end
     * @param Illuminate\Http\Request;
     */
    private function createOrderDetails($request){
        $tokendata = $this->createTokenDetails($request);
        //$tokendata = json_decode($totkenDetails, true);
        //dd($tokendata);
        if($tokendata['status']=='SUCCESS'){
            $token = $tokendata['data']['token'];
            $gateway_id = $request->get('gateway_id');
            list($client_id, $paymentMode, $tokenApiUrl, $orderApiUrl, $orderStatusApiUrl, $merchantIdFromConfig) = $this->getGlobalConfig($gateway_id);
            $amount       = $request->get('amount');
            $payemnt_type = $request->get('payemnt_type');
            $urlText      = $request->get('urlText');
            $user_id      = $request->get('user_id');
            $gateway_id   = $request->get('gateway_id');

             //Get Gateway Configuration
            $gatewaydsDetails = Gateway::find($gateway_id);
            $key_id = $gatewaydsDetails['pg_client_key'];
            $secret = $gatewaydsDetails['pg_seceret_key'];
            // Set your Razorpay API key and secret
            $keyId  = $key_id;
            $keySecret = $secret;
            // Set the API endpoint URL

            $url = $orderApiUrl;
            $order_id = 'pay_'.generateRandomAlphabetString(15);
            $merc_unq_ref = 'pay_'.generateRandomAlphabetString(15);
             // Set the request payload data
            $data = [
                'amount' =>  $amount,
                'currency' => 'INR',
                'callbackurl'=>route('payment_callback'),
                'order_id'=>$order_id,
                'merc_unq_ref'=>$merc_unq_ref,
            ];
            //dd($data);
             // Encode the data as JSON
            $jsonData = json_encode($data);
            Log::debug("Callback URL From Module file - ".json_encode($data));
            $headers = [
                'Content-Type: multipart/form-data',
                //'Content-Type: application/json',
                'client_id: ' . $client_id,
                'token: ' . $token,
            ];
            
            //dd($headers);
             $ch = curl_init();
            // Set curl options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // Increase timeout settings
            curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 120 seconds timeout
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); // 60 seconds connect timeout
            // Enable verbose output for debugging
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            
         
            // Execute curl request
            $response = curl_exec($ch);
            //dd($response);
            // Check for curl errors
            if(curl_error($ch)) {
                $result = [
                    'status'=>true, 
                    'key_id'=>$key_id, 
                    'response'=> curl_error($ch),
                    'module'=>'PG',
                    'order_id'=>$order_id,
                    'merc_unq_ref'=>$merc_unq_ref
                ];
                //dd($result);
                return $result;
              
            } else {
                // Print the response
                $result = [
                    'status'=>true, 
                    'key_id'=>$key_id, 
                    'response'=>$response,
                    'module'=>'PG',
                    'order_id'=>$order_id,
                    'merc_unq_ref'=>$merc_unq_ref
                ];
                return $result;
            }
            // Close curl session
            curl_close($ch);
        }else{
            return $result = ['status'=>false, 'message'=>$tokendata['message']];
        }
       
    }




    /**
     * Payment Return Status
     * Check the Payment Status after Payment Done by the user
     * @param Request $request
     * 
     */
    public function  paymentReturnStatus($request){
        Log::debug("Transaction Callback paymentReturnStatus From Module file - ".json_encode($request->all()));
        $order_id = $request->get('ORDER_ID');
        $transactionDetails = Transaction::where('order_id',$order_id)->first();
        $transaction_id = $transactionDetails['id'];
        if($transaction_id > 0){
           $transactionDetails = Transaction::with('Gateway')->find($transaction_id);
           if(!empty($transactionDetails)){
                $gateway_id = $transactionDetails['gateway_id'];
                $gatewayDetails = Gateway::find($gateway_id);
                $responseData = $request->all();
                $paymentDetails['STATUS']       = $responseData['STATUS'];
                $paymentDetails['STATUS_CODE']  = $responseData['STATUS_CODE'];
                $paymentDetails['ORDER_ID']     = $responseData['ORDER_ID'];
                $paymentDetails['TXN_MODE']     = $responseData['TXN_MODE'];
                $paymentDetails['TXN_AMOUNT']   = $responseData['TXN_AMOUNT'];
                $paymentDetails['CARD_CATEGORY']= $responseData['CARD_CATEGORY'];
                $paymentDetails['TXN_DATE']     = $responseData['TXN_DATE'];
                $paymentDetails['TXN_INFO']     = $responseData['TXN_INFO'];
                $paymentDetails['CUSTOMER_NAME']     = $responseData['CUSTOMER_NAME'];
                $paymentDetails['CUSTOMER_EMAIL']     = $responseData['CUSTOMER_EMAIL'];
                $paymentDetails['CUSTOMER_PHONE']     = $responseData['CUSTOMER_PHONE'];
                $paymentDetails['BANK_TXNID']     = $responseData['BANK_TXNID'];
                $paymentDetails['BANK_CODE']     = $responseData['BANK_CODE'];
                $paymentDetails['ERROR_ID']     = $responseData['ERROR_ID'];
                $paymentDetails['ERROR_DESC']     = $responseData['ERROR_DESC'];
                $paymentDetails['CARD_NUMBER']     = $responseData['CARD_NUMBER'];
                $paymentDetails['CARD_TYPE']     = $responseData['CARD_TYPE'];
                $paymentDetails['UNMAPPED_STATUS']     = $responseData['UNMAPPED_STATUS'];
                $paymentDetails['PG_PARTNER']     = $responseData['PG_PARTNER'];
                $paymentDetails['MERC_UNQ_REF']     = $responseData['MERC_UNQ_REF'];
                $transactionTable = $this->updateTransactionTable($paymentDetails, $transaction_id);
                return array('status'=>true, 'transactionTable'=>$transactionTable, 'message'=>'Transaction Found.');
                
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
        $transactionObj = Transaction::find($transactionId);
        $cardDetails = "";
        $paymentMethod = $this->getPaymentTypeMethod($paymentDetails);
        if($paymentMethod!=''){ 
            $method_name = $paymentMethod; 
        }else{ 
            $method_name = 'CREDIT_CARD';
        };
        
        if($paymentDetails['STATUS']=='SUCCESS'){
            $status = 'Success';
            $amount = $paymentDetails['TXN_AMOUNT'];
        }else if($paymentDetails['STATUS']=='ERROR'){
            $status = 'Error';
            $amount = '0.00';
        }else{
            $status = 'Pending';
            $amount = '0.00';
        }

        $updateData = [
                        "entity"=>"",
                        "gateway_payment_id" => $paymentDetails['BANK_TXNID'],
                        "payment_ref_key" => $paymentDetails['BANK_TXNID'],
                        "rate_fee" => "0.00",
                        "deposite_amount" => "0.00",
                        "status" => $status,
                        "method" => $method_name,
                        "payment_mode" => null,
                        "amount_refunded" => "0.00",
                        "refund_status" => null,
                        "captured" => null,
                        "description" => null,
                        "link_text" => null,
                        "card_id" => $paymentDetails['CARD_NUMBER'],
                        "card" => $cardDetails,
                        "bank" => $paymentDetails['CARD_CATEGORY'],
                        "wallet" => null,
                        "vpa" => null,
                        "fee" => "0.00",
                        "tax" => "0.00",
                        "error_code" => $paymentDetails['ERROR_ID'],
                        "error_description" =>$paymentDetails['ERROR_DESC'],
                        "error_source" => null,
                        "error_step" => null,
                        "error_reason" => $paymentDetails['ERROR_DESC'],
                        "notes" => "",
                        "created_date" => $paymentDetails['TXN_DATE'],
                        "more_details" => null
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

    }




    /**
     * Method Name: getPaymentTypeMethod()
     * Get Payment Method Type After Response By Easebuzz
     * @param PaymentDetailsResponse
     * @return String
     */
    private static function getPaymentTypeMethod($paymentDetails){
        $method_type = 'CREDIT_CARD';
        if($paymentDetails['STATUS']=='SUCCESS'){
            if($paymentDetails['TXN_MODE']=='CREDIT_CARD'){
                if($paymentDetails['CARD_TYPE']=='CREDIT_CARD'){
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
     * Get Commission  Details for a Payment from Razorpay
     * Get the User Commission for Retailer
     * @param string transaction Table Records
     */




    /**
     * HMAC SHA256 Function
     */
    private  function hmac_sha256($data, $key) {
        return hash_hmac('sha256', $data, $key);
    }





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
        //dd( $paymentTypeList);
        $paymentTypeKeys = array_keys($paymentTypeList);
        if(!empty($transactionRow)){
            if($transactionRow['method'] == 'CREDIT_CARD'){
                $paymentMethodType = 'CREDIT_CARD';
            }elseif($transactionRow['method'] == 'EMI'){
                $paymentMethodType = 'CREDIT_CARD';
            }elseif($transactionRow['method'] == 'DEBIT_CARD'){
                $paymentMethodType = 'DEBIT_CARD';
            }else{
                $paymentMethodType = 'CREDIT_CARD';
            }
        }else{
            $paymentMethodType = 'CREDIT_CARD';
        }
        return $paymentMethodType;
    }














}