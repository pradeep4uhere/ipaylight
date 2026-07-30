<?php namespace App\Checkout\Gateways;
use App\Checkout\PaymentGateWayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestNew;
use App\Models\Gateway;
use App\Models\Transaction;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Facades\Agent;
use PhonePe\Configuration;
use PhonePe\Exceptions\PhonePeException;
use PhonePe\PhonePe;
use PhonePe\Requests\Transaction\InitiateRefundRequest;
use PhonePe\PhonePePaymentClient;
use Config;

/**
 * Created by Pradeep Kumar.
 * User: Pradeep
 * Date:01/01/24
 * Time: 08:37
 */

 class PhonePeGateway implements  PaymentGateWayInterface  {
 
    

    private function getGlobalConfig($gateway_id){
        $paymentMode = 'Test';
        $phonePeGlobalArr = Config::get('global.GATWAYS_URL.PHONEPE');
        $gatewaydsDetails = Gateway::find($gateway_id);
        if($gatewaydsDetails['mode']=='Prod'){
            $paymentMode = 'Prod';
            $apiUrl  = $phonePeGlobalArr['PROD_API_ENDPOINT'];
            $merchantIdFromConfig = $phonePeGlobalArr['PROD_MERCHANT_ID'];
        }else{
            $paymentMode = 'Test';
            $apiUrl = $phonePeGlobalArr['TEST_API_ENDPOINT'];
            $merchantIdFromConfig = $phonePeGlobalArr['TEST_MERCHANT_ID'];
        }
        // Replace these with your actual PhonePe API credentials
        $apiUrl = $apiUrl;
        $merchantId = $merchantIdFromConfig;
        return [$paymentMode, $apiUrl, $merchantId];
    }
     
    /**
    * Get Configuration For Payment Gateway 
    * Arrage Data for Checkout for payment Gateway
    */
   public function getGatewayConfigurtionMode($gateway_id){
       $gatewayDetails =  Gateway::find($gateway_id);
       if($gatewayDetails['mode']=='Prod'){
           return 'Production';
       }else{
           return 'Sandbox';
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
    * PreProcess For Payment Gateway 
    * Arrage Data for Checkout for payment Gateway
    */
   public function process(Request $request){
    //dd($request->all());
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
           // Assuming you have the necessary data to create a transaction
           $transactionData = [
               'user_id' => $request->get('user_id'),
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
               'order_id' => "order_".generateRandomAlphabetString(10),
               'ip_address'=>$ipAddress,
               'user_browser'=>$browser,
               'link_text'=>$request->get('urlText'),
               'userAgent'=>$device,
               'location'=>json_encode(isset($location)?$location:null)
               // Add other fields as needed
           ];
           // Create a new transaction record
           $transaction = Transaction::create($transactionData);
           //dd($transaction);
           if($transaction->id > 0 ){
               $orderDetails = $this->createOrderDetails($transactionData);
               
               return ['status'=>true, 'transaction_id'=>$transaction->id, 'key_id'=>'1','orderDetails'=>$orderDetails];
           }else{
               $result = ['status'=>false, 'transaction_id'=>null, 'orderDetails'=>[]];
               return  $result;
           }
       }else{
           $result = ['status'=>false, 'transaction_id'=>null, 'orderDetails'=>null];
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
   private function createOrderDetails($transactionData){
       //dd($transactionData);
       $amount       = $transactionData['amount'];
       $name         = $transactionData['customer_name'];
       $email        = $transactionData['customer_email'];
       $mobile       = $transactionData['customer_mobile'];
       $descriptions = $transactionData['description'];
       $payemnt_type = $transactionData['payment_type'];
       $urlText      = $transactionData['link_text'];
       $user_id      = $transactionData['user_id'];
       $gateway_id   = $transactionData['gateway_id'];
       //Get Gateway Configuration
       $gatewaydsDetails = Gateway::find($gateway_id);
       //dd($gatewaydsDetails);
       $key_index = $gatewaydsDetails['pg_client_key'];
       $secret = $gatewaydsDetails['pg_seceret_key'];
       // Set your PhonePe API key and secret
       $keyId  = $key_index; 
       $keySecret = $secret;  
       // Set the API endpoint URL
       $phonePeGlobalArr = Config::get('global.GATWAYS_URL.PHONEPE');
       //dd($phonePeGlobalArr);
       if($gatewaydsDetails['mode'] === 'Prod'){
           $apiUrl  = $phonePeGlobalArr['PROD_API_ENDPOINT'];
           $merchantIdFromConfig = $phonePeGlobalArr['PROD_MERCHANT_ID'];
       }else{
           $apiUrl = $phonePeGlobalArr['TEST_API_ENDPOINT'];
           $merchantIdFromConfig = $phonePeGlobalArr['TEST_MERCHANT_ID'];
       }
       //dd($merchantIdFromConfig);
    //dd($apiUrl);
       // Replace these with your actual PhonePe API credentials
       $apiKey = $keySecret;
       $merchantId = $merchantIdFromConfig;
       $redirectUrl = route('payemnt_return_url');
           
        // Set transaction details
        //dd($transactionData);
        $order_id = $transactionData['txn_id'];
        $CUSTOMER_UNIQUE_ID = $transactionData['user_id'];
        $name="Payment Solutions";
        $description = 'Payment for Payment Service';

       
         $url = $apiUrl.'pay'; 
        // Set the request payload data
        // Prepare the payment request data (you should customize this)
        $paymentData = array(
            'merchantId' => $merchantId,
            'merchantTransactionId' => $order_id,
            "merchantUserId"=>$CUSTOMER_UNIQUE_ID,
            'amount' => $amount*100, // Amount in paisa (10 INR)
            'redirectUrl'=>$redirectUrl,
            'redirectMode'=>"POST",
            'callbackUrl'=>route('payemnt_return_url'),
            "merchantOrderId"=> $order_id,
            "mobileNumber"=>$mobile,
            "message"=>$description,
            "email"=>$email,
            "param1"=>$order_id,
            "shortName"=>$name,
            "paymentInstrument"=> array(    
            "type"=> "PAY_PAGE",
        )
        );
       //dd( $paymentData);

        $jsonencode = json_encode($paymentData);
        $payloadMain = base64_encode($jsonencode);

        $salt_index = $keyId; //key index 1
        $payload = $payloadMain . "/pg/v1/pay" . $apiKey; 
        $sha256 = hash("sha256", $payload);
        $final_x_header = $sha256 . '###' . $salt_index; 
        $requestStr = json_encode(array('request'=>$payloadMain));


        // Set headers for the request
        $headers = [
            'Content-Type: application/json',
            'X-VERIFY: ' . $final_x_header,
        ];

        // Define PhonePe API URL
        $phonePayUrl = $url; // For Development 
        //$phonePayUrl = 'https://api.phonepe.com/apis/hermes/pg/v1/pay'; // For Production
        //dd($phonePayUrl);
        // Prepare data for the request
        $data = [
            'request' => $payloadMain,
        ];


        // Set options for the HTTP request
        $options = [
            'http' => [
                'method' => 'POST',
                'content' => json_encode($data),
                'header' => implode("\r\n", $headers),
            ],
        ];
        //dd($options);
        // Create a stream context
        $context = stream_context_create($options);

          // Make the request to PhonePe API
       // $response = @file_get_contents($phonePayUrl, false, $context);
        //dd($response);
        $maxRetries = 3;
        $retryDelay = 1; // in seconds
        $retryCount = 0;

        // Make the request to PhonePe API
       
        do {
            $response = @file_get_contents($phonePayUrl, false, $context);
            //dd($response);
            if ($response === false) {
                // Request failed, check if it's a 429 error
                $httpResponseHeaders = $http_response_header;
                if (strpos($httpResponseHeaders[0], '429') !== false) {
                    // 429 Too Many Requests, retry after delay
                    sleep($retryDelay);
                    $retryCount++;
                } else {
                    // Handle other errors
                    echo "Error: Failed to fetch data from the API.";
                    break;
                }
            } else {
                if($response!=null){
                    $result = json_decode($response,true);
                    if($result['success']==true){
                        $result = ['status'=>true, 'key_id'=>'', 'response'=>$response,'module'=>'PP'];
                        return $result;
                    }else{
                        return ['status'=>false, 'key_id'=>'', 'response'=>$response,'module'=>'PP'];
                    }
                }
                // Request succeeded, process response
                //echo "API response: " . $response;
                break;
            }
        } while ($retryCount < $maxRetries);

        //dd($response);
        if($response==false){
            return ['status'=>false, 'key_id'=>"", 'response'=>"No response from payment gateway",'module'=>'PP'];
        }else{
            // Decode the response
            $result = json_decode($response, true);

            // Extract the redirect URL for payment
            $redirectUrl = $result['data']['instrumentResponse']['redirectInfo']['url'];

            // Redirect the user to PhonePe for payment
            header("Location: $redirectUrl");
        }
        //https://www.imdos.in/blog/phonepe-payment-gateway-in-php

       
   }




   /**
    * Payment Return Status
    * Check the Payment Status after Payment Done by the user
    * @param Request $request
    * 
    */
   public function  paymentReturnStatus($request){
       //$transaction_id = \Crypt::decryptString($request->get('ltid'));
       $transaction_id =  $request->get('transactionId');
       if($transaction_id!=''){
        
          $transactionDetails = Transaction::with('Gateway')->where('txn_id',$transaction_id)->first();
          if(!empty($transactionDetails)){
               $gateway_id = $transactionDetails['gateway_id'];
               $gatewayDetails = Gateway::find($gateway_id);
               $key_id = $gatewayDetails['pg_client_key'];
               $secret = $gatewayDetails['pg_seceret_key'];

               $transactionId = $request->get('transactionId');
               $providerReferenceId = $request->get('providerReferenceId');
               $checksum = $request->get('checksum');
               list($paymentMode, $apiUrl, $merchantId) = $this->getGlobalConfig($gateway_id);
                // Define PhonePe gateway information
                $gateway = (object) [
                    'token' => $merchantId,
                    'secret_key' => $secret,
                ];
                //dd($gateway);
                // Extract transaction ID from POST data
                $orderId = $transactionId;

                // Construct X-VERIFY header for status check
                $encodeIn265 = hash('sha256', '/pg/v1/status/' . $gateway->token . '/' . $orderId . $gateway->secret_key) . '###1';

                // Set headers for the status check request
                // $headers = [
                //     'http' => [
                //         'method' => 'GET',
                //         'header' => 'Content-Type: application/json' . "\r\n" .
                //                     'X-MERCHANT-ID: ' . $gateway->token . "\r\n" .
                //                     'X-VERIFY: ' . $encodeIn265 . "\r\n" .
                //                     'Accept: application/json'
                //     ]
                // ];

                $headers = [
                    'Content-Type: application/json',
                    'X-MERCHANT-ID: ' . $gateway->token,
                    'X-VERIFY: ' . $encodeIn265,
                    'Accept: application/json',
                ];
                // Define PhonePe status check URL
                $phonePeStatusUrl = $apiUrl . 'status/' . $gateway->token . '/' . $orderId; // For Development
                // $phonePeStatusUrl = 'https://api.phonepe.com/apis/hermes/pg/v1/status/' . $gateway->token . '/' . $orderId; // For Production

                // Initialize stream context for file_get_contents
                //$context = stream_context_create($headers);

                // Make the status check request using file_get_contents
                //$response = file_get_contents($phonePeStatusUrl, false, $context);

                // Decode the status check response
                //$api_response = json_decode($response);
                //dd($api_response);

                // Initialize cURL for status check
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $phonePeStatusUrl);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $response = curl_exec($ch);
                curl_close($ch);

                // Decode the status check response
                $api_response = json_decode($response);
                //dd($api_response);
                if($api_response!=null){
                    // Check if the payment was successful
                    if ($api_response->code == "PAYMENT_SUCCESS") {
                        $paymentDetails = $api_response;
                        
                        $transactionTable = $this->updateTransactionTable($paymentDetails, $transactionDetails['id']);
                        return array('status'=>true, 'transactionTable'=>$transactionTable, 'message'=>'Transaction Found.');
                    } else {
                        // Handle failed transactions
                        return array('status'=>false, 'transactionTable'=>$transactionDetails,'message'=>'Transaction Response Not Found.');
                    }
                }else{
                    // Handle failed transactions
                    return array('status'=>false, 'transactionTable'=>$transactionDetails,'message'=>'Transaction Response Not Found.');
                }
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
       //dd($transactionId);
       //dd($paymentDetails);
       $transactionObj = Transaction::find($transactionId);
       if($paymentDetails->data->paymentInstrument->type=='CARD'){
           $cardDetailsArr = (array)$paymentDetails->data->paymentInstrument;
           $cardDetails = json_encode($cardDetailsArr);
           if($paymentDetails->data->paymentInstrument->cardType=='CREDIT_CARD'){
                $method = 'CREDIT_CARD';
           }else{
             $method = 'CREDIT_CARD';
           }
           //dd($cardDetails);
       }else if($paymentDetails->data->paymentInstrument->type=='UPI'){
           
           $cardDetailsArr = (array)$paymentDetails->data->paymentInstrument;
           $cardDetailsArr['pgTransactionId'] = $paymentDetails->data->paymentInstrument->utr;
           $cardDetailsArr['bankTransactionId'] = $paymentDetails->data->paymentInstrument->utr;
           $cardDetailsArr['bankId'] = $paymentDetails->data->paymentInstrument->cardNetwork;
           
           $cardDetails = json_encode($cardDetailsArr);
          
            $method = 'UPI';
           //dd($cardDetails);
       }else{
           $cardDetailsArr = (array)$paymentDetails->data->paymentInstrument;
           $cardDetails = json_encode($cardDetailsArr);
           $method = 'CREDIT_CARD';
       }
       //dd($cardDetailsArr['pgTransactionId']);
       //dd($paymentDetails->card->toArray());
       //Update the Transaction Table
       if($paymentDetails->code == 'PAYMENT_SUCCESS'){
            $status = 'Success';
            $captured = true;
       }else{
            $status = 'Pending';
            $captured = false;
       }
       
       
       $description = $paymentDetails->message;
       $updateData = [
                       "entity"=>"",
                       "gateway_payment_id" => $paymentDetails->data->transactionId,
                       "payment_ref_key" => $cardDetailsArr['pgTransactionId'],
                       "rate_fee" => "0.00",
                       "deposite_amount" => "0.00",
                       "status" => $status,
                       "method" => $method,
                       "payment_mode" => null,
                       "amount_refunded" => "0.00",
                       "refund_status" => null,
                       "captured" => $captured,
                       "description" => $description,
                       "link_text" => null,
                       "card_id" => $cardDetailsArr['bankTransactionId'],
                       "card" => $cardDetails,
                       "bank" => $cardDetailsArr['bankId'],
                       "wallet" => null,
                       "vpa" => null,
                       "fee" => '0.00',
                       "tax" => '0.00',
                       "error_code" => null,
                       "error_description" => null,
                       "error_source" => null,
                       "error_step" => null,
                       "error_reason" => null,
                       "notes" => $description,
                       "created_date" => date("Y-m-d h:i:s"),
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
    * New Code added
    */
   public function getCurrentPaymentType($transactionRow){
       //Get All Payment Type Globally  Defined in Helpers/helper.php
       $paymentTypeList = getPaymentTypeList();
       $paymentTypeKeys = array_keys($paymentTypeList);
       $paymentMethodType = 'CREDIT_CARD';
       if(!empty($transactionRow)){
           if($transactionRow['method'] == 'CREDIT_CARD'){
               $cardDetails = json_decode($transactionRow['card'],true);
               if($cardDetails['type']=='CARD'){
                   if($cardDetails['cardType']==('CREDIT_CARD')){
                       $paymentMethodType = 'CREDIT_CARD';
                   }else{
                       $paymentMethodType = 'CREDIT_CARD';
                   }
               }else{
                    $paymentMethodType = 'EMI';
               }
           }elseif($transactionRow['method'] == 'NETBANKING'){
                $paymentMethodType = 'NETBANKING';
           }elseif($transactionRow['method'] == 'emi'){
               $paymentMethodType = 'CREDIT_CARD';
           }elseif($transactionRow['method'] == 'UPI'){
               $paymentMethodType = 'UPI';
           }else{
               $paymentMethodType = 'CREDIT_CARD';
           }
       }else{
           $paymentMethodType = 'CREDIT_CARD';
       }
       return $paymentMethodType;
   }














}