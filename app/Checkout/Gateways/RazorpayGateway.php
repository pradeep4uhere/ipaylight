<?php namespace App\Checkout\Gateways;
use App\Checkout\PaymentGateWayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestNew;
use App\Models\Gateway;
use App\Models\Transaction;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Facades\Agent;
use Razorpay\Api\Api;




/**
 * Created by Pradeep Kumar.
 * User: Pradeep
 * Date:01/01/24
 * Time: 08:37
 */

 class RazorpayGateway implements  PaymentGateWayInterface  {
 
    
     
     /**
     * Get Configuration For Payment Gateway 
     * Arrage Data for Checkout for payment Gateway
     */
    public function getGatewayConfigurtionMode($gateway_id){
        $gatewayDetails =  Gateway::find($gateway_id);
        if($gatewayDetails['mode']=='Prod'){
            return 'Sandbox';
        }else{
            return 'Production';
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
        $orderDetails = $this->createOrderDetails($request);
        //dd($orderDetails);
        //dd($request);
        //save Transaction Initiation Records into Database Table
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
            // Assuming you have the necessary data to create a transaction
            $transactionData = [
                'user_id' => $request->get('user_id'),
                'gateway_id' => $request->get('gateway_id'),
                'amount' => $request->get('amount'),
                'customer_name' => $request->get('name'),
                'customer_email' => $request->get('email'),
                'customer_mobile' => $request->get('mobile'),
                'txn_id' => 'pay_'.generateRandomAlphabetString(15),
                'rate_fee' => '0.00',
                'payment_type'=>$paymentType,
                'status' => 'created',
                'description'=>$request->get('description'),
                'order_id' => $orderDetailsArr['id'],
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
    private function createOrderDetails($request){
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
        $url = 'https://api.razorpay.com/v1/orders';
        // Set the request payload data
        $data = [
            'amount' =>  $amount*100,
            'currency' => 'INR',
            'receipt' => 'qwsaq1',
            'partial_payment' => false,
            'first_payment_min_amount' => $amount*100
        ];
        // Encode the data as JSON
        $jsonData = json_encode($data);
        // Initialize curl session
        $ch = curl_init();
        // Set curl options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'content-type:application/json',
            'Authorization: Basic ' . base64_encode("$keyId:$keySecret")
        ]);

        // Execute curl request
        $response = curl_exec($ch);

        // Check for curl errors
        if(curl_error($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            // Print the response
            $result = ['status'=>true, 'key_id'=>$key_id, 'response'=>$response,'module'=>'RZ'];
            return $result;
        }

        // Close curl session
        curl_close($ch);
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
           if(!empty($transactionDetails)){
                $gateway_id = $transactionDetails['gateway_id'];
                $gatewayDetails = Gateway::find($gateway_id);
                //dd($request->all());
                $razorpay_payment_id = $request->get('razorpay_payment_id');
                $razorpay_order_id = $request->get('razorpay_order_id');
                $razorpay_signature = $request->get('razorpay_signature');
                $key_id = $gatewayDetails['pg_client_key'];
                $secret = $gatewayDetails['pg_seceret_key'];
                //echo $key_id.'--'.$secret; die;
                $api = new Api($key_id, $secret);
                $generated_signature = $this->hmac_sha256($razorpay_order_id . "|" . $razorpay_payment_id, $secret);
                if ($generated_signature == $razorpay_signature) {
                    $paymentDetails = $api->payment->fetch($razorpay_payment_id);
                    $transactionTable = $this->updateTransactionTable($paymentDetails, $transaction_id);
                    return array('status'=>true, 'transactionTable'=>$transactionTable, 'message'=>'Transaction Found.');
                }else{
                    return array('status'=>false, 'transactionTable'=>[],'message'=>'Transaction Not Found due to Signature Mismatch');
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
        $transactionObj = Transaction::find($transactionId);
        if($paymentDetails->method=='card'){
            $cardDetails = json_encode($paymentDetails->card->toArray());
        }else{
            $cardDetails = "";
        }
        //dd( $transactionObj);
        //dd($paymentDetails->card->toArray());
        //Update the Transaction Table
        $paymentMethod = $this->getPaymentTypeMethod($paymentDetails);
        if($paymentMethod!=''){ $method_name = $paymentMethod; }else{ $method_name = 'CREDIT_CARD';};
        $updateData = [
                        "entity"=>"",
                        "gateway_payment_id" => $paymentDetails->id,
                        "payment_ref_key" => $paymentDetails->id,
                        "rate_fee" => "0.00",
                        "deposite_amount" => "0.00",
                        "status" => "created",
                        "method" => $method_name,
                        "payment_mode" => null,
                        "amount_refunded" => "0.00",
                        "refund_status" => null,
                        "captured" => null,
                        "description" => $paymentDetails->description,
                        "link_text" => null,
                        "card_id" => $paymentDetails->card_id,
                        "card" => $cardDetails,
                        "bank" => null,
                        "wallet" => null,
                        "vpa" => null,
                        "fee" => $paymentDetails->fee,
                        "tax" => $paymentDetails->tax,
                        "error_code" => null,
                        "error_description" => null,
                        "error_source" => null,
                        "error_step" => null,
                        "error_reason" => null,
                        "notes" => json_encode($paymentDetails->notes->toArray()),
                        "created_date" => date("Y-m-d h:i:s", $paymentDetails->created_at),
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