<?php

namespace App\Http\Controllers;

use App\Models\Gateway;
use App\Models\PaymentGatewayRate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\GatewayRequest;
use App\Http\Requests\UpdateGatewayRequest;
use Illuminate\Support\Facades\Crypt;


class GatewayController extends Controller
{
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
    public function show(Gateway $gateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gateway $gateway)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gateway $gateway)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gateway $gateway)
    {
        
    }


    /**
     * Add New Payment Gateways.
     */
    public function addNewPaymentGateways(Request $request)
    {
       
        $paymentGatewayList = getPaymentGatewayList();
        //dd($paymentGatewayList);
        $paymentTypeList = getPaymentTypeList();
        return view('Admin.Gateway.addGatewayPage',[
            'pageTitle'=> "Add Payment Gateway",
            'elements'=> "Customer.Profile.profileView",
            'paymentTypeList'=>$paymentTypeList,
            'paymentGatewayList'=>$paymentGatewayList
        ]);
    }
    



    /**
     * Add New Payment Gateways.
     */
    public function savePaymentGateways(Gateway $gateway, GatewayRequest $request)
    {
        if($request->isMethod('post')){
            $gateway_name = $request->get('gateway_name');
            $pg_name = $request->get('pg_name');
            $pg_short_code = $request->get('pg_short_code');
            $pg_client_key = $request->get('pg_client_key');
            $pg_seceret_key = $request->get('pg_secert_key');
            $payout_client_key = $request->get('payout_client_key');
            $payout_secerts_key = $request->get('payout_secerts_key');
            
            $gateway_active = $request->get('gateway_active');
            $payout_active = $request->get('payout_active');
            $payment_type_status = $request->get('payment_type_status');
            $payment_type_value = $request->get('payment_type_value');
            $payment_rate_type =  $request->get('payment_rate_type');
            $payment_mode =  $request->get('mode');
            $payemtnStatusWithBasePrice = [];
            if($payment_type_status===null){
                return redirect()->back()->with('error', "Please select at least one Payment Type.");
            }

            if(isset($payment_type_value)){
                foreach($payment_type_value as $key=>$value){
                    $payemtnStatusWithBasePrice[$key] = [
                        'is_active' => (array_key_exists($key, $payment_type_status)? $payment_type_status[$key] : 0), 
                        'base_rate'=>  (array_key_exists($key, $payment_type_value)? $payment_type_value[$key] : '0.00'),
                        'rate_type'=>  (array_key_exists($key, $payment_rate_type)? $payment_rate_type[$key] : 'Percentage')
                    ];
                }
            }
           
            try{
                //dD($request->payout_active);
                $gateway = Gateway::create([
                    'gateway_name' => $request->gateway_name,
                    'pg_name' => $request->pg_name,
                    'pg_short_code' => $request->pg_short_code,
                    'pg_client_key' => $request->pg_client_key,
                    'pg_seceret_key' => $request->pg_secert_key,
                    'payout_client_key' => $request->payout_client_key,
                    'payout_secerts_key' => $request->payout_secerts_key,
                    'gateway_active' => $request->gateway_active,
                    'payout_active' => $request->payout_active,
                    'mode'=>$payment_mode,
                    'payment_type_status_and_rate' => serialize($payemtnStatusWithBasePrice),
                ]);
                
                if($gateway){
                    $typeRateArray = [];
                    foreach($payemtnStatusWithBasePrice as $k=>$val){
                        $typeRateArray=[
                            'gateway_id'=>$gateway->id,
                            'payment_type'=>$k,
                            'rate'=>$val['base_rate'],
                            'rate_type'=>$val['rate_type'],
                            'is_active'=>$val['is_active']
                        ];
                        PaymentGatewayRate::create($typeRateArray);
                    }
                   
                    return redirect()->route('allgateway')->with('success', 'Payment Gateways Added successfully.');
                }
            } catch (\Illuminate\Database\QueryException $e) {
                if($e->getMessage()){
                    //session()->flash('error', "Data Not Saved, Please try again.");
                    return redirect()->back()->with('error', $e->getMessage());
                    //return redirect()->back()->with('error', 'Payment Gateways Not Addedd.');
                }else{
                    //session()->flash('error', $e->getMessage());
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
        }
        
    }


    private function  savePaymentRates($gateWayId, $paymentRates){

    }
    



    
     /**
     * Add New Payment Gateways.
     */
    public function allGatewaysList(Gateway $gateway, Request $request){
        //Get All Gateway
        $list = Gateway::with('PaymentGatewayRate')->get();
        //dd($list);
        return view('Admin.Gateway.allGatewayList',[
            'pageTitle'=> "All Payment Gateway",
            'list'=>$list
        ]);
    }



     /**
     * Edit Payment Gateways.
     */
    public function editPaymentGateways(Gateway $gateway, Request $request, $id){
        $gateway_id = Crypt::decryptString($id);
        $details = Gateway::with('PaymentGatewayRate')->find($gateway_id);
        $paymentGatewayList = getPaymentGatewayList($details['gateway_name']);
        $paymentTypeList = getPaymentTypeList();
       
        return view('Admin.Gateway.editGatewayPage',[
            'pageTitle'=> "Edit Payment Gateway",
            'details'=>$details,
            'paymentTypeList'=>$paymentTypeList,
            'paymentGatewayList'=>$paymentGatewayList,
        ]);
    }
    




    /**
     * Add New Payment Gateways.
     */
    public function updatePaymentGateways(Gateway $gateway, UpdateGatewayRequest $request)
    {
        if($request->isMethod('post')){
            $id = $request->get('id');
            $gateway = Gateway::find($id);
            $gateway->gateway_name = $request->get('gateway_name');
            $gateway->pg_name = $request->get('pg_name');
            $gateway->pg_short_code = $request->get('pg_short_code');
            $gateway->pg_client_key = $request->get('pg_client_key');
            $gateway->pg_seceret_key = $request->get('pg_secert_key');
            $gateway->payout_client_key = $request->get('payout_client_key');
            $gateway->payout_secerts_key = $request->get('payout_secerts_key');
            $gateway->mode = $request->get('mode');
            //dd($request->get('gateway_active'));
            if($request->get('gateway_active') == null){
                $gateway->gateway_active = 0;
            }else{
                $gateway->gateway_active = $request->get('gateway_active');
            }
            $gateway->payout_active = $request->get('payout_active');
            $payment_type_status = $request->get('payment_type_status');
            $payment_type_value = $request->get('payment_type_value');
            $payment_rate_type =  $request->get('payment_rate_type');
            $payemtnStatusWithBasePrice = [];
            if($payment_type_status===null){
                return redirect()->back()->with('error', "Please select at least one Payment Type.");
            }
            //dd($payment_rate_type);
            if(isset($payment_type_value)){
                foreach($payment_type_value as $key=>$value){
                    $payemtnStatusWithBasePrice[$key] = [
                        'is_active' => (array_key_exists($key, $payment_type_status)? $payment_type_status[$key] : 0), 
                        'base_rate'=>  (array_key_exists($key, $payment_type_value)? $payment_type_value[$key] : '0.00'),
                        'rate_type'=>  (array_key_exists($key, $payment_rate_type)? $payment_rate_type[$key] : 'Percentage')
                    ];
                }
            }
            //dd($payemtnStatusWithBasePrice);
            try{
              //Delete All Gateway Payment Type List
              if($gateway->save()){
                   PaymentGatewayRate::where('gateway_id',$id)->delete();
                    //Save Payment Type Rate
                    $typeRateArray = [];
                    foreach($payemtnStatusWithBasePrice as $k=>$val){
                        $typeRateArray=[
                            'gateway_id'=>$gateway->id,
                            'payment_type'=>$k,
                            'rate'=>$val['base_rate'],
                            'rate_type'=>$val['rate_type'],
                            'is_active'=>$val['is_active']
                        ];
                        PaymentGatewayRate::create($typeRateArray);
                    }
                    return redirect()->route('allgateway')->with('success', 'Payment Gateways Updated successfully.');
                }
            } catch (\Illuminate\Database\QueryException $e) {
                if($e->getMessage()){
                    //return redirect()->back()->with('error', $e->getMessage());
                    return redirect()->back()->with('error', "Somthing Went Wrong, Please try again later.");
                }else{
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
        }
        
    }
    
    


    
}
