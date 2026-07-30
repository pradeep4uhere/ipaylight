<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use App\Models\SettlementSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\DomesticSettlementRequest;
use App\Http\Requests\InternationalSettlementRequest;
use App\Events\ProcessSettlements;
use App\Models\Gateway;
use App\Services\WalletService;
use DB;
use App\Models\User;




class SettlementController extends Controller
{


    protected $roleDirectory;

    protected $walletService;


    /**
     * Create the event listener.
     */
    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
        $this->roleDirectory = 'Admin';
    }

    


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Settlement $settlement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settlement $settlement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Settlement $settlement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settlement $settlement)
    {
        //
    }



    /**
     * Method Name: View Settalment Details In Retialer Profile
     */
    public function viewSettalmentDetailsInRetailerProfile(Request $request, $id){
        try {
            
            $settlement_id = Crypt::decryptString($id);
            //dd($settlement_id);
            $settalmentDetails = Settlement::with(['Transaction','User'])->find($settlement_id);
            $taxAmount = $settalmentDetails->amount  * 0.01 * $settalmentDetails->tax;
            $deductionAmount = $settalmentDetails->amount - $taxAmount;
            //dd($settalmentDetails);
            $fee = 0;
            $tax = $taxAmount * 0.18;
            $deductionAmount = $taxAmount - $tax; 
            if(Auth::user()->role == 'admin'){
                $viewPageName = 'Admin.Settalment.SettalmentDetails';
            }else{
                $viewPageName = 'Retailer.Settalment.SettalmentDetails';
            }
            $pageTitle = 'Settalment Details';
            //dd($viewPageName);
            //Get Settalment Setting
            //dd($userProfile);
            //SettalmentSetting::where('user_id')
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error, e.g., log the error or return a response
            Log::error('Decryption error: ' . $e->getMessage());
            //return response()->json(['error' => 'Failed to decrypt the payload.'], 400);
            $viewPageName = 'Retailer.PageNotFound';
            $pageTitle = 'Opps ! Page Not Found.';
            $settalmentDetails = [];
        }
        return view($viewPageName,[
            'pageTitle'=>$pageTitle,
            'details'=>$settalmentDetails,
            'taxAmount'=>number_format($taxAmount,2),
            'deductionAmount'=>number_format($deductionAmount,2),
            'Fee'=>number_format($fee,2),
            'tax'=>$tax
        ]);

    }




    public function saveDomesticSettalmentPermissions(DomesticSettlementRequest $request){
        $user_id =  decryptString($request->get('user_id'));
        $gateway_id= decryptString($request->get('gateway_id'));
        $saveData = [
            'domestic_settlement'=>$request->get('domestic_settlement'),
            'domestic_settlement_cycle'=>$request->get('domestic_settlement_cycle'),
            'domestic_settlement_time'=>$request->get('domestic_settlement_time'),
            'domestic_settlement_fee'=>$request->get('domestic_settlement_fee'),
            'gateway_id'=>$gateway_id,
            'user_id'=>$user_id
        ];
        $existingRecord = SettlementSetting::where('user_id', $user_id)
                                  ->where('gateway_id', $gateway_id)
                                  ->first();
        if ($existingRecord) {
            // Existing record found
            $id = $existingRecord->id;
            // Update the existing record
            $existingRecord->update($saveData);
            return redirect()->back()->with('success', "Settalment Setting Saved.");
        } else {
            // No existing record found
            $id = null;
            // Create a new record
            $newRecord = SettlementSetting::create( $saveData );
            $id = $newRecord->id;
            return redirect()->back()->with('success', "Settalment Setting Saved.");
        }

    }
    



    public function saveInternationalSettalmentPermissions(InternationalSettlementRequest $request){
        $user_id =  decryptString($request->get('user_id'));
        $gateway_id= decryptString($request->get('gateway_id'));
        $saveData = [
            'international_settlement'=>$request->get('international_settlement'),
            'international_settlement_cycle'=>$request->get('international_settlement_cycle'),
            'international_settlement_time'=>$request->get('international_settlement_time'),
            'international_settlement_fee'=>$request->get('international_settlement_fee'),
            'gateway_id'=>$gateway_id,
            'user_id'=>$user_id
        ];
        $existingRecord = SettlementSetting::where('user_id', $user_id)
                                  ->where('gateway_id', $gateway_id)
                                  ->first();
        if ($existingRecord) {
            // Existing record found
            $id = $existingRecord->id;
            // Update the existing record
            $existingRecord->update($saveData);
            return redirect()->back()->with('success', "Settalment Setting Saved.");
        } else {
            // No existing record found
            $id = null;
            // Create a new record
            $newRecord = SettlementSetting::create( $saveData );
            $id = $newRecord->id;
            return redirect()->back()->with('success', "Settalment Setting Saved.");
        }
    }




    /**
     * Method Name: makeSettalment With CronJob;
     * Description: this Method will call using CRON Job
     * All Settalment will be made here
     * @return void
     * 
    */
    public function makeSettalment(){
        //this Event Dispatch for make all settalment wihtin time period
        event(new ProcessSettlements());
    }







   /**
    * From Admin Portal Settalment Report
    * Method Name: getAllSettalment()
    * Author Name: Pradeep Kumar
    * Description: getAllSettalment
    * Return: List
    */

    public function getAllSettalment(Request $request){
        
        $gatewaySettalmentArr = Gateway::where('gateway_active',1)->get();
        $gatewaySettalment = [];
        foreach($gatewaySettalmentArr as $item){
            $gatewaySettalment[$item['gateway_name']] = $item->toArray();
        }
        //dd($gatewaySettalment);
        $retailerGatewayList = $gatewaySettalment;
        //$retailerGatewayList = parent::getRetailerPaymentGatewaysList();
        $request_gateway_id = '';
        $gateway_name = "";
        $user_id = null;
        $userDetails = null;
        if($request->isMethod('post')){
            $date_range = $request->get('date_range');
            $settlement_id = $request->get('settalment_id');
            $utr_number = $request->get('utr_number');
            $status = $request->get('status');
            $query = Settlement::where('user_id', getAuthValue('id'));
            //dd($query);
            if($date_range!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' - ', $date_range);
                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d'); 
                $endDateFormatted = $endDate->format('Y-m-d');
                if($endDateFormatted > $startDateFormatted){
                    $query->whereBetween('created_at', [$startDateFormatted . ' 00:00:00', $endDateFormatted . ' 23:59:59']);
                }
            }

            if($settlement_id!=''){
                $query->where('settlement_id', $settlement_id);
            }

            if($utr_number!=''){
                $query->where('utr_number', $utr_number);
            }
            if($status!=''){
                $query->where('status', $status);
            }
            $settlementList = $query->orderBy('id', 'DESC')
            ->get();

        }else{
            if($request->get('pg')!='All' && $request->get('pg')!=''){
                $request_gateway_name = decryptString($request->get('pg'));
                $request_agent_code = $request->get('agent_code');

                //Get User Details
                if($request_agent_code!=''){
                    $userDetails = User::where('agent_code',$request_agent_code)->first();
                    if($userDetails!=null){
                        $user_id = $userDetails['id'];
                    }else{
                        $user_id = null;
                    }
                }else{
                    $user_id = null;
                }
                //dd($request_agent_code);
                //dd($request_gateway_name);
                $gatewayDetails = $retailerGatewayList[$request_gateway_name];
                //dd($gatewayDetails);
                $request_gateway_id = $gatewayDetails['id']; 
                $gateway_name = $request_gateway_name;
                $settlementList = Settlement::where('gateway_id',$request_gateway_id)
                    ->orderBy('id','desc')
                    ->when($user_id != '', function ($query) use ($user_id) {
                        return $query->where('user_id', $user_id);
                    })
                    ->get();
            }else{
                $settlementList = Settlement::orderBy('id','DESC')->get();
            }
           
        }
        if($user_id!=''){
            $totalAmount = Settlement::where('user_id',$user_id)->where('is_settled',0)->sum('net_amount');
        }else{
            $totalAmount = Settlement::where('is_settled',0)->sum('net_amount');
        }
        $upcommingSettalmentAmount = Settlement::getUpcomingSettalment($user_id,'Amount');
        $upcommingSettalmentTime = Settlement::getUpcomingSettalment($user_id,'Time');
        $prevousSettalAmount = Settlement::getPreviousSettalment($user_id,'Amount');
        $prevousSettaltime = Settlement::getPreviousSettalment($user_id,'Time');
        $todayTotalSettalment = Settlement::getTodaySettalment($user_id,); 
        //dd($todayTotalSettalment);
        $viewPage = 'settalmentList';
        //dd($prevousSettalAmount);
        //dd($this->roleDirectory);
        return view($this->roleDirectory.'.Settalment.'.$viewPage,[
            'userDetails'=>$userDetails,
            'pageTitle'=> "Settalment List",
            'settlementList'=>$settlementList,
            'retailerGatewayList'=>$retailerGatewayList,
            'totalAmount'=>number_format($totalAmount,2),
            'request_gateway_id'=>$request_gateway_id,
            'gateway_name'=>$gateway_name,
            'upcommingSettalmentAmount'=>$upcommingSettalmentAmount,
            'upcommingSettalmentDate'=>$upcommingSettalmentTime,
            'prevousSettalAmount'=>$prevousSettalAmount,
            'prevousSettaltime'=>$prevousSettaltime,
            'retailerGatewayList'=>$gatewaySettalment,
            'todayTotalSettalment'=>$todayTotalSettalment
        ]);
    }





    /**
     * Methode Name instantSettalmentProcess()
     * This Method will help to do the settalment Manual By the Amdin
     * If any settalment Stuck due to some technical issue , then Admin
     * can settal the amount into Retialer Wallet instant.
     * @param settalemnt_id|user_id as payload of Settalment Table and admin user id
     * @method post
     * @return boolean
     */
    public function instantSettalmentProcess(Request $request){
        $settlementString = $request->get('payload');
        if($settlementString!=''){
            $settlementArray = Crypt::decryptString($settlementString);
            list($settalment_id, $user_id) = explode('|',$settlementArray);
            if($user_id == getAuthValue('id')){
                $settalment = Settlement::where('is_settled',0)->where('id',$settalment_id)->first();
                if($settalment){
                      $res = $this->makeSettalmentStatusFromCreatedToProccessed($settalment);
                    if($res['status']){
                       return response()->json(['status'=>true,'message'=>'Settalment Done.']);
                    }else{
                        return response()->json(['status'=>false,'message'=> $res['message']]);
                    }
                }else{
                    return response()->json(['status'=>'error','message'=>'Settalment Not Found To be Settal.']);
                }
            }else{
                return response()->json(['status'=>'error','message'=>'You are not authorized to do this action']);
            }
        }else{
            return response()->json(['status'=>'error','message'=>'Invlaid Payload, Please try after sometime.']);
        }
    }




    /**
     * Method: Update Settalment Status
     */
    private function makeSettalmentStatusFromCreatedToProccessed(Settlement $settalment){
        DB::beginTransaction();
        try {
            $settalmentSettingDetails = SettlementSetting::where('user_id',$settalment->user_id)
            ->where('gateway_id',$settalment->gateway_id)
            ->first();
            if (!$settalmentSettingDetails) {
                Log::debug("Settalment Not Enabled in Settalment Controller ".date("d M,Y | H:i:s A"));
                return ['status'=>false,'message'=>"Settalment Not Enabled."];
            }
            if($settalmentSettingDetails->domestic_settlement=='Enable'){
                //dd($settalmentSettingDetails);
                $settalmentObj = Settlement::find($settalment->id);
                $settalmentObj->status = 'Processed';
                $settalmentObj->is_settled = 1;
                $settalmentObj->settled_at = date('Y-m-d H:i:s');
                $settalmentObj->utr_number = generateRandomAlphabetString(15);
                if($settalmentObj->save()){
                    $amount = $settalmentObj->net_amount;
                    $receiver_id = $settalmentObj->user_id;
                    $sender_id = $settalmentObj->user_id; 
                    $description = 'Settlement Amount By Admin';
                    $transaction_id = $settalmentObj->transaction_id;
                    $lastWalletInsertId = $this->walletService->credit($amount, $receiver_id, $sender_id,  $description,'Success', $transaction_id);
                    if($lastWalletInsertId){
                        Log::debug("Settalment Process done with amount credit into wallet in makeSettalmentStatusFromCreatedToProccessed in Settalment Controller ".date("d M,Y | H:i:s A"));
                        DB::commit();
                        return ['status'=>true,'message'=>"Settalment Process done with amount."];
                    }
                }else{
                    Log::debug("Settalment Not Process due some issue with update query makeSettalmentStatusFromCreatedToProccessed in Settalment Controller ".date("d M,Y | H:i:s A"));
                    return ['status'=>false,'message'=>"settalment Not proccessed, Please try after sometime."];
                }
            }else{
                Log::debug("Settalment Not Enabled in Settalment Controller ".date("d M,Y | H:i:s A"));
                return ['status'=>false,'message'=>"Settalment Not Enabled."];
            }
           
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug("Settalment Process Amount Found To be Settaled.".date("d M,Y | H:i:s A"));
            // Handle the exception, log, or throw further
        }
    }

    




}
