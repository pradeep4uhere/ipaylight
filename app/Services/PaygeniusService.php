<?php 
namespace App\Services;

use GuzzleHttp\Client;
use App\Models\BeneficiaryAccount;
use Log;
use App\Models\Gateway;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Facades\Agent;
use Config;
use Illuminate\Support\Facades\DB;
use Cache;


class PaygeniusService
{
    protected $client;

    protected $tokenBarear;

    private $baseUrl;

    private $key;

    private $secert;

    private $client_id;

    private $tokenUrl;

    private $payoutUrl;

    private $payoutStatusUrl;

    private $walletBalanceUrl;



    public function __construct()
    {
        $this->client = new Client();
        $this->initializeBaseUrl();
    }



    /**
     * Get Global URL for APIs
     */
    private function getGlobalConfig(){
        $paymentMode = 'Test';
        $pgGlobalArr = Config::get('global.GATWAYS_URL.PAYGENIUS');
        $gatewaydsDetails = Gateway::where('gateway_name', 'PAYGENIUS')->first();
        if($gatewaydsDetails['mode']=='Prod'){
            $paymentMode = 'Prod';
            $client_id = $pgGlobalArr['PROD']['CLIENT_ID'];
            $tokenApiUrl  = $pgGlobalArr['PROD']['TOKEN'];
            $payoutApiUrl  = $pgGlobalArr['PROD']['PAYOUT'];
            $payoutStatusApiUrl  = $pgGlobalArr['PROD']['PAYOUT_STATUS'];
            $walletBalanceApiUrl  = $pgGlobalArr['PROD']['WALLET_BALANCE'];
            $merchantIdFromConfig = $gatewaydsDetails;
        }else{
            $paymentMode = 'Test';
            $client_id = $pgGlobalArr['UAT']['CLIENT_ID'];
            $tokenApiUrl  = $pgGlobalArr['UAT']['TOKEN'];
            $payoutApiUrl  = $pgGlobalArr['UAT']['PAYOUT'];
            $payoutStatusApiUrl  = $pgGlobalArr['UAT']['PAYOUT_STATUS'];
            $walletBalanceApiUrl  = $pgGlobalArr['UAT']['WALLET_BALANCE'];
            $merchantIdFromConfig = $gatewaydsDetails;
        }
        return [$client_id, $paymentMode, $tokenApiUrl, $payoutApiUrl, $payoutStatusApiUrl, $walletBalanceApiUrl, $merchantIdFromConfig];
    }




    /**
     * Method Name: initializeBaseUrl()
     * This Method used for getting base url
     * of the Cashfree API URL based on Test and Production Mode
     */
    private function initializeBaseUrl()
    {
        list($client_id, $paymentMode, $tokenApiUrl, $payoutApiUrl, $payoutStatusApiUrl, $walletBalanceApiUrl, $merchantIdFromConfig) = $this->getGlobalConfig();
        $this->payoutUrl = $payoutApiUrl;
        $this->payoutStatusUrl = $payoutStatusApiUrl;
        $this->walletBalanceUrl = $walletBalanceApiUrl;
        $this->tokenUrl = $tokenApiUrl;
        $this->key = $merchantIdFromConfig['pg_client_key'];
        $this->secert = $merchantIdFromConfig['pg_seceret_key'];
        $this->client_id = $client_id;
    }



     /**
     * Method Name: getBaseUrl()
     * This Method used for getting base url
     * of the Cashfree API URL based on Test and Production Mode
     */
    private function getBaseUrl()
    {
        return $this->baseUrl;
    }




     /**
     * Method Name: getAuthorizeUrl()
     * This Method used for getting base url
     * of the Cashfree API URL based on Test and Production Mode
     */
    private function getAuthorizeUrl()
    {
        return $this->tokenUrl;
    }


