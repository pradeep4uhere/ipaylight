<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PayoutTransfer; 
use App\Models\Gateway; 
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Config;
use Cache;


class ProcessPendingPayoutOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:pending-payout-orders';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all pending orders and update their status';


    protected $client;

    protected $tokenBarear;

    protected $baseUrl;

    protected $key;

    protected $secert;

    protected $client_id;

    protected $tokenUrl;

    protected $payoutStatusUrl;

    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
        //$this->initializeBaseUrl();
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
            $client_id = $pgGlobalArr['PROD']['CLIENT_ID'];
            $tokenApiUrl  = $pgGlobalArr['UAT']['TOKEN'];
            $payoutApiUrl  = $pgGlobalArr['PROD']['PAYOUT'];
            $payoutStatusApiUrl  = $pgGlobalArr['PROD']['PAYOUT_STATUS'];
            $walletBalanceApiUrl  = $pgGlobalArr['PROD']['WALLET_BALANCE'];
            $merchantIdFromConfig = $gatewaydsDetails;
        }
        return [$client_id, $paymentMode, $tokenApiUrl, $payoutApiUrl, $payoutStatusApiUrl, $walletBalanceApiUrl, $merchantIdFromConfig];
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
           $response = $this->client->request('POST', $this->getAuthorizeUrl(), [
               'headers' => [
                   'accept' => 'application/json',
                   'client_id' => $this->client_id,
                   'username' => $this->key,
                   'password'=> $this->secert
               ],
           ]);
           $authorizeTokenResultArray =  json_decode($response->getBody(), true);
           //$authorizeTokenResultArray =  json_decode($result, true);
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
     * Execute the console command.
     */
    public function handle()
    {
        // Move initialization here
        $this->initializeBaseUrl();

        $result = $this->authorizeToken();
        $pendingOrders = PayoutTransfer::where('status', 'Pending')->where('payout_name','PG')->get(); // Adjust based on your model structure
        if($result['status']){
            foreach ($pendingOrders as $order) {
                $response = $this->client->request('POST', 'https:// api.payout.runpaisa.com/status', [
                    'form_params' => [
                        'order_id' => $order->transfers_reference_id, // Adjust based on your table structure
                    ],
                    'headers' => [
                        'accept' => 'application/json',
                        'client_id' => $this->client_id,
                        'token'=> $this->tokenBarear
                    ]
                ]);

                $result = json_decode($response->getBody(), true);
                // Process the API response and update the order status
                if ($result['status'] === 'ACCEPTED') {
                    $order->status = $result['"ORDERSTATUS']['"STATUS'];
                    $order->utr_number = $result['"ORDERSTATUS']['"UTR_NO'];
                    $order->save();
                }
            }
            $this->info('Pending payout orders processed successfully.');
            Log::info("Pending payout orders processed successfully at -  ".date('Y-m-d h:i:s'));
        }else{
            Log::error("Token is not generated at ".date('Y-m-d h:i:s'));
        }
    }









}
