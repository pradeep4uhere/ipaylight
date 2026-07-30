<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateGeneratePaymentLinkRequest;
use Illuminate\View\View;
use App\Models\User;
use App\Models\PaymentLink;


class PaymentPageController extends Controller
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentLink $paymentLink)
    {
        $paymentLink->delete();

        return redirect()->back()->with('success', 'Payment link deleted successfully.');
    }



     
    /**
     * Payment Page
     */
    public function paymentPage(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'Payment Page'
            
        ]);
    }




    /**
     * Payment Link
     */
    public function paymentLink(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'Payment Link'
            
        ]);
    }



    /**
     * This  method will process the payment with Retailer Profile
     * Genertate New Payment Link For Gateway
     */
    public function generatePaymentLink(Request $request)
    {
        if(!$this->isPermittedAction('GENERATE_PAYMENT_LINK')){
            return view('unauthorizedPage');
        }
        //Get All Payment Gateway For this Retailer
        $userCommissionList = parent::getRetailerGateways();
        //dd($userCommissionList);
        $viewPage = 'Retailer.retailerContentBodyPage';
        $elementPage = 'Retailer.PaymentPage.PaymentPage';
        
        return view($viewPage,[
            'pageTitle'=>'Payment Link',
            'element'=>$elementPage,
            'gatewayList'=> $userCommissionList
        ]);
    }



    /**
     * This  method will process the payment with Retailer Profile
     * Genertate New Payment Link For Gateway
     */
    public function savePaymentLink(CreateGeneratePaymentLinkRequest $request)
    {
        if($request->isMethod('post')){
            try {
               //dd($request->all());
                if(array_key_exists('id',$request->all())){
                    $paymentLink = PaymentLink::find($request->get('id'));
                }else{
                    $paymentLink = new PaymentLink();
                }
                $paymentLink->fill($request->validated());
                $paymentLink->user_id = getAuthValue('id');
                $paymentLink->max_amount = $request->get('amount');
                $paymentLink->payment_link = $this->getRandomString(10);
                if(!array_key_exists('status', $request->all())){
                    $paymentLink->status = 'InActive';
                }
                if($request->get('status')==0){
                    $paymentLink->status = 'InActive';
                }
                //dd($paymentLink);
                $paymentLink->save();
                return Redirect::back()->with('success', 'Payment Link Generated Successfully.'); 
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Redirect back with validation errors if validation fails
                return Redirect::back()->withErrors($e->validator->errors())->withInput();
            }  
        }
    }


    /**
     * This  method will process the payment with Retailer Profile
     * Genertate New Payment Link For Gateway
     */
    public function myPaymentLink(Request $request): View
    {
        //Get All Payment Gateway For this Retailer
        $editPaymentLinkDetails = [];
        $userCommissionList = parent::getRetailerGateways();
        //dd($userCommissionList);
        $paymentLink = PaymentLink::with('Gateway')->where('user_id',$this->getAuthUserId())->orderBy('id','DESC')->orderBy('status','ASC')->get();
        //dd($c);
        $viewPage = 'Retailer.retailerContentBodyPage';
        $elementPage = 'Retailer.PaymentPage.PaymentLinks';
        return view($viewPage,[
            'pageTitle'=>'Payment Link',
            'element'=>$elementPage,
            'gatewayList'=> $userCommissionList,
            'paymentLink'=>$paymentLink,
            'editPaymentLinkDetails'=>$editPaymentLinkDetails
        ]);
    }




    /**
     * This  method will process the payment with Retailer Profile
     * Genertate New Payment Link For Gateway
     */
    public function editlinkMyPaymentLink(Request $request, $id): View
    {
        $payment_link_id = decryptstring($id);
        $editPaymentLinkDetails = PaymentLink::with('Gateway')->find($payment_link_id);
        //dd($editPaymentLinkDetails);
        //Get All Payment Gateway For this Retailer
        $userCommissionList = parent::getRetailerGateways();
        //dd($userCommissionList);
        $paymentLink = PaymentLink::with('Gateway')
        ->where('user_id',$this->getAuthUserId())
        ->orderByRaw("status = 'Active' DESC")
        ->orderBy('id','DESC')->get();
        //dd($c);
        $viewPage = 'Retailer.retailerContentBodyPage';
        $elementPage = 'Retailer.PaymentPage.PaymentLinks';
        return view($viewPage,[
            'pageTitle'=>'Payment Link',
            'element'=>$elementPage,
            'gatewayList'=> $userCommissionList,
            'paymentLink'=>$paymentLink,
            'editPaymentLinkDetails'=>$editPaymentLinkDetails
        ]);
    }


    

    /********************************************************************/
    /********************************************************************/
    /********************************************************************/
    /********************************************************************/
    /**********************DISTRIBUTOR SECTION START**********************/


    /**
     * Method Name: retailerPaumentLinks
     * @param $user_id
     * @return Array Payment Links
     */
    public function retailerPaymentLinks(Request $request, User $user){
         //Get All Payment Gateway For this Retailer
         $editPaymentLinkDetails = [];
         $userCommissionList = parent::getRetailerGateways();
         //dd($userCommissionList);
         $paymentLink = PaymentLink::with('Gateway')->where('user_id',$user->id)->orderBy('id','DESC')->orderBy('status','ASC')->get();
         //dd($c);
         //$elementPage = 'Distributor.Retailer.AjaxLoadingPage';
         $viewPage = 'Retailer.PaymentPage.PaymentLinks';
         return view($viewPage,[
             'pageTitle'=>'Payment Link',
             //'element'=>$elementPage,
             'gatewayList'=> $userCommissionList,
             'paymentLink'=>$paymentLink,
             'editPaymentLinkDetails'=>$editPaymentLinkDetails
         ]);

    }




    /**
     * Method Name: generatePaymentLinkForRetailer()
     * @param Request $request
     * @return \Illuminate\Http
     * @param User $user | store Data into $userProfile
     * @return Form View Page Payment Links Form
     */
    public function generatePaymentLinkForRetailer(Request $request, User $user)
    {
        //Get All Payment Gateway For this Retailer
        $userCommissionList = parent::getRetailerGateways($user);
        //dd($userCommissionList);
        $viewPage = 'Distributor.Retailer.AjaxLoadingPage';
        $elementPage = 'Distributor.Retailer.PaymentPage.PaymentPage';
        
        return view($viewPage,[
            'pageTitle'=>'Payment Link',
            'element'=>$elementPage,
            'gatewayList'=> $userCommissionList,
            'userProfile'=>$user
        ]);
    }




    /**
     * Method Name: savePaymentLinkForRetailer()
     * @param Request $request
     * @return \Illuminate\Http
     * @param User $user | store Data into $userProfile
     * @return Redirect to back 
     */
    public function savePaymentLinkForRetailer(CreateGeneratePaymentLinkRequest $request, User $user)
    {
        if($request->isMethod('post')){
            try {
               //dd($request->all());
                if(array_key_exists('id',$request->all())){
                    $paymentLink = PaymentLink::find($request->get('id'));
                }else{
                    $paymentLink = new PaymentLink();
                }
                $paymentLink->fill($request->validated());
                $paymentLink->user_id = getAuthValue('id');
                $paymentLink->max_amount = $request->get('amount');
                $paymentLink->payment_link = $this->getRandomString(10);
                if(!array_key_exists('status', $request->all())){
                    $paymentLink->status = 'InActive';
                }
                if($request->get('status')==0){
                    $paymentLink->status = 'InActive';
                }
                //dd($paymentLink);
                $paymentLink->save();
                return Redirect::back()->with('success', 'Payment Link Generated Successfully.'); 
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Redirect back with validation errors if validation fails
                return Redirect::back()->withErrors($e->validator->errors())->withInput();
            }  
        }
    }

    /**********************DISTRIBUTOR SECTION ENDS**********************/
    /********************************************************************/
    /********************************************************************/
    /********************************************************************/
    /********************************************************************/
    /********************************************************************/
    /********************************************************************/

    

    
}
