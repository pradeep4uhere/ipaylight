<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Mail\TestMail;
use App\Models\User;
use App\Models\UserContact;
use Mail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;


class DMTController extends Controller
{
    
    public $directoryName = 'Retailer.DMT';

    public function tatkalTransfer(Request $request){
        $data = [];
        $accountList = [];
        $data['user'] = [];
        $data['accountList'] = $accountList;
        $data['mobileNumber'] = "";
        return view($this->directoryName.'.tatkalTransfer',[
            'pageTitle'=>'Money Transfer',
            'data'=>$data
        ]);
    }



    public function getAllBeneficiaryList(Request $request){
        $mobile = $request->get('mobile'); 
        $defaultPayoutServiceName =  getDefaultPayoutServiceName();
        $data = [];
        $accountList = [];
        $userContacts = UserContact::with(['beneficiaryAccounts' => function ($query) use ($defaultPayoutServiceName)  {
            $query->with(['payoutBeneficiaries' => function ($query) use ($defaultPayoutServiceName) {
                $query->where('payout_name', $defaultPayoutServiceName);
            }]);
        }])->where('mobile_number', $mobile)->first();
        //return response()->json($userContacts);
        if ($userContacts && $userContacts->beneficiaryAccounts->isNotEmpty()) {
            foreach($userContacts->beneficiaryAccounts as $accountItem){
                if ($accountItem->payoutBeneficiaries && $accountItem->payoutBeneficiaries->isNotEmpty()) {
                    foreach ($accountItem->payoutBeneficiaries as $beneficiary) {
                        if (($beneficiary->is_payout_beneficiary_added == 1) && ($defaultPayoutServiceName == $beneficiary->payout_name)) {
                            $api_contact_id = $beneficiary->api_contact_id;
                        }
                    }
                }else{
                    $api_contact_id = "";
                }
                $accountList[] = [
                        "id"=> $accountItem['id'],
                        "beneficiary_id" => $accountItem['beneficiary_id'],
                        "api_contact_id"=> $api_contact_id,
                        "user_id" => $accountItem['user_id'],
                        "bank_id" => $accountItem['bank_id'],
                        "user_contact_id" => $accountItem['user_contact_id'],
                        "beneficiary_name" => $accountItem['beneficiary_name'],
                        "account_number" => $accountItem['account_number'],
                        "bank_name" => $accountItem['bank_name'],
                        "ifsc_code" =>  $accountItem['ifsc_code'],
                        "status" => $accountItem['status'],
                        "bank_name"=>$accountItem->masterBank->bank_name,
                        "bank_icon"=>$accountItem->masterBank->icon,
                        "serviceName"=>'CF',
                        "is_verified" => 'NO'
                ];
            }
        }else{
            $accountList = [];
        }
     
        //return response()->json($accountList);
        // Render the view and pass the data to it
        
        $user['name'] = $userContacts['first_name'].' '.$userContacts['last_name'];
        $user['mobile_number'] = $userContacts['mobile_number'];
        $user['status'] = $userContacts['status'];
        $user['kyc_status'] = '-NO-';
        $user['monthly_limit'] = '25000.00';
        $user['balance_limit'] = '25000.00';
        $data['user'] = $user;
        $data['accountList'] = $accountList;
        $data['mobileNumber'] = $mobile;
        $data['cid'] = $userContacts->id;
        $view = view('Retailer.DMT.contact_search_view',[
            'data'=>$data
        ])->render();
        // Return the rendered view as JSON
        return response()->json(['status'=>true,'html' => $view]);
    }



    /**
     * Add New Add New Beneficiary
     */
    public function  addNewBeneficiary(Request $request, $cid){
        try{
            $contact_id = Crypt::decryptString($cid);
            if($contact_id ){
                $user = Auth::user();
                $userContactDetails = UserContact::find($contact_id);
                //dd($userContactDetails);
                $viewPage = 'addNewBeneficiary';
                return view($this->directoryName.'.'.$viewPage,[
                    'pageTitle'=> "Retailer All Contacts",
                    'userProfile'=>$user,
                    'userContactDetails'=>$userContactDetails
                ]);
            }else{
                return  back()->with('error', __('Transaction Not Found with requested parameters.'));
            }
        }catch (DecryptException $e) {
            return  back()->with('error', __('Invalid Payload, Please try again.'));
        } 
    }






