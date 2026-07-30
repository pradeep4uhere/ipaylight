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

/**
 * Created by Pradeep Kumar.
 * User: Pradeep
 * Date:01/01/24
 * Time: 08:37
 */

 class CashfreeGateway implements  PaymentGateWayInterface  {
  
  

     
     
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
        //dd($gatewaydsDetails );
        $key_id = $gatewaydsDetails['pg_client_key'];
        $secret = $gatewaydsDetails['pg_seceret_key'];
        // Set your Razorpay API key and secret
        $keyId  = $key_id;
        $keySecret = $secret;
        // Set the API endpoint URL
        $cashfreeGlobalArr = Config::get('global.GATWAYS_URL.CASHFREE');
        if(env('PAYMENT_MODE')=='Prod'){
            $apiUrl = $cashfreeGlobalArr['PROD_API_ENDPOINT'].'/orders';
        }else{
            $apiUrl = $cashfreeGlobalArr['TEST_API_ENDPOINT'].'/orders';
        }
        //dd($last_transaction_id);
        $returnUrl = 'payemnt_status?ltid='.encryptString($last_transaction_id).'&uid='.encryptString($user_id).'&gateway=Cashfree';
            // Data to be sent in the request body
            //List of payment modes. 
            //Use the following values - cc, dc, ccc, ppc, nb, upi, paypal, emi, app paylater.
        $data = [
            'order_amount' => $amount,
            'order_currency' => 'INR',
            'customer_details' => [
                'customer_id' => $user_id,
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => '+91'.$mobile
            ],
            'order_note' => '',
            'order_meta' => [
                'return_url' => url($returnUrl),
                'payment_methods'=>null
                //'notify_url' => url($returnUrl)
            ]
        ];
        //dd($data);
        // Headers for the request
        $headers = [
            'X-Client-Secret: '.$keySecret.'',
            'X-Client-Id: '.$keyId.'',
            'x-api-version: 2023-08-01',
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        //dd($headers);

        // Encode the data as JSON
        $jsonData = json_encode($data);
        // Initialize curl session
        $ch = curl_init();
        // Set curl options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Execute curl request
        $response = curl_exec($ch);
        //dd( $response);
        // Check for curl errors
        if(curl_error($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            // Print the response
            $result = ['status'=>true, 'key_id'=>$key_id, 'response'=>$response,'module'=>'CF'];
            return $result;
        }
        // Close curl session
        curl_close($ch);
        
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
            $orderDetails = $this->createOrderDetails($request,$nextId);
            //dd($orderDetails);
            if($orderDetails){
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
                //dd($orderDetailsArr);
                // Assuming you have the necessary data to create a transaction
                $transactionData = [
                    'user_id' => $request->get('user_id'),
                    'entity'=>$orderDetailsArr['entity'],
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
                    'order_id' => $orderDetailsArr['order_id'],
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
            // Handle the exception
            // For example: Log the error, display a message to the user, etc.
        }
        //dd($orderDetails);
        /*
        {
            "cart_details":null,
            "cf_order_id":"2181657636",
            "created_at":"2024-04-09T00:56:09+05:30",
            "customer_details":{
                "customer_id":"2",
                "customer_name":"Pradeep Kumar",
                "customer_email":"admin@gmail.com",
                "customer_phone":"+919898989898",
                "customer_uid":null
            },
            "entity":"order",
            "order_amount":5000.00,
            "order_currency":"INR",
            "order_expiry_time":"2024-05-09T00:56:09+05:30",
            "order_id":"order_100598052epbGJnBqxkDItzrpht6yJUpuQb",
            "order_meta":{"return_url":"http://127.0.0.1:8000/payemnt_status",
            "notify_url":null,
            "payment_methods":null},
            "order_note":null,
            "order_splits":[],
            "order_status":"ACTIVE",
            "order_tags":null,
            "payment_session_id":"session_CB9oatvL89eHLbxun45aZIRtZFYcxw2gPuniL45zKpfHP_NREwUajRxAVho22qd0u1MaV1y8s14SqXv-fulIqgbk3G-kvRZxkY1uy7z3Ge71",
            "terminal_data":null
        }
        */
        //save Transaction Initiation Records into Database Table
        
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
        $transaction_id = \Crypt::decryptString($request->get('ltid'));
        if($transaction_id > 0){
           $transactionDetails = Transaction::with('Gateway')->find($transaction_id);
           $orderId = $transactionDetails->order_id;
           
           if(!empty($transactionDetails)){
                $response = $this->getOrderDetails($transactionDetails);
                //dd($response);
                $responseArr = json_decode($response,true);
                if(is_array(($responseArr))){
                    $paymentDetails = $responseArr[0];
                    $transactionTable = $this->updateTransactionTable($paymentDetails, $transaction_id);
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
       
        $transactionObj = Transaction::find($transactionId);
        if($paymentDetails['is_captured'] === true){
            $cardDetails = json_encode($paymentDetails['payment_method']['card']);
            $updateData = [
                            "entity"=>"",
                            "gateway_payment_id" => $paymentDetails['cf_payment_id'],
                            "payment_ref_key" => $paymentDetails['bank_reference'],
                            "rate_fee" => "0.00",
                            "deposite_amount" => "0.00",
                            "status" => ucfirst(strtolower($paymentDetails['payment_status'])),
                            "captured"=>true,
                            "method" => $paymentDetails['payment_group'],
                            "payment_mode" => $paymentDetails['payment_group'],
                            "amount_refunded" => "0.00",
                            "refund_status" => null,
                            "captured" => null,
                            "link_text" => null,
                            "card_id" => $paymentDetails['payment_method']['card']['card_number'],
                            "card" => $cardDetails,
                            "bank" => $paymentDetails['payment_method']['card']['card_bank_name'],
                            "wallet" => null,
                            "vpa" => null,
                            "fee" => '0.00',
                            "tax" => '0.00',
                            "error_code" => null,
                            "error_description" => null,
                            "error_source" => null,
                            "error_step" => null,
                            "error_reason" => null,
                            "notes" => null,
                            "more_details"=>json_encode($paymentDetails),
                            "created_date" => date("Y-m-d h:i:s", strtotime($paymentDetails['payment_time'])),
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
        }elseif($paymentDetails['is_captured'] === false){
            if(array_key_exists('error_details',$paymentDetails)){
                if(!empty($paymentDetails['error_details'])){
                    $error_description = $paymentDetails['error_details']['error_description_raw'];
                    $error_code_raw = $paymentDetails['error_details']['error_code_raw'];
                    $error_source = $paymentDetails['error_details']['error_source'];
                    $error_code = $paymentDetails['error_details']['error_code'];
                    if($error_code==59){
                        $payment_status = 'Decline';
                    }else{
                        $payment_status = 'Failed';
                    }
                }else{
                    if($paymentDetails['payment_status']=='PENDING'){
                        $error_description="";
                        $error_code_raw ="";
                        $error_source ="";
                        $payment_status = 'Pending';
                    }
                }
            }else{
                $error_description="";
                $error_code_raw ="";
                $error_source ="";
                $payment_status = 'Failed';
            }
            $cardDetails = json_encode($paymentDetails['payment_method']['card']);
            $updateData = [
                            "entity"=>"",
                            "gateway_payment_id" => $paymentDetails['cf_payment_id'],
                            "payment_ref_key" => $paymentDetails['bank_reference'],
                            "rate_fee" => "0.00",
                            "deposite_amount" => "0.00",
                            "status" => $payment_status,
                            "captured"=>false,
                            "method" => $paymentDetails['payment_group'],
                            "payment_mode" => $paymentDetails['payment_group'],
                            "amount_refunded" => "0.00",
                            "refund_status" => null,
                            "captured" => null,
                            "link_text" => null,
                            "card_id" => $paymentDetails['payment_method']['card']['card_number'],
                            "card" => $cardDetails,
                            "bank" => $paymentDetails['payment_method']['card']['card_bank_name'],
                            "wallet" => null,
                            "vpa" => null,
                            "fee" => '0.00',
                            "tax" => '0.00',
                            "error_code" => $error_code_raw,
                            "error_description" => $error_description,
                            "error_source" => $error_source,
                            "error_step" => null,
                            "error_reason" => null,
                            "notes" => null,
                            "more_details"=>json_encode($paymentDetails),
                            "created_date" => date("Y-m-d h:i:s", strtotime($paymentDetails['payment_time']))
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
     * Get Order Details  and Update in Transactions Table
     * @param Order_id  
     * @return PaymentDetails in array
     */

    private function getOrderDetails($transactionDetails) {

            //Get Gateway Configuration
            $gateway_id = $transactionDetails->gateway_id;
            $orderId = $transactionDetails->order_id;
            $gatewaydsDetails = Gateway::find($gateway_id);
            //dd($gatewaydsDetails );
            $key_id = $gatewaydsDetails['pg_client_key'];
            $secret = $gatewaydsDetails['pg_seceret_key'];
            // Set your Razorpay API key and secret
            $keyId  = $key_id;
            $keySecret = $secret;
            // Set the API endpoint URL
            $cashfreeGlobalArr = Config::get('global.GATWAYS_URL.CASHFREE');
            if(env('PAYMENT_MODE')=='Prod'){
                $apiUrl = $cashfreeGlobalArr['PROD_API_ENDPOINT'].'/orders/';
            }else{
                $apiUrl = $cashfreeGlobalArr['TEST_API_ENDPOINT'].'/orders/';
            }
            $url = $apiUrl . $orderId.'/payments';

          
              // Headers for the request
            $headers = [
                'X-Client-Secret: '.$keySecret.'',
                'X-Client-Id: '.$keyId.'',
                'x-api-version: 2023-08-01',
                'Content-Type: application/json',
                'Accept: application/json'
            ];

            // Initialize cURL session
            $ch = curl_init($url);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Execute cURL session
            $response = curl_exec($ch);

            // Check for errors
            if (curl_errno($ch)) {
                return 'Error: ' . curl_error($ch);
            }

            // Close cURL session
            curl_close($ch);

            // Return the response
            return $response;
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
            }else{
                $paymentMethodType = 'CREDIT_CARD';
            }
        }else{
            $paymentMethodType = 'CREDIT_CARD';
        }
        return $paymentMethodType;
    }


}