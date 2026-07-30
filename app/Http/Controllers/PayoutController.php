<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayoutServiceFactory;
use App\Models\PayoutBeneficiary;
use Illuminate\Support\Facades\Validator;
use App\Models\BeneficiaryAccount;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\PayoutTransfer;
use Session;
use Log;
use DB;
use App\Models\MasterBank;
use Illuminate\Support\Facades\Storage;
use App\Services\WalletService;


class PayoutController extends Controller
{
    /**
     * payoutServiceFactory
     */
    protected $payoutServiceFactory;

    /**
     * walletService
     */
    protected $walletService;

    /**
     * serviceName
     */
    protected $serviceName;


    /**
     * Set status 
     */
    protected $status;



    public function __construct(PayoutServiceFactory $payoutServiceFactory, WalletService $walletService)
    {
        $this->payoutServiceFactory = $payoutServiceFactory;
        $this->walletService = $walletService;
        $this->status = 'Pending';
    }




    /**
     * Method Name: Add addBeneficiary
     * Author: Pradeep Kumar
     * Date: 27th May 2024
     */
    public function addBeneficiary(Request $request)
    {
        $serviceName = $request->input('service_name', 'CF'); // Default to 'CF'
        $paymentService = $this->payoutServiceFactory->getService($serviceName);

        $beneficiaryData = [
            'beneId' => 'HSDAS34234234',
            'name' => 'PRADEEP',
            'email' => 'pradeep@gmail.com',
            'phone' => '9015446567',
            'bankAccount' => '001111222333',
            'ifsc' => 'HDFC0000001',
            'address1' => 'noida Mahagun Myowdds',
            'city' => 'Noida',
            'state' => 'Bihar',
            'pincode' => '201301'
        ];

        $response = $paymentService->addBeneficiary($beneficiaryData);

        return response()->json($response);
    }



