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


class CashfreeService
{
    protected $client;

    protected $tokenBarear;

    private $baseUrl;

    private $key;

    private $secert;



    public function __construct()
    {
        $this->client = new Client();
        $this->initializeBaseUrl();
    }


    /**
     * Method Name: initializeBaseUrl()
     * This Method used for getting base url
     * of the Cashfree API URL based on Test and Production Mode
     */
    private function initializeBaseUrl()
    {
        $gatewayDetails = Gateway::where('gateway_name', 'CASHFREE')->first();
        if ($gatewayDetails && $gatewayDetails['mode'] == 'Prod') {
            $this->baseUrl = 'https://payout-api.cashfree.com/payout/v1/';
            $this->key = $gatewayDetails['payout_client_key'];
            $this->secert = $gatewayDetails['payout_secerts_key'];
        } else {
            $this->baseUrl = 'https://payout-gamma.cashfree.com/payout/v1/';
            $this->key = $gatewayDetails['payout_client_key'];
            $this->secert = $gatewayDetails['payout_secerts_key'];
        }
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
        return $this->getBaseUrl() . 'authorize';
    }


     /**
     * Method Name: authorizeToken()
     * This Method used for getting Token From Server
     * @return Bearer Token as string
     */
    private function authorizeToken(){

         // Check if token is cached
         $cachedToken = Cache::get('cashfree_token');
         if ($cachedToken) {
             $this->tokenBearer = 'Bearer ' . $cachedToken;
             return ['status' => true, 'token' => $this->tokenBearer];
         }
        try{
            $response = $this->client->request('POST', $this->getAuthorizeUrl(), [
                'headers' => [
                'accept' => 'application/json',
                'x-client-id' => $this->key,
                'x-client-secret' => $this->secert,
                ],
            ]);
            $authorizeTokenResultArray =  json_decode($response->getBody(), true);
            if ($authorizeTokenResultArray['status'] === 'SUCCESS' && $authorizeTokenResultArray['subCode'] == 200) {
                $token = $authorizeTokenResultArray['data']['token'];
                $this->tokenBearer = 'Bearer ' . $token;
                // Cache the token
                Cache::put('cashfree_token', $token, 55); // Cache for 55 minutes
                return ['status' => true, 'token' => $this->tokenBearer];
            } else {
                $message = $authorizeTokenResultArray['message'] ?? 'Authorization failed';
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
            $response = $this->client->request('GET', $this->getBaseUrl() . $type, [
                'headers' => [
                    'Authorization' => $this->tokenBearer,
                    'accept' => 'application/json'
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            if ($result['status'] === 'SUCCESS' && $result['subCode'] == 200) {
                return ['status' => true, 'message' => $result['message'], 'data'=>$result['data']];
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
        if($authorizeTokenResultArray['status']){
            $result = $this->getAPIAction('getBalance');
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
     * Method Name::  postAPIAction()
     * this method call for API with Post Data
     * @param Array
     * @return Array
     */
    private function postAPIActionForTransfer($postData,$type){
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
            if ($result['status'] === 'ACCEPTED') {
                return ['status' => true, 'message' => $result['message'], 'data'=>$result['data']];
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
     * Method Name: standardTransferSyncAction()
     * @param transferObject
     * @return array
     * Trnasfer Options requestTransfer, requestAsyncTransfer
     */
    private function standardTransferSyncAction($transferObject){
        return $this->postAPIActionForTransfer($transferObject,'requestAsyncTransfer');
    }




    /**
     * Method Name:  Get Transction Status
     * @param TransactionObject Array
     * $transferObject['referenceId'] and $transferObject['transferId']
     */
    public function getTransferStatus($transferObject){
        $authorizeTokenResultArray =  $this->authorizeToken();
        if($authorizeTokenResultArray['status']){
            $url = 'getTransferStatus?referenceId='.$transferObject['referenceId'].'&transferId='.$transferObject['transferId'];
            $result  = $this->getAPIAction($url);
            if($result['status']){
                return ['status'=>true, 'message'=>$result['message'], 'data'=>$result['data']];
            }else{
                return ['status'=>false, 'message'=>$result['message']];
            }
        }else{
            return ['status'=>'Error', 'message'=>$authorizeTokenResultArray['message']];
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
        if($virtualBalanceResponse['status']){
            $virtualBalance = $virtualBalanceResponse['data']['balance'];
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
            if($authorizeTokenResultArray['status']){
               $transferSyncResponse =  $this->standardTransferSyncAction($payloadata);
               //dd($transferSyncResponse);
               if($transferSyncResponse['status']){
                 return ['status'=>'SUCCESS', 'message'=>$transferSyncResponse['message'], 'data'=>$transferSyncResponse['data']];
               }else{
                return ['status'=>'Error', 'message'=>'Transfer Initiated', 'data'=>""];
               }
            }else{
                return ['status'=>'Error', 'message'=>$authorizeTokenResultArray['message']];
            }
        }
    }

























}