    /********************************************Payout Service******************************************/
    public function searchaBeneficiaryForPayout(Request $request){
        $data = [];
        $accountList = [];
        $data['user'] = [];
        $data['accountList'] = $accountList;
        $data['mobileNumber'] = "";
        return view($this->directoryName.'.searchaBeneficiaryWithPayout',[
            'pageTitle'=>'Money Transfer',
            'data'=>$data
        ]);
    }



    public function getPayoutAllBeneficiaryList(Request $request){
        $mobile = $request->get('mobile'); 
        $payouttype = $request->get('payouttype'); 
        $serviceName = $this->getDefaultPayoutService($payouttype);
        $defaultPayoutServiceName =  getDefaultPayoutServiceName();
        $data = [];
        $accountList = [];
        $userContacts = UserContact::with(['beneficiaryAccounts' => function ($query) use ($defaultPayoutServiceName)  {
            $query->with(['payoutBeneficiaries' => function ($query) use ($defaultPayoutServiceName) {
                $query->where('payout_name', $defaultPayoutServiceName);
            }]);
        }])->where('mobile_number', $mobile)->first();
        //return response()->json($userContacts);
        if ($userContacts && $userContacts->beneficiaryAccounts->isNotEmpty()) {
            foreach($userContacts->beneficiaryAccounts as $accountItem){
                if ($accountItem->payoutBeneficiaries && $accountItem->payoutBeneficiaries->isNotEmpty()) {
                    foreach ($accountItem->payoutBeneficiaries as $beneficiary) {
                        if (($beneficiary->is_payout_beneficiary_added == 1) && ($defaultPayoutServiceName == $beneficiary->payout_name)) {
                            $api_contact_id = $beneficiary->api_contact_id;
                        }
                    }
                }else{
                    $api_contact_id = "";
                }
                $accountList[] = [
                        "id"=> $accountItem['id'],
                        "beneficiary_id" => $accountItem['beneficiary_id'],
                        "api_contact_id"=> $api_contact_id,
                        "user_id" => $accountItem['user_id'],
                        "bank_id" => $accountItem['bank_id'],
                        "user_contact_id" => $accountItem['user_contact_id'],
                        "beneficiary_name" => $accountItem['beneficiary_name'],
                        "account_number" => $accountItem['account_number'],
                        "bank_name" => $accountItem['bank_name'],
                        "ifsc_code" =>  $accountItem['ifsc_code'],
                        "status" => $accountItem['status'],
                        "bank_name"=>$accountItem->masterBank->bank_name,
                        "bank_icon"=>$accountItem->masterBank->icon,
                        "serviceName"=>$serviceName,
                        "is_verified" => 'NO'
                ];
            }
        }else{
            $accountList = [];
        }
     
        //return response()->json($accountList);
        // Render the view and pass the data to it
        
        $user['name'] = $userContacts['first_name'].' '.$userContacts['last_name'];
        $user['mobile_number'] = $userContacts['mobile_number'];
        $user['status'] = $userContacts['status'];
        $user['kyc_status'] = '-NO-';
        $user['monthly_limit'] = '25000000.00';
        $user['balance_limit'] = '25000000.00';
        $data['user'] = $user;
        $data['accountList'] = $accountList;
        $data['mobileNumber'] = $mobile;
        $data['cid'] = $userContacts->id;
        $view = view('Retailer.DMT.contact_search_view_with_payout',[
            'data'=>$data
        ])->render();
        // Return the rendered view as JSON
        return response()->json(['status'=>true,'html' => $view]);
    }




    private function getDefaultPayoutService($payoutType){
        if($payoutType==1){
            return 'PG'; //RUNPAISA
        }elseif($payoutType==2){
            return 'CF'; //Cashfree
        }elseif($payoutType==3){
            return 'RZ'; //Razorpay
        }elseif($payoutType==4){
            return 'EB'; //Easebuzz
        }elseif($payoutType==5){
            return 'PT'; //Paytm
        }else{
            return 'PG'; //PayU
        }
    }
    /********************************************Payout Service******************************************/



}