    /**
     * Method Name: verifyBeneficiary()
     * Author: Pradeep Kumar
     * Date: 27th May 2024
     * this method will verify the bank account with 
     * bank then added into payout bank
     */
    public function verifyBeneficiary(Request $request)
    {
        try {
            $identifierString = $request->get('identifier', 'CF'); // Default to 'CF'
            if ($request->has('identifier_service')) {
                $identifierServiceString = $request->get('identifier_service');
                $identifierServiceName = decryptString($identifierServiceString);
            } else {
                $$identifierServiceName = null; // Or set a default value
            }
            
            $identifier = decryptString($identifierString);
            $identifierArray = explode('|',$identifier);
            if(is_array($identifierArray)){
                $serviceName = $identifierArray[0];
                $beneficiaryId = $identifierArray[1]; 
            }
            $serviceList = array_keys(getPayoutList());
            if(in_array($serviceName, $serviceList)){
                $paymentService = $this->payoutServiceFactory->getService($serviceName);
                try {
                    //echo "dasdasd"; die;
                    $response = $paymentService->verifyBeneficiary($beneficiaryId);
                    //dd($response);
                    if($response['status']=='SUCCESS'){
                        if($this->createPayoutBeneficiaries($response['data'])){
                            if($identifierServiceName=='DMT'){
                                return response()->json(['status' => true, 'message'=>$response['message'],'identifier'=>$identifierString]);
                            }else{
                                return redirect()->back()->with(['success' => $response['message']]);
                            }
                        }else{
                            return response()->json(['status'=>'FAILED','message'=>'Failed to create payout beneficiary']);
                        }
                    }else{
                        if($identifierServiceName=='DMT'){
                            return response()->json(['status' => false, 'message'=>$response['message']]);
                        }else{
                            return redirect()->back()->withErrors(['error' => $response['message']]);
                        }
                    }
                } catch (\Exception $e) {
                    parent::writeErrorLog('Error in verifying bank account verifyBeneficiary() method in PayoutController.');
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
            }else{
                parent::writeErrorLog('Error Invalid Service Name in verifyBeneficiary() method in PayoutController.');
                return redirect()->back()->withErrors(['error' => 'Invalid Service Name']);
            }
        } catch (DecryptException $e) {
            parent::writeErrorLog('Invalid payload, Please try after somtime in verifyBeneficiary() method in PayoutController.');
            return response()->json(['error' => 'Invalid payload, Please try after somtime'], 400);
        }
    }





    /**
     * Method Name: createPayoutBeneficiaries()
     * Author: Pradeep Kumar
     * Date: 27th May 2024
     * @params Result Service Response and Payout 
     * Beneficiary data
     * @return boolean
     */
    // private function createPayoutBeneficiaries($data){
    //     $payoutBeneficiary = new PayoutBeneficiary();
    //     $payoutBeneficiary->user_id = $data['user_id'];
    //     $payoutBeneficiary->user_contact_id = $data['contact_id'];
    //     $payoutBeneficiary->beneficiary_account_id = $data['beneficiary_account_id'];
    //     $payoutBeneficiary->payout_name = $data['payout_name'];
    //     $payoutBeneficiary->api_contact_id = $data['beneficiary_id'];
    //     $payoutBeneficiary->is_payout_beneficiary_added = true;
    //     $payoutBeneficiary->is_beneficiary_verified = false;
    //     if($payoutBeneficiary->save()){
    //         return $payoutBeneficiary->id;
    //     }else{
    //         return false;
    //     }
    // }
    private function createPayoutBeneficiaries($data) {
        $existingPayoutBeneficiary = PayoutBeneficiary::where('user_id', $data['user_id'])
            ->where('user_contact_id', $data['contact_id'])
            ->where('beneficiary_account_id', $data['beneficiary_account_id'])
            ->where('payout_name', $data['payout_name'])
            ->first();
    
        if ($existingPayoutBeneficiary) {
            $existingPayoutBeneficiary->api_contact_id = $data['beneficiary_id'];
            $existingPayoutBeneficiary->is_payout_beneficiary_added = true;
            $existingPayoutBeneficiary->is_beneficiary_verified = false;
            $existingPayoutBeneficiary->save();
            return $existingPayoutBeneficiary->id;
        } else {
            $payoutBeneficiary = new PayoutBeneficiary();
            $payoutBeneficiary->user_id = $data['user_id'];
            $payoutBeneficiary->user_contact_id = $data['contact_id'];
            $payoutBeneficiary->beneficiary_account_id = $data['beneficiary_account_id'];
            $payoutBeneficiary->payout_name = $data['payout_name'];
            $payoutBeneficiary->api_contact_id = $data['beneficiary_id'];
            $payoutBeneficiary->is_payout_beneficiary_added = true;
            $payoutBeneficiary->is_beneficiary_verified = false;
            if ($payoutBeneficiary->save()) {
                return $payoutBeneficiary->id;
            } else {
                return false;
            }
        }
    }
    
    


    /**
     * Method Name: verifyBeforeTransferForPaygeniusPayout()
     * Author: Pradeep Kumar
     * Date: 9th May 2024
     * this method help to pre validate the transfer
     * @param amount , benificery_id
     */
    public function verifyBeforeTransferForPaygeniusPayout(Request $request){
        $data = $request->all();
        //dd( $data);
        if($request->has('indentifier_type')){
            $identifier_type = $request->get('indentifier_type');
            if($identifier_type!=''){
                $identifierTypeString = decryptstring($identifier_type);
            }else{
                $identifierTypeString = "";
            }
           
        }else{
            $identifier_type ='';
            $identifierTypeString = '';
        }
        $rules = [
            'amount' => 'required|numeric|min:1|max:199999',
            'transfer_type' => 'required|in:IMPS,NEFT', // assuming there are only two transfer types
            'tpin' => 'required|digits:5', // assuming TPIN is a 5-digit number
        ];
        $validator = Validator::make($data, $rules);    
        if ($validator->fails()) {
            //return response()->json(['error' => $validator->messages()], 422);
            // Validation fails
            $errors = $validator->errors()->all();
            //dd($errors);
            try {
               
                $indentifier = $request->get('indentifier');
                $beneficiaryString = decryptstring($indentifier);
                $beneficiaryArr = explode('|',$beneficiaryString);
                $serviceName = $beneficiaryArr[0];
                $beneficiary_id = $beneficiaryArr[1];
                $beneficiaryAccountDetails = BeneficiaryAccount::with('masterBank')->find($beneficiary_id);
                $viewPage = 'preValidateTransfer';
                $route = route('payout.verify_before_pg_transfer');
                //dd($beneficiaryAccountDetails);
                return view('Retailer.Payout.'.$viewPage,[
                    'data'=> $beneficiaryAccountDetails,
                    'indentifier'=>$indentifier,
                    'indentifierType'=>$identifier_type,
                    'errors' => $errors, 
                    'route'=>$route
                ]);
            } catch (DecryptException $e) {
                return $this->handleError('Invalid payload, Please try after somtime');
                // Handle the decryption error
                return response()->json(['error' => 'Invalid payload, Please try after somtime'], 400);
                //return redirect()->back()->withErrors(['error' => 'Invalid encrypted data. Please try again.']);
            } 
           
        } else {
            $errors = "";
            Session::put('error','');
            $identifier_type = $request->get('indentifier_type');
            $identifierTypeValue = decryptstring($identifier_type);
            $amount = $request->get('amount');
            $transfer_type = $request->get('transfer_type');
            $indentifier = $request->get('indentifier');
            $tpin = $request->get('tpin');
            $beneficiaryString = decryptstring($indentifier);
            $beneficiaryArr = explode('|',$beneficiaryString);
            $serviceName = $beneficiaryArr[0];
            $beneficiary_id = $beneficiaryArr[1];
            $transferFee = $this->getConveninceFee();
            //$beneficiaryAccountDetails = BeneficiaryAccount::with('masterBank')->find($beneficiary_id);
            $beneficiaryAccountDetails = BeneficiaryAccount::with(['UserContact','masterBank'])
            ->select('beneficiary_accounts.*')
            ->where('beneficiary_accounts.id', $beneficiary_id)
            ->first();
            //dd($beneficiaryAccountDetails);
            $route = route('payout.transferprocess');
            $viewPage = 'confirmBeforeTransfer';
            $payout_beneficiaries = $beneficiaryAccountDetails['payout_beneficiaries_id'];
            $payload = encryptString($amount.'#'.$transfer_type.'#'.$serviceName.'#'.$payout_beneficiaries);
            //dd($beneficiaryAccountDetails);
            //dd($identifier_type);
            return view('Retailer.Payout.'.$viewPage,[
                'data'=> $beneficiaryAccountDetails,
                'amount'=>$amount,
                'transfer_type'=>$transfer_type,
                'transferFee'=>$transferFee,
                'indentifier'=>$indentifier,
                'payload'=>$payload,
                'errors' => $errors, 
                'indentifierType'=>$identifier_type,
                'route'=>$route
            ]);
        }   
    }



    /**
     * Method Name: verifyBeforeTransfer()
     * Author: Pradeep Kumar
     * Date: 27th May 2024
     * this method help to pre validate the transfer
     * @param amount , benificery_id
     */
    public function verifyBeforeTransfer(Request $request){
        $data = $request->all();
        if($request->has('indentifier_type')){
            $identifier_type = $request->get('indentifier_type');
            if($identifier_type!=''){
                $identifierTypeString = decryptstring($identifier_type);
            }else{
                $identifierTypeString = "";
            }
           
        }else{
            $identifier_type ='';
            $identifierTypeString = '';
        }
        if($identifierTypeString=='DMT'){
            $rules = [
                'amount' => 'required|numeric|min:1|max:25000',
                'transfer_type' => 'required|in:IMPS,NEFT', // assuming there are only two transfer types
                'tpin' => 'required|digits:5', // assuming TPIN is a 5-digit number
            ];
        }else{
            $rules = [
                'amount' => 'required|numeric|min:1|max:199999',
                'transfer_type' => 'required|in:IMPS,NEFT', // assuming there are only two transfer types
                'tpin' => 'required|digits:5', // assuming TPIN is a 5-digit number
            ];
        }
        $validator = Validator::make($data, $rules);    
        if ($validator->fails()) {
            
            // Validation fails
            $errors = $validator->errors()->all();
            try {
                $indentifier = $request->get('indentifier');
                $beneficiaryString = decryptstring($indentifier);
                $beneficiaryArr = explode('|',$beneficiaryString);
                $serviceName = $beneficiaryArr[0];
                $beneficiary_id = $beneficiaryArr[1];
                $beneficiaryAccountDetails = BeneficiaryAccount::with('masterBank')->find($beneficiary_id);
                $viewPage = 'preValidateTransfer';
                //dd($beneficiaryAccountDetails);
                return view('Retailer.Payout.'.$viewPage,[
                    'data'=> $beneficiaryAccountDetails,
                    'indentifier'=>$indentifier,
                    'indentifierType'=>$identifier_type,
                    'errors' => $errors, 
                ]);
            } catch (DecryptException $e) {
                return $this->handleError('Invalid payload, Please try after somtime');
                // Handle the decryption error
                return response()->json(['error' => 'Invalid payload, Please try after somtime'], 400);
                //return redirect()->back()->withErrors(['error' => 'Invalid encrypted data. Please try again.']);
            } 
           
        } else {
            $errors = "";
            Session::put('error','');
            $amount = $request->get('amount');
            $transfer_type = $request->get('transfer_type');
            $indentifier = $request->get('indentifier');
            $tpin = $request->get('tpin');
            $beneficiaryString = decryptstring($indentifier);
            $beneficiaryArr = explode('|',$beneficiaryString);
            $serviceName = $beneficiaryArr[0];
            $beneficiary_id = $beneficiaryArr[1];
            $transferFee = $this->getConveninceFee();
            //$beneficiaryAccountDetails = BeneficiaryAccount::with('masterBank')->find($beneficiary_id);
            $beneficiaryAccountDetails = BeneficiaryAccount::with(['masterBank'])
            ->join('payout_beneficiaries', function ($join) use ($serviceName) {
                $join->on('beneficiary_accounts.id', '=', 'payout_beneficiaries.beneficiary_account_id')
                    ->where('payout_beneficiaries.payout_name', '=', $serviceName)
                    ->where('payout_beneficiaries.is_payout_beneficiary_added', '=', 1)
                    ->whereColumn('beneficiary_accounts.user_id', '=', 'payout_beneficiaries.user_id')
                    ->whereColumn('beneficiary_accounts.user_contact_id', '=', 'payout_beneficiaries.user_contact_id');
            })
            ->select('beneficiary_accounts.*', 'payout_beneficiaries.id as payout_beneficiaries_id','payout_beneficiaries.*')
            ->where('beneficiary_accounts.id', $beneficiary_id)
            ->first();

            if($identifier_type1=''){
                $route = route('dmtpayout.transferprocess');
            }else{
                $route = route('payout.transferprocess');
            }
            $viewPage = 'confirmBeforeTransfer';
            $payout_beneficiaries = $beneficiaryAccountDetails['payout_beneficiaries_id'];
            $payload = encryptString($amount.'#'.$transfer_type.'#'.$serviceName.'#'.$payout_beneficiaries);
            //dd($beneficiaryAccountDetails);
            //dd($identifier_type);
            return view('Retailer.Payout.'.$viewPage,[
                'data'=> $beneficiaryAccountDetails,
                'amount'=>$amount,
                'transfer_type'=>$transfer_type,
                'transferFee'=>$transferFee,
                'indentifier'=>$indentifier,
                'payload'=>$payload,
                'errors' => $errors, 
                'indentifierType'=>$identifier_type,
                'route'=> $route
            ]);
        }   
    }




        private function validateRequest($request) {
            $validator = Validator::make($request->all(), [
                'identifier' => 'required|string',
                'indentifier_type' => 'required|string',
                'payload' => 'required|string',
            ]);
            if ($validator->fails()) {
                return [
                    'status' => 'error',
                    'errors' => $validator->errors()->all()
                ];
            }
            return ['status' => 'success'];
        }


        private function decryptAndValidateIdentifier($identifier) {
            $beneficiaryString = decryptstring($identifier);
            $beneficiaryArr = explode('|', $beneficiaryString);
            //dd($beneficiaryArr);
            if (count($beneficiaryArr) < 2) {
                throw new \Exception('Invalid decrypted data format.');
            }
            $this->serviceName =  $beneficiaryArr[0];
            return [$beneficiaryArr[0], $beneficiaryArr[1]];
        }
        
        private function decryptAndValidatePayload($payloadString) {
            $payloadStr = decryptstring($payloadString);
            $payloadStrArr = explode("#", $payloadStr);
            if (count($payloadStrArr) < 4) {
                throw new \Exception('Invalid payload data format.');
            }
            return [$payloadStrArr[0], $payloadStrArr[1], $payloadStrArr];
        }



        private function getBeneficiaryAccountDetails($beneficiary_id) {
            return BeneficiaryAccount::with('masterBank')->find($beneficiary_id);
        }
        
        private function prepareTransferPostData($amount, $transferMode, $beneficiaryAccountDetails) {
            return [
                'amount' => $amount,
                'transferMode' => strtolower($transferMode),
                'beneId' => $beneficiaryAccountDetails['beneficiary_id'],
                'transferId' => 'payout_' . generateRefernceNumber(10)
            ];
        }


        private function processTransfer($postData, $serviceName) {
            $paymentService = $this->payoutServiceFactory->getService($serviceName);
            return $paymentService->processTransfer($postData);
        }


       


        private function getConveninceFee(){
            return 15;
        }


        private function prepareSaveData($response, $postData, $beneficiaryAccountDetails, $payloadStrArr) {
            //dd($this->serviceName);
            //dd($payloadStrArr);
            return [
                'payout_id' => $response['data']['referenceId'],
                'reference_id' => $postData['transferId'],
                'name' => $response['data']['referenceId'],
                'user_id' => getAuthValue('id'),
                'beneficiary_account_id' => $beneficiaryAccountDetails['id'],
                'user_contact_id' => $beneficiaryAccountDetails['user_contact_id'],
                'payout_beneficiary_id' => ($payloadStrArr[3]!='')?$payloadStrArr[3]:0,
                'amount' => $postData['amount'],
                'fee' => $this->getConveninceFee(),
                'tax' => '0.00',
                'status' => $this->status,
                'utr_number' => "",
                'descriptions' => '',
                'more_details' => serialize($response['data']),
                'failed_reason' => '',
                'payout_name' => $this->serviceName
            ];
        }
        
        private function handleError($message) {
            parent::writeErrorLog($message);
            Session::flash('error', $message);
            return view('Retailer.PageNotFound', ['message' => $message]);
        }


        public function preValidateTransferView($indentifier,$message, $identifier_type=null){
            list($serviceName, $beneficiary_id) = $this->decryptAndValidateIdentifier($indentifier);
            $beneficiaryAccountDetails = BeneficiaryAccount::with('masterBank')->find($beneficiary_id);
            $viewPage = 'preValidateTransfer';
            //dd($beneficiaryAccountDetails);
            return view('Retailer.Payout.'.$viewPage,[
                'data'=> $beneficiaryAccountDetails,
                'indentifier'=>$indentifier,
                'indentifierType'=>$identifier_type,
                'message' => $message
            ]);
        }


        private function isDuplicateRequest($payoutBeneficiaryId, $userContactId, $beneficiaryAccountId, $payoutName,  $amount) {
            $twoMinutesAgo = now()->subMinutes(2);
            return PayoutTransfer::where('payout_beneficiary_id', $payoutBeneficiaryId)
                ->where('user_contact_id', $userContactId)
                ->where('beneficiary_account_id', $beneficiaryAccountId)
                ->where('payout_name', $payoutName)
                ->where('amount', $amount)
                ->where('created_at', '>=', $twoMinutesAgo)
                ->exists();
        }
        
        
        /**
         * Method: transferMoneyProcess()
         * this Method is handle the process of acutal transfer
         * money from wallet to account.
         */
        public function transferMoneyProcess(Request $request){
                //dd($request->all());
                $validationResult = $this->validateRequest($request);
                // Step 2: Handle Decryption and Processing
                try {
                    $indentifier = $request->get('indentifier');
                    $payloadString = $request->get('payload');
                    //dd($payloadString);
                    list($serviceName, $beneficiary_id) = $this->decryptAndValidateIdentifier($indentifier);
                    list($amount, $transferMode, $payloadStrArr) = $this->decryptAndValidatePayload($payloadString);
                    
                    $beneficiaryAccountDetails = $this->getBeneficiaryAccountDetails($beneficiary_id);
                    //dd($payloadStrArr);
                    $payout_beneficiaries_id = $payloadStrArr[3];

                    // Check for duplicate requests with the same amount
                    if ($this->isDuplicateRequest($payout_beneficiaries_id, $beneficiaryAccountDetails['user_contact_id'], $beneficiaryAccountDetails['id'], $serviceName, $amount)) {
                        $message = 'Duplicate request. Please try again after 5 minutes.';
                        Session::flash('error', $message);
                        return $this->preValidateTransferView($indentifier, $message);
                    }
                    
                    $postData = $this->prepareTransferPostData($amount, $transferMode, $beneficiaryAccountDetails);

                    // Begin DB Transaction
                    DB::beginTransaction();
                    // Debit from Wallet
                   
                    $this->debitFromWallet($amount, $postData['transferId']);
                    $response = $this->processTransfer($postData, $serviceName);
                    if ($response['status'] === 'SUCCESS') {
                        $saveData = $this->prepareSaveData($response, $postData, $beneficiaryAccountDetails, $payloadStrArr);
                        $saveData['status'] = 'Pending';
                        $resultAfterSave = $this->savePayoutTransferEntry($saveData);
                        //dd($resultAfterSave);
                        if ($resultAfterSave['status'] === 'success') {
                            DB::commit();
                            return redirect()->route('payout.transfersuccess', ['identifier' => encryptString($resultAfterSave['id'])]);
                        } else {
                            // Rollback transaction if processTransfer fails
                            DB::rollBack();
                            return $this->handleError($resultAfterSave['message']);
                        }
                    }else if($response['status'] === 'ERROR') {
                        $saveData = $this->prepareSaveData($response, $postData, $beneficiaryAccountDetails, $payloadStrArr);
                        $saveData['status'] = 'Pending';
                        $resultAfterSave = $this->savePayoutTransferEntry($saveData);
                        if ($resultAfterSave['status'] === 'success') {
                            return redirect()->route('payout.transfersuccess', ['identifier' => encryptString($resultAfterSave['id'])]);
                        } else {
                            // Rollback transaction if processTransfer fails
                            DB::rollBack();     
                            return $this->handleError($resultAfterSave['message']);
                        }
                    }else {
                        return $this->handleError($response['message']);
                    }
                } catch (DecryptException $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid payload. Please try again later.',
                    ], 400);
                } catch (Exception $e) {
                    DB::rollBack(); // Rollback transaction on error
                    return response()->json([
                        'status' => 'error',
                        'message' => $e->getMessage(),
                    ], 500);
                }
        }
        
    

    /**
     * Method Name: debitFromWallet()
     * This method will take care for debit amount from wallet
     * after transfer the amount from wallet to bank account.
     */
    private function debitFromWallet($amount, $transaction_id){
        $sender_id = getAuthValue('id'); // Assuming the authenticated user is the sender
        $description = "Debit for transfer"; // Provide a suitable description
        $lastWalletId = $this->walletService->debit($amount, $sender_id, $sender_id, $description, 'Success', $transaction_id);
        if (!$lastWalletId) {
            Log::error("Failed to debit the wallet.");
        }
    }



    /**
     * Method Name: savePayoutTransferEntry()
     * @param PayoutResponse
     * This method make new entery for each payout transfer
     * craete new entery on payout transfer and debit the amount from wallet balance
     */
    private function savePayoutTransferEntry($requestData){
        try {
            $payoutTransfer = new PayoutTransfer();
            $payoutTransfer->transfers_reference_id  = $requestData['reference_id'];
            $payoutTransfer->payout_id   = $requestData['payout_id'];
            $payoutTransfer->fund_account_id = $requestData['beneficiary_account_id'];
            $payoutTransfer->name           = $requestData['name'];
            $payoutTransfer->user_id        = $requestData['user_id'];
            $payoutTransfer->beneficiary_account_id  = $requestData['beneficiary_account_id'];
            $payoutTransfer->user_contact_id  = $requestData['user_contact_id'];
            $payoutTransfer->payout_beneficiary_id  = $requestData['payout_beneficiary_id'];
            $payoutTransfer->amount  = $requestData['amount'];
            $payoutTransfer->fee  = $requestData['fee'];
            $payoutTransfer->tax  = $requestData['tax'];
            $payoutTransfer->status  = $requestData['status'];
            $payoutTransfer->utr_number  = $requestData['utr_number'];
            $payoutTransfer->descriptions  = $requestData['descriptions'];
            $payoutTransfer->more_details  = $requestData['more_details'];
            $payoutTransfer->failed_reason  =  $requestData['failed_reason'];
            $payoutTransfer->payout_name = $requestData['payout_name'];
            //dd($payoutTransfer);
            if ($payoutTransfer->save()) {
                return [
                    'status' => 'success',
                    'message' => 'Payout transfer entry saved successfully.',
                    'id' => $payoutTransfer->id
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Failed to save payout transfer entry.'
                ];
            }
        }catch (\Exception $e) {
            Log::error('Error saving payout transfer entry: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'An error occurred while saving the payout transfer entry.',
                'error' => $e->getMessage()
            ];
        }
    }












    /**
     * Method Name: transferSuccessRecipet()
     * This Method View the details after transfer action by the service
     * @param integer last_transfer_identifier
     * @return view
     */
    public function transferSuccessRecipet(Request $request, $identifier){
        try{
            //Getting Payout Transfer Id
            $id = decryptString($identifier);
            $this->getTransctionStatus($id);
            $payoutTransfer = PayoutTransfer::with('BeneficiaryAccount','UserContact')->find($id);
            //dd($payoutTransfer);
            //GetBankDetails
            $bankDetails = MasterBank::find($payoutTransfer['BeneficiaryAccount']['bank_id']);
            $icon = $bankDetails['icon'];
            
            $resultData = [
                'Agent' => [
                    'Name'=>getAuthValue('name'),
                    'AgentCode'=>getAuthValue('agent_code'),
                ],
                'ReceiptNo'=>date('Ymd',strtotime($payoutTransfer['created_at'])).$payoutTransfer['id'],
                'TransactionDate'=>getFormatDate($payoutTransfer['created_at']),
                'TransfersReferenceId'=>$payoutTransfer['transfers_reference_id'],
                'SenderName'=> $payoutTransfer['UserContact']['first_name'].' '.$payoutTransfer['UserContact']['last_name'],
                'SenderMobile'=>$payoutTransfer['UserContact']['mobile_number'],
                'BankName'=>$payoutTransfer['BeneficiaryAccount']['bank_name'],
                'BenificieryName'=>$payoutTransfer['BeneficiaryAccount']['beneficiary_name'],
                'BenificieryAccount'=>$payoutTransfer['BeneficiaryAccount']['account_number'],
                'BenificieryIFSCCode'=>$payoutTransfer['BeneficiaryAccount']['ifsc_code'],
                'BenificieryAccountType'=>'Saving Account',
                'TransferMode'=>"IMPS",
                'Amount'=>$payoutTransfer['amount'],
                'RefNumber'=>$payoutTransfer['payout_id'],
                'UTR'=>$payoutTransfer['utr_number'],
                'Status'=>$payoutTransfer['status'],
                'ConvenienceFee'=>$payoutTransfer['fee'],
                'Remarks'=>$payoutTransfer['descriptions'],
                'BankIcon'=>asset('assets/bank/').'/'.$icon,
                'Total'=>$payoutTransfer['amount']+$payoutTransfer['fee']
            ];
            $viewPage = "transferConfirmation";
            //"data" => "{"status":"SUCCESS","subCode":"200","message":"Money Transfred Successfully","data":{"referenceId":"4dfb9780DASDASD","utr":"UTR4dfb9780DASDASD","acknowledged":1}}                
            return view('Retailer.Payout.'.$viewPage,[
                'data'=> $resultData,
            ]);
        } catch (DecryptException $e) {
            // Handle the decryption error
            return response()->json(['error' => 'Invalid payload, Please try after somtime'], 400);
            //return redirect()->back()->withErrors(['error' => 'Invalid encrypted data. Please try again.']);
        } 
    }



    /**
     * Method Name: Getting Transasction Status
     * @param LastPayoutTransfer Id
     * @response Array
     * Reference: https://docs.cashfree.com/reference/get-transfer-status
     */
    private function getTransctionStatus($id){
        $payoutTransfer = PayoutTransfer::with('BeneficiaryAccount','UserContact')->find($id);
        $serviceName = $payoutTransfer['payout_name'];
        if($payoutTransfer['status']=='Pending'){
            $paymentService = $this->payoutServiceFactory->getService($serviceName);
            //dd($paymentService);
            $payload = [
                'referenceId' => $payoutTransfer['payout_id'],
                'transferId' => $payoutTransfer['transfers_reference_id']
            ];
            $result = $paymentService->getTransferStatus($payload);
            if($result['status']){
                try {
                        $status = $result['data']['transfer']['status'];
                        $reason = $result['data']['transfer']['reason'];
                        $payoutTransfer->status = ucFirst(strtolower($status));
                        $payoutTransfer->failed_reason = $reason;
                        if ($payoutTransfer->save()) {
                            //check if transfer Status is fetch after proccessed
                            $this->processAfterTransferAction($result, $payoutTransfer);
                            return [
                                'status' => 'success',
                                'message' => 'Payout transfer entry saved successfully.',
                                'id' => $payoutTransfer->id
                            ];
                        } else {
                            return [
                                'status' => 'error',
                                'message' => 'Failed to save payout transfer entry.'
                            ];
                        }

                    } catch (\Exception $e) {
                        Log::error('Error saving payout transfer entry: ' . $e->getMessage());
                        return [
                            'status' => 'error',
                            'message' => 'An error occurred while saving the payout transfer entry.',
                            'error' => $e->getMessage()
                        ];
                }
            }
       }
        
    }





    /**
     * 
     */
    private  function processAfterTransferAction($result, $payoutTransfer){
        //check if transfer Status is fetch after proccessed
        
        if($payoutTransfer){
            if($payoutTransfer['status']=='Rejected'){
                //if rejected then update payout status to rejected
                $sender_id = getAuthValue('id'); // Assuming the authenticated user is the sender
                $amount = $payoutTransfer['amount'];
                $description = "Reverse Transfer"; // Provide a suitable description
                $transaction_id = generateTransactionNumber(10);
                $lastWalletId = $this->walletService->credit($amount, $sender_id, $sender_id, $description, 'Reversal', $transaction_id);
                if (!$lastWalletId) {
                    Log::error("Failed to reverse into the wallet.");
                }
            }
        }
    }








    /**
     * Method Name: saveScreenshot()
     * This method save the screenshot on the server when user take screenshots
     * and share print recipt to whatsapp.
     */
    public function saveScreenshot(Request $request)
    {
        if ($request->hasFile('screenshot')) {
            $file = $request->file('screenshot');
            $path = $file->store('screenshots', 'public');
            $imagePath = asset('storage/'.$path);
            return response()->json(['status' => 'success', 'imagepath' => $imagePath]);
        }
        return response()->json(['status' => 'error'], 400);
    }




    /**
     * Setting For Domestic Money Transfer
     * Default Amount on Per Transcation
     */
    private function getAmountPerTransaction(){
        $amountPerTransaction = 5000;
        return $amountPerTransaction;
    }


    /**
     * Get Amount Array for DMT
     */
    private function getAmountArray($requestAmount){
        while ($requestAmount > 0) {
            if ($requestAmount >= $this->getAmountPerTransaction()) {
                $amountArr[] = $this->getAmountPerTransaction();
                $requestAmount -= $this->getAmountPerTransaction();
            } else {
                $amountArr[] = $requestAmount;
                $requestAmount = 0;
            }
        }
        return $amountArr;
    }



        /**
         * Money Trnasfer For Domestic Money Transfer
         * Date: 
         */
        public function transferDMTMoneyProcess(Request $request){
            $validationResult = $this->validateRequest($request);
            // Step 2: Handle Decryption and Processing
            try {
                $indentifier = $request->get('indentifier');
                if($request->has('indentifier_type')){
                    $identifier_type = $request->get('indentifier_type');
                    if($identifier_type!=''){
                        $identifierTypeString = decryptstring($identifier_type);
                    }else{
                        $identifierTypeString = "";
                    }
                }else{
                    $identifier_type ='';
                    $identifierTypeString = '';
                }
                
                $payloadString = $request->get('payload');
                list($serviceName, $beneficiary_id) = $this->decryptAndValidateIdentifier($indentifier);
                list($amount, $transferMode, $payloadStrArr) = $this->decryptAndValidatePayload($payloadString);
                $beneficiaryAccountDetails = $this->getBeneficiaryAccountDetails($beneficiary_id);
                $payout_beneficiaries_id = $payloadStrArr[3];
                // Check for duplicate requests with the same amount
                
                if ($this->isDuplicateRequest($payout_beneficiaries_id, $beneficiaryAccountDetails['user_contact_id'], $beneficiaryAccountDetails['id'], $serviceName, $amount)) {
                    $message = 'Duplicate request. Please try again after 5 minutes.';
                    Session::flash('error', $message);
                    return $this->preValidateTransferView($indentifier, $message, $identifier_type);
                }

                //dd($request->all());
                //dd($postData);
                $amountArr = $this->getAmountArray($amount);
                if (empty($amountArr)) {
                    return $this->handleError('Amount array is empty');
                }
                $successResponses = [];
                $errorResponses = [];
                $allIds = [];
                foreach ($amountArr as $amountPerTransaction) {
                    $postData = $this->prepareTransferPostData($amountPerTransaction, $transferMode, $beneficiaryAccountDetails);
                    // Begin DB Transaction
                    DB::beginTransaction();
                    try {
                        // Debit from Wallet
                        $this->debitFromWallet($amountPerTransaction, $postData['transferId']);
                        // Process the transfer
                        $response = $this->processTransfer($postData, $serviceName);
                        if ($response['status'] === 'SUCCESS') {
                            $result = $this->handleSuccessfulTransfer($response, $postData, $beneficiaryAccountDetails, $payloadStrArr);
                            if ($result['status'] === 'success') {
                                $successResponses[] = $result['data'];
                                $allIds[] = $result['data']['id']; // Collect the id
                            } else {
                                $errorResponses[] = $result['message'];
                            }
                        } elseif ($response['status'] === 'ERROR') {
                            $result = $this->handleErrorTransfer($response, $postData, $beneficiaryAccountDetails, $payloadStrArr);
                            if ($result['status'] === 'success') {
                                $successResponses[] = $result['data'];
                            } else {
                                $errorResponses[] = $result['message'];
                            }
                        } else {
                            DB::rollBack();
                            $errorResponses[] = $response['message'];
                        }
                    } catch (Exception $e) {
                        DB::rollBack();
                        $errorResponses[] = $e->getMessage();
                    }
                }
                
                // Create a string of all collected IDs separated by '|'
                $allIdsString = implode('|', $allIds);
                // Redirect to confirmation page with success and error responses and all IDs string
                return redirect()->route('dmtpayout.transfersuccess',['source'=>encryptString($allIdsString)])
                ->with([
                    'successResponses' => $successResponses,
                    'errorResponses' => $errorResponses,
                    'allIdsString' => $allIdsString,
                    'identifier' => encryptString($allIdsString)
                ]);

            } catch (DecryptException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid payload. Please try again later.',
                ], 400);
            } catch (Exception $e) {
                DB::rollBack(); // Rollback transaction on error
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 500);
            }
    }



    private function handleSuccessfulTransfer($response, $postData, $beneficiaryAccountDetails, $payloadStrArr)
    {
        $saveData = $this->prepareSaveData($response, $postData, $beneficiaryAccountDetails, $payloadStrArr);
        $saveData['status'] = 'Pending';
        $resultAfterSave = $this->savePayoutTransferEntry($saveData);
       // dd($resultAfterSave);
        if ($resultAfterSave['status'] === 'success') {
            DB::commit();
            return ['status' => 'success', 'data' => $resultAfterSave];
        } else {
            DB::rollBack();
            return ['status' => 'error', 'message' => $resultAfterSave['message']];
        }
    }



    private function handleErrorTransfer($response, $postData, $beneficiaryAccountDetails, $payloadStrArr)
    {
        $saveData = $this->prepareSaveData($response, $postData, $beneficiaryAccountDetails, $payloadStrArr);
        $saveData['status'] = 'Pending';
        $resultAfterSave = $this->savePayoutTransferEntry($saveData);

        if ($resultAfterSave['status'] === 'success') {
            return ['status' => 'success', 'data' => $resultAfterSave['data']];
        } else {
            DB::rollBack();
            return ['status' => 'error', 'message' => $resultAfterSave['message']];
        }
    }






    /**
     * Method Name: transferSuccessRecipet()
     * This Method View the details after transfer action by the service
     * @param integer last_transfer_identifier
     * @return view
     */
    public function dmtTransferConfirmationRecipet(Request $request, $source){
        try{
            $successResponses = session('successResponses');
            $errorResponses = session('errorResponses');
            $allIdsString = session('allIdsString');
            $idString = decryptString($source);
            $idsArr = explode('|',$idString);
            if(!empty($idsArr)){
                $convenienceFee = 0;
                foreach($idsArr as $id){
                    $this->getTransctionStatus($id);
                    $payoutTransfer = PayoutTransfer::with('BeneficiaryAccount','UserContact')->find($id);
                    $bankDetails = MasterBank::find($payoutTransfer['BeneficiaryAccount']['bank_id']);
                    $icon = $bankDetails['icon'];
                    $resultData[] = [
                        'Agent' => [
                            'Name'=>getAuthValue('name'),
                            'AgentCode'=>getAuthValue('agent_code'),
                        ],
                        'ReceiptNo'=>date('Ymd',strtotime($payoutTransfer['created_at'])).$payoutTransfer['id'],
                        'TransactionDate'=>getFormatDate($payoutTransfer['created_at']),
                        'TransfersReferenceId'=>$payoutTransfer['transfers_reference_id'],
                        'SenderName'=> $payoutTransfer['UserContact']['first_name'].' '.$payoutTransfer['UserContact']['last_name'],
                        'SenderMobile'=>$payoutTransfer['UserContact']['mobile_number'],
                        'BankName'=>$payoutTransfer['BeneficiaryAccount']['bank_name'],
                        'BenificieryName'=>$payoutTransfer['BeneficiaryAccount']['beneficiary_name'],
                        'BenificieryAccount'=>$payoutTransfer['BeneficiaryAccount']['account_number'],
                        'BenificieryIFSCCode'=>$payoutTransfer['BeneficiaryAccount']['ifsc_code'],
                        'BenificieryAccountType'=>'Saving Account',
                        'TransferMode'=>"IMPS",
                        'Amount'=>$payoutTransfer['amount'],
                        'RefNumber'=>$payoutTransfer['payout_id'],
                        'UTR'=>$payoutTransfer['utr_number'],
                        'Status'=>$payoutTransfer['status'],
                        'ConvenienceFee'=>$payoutTransfer['fee'],
                        'Remarks'=>$payoutTransfer['descriptions'],
                        'BankIcon'=>asset('assets/bank/').'/'.$icon,
                        'Total'=>$payoutTransfer['amount']+$payoutTransfer['fee']
                    ];
                    $totalAmount[] = $payoutTransfer['amount']  + $payoutTransfer['fee'];
                    $convenienceFee += $payoutTransfer['fee'];
                }
            }
            $viewPage = "transferConfirmation";
            //dd($resultData);
            //"data" => "{"status":"SUCCESS","subCode":"200","message":"Money Transfred Successfully","data":{"referenceId":"4dfb9780DASDASD","utr":"UTR4dfb9780DASDASD","acknowledged":1}}                
            return view('Retailer.DMT.'.$viewPage,[
                'data'=> $resultData,
                'totalAmount'=>array_sum($totalAmount),
                'convenienceFee'=>number_format($convenienceFee,2)
            ]);
        } catch (DecryptException $e) {
            // Handle the decryption error
            return response()->json(['error' => 'Invalid payload, Please try after somtime'], 400);
            //return redirect()->back()->withErrors(['error' => 'Invalid encrypted data. Please try again.']);
        } 
    }





    /***
     * Method Name: getPayoutStatus
     * this method used for callback for Payout Status after trnasfer the payment
     */
    public function updatePayoutOrderStatus(Request $request){
        $data = $request->all();
        $paymentService = $this->payoutServiceFactory->getService($serviceName);
        Log::debug("Transaction Callback paymentCallBackStatus - ".json_encode($request->all()));
        $callbackResponse = '{
                                "status": "ACCEPTED",
                                "message": "Request accepted",
                                "code": "RP000",
                                "ORDERSTATUS": {
                                        "ORDER_ID": "VG006",
                                        "TXN_MODE": "BANK",
                                        "TXN_AMOUNT": "6500",
                                        "UTR_NO": "1684239125376790",
                                        "STATUS": "SUCCESS",
                                        "ACK": 1,
                                        "DESCRIPTION": "NA",
                                        "TXN_DATE": "2023-05-16 13:29:53",
                                        "PROCESSED_DATE": "2023-05-16 17:42:05"
                                }
                        }';
        
        try {
            $requestData = json_encode($request->all());
            $payoutTransfer = new PayoutTransfer();
            $payoutTransfer->beneficiary_account_id  = $requestData['beneficiary_account_id'];
            $payoutTransfer->status  = $requestData['ORDERSTATUS']['STATUS'];
            $payoutTransfer->utr_number  = $requestData['ORDERSTATUS']['UTR_NO'];
            $payoutTransfer->failed_reason  =   $requestData['message'];
            if ($payoutTransfer->save()) {
                return [
                    'status' => 'success',
                    'message' => 'Payout transfer entry updated successfully after callback.',
                    'id' => $payoutTransfer->id
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Failed to save payout transfer entry.'
                ];
            }
        }catch (\Exception $e) {
            Log::error('Error saving payout transfer entry: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'An error occurred while saving the payout transfer entry.',
                'error' => $e->getMessage()
            ];
        }
         

    }








}