     /**
     * Method Name: authorizeToken()
     * This Method used for getting Token From Server
     * @return Bearer Token as string
     */
    private function authorizeToken(){
         // Check if token is cached
         $cachedToken = Cache::get('paygenius_token');
         if ($cachedToken) {
             $this->tokenBearer = $cachedToken;
             return ['status' => true, 'token' => $this->tokenBearer];
         }
        try{
            //dd($this->getAuthorizeUrl());
            //dd($this->client_id);
            //dd($this->secert);
            //echo $this->secert; die;
            
            
            $response = $this->client->request('POST', $this->getAuthorizeUrl(), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'client_id' => $this->client_id,
                    'username' => $this->key,
                    'password'=> $this->secert
                ],
            ]);
            $authorizeTokenResultArray =  json_decode($response->getBody(), true);
            //dd($authorizeTokenResultArray);
            if ($authorizeTokenResultArray['status'] === 'SUCCESS' && $authorizeTokenResultArray['code'] == 'RP000') {
                $token = $authorizeTokenResultArray['data']['token'];
                $expiry = $authorizeTokenResultArray['data']['expiry'];
                $this->tokenBearer = $token;
                // Cache the token
                Cache::put('paygenius_token', $token, $expiry); // Cache for 55 minutes
                return ['status' => true, 'token' => $this->tokenBearer];
            } else {
                $message = $authorizeTokenResultArray['message'] ?? 'Authorization failed, Token not generated';
                return ['status' => false, 'message' => $message];
            }
        } catch (\Exception $e) {
            Log::error('Authorization error: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Authorization error. Please try again later.'];
        }
    }




    /**
     * Method Name::  postAPIAction()
     * this method call for API with Post Data
     * @param Array
     * @return Array
     */
    private function postAPIAction($postData,$type){
        if (!$this->tokenBearer) {
            $authResult = $this->authorizeToken();
            if (!$authResult['status']) {
                return $authResult;
            }
        }
        try {
            $response = $this->client->request('POST', $this->getBaseUrl() . $type, [
                'body' => json_encode($postData),
                'headers' => [
                    'Authorization' => $this->tokenBearer,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);

            $result = json_decode($response->getBody(), true);
           

            if ($result['status'] === 'SUCCESS' && $result['subCode'] == 200) {
                return ['status' => true, 'message' => $result['message']];
            } else {
                $message = $result['message'] ?? 'Request failed';
                return ['status' => false, 'message' => $message];
            }
        } catch (\Exception $e) {
            Log::error('API post error: ' . $e->getMessage());
            return ['status' => false, 'message' => 'API request error. Please try again later.'];
        }
    }



     /**
     * Method Name::  getAPIAction()
     * this method call for API with Post Data
     * @param Array
     * @return Array
     */
    private function getAPIAction($type){
        if (!$this->tokenBearer) {
            $authResult = $this->authorizeToken();
            if (!$authResult['status']) {
                return $authResult;
            }
        }
        try {
            if($type=='getBalance'){ $getUrl = $this->walletBalanceUrl; }
            if($type=='status'){ $getUrl = $this->payoutStatusUrl; }
            $response = $this->client->request('GET', $getUrl , [
                'headers' => [
                    'client_id' => $this->client_id,
                    'token' => $this->tokenBearer,
                    'accept' => 'application/json'
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            if ($result['status'] === 'Success' && $result['code'] == 'RP000') {
                return ['status' => true, 'message' => $result['message'], 'data'=>$result['balance']];
            } else {
                $message = $result['message'] ?? 'Request failed';
                return ['status' => false, 'message' => $message];
            }
        } catch (\Exception $e) {
            Log::error('API post error: ' . $e->getMessage());
            return ['status' => false, 'message' => 'API request error. Please try again later.'];
        }
    }



    /**
     * Method Name: Get Balance of Virtual Account From Server
     * This method will help to get the actual balance from server
     * based on this balance, we will procced further action of
     * transfers, else we will return to previous action.
     */
    private function getVirtualAccountBalance(){
        $authorizeTokenResultArray =  $this->authorizeToken();
        //dd($authorizeTokenResultArray);
        if($authorizeTokenResultArray['status']){
            $result = $this->getAPIAction('getBalance');
            if($result['status']){
                return ['status'=>true, 'message'=>$result['message'], 'data'=>$result['data']];
            }else{
                return ['status'=>false, 'message'=>$result['message']];
            }
        }else{
            return ['status'=>false, 'message'=>$authorizeTokenResultArray['message']];
        }
    }




    /**
     * Method Name::  postAPIAction()
     * this method call for API with Post Data
     * @param Array
     * @return Array
     */
    private function postAPIActionForTransfer($postData){
        if (!$this->tokenBearer) {
            $authResult = $this->authorizeToken();
            if (!$authResult['status']) {
                return $authResult;
            }
        }
        try {
            $headers = [
                'Content-Type: multipart/form-data',
                'client_id: ' . $this->client_id,
                'token: ' . $this->tokenBearer,
            ];
            $ch = curl_init();
            //dd($this->payoutUrl);
            curl_setopt($ch, CURLOPT_URL, $this->payoutUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 120 seconds timeout
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); // 60 seconds connect timeout
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);
            //dd($result);
            if ($result['status'] === 'ACCEPTED' || $result['status'] === 'SUCCESS') {
                return ['status' => true, 'message' => $result['message'], 'code'=>$result['code']];
            }else{
                $message = $result['message'] ?? 'Request failed';
                return ['status' => false, 'message' => $message, 'code'=>$result['code']];
            }
        } catch (\Exception $e) {
            //dd( $e->getMessage());
            Log::error('API post error: ' . $e->getMessage());
            return ['status' => false, 'message' => 'API request error. Please try again later.'];
        }
    }


    /**
     * Method Name: standardTransferSyncAction()
     * @param transferObject
     * @return array
     * Trnasfer Options requestTransfer, requestAsyncTransfer
     */
    private function standardTransferSyncAction($transferObject){
        return $this->postAPIActionForTransfer($transferObject);
    }




    /**
     * Method Name:  Get Transction Status
     * @param TransactionObject Array
     * $transferObject['referenceId'] and $transferObject['transferId']
     */
    public function getTransferStatus($transferObject){
        $authorizeTokenResultArray =  $this->authorizeToken();
        if($authorizeTokenResultArray['status']){
            //dd($transferObject);
            $postData = [];
            $postData['order_id'] = $transferObject['referenceId'];
            $result  = $this->paymentStatusAPI($postData);
            //dd($result);
            if($result['status']){
                return ['status'=>true, 'message'=>$result['message'], 'data'=>$result['data']];
            }else{
                return ['status'=>false, 'message'=>$result['message']];
            }
        }else{
            return ['status'=>'Error', 'message'=>$authorizeTokenResultArray['message']];
        }
    }
    
    
    
    /**
     * Method Name::  paymentStatusAPI()
     * this method call for API with Post Data
     * @param Array
     * @return Array
     */
    private function paymentStatusAPI($postData){
        //dd($postData);
        if (!$this->tokenBearer) {
            $authResult = $this->authorizeToken();
            if (!$authResult['status']) {
                return $authResult;
            }
        }
        try {
            $headers = [
                'Content-Type: application/json',
                'client_id:' . $this->client_id,
                'token:' . $this->tokenBearer,
            ];
            //dd($this->payoutStatusUrl);
            $postDataa = json_encode($postData);
            //dd($postDataa);
            $ch = curl_init();
            //dd($this->payoutUrl);
            curl_setopt($ch, CURLOPT_URL, $this->payoutStatusUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataa);
            curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 120 seconds timeout
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); // 60 seconds connect timeout
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);
            if (($result['STATUS'] == 'ACCEPTED') ) {
                Log::info("PayoutLog:".json_encode($result));
                return ['status' => true, 'message' => $result['MESSAGE'], 'code'=>$result['CODE'], 'data'=>$result['ORDERSTATUS']];
                
            }else if($result['STATUS'] == 'SUCCESS'){
                Log::info("PayoutLog:".json_encode($result));
                return ['status' => true, 'message' => $result['MESSAGE'], 'code'=>$result['CODE'], 'data'=>$result['ORDERSTATUS']];
                
            }else{
                
                $message = $result['MESSAGE'] ?? 'Request failed';
                return ['status' => false, 'message' => $message, 'code'=>$result['code']];
            }
        } catch (\Exception $e) {
            //dd( $e->getMessage());
            Log::error('API post error: ' . $e->getMessage());
            return ['status' => false, 'message' => 'API request error. Please try again later.'];
        }
    }





  /****************************************************************************************/


    /**
     * Method: Add Beneficiary Account
     */
    public function addBeneficiary($beneficiaryData)
    {
        $authorizeTokenResultArray =  $this->authorizeToken();
        if($authorizeTokenResultArray['status']){
            //Preapre Post Data For Add Benificiery To CashFree Service
            $post_data = [
                'beneId'=>$beneficiaryData['beneficiary_id'],
                'name'=>$beneficiaryData['beneficiary_name'],
                'email'=>$beneficiaryData['beneficiary_email'],
                'phone'=>$beneficiaryData['beneficiary_mobile'],
                'bankAccount'=>$beneficiaryData['beneficiary_account_number'],
                'ifsc'=>$beneficiaryData['beneficiary_ifsc_code'],
                'address1'=>$beneficiaryData['beneficiary_address']
            ];
            $result = $this->postAPIAction($post_data, 'addBeneficiary');
            if($result['status']){
                return ['status'=>true, 'message'=>$result['message']];
            }else{
                return ['status'=>false, 'message'=>$result['message']];
            }
        }else{
            return ['status'=>'Error', 'message'=>$authorizeTokenResultArray['message']];
        }

    }




    /**
     * Method Name: verifyBeneficiary()
     * @param benificiery_id
     */
    public function verifyBeneficiary($beneficiaryId)
    {
        $beneficiaryAccountList = BeneficiaryAccount::With('UserContact')->where('user_id',getAuthValue('id'))
        ->where('id',$beneficiaryId)
        ->first();
        //dd($beneficiaryAccountList);
        if($beneficiaryAccountList){
            $beneficiaryData = [
                'beneficiary_email'=>$beneficiaryAccountList['UserContact']['email'],
                'beneficiary_mobile'=>$beneficiaryAccountList['UserContact']['mobile_number'],
                'beneficiary_address'=>$beneficiaryAccountList['UserContact']['address'],
                'beneficiary_id'=> $beneficiaryAccountList['beneficiary_id'],
                'beneficiary_name'=> $beneficiaryAccountList['beneficiary_name'],
                'beneficiary_account_number'=> $beneficiaryAccountList['account_number'],
                'beneficiary_bank_name'=> $beneficiaryAccountList['bank_name'],
                'beneficiary_ifsc_code'=> $beneficiaryAccountList['ifsc_code'],
            ];
        }
        $result =  $this->addBeneficiary($beneficiaryData);
        if($result['status']=='SUCCESS'){
            $data = [
                'user_id'=>getAuthValue('id'),
                'contact_id'=>$beneficiaryAccountList['UserContact']['id'],
                'beneficiary_account_id'=>$beneficiaryAccountList['id'],
                'payout_name'=>'CF',
                'beneficiary_id'=>$beneficiaryAccountList['beneficiary_id'],
            ];
            return ['status'=>'SUCCESS', 'message'=>'Beneficiary added successfully','data'=>$data];
        }else{
            return ['status'=>'ERROR', 'message'=>$result['message'], 'data'=>[]];
        }
    }



    private function handleInsufficientBalanceError($amount){
        $virtualBalanceResponse = $this->getVirtualAccountBalance();
        //dd($virtualBalanceResponse);
        if($virtualBalanceResponse['status']===true){
            $virtualBalance = $virtualBalanceResponse['data'];
            if($amount > $virtualBalance){
                return ['status'=>'Error', 'message'=>"Insufficient Balance, Please Contact Your System Administrator."];
            }else{
                return true;
            }
        }else{
            return ['status'=>'Error', 'message'=>$virtualBalanceResponse['message']];
        }

    }


    /**
     * Method Name :: processTransfer()
     * This Methods handle the Transfer Money From Wallet to Bankaccount
     */
    public function processTransfer($payloadata){
        if($this->handleInsufficientBalanceError($payloadata['amount'])){
            $authorizeTokenResultArray =  $this->authorizeToken();
            //dd($authorizeTokenResultArray);
            if($authorizeTokenResultArray['status']){
               $beneficiary_id = $payloadata['beneId'];
               $transferMode = $payloadata['transferMode'];
               $amsount = $payloadata['amount'];
               $orderid = $payloadata['transferId'];
               $beneficiaryAccountDetails = BeneficiaryAccount::where('beneficiary_id',$beneficiary_id)->first();
               $beneficiary_name = $beneficiaryAccountDetails['beneficiary_name'];
               $account_number = $beneficiaryAccountDetails['account_number'];
               $ifsc_code = $beneficiaryAccountDetails['ifsc_code'];
               $paymentData =[
                    'beneficiaryName'=>$beneficiary_name,
                    'beneficiaryAccountNumber'=>$account_number,
                    'beneficiaryIfscCode'=>$ifsc_code,
                    'paymentMode'=>$transferMode,
                    'amount'=>$amsount,
                    'orderId'=>$orderid,
                    'callbackurl'=> route('payout.payout_callback')
               ];
               $transferSyncResponse =  $this->standardTransferSyncAction($paymentData);
               $responseData = [
                        'referenceId'=>$orderid,
                        'code'=>$transferSyncResponse['code'],
                ];
               //echo "transferSyncResponse-------";
               //dd($transferSyncResponse);
               if($transferSyncResponse['status']){
                 return ['status'=>'SUCCESS', 'message'=>$transferSyncResponse['message'], 'data'=>$responseData];
               }else{
                return ['status'=>'ERROR', 'message'=>$transferSyncResponse['message'], 'data'=>$responseData];
               }
            }else{
                return ['status'=>'Error', 'message'=>$authorizeTokenResultArray['message']];
            }
        }
    }

























}
