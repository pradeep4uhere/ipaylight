<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Gateway;
use App\Models\Transaction;
use App\Models\PaymentLink;
use App\Models\UserCommissionSetting;
use App\Checkout\PaymentGatewayInterface;
use App\Events\TransactionSuccessful;
use PDF;
use Carbon\Carbon;
use App\Http\Controllers\EmailController;
use App\Services\PdfGenerator;
use Illuminate\Support\Facades\Log;
use App\Checkout\Gateways\PaygeniusGateway;



class PaymentController extends Controller
{

    protected $userId;
    protected $gatewayId;
    protected $transactionId;

    protected $pdfGeneratorService;

    public function __construct(PdfGenerator $pdfGeneratorService)
    {
        $this->pdfGeneratorService = $pdfGeneratorService;
    }

    protected function validateData(Request $request)
    {
        return $request->validate([
            'amount' => 'required|numeric',
            'name' => ['required', 'regex:/^[a-zA-Z]+(\s[a-zA-Z]+)?(\s[a-zA-Z]+)?$/'], // Allow one space between each part
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'descriptions' => ['required', 'regex:/^\S+(\s+\S+)+$/'], // At least two words
        ], [
            'amount.required' => 'Enter Your Ammount.',
            'amount.numeric' => 'Amount must be a number b/w 100 to 199999.',
            'name.required' => 'Enter Valid Customer Name.',
            'name.regex' => 'The name must be 6 alphanumeric characters with no spaces or special characters.',
            'email.required' => 'Enter Valid Customer Email Address.',
            'email.email' => 'Please enter a valid email address.',
            'mobile.required' => 'Enter Customer Mobile Number.',
            'mobile.digits' => 'The mobile field must be 10 digits.',
            'descriptions.required' => 'Enter at least two words in the descriptions field.',
            'descriptions.regex' => 'The descriptions must contain at least two words.',
        ]);
    }

    /**
     * Payment Intiation By User
     * Method user before Going to Checkout
     * Dynamic Payment Gateway Used
     */
    public function checkoutInitiating(Request $request, PaymentGatewayInterface $module){
        //dd($module);
        //dd($request->all());
        $validatedData = $this->validateData($request);
        $result = $module->process($request);
        //dd($result);
        if($result==null){
           return view('Checkout.gatewayNotActivePage',[
            'pageTitle'=>"",
            'gatewayName'=>""
           ]);
        }elseif($result['status']==false && array_key_exists('orderDetails',$result)){
            return redirect()->back()->with([
                'error' => $result['orderDetails']['message']
            ]);
        }elseif($result['status']==false){
            return view('Checkout.gatewayNotActivePage',[
             'pageTitle'=>"",
             'gatewayName'=>""
            ]);
         }else{
            if($result['status']==true){
                $res= $result['orderDetails'];
                $last_transaction_id = $result['transaction_id'];
                if($res['module']=='PG'){
                    $payemnt_return_url = route('payment_callback');
                }else{
                    $payemnt_return_url = route('payemnt_return_url');
                }
                $checkoutDetails = [
                    'order_details'=>json_decode($res['response'],true),
                    'description'=>$request->get("descriptions"),
                    'image'=> asset('logo.svg'),
                    'callback_url'=>$payemnt_return_url,
                    'customer_name'=>$request->get('name'),
                    'customer_email'=>$request->get('email'),
                    'customer_mobile'=>$request->get('mobile'),
                    'user_id'=>$request->get('user_id'),
                    'link_text'=>$request->get('urlText'),
                    'gateway_id'=>$request->get('gateway_id'),
                    'payemnt_type'=>$request->get('payemnt_type'),
                    'key_id'=>$res['key_id'],
                    'amount'=>$request->get('amount'),
                    'last_transaction_id'=>$last_transaction_id,
                    'payment_mode'=>$module->getGatewayConfigurtionMode($request->get('gateway_id'))
                ];
                $checkoutDetailsEncryptString = encryptString(json_encode($checkoutDetails));
                if(array_key_exists('module',$res) && $res['status']){
                    if($res['module']=='CF'){
                        $viewPage = 'Checkout.preProcessingCashFreeCheckout';
                    }elseif($res['module']=='RZ'){
                        $viewPage = 'Checkout.preProcessingCheckout';
                    }elseif($res['module']=='PP'){
                        $viewPage = 'Checkout.preProcessingPhonePeCheckout';
                    }elseif($res['module']=='PG'){
                        $viewPage = 'Checkout.preProcessingPaygeniusPeCheckout';
                    }else{
                        $viewPage = 'Checkout.checkoutError';
                    }
                }else{
                    $viewPage = 'Checkout.checkoutErrorPage';
                }
                return redirect()->route('order_confirmation', ['_check_detail' => $checkoutDetailsEncryptString, '_view_page'=>encryptString($viewPage) ]);
            }
        }
    }





    /**
     * Method Name: orderConfirmationBeforePayment()
     * This Method is use for making payment after Order Creation
     * from backend
     */
    public function orderConfirmationBeforePayment(Request $request){
        $encryptedStringCheckoutDetails = $request->query('_check_detail');
        $encryptedStringviewPage = $request->query('_view_page');
        $checkoutDetailJson = decryptString($encryptedStringCheckoutDetails);
        //dd($checkoutDetailJson);
        $checkoutDetails = json_decode($checkoutDetailJson, true);
        $gateway_id = $checkoutDetails['gateway_id'];
        $gatewayDetails = Gateway::find($gateway_id);
        //dd( $gatewayDetails);
        $checkoutDetails['gateway_name'] = $gatewayDetails['gateway_name'];
        //dd($checkoutDetails);
        $viewPage = decryptString($encryptedStringviewPage);//Just For URL Encryption Remove in future. 
       //die;
        return view($viewPage,[
                'pageTitle'=>'Payment Confirmation',
                'checkoutDetails'=>$checkoutDetails,
                
        ]);
    }


    /**
     * Checkout Page
     * 
     */
    public function checkoutPage(Request $request, $link){
        $paymentLink = PaymentLink::with('User','Gateway')
        ->where('expiry_date', '>=', Carbon::now())
        ->where('payment_link', $link)
        ->first();
        if($paymentLink==null){
            $pageTitle = __('messages.TEMPERORY_SERVICE_NOT_AVAILABLE');
            $viewPage = 'Checkout.gatewayNotActivePage';
            return view($viewPage,[
                'gatewayName'=>"",
                'pageTitle'=>$pageTitle
            ]);
        }
        $paymentMode = $paymentLink->Gateway->mode;
        $isGatewayActive = $paymentLink->Gateway->gateway_active;
        $gatewayName = ucfirst(strtolower($paymentLink->Gateway->gateway_name));
        $agent_user_id = $paymentLink['user_id'];
        $gateway_id =  $paymentLink->gateway_id;
        $userObj = $paymentLink['User'];
       
        $userCommissionList = parent::getRetailerGateways($userObj);
        if($isGatewayActive==1){
            $userPermission = $this->getUserGatewayPermissionAction($paymentLink->Gateway->gateway_name,'gateway_name', $userObj);
            //dd($userPermission);
            if($userPermission){
                $pageTitle = __('messages.CHECKOUT');
                $viewPage = 'Checkout.checkoutPage';
            }else{
                $pageTitle = __('messages.TEMPERORY_SERVICE_NOT_AVAILABLE');
                $viewPage = 'Checkout.gatewayNotActivePage';
            }
        }else{
            $pageTitle = __('messages.SERVICE_NOT_AVAILABLE');
            $viewPage = 'Checkout.gatewayNotActivePage';
        }
        $gatewayList = \Config::get('paymenttype.PAYMENT_GATEWAY');
        return view($viewPage,[
            'pageTitle'=>$pageTitle,
            'gatewayList'=>$userCommissionList,
            'gateway_id'=>$gateway_id,
            'link'=>$link,
            'agent_user_id'=>$agent_user_id,
            'paymentMode'=>$paymentMode,
            'gatewayName'=>$gatewayName
        ]);

    }






    /**
     * Method Name: paymentReturnStatusURL
     * this method help to update the trnasction table after successfully payment done
     * to payment gateway.
     * @param Request $request
     * @return void
     */
    public function paymentReturnStatusURL(Request $request, PaymentGatewayInterface $module){
        Log::debug(" paymentReturnStatusURL - ".json_encode($request->all()));
        //die;
        //dd($module);
        //Update Transaction Table After Payment Success
        //dd($request->all());
        //dd($module);
        $result = $module->paymentReturnStatus($request);
        //dd($result);
        $transactionObj = $result['transactionTable'];
        $this->userId = $transactionObj->user_id;
        $this->gatewayId = $transactionObj->gateway_id;
        $this->transactionId = $transactionObj->id;
        if($result['status']===true){
            //@pram will be Result of previous result
            $paymentMethodType = $module->getCurrentPaymentType($result['transactionTable']);
            //dd($paymentMethodType);
            $rateRow = $this->getRateOfPaymentType($paymentMethodType);
            $isAmountDeposited = $this->updateAmountAfterCommission($rateRow);
            if($isAmountDeposited){
            //Send Email Confirmation to User and Admin
            //$this->pdfGeneratorService->pdfGenerationAndSave($this->transactionId);
            EmailController::trasncationNotificationEmail($this->transactionId);
            return Redirect::route('payment_success',['ltid'=>encryptString($this->transactionId)])->with('status', 'Payment Success.');
            }
        
        }else{
            return Redirect::route('payment_failed',['ltid'=>encryptString($this->transactionId)])->with('status', 'Payment Success.');
            parent::writeError('Error paymentReturnStatusURL() Transaction Not Completed or not Success.');
        }
    }



    /**
     * Method Name: updateAmountAfterCommission
     * This method will update the amount based on user commission rate into Transaction Table
     * as Deposite Amount
     * @param object $transactionObj
     * @return Void
     */
    private function updateAmountAfterCommission($rateRow){
        //dd($rateRow);
        if($this->userId!='' &&  $this->gatewayId!='' && $this->transactionId!=''){
            $transactionDetails = Transaction::where('user_id',$this->userId)
            ->where('gateway_id',$this->gatewayId)
            ->where('id',$this->transactionId)
            ->first();
            //dd($transactionDetails);
            if($transactionDetails){
                $rate = $rateRow['rate'];
                $rateType = $rateRow['rate_type'];
                $paymentAmount = $transactionDetails->amount;
                $depositeAmount = parent::getDepositeAmount($paymentAmount, $rate , $rateType);
                if($depositeAmount){
                    $transactionDetails->deposite_amount = $depositeAmount;
                    $transactionDetails->status = "Success";
                    $transactionDetails->rate_fee = $rate;
                    //dd("dasd");
                    if($transactionDetails->save()){
                        //dd($transactionDetails);
                        event(new TransactionSuccessful($this->transactionId, $this->userId));
                        return true;
                    }else{
                        parent::writeError('Error updateAmountAfterCommission() transaction not Updated');
                    }
                }else{
                    parent::writeError('Error updateAmountAfterCommission() transaction not Updated due to depositeAmount is not valid amount.');
                }
            }else{
                parent::writeError('Error updateAmountAfterCommission() transactionDetails is missing');
            }
        }else{
            parent::writeError('Error updateAmountAfterCommission() userId or gatewayId or  transactionId is missing');
        }
    }
     




    /***
     * Method Name: Get Rate From UserCommission Table
     * @param text i.e CREDIT_CARD, CORPORTE_CARD, AMERICAN_EXPRESS_CARD
     * @return UserCommission Row based on Payemnt Type
     */
    private function getRateOfPaymentType($payemntType){
        if($this->userId!='' &&  $this->gatewayId!=''){
            $usercommissionArr = UserCommissionSetting::where('user_id', $this->userId)
            ->where('gateway_id', $this->gatewayId)
            ->get();
            //dd( $usercommissionArr);
            if($usercommissionArr){
                foreach($usercommissionArr as $key=>$value){
                    if(strtolower($value['payment_type'])==strtolower($payemntType)){
                        
                        return $value->toArray();
                    }
                }
            }else{
                parent::writeErrorLog('Error getRateOfPaymentType() usercommissionArr is empty');
                return null;
                
            }
        }else{
            parent::writeErrorLog('Error getRateOfPaymentType() userId and gatewayId is empty');
            return null; 
        }
    }




    /**
     * Method Name: paymentSuccess()
     */
    public function paymentSuccess(Request $request, $ltid){
        $transaction_id = decryptString($ltid);
        if($transaction_id){
            $transactionDetails = Transaction::find($transaction_id);
            //$this->pdfGeneratorService->pdfGenerationAndSave($transaction_id);
            //$this->generateInvoice($transactionDetails);
            //dd($transactionDetails);
        }else{
            dd("Invalid Payload");
        }
        $resultData = [
            'paymentDate'=>$transactionDetails->created_date,
            'amount'=> $transactionDetails->amount,
            'customer_name'=>$transactionDetails->customer_name,
            'customer_mobile'=>$transactionDetails->customer_mobile,
            'customer_email'=>$transactionDetails->customer_email,
            'company_name'=>env('APP_NAME'),
            'payment_status'=>$transactionDetails->status,
            'company_address'=>env('APP_ADDRESS'),
            'company_contact'=>env('APP_CONTACT'),
            'payment_reference'=>$transactionDetails->gateway_payment_id,
            'transaction_number'=>$transactionDetails->txn_id,
            'paymentType'=>$transactionDetails->payment_type,
            'order_id'=>$transactionDetails->order_id,
            'payment_method'=>$transactionDetails->method,
            'description'=>$transactionDetails->description,
            'ip_address'=>$transactionDetails->ip_address,
            'user_browser'=>$transactionDetails->user_browser,
            'userAgent'=>$transactionDetails->userAgent,
            'location'=>$transactionDetails->location,
            'gst'=>'0.00',
            'convenience_fee'=>'0.00',
            'error_description'=>$transactionDetails->error_description,
            'totalAmount'=>$transactionDetails->amount,
            'created_at'=>$transactionDetails->created_at
        ];
        if($resultData['payment_status']=='Pending'){
            $viewPage = 'Checkout.paymentFailed';
        }elseif($resultData['payment_status']=='Success'){
            $viewPage = 'Checkout.paymentSuccess';
        }else{
            $viewPage = 'Checkout.paymentFailed';
        }
        return view($viewPage,[
            'pageTitle'=>'Payment Confirmation',
            'resultData'=>$resultData
        ]);
    }




    public function generateInvoice($transactionDetails){
        // Generate PDF
        $pdf = PDF::loadView('Invoices.invoices', compact('transactionDetails'));
        // Download the PDF
        //dd($pdf->download('invoice.pdf'));
        return $pdf->download('invoice.pdf');
    }
    
    
    
    
    /**
     * Method Name: paymentReturnCallbackStatus
     * this method help to update the trnasction table after successfully payment done
     * to payment gateway.
     * @param Request $request
     * @return void
     */
    public function paymentCallBackStatus(Request $request,PaymentGatewayInterface $module){
        Log::debug("Transaction Callback paymentCallBackStatus - ".json_encode($request->all()));
        $module = new PaygeniusGateway();
        $result = $module->paymentReturnStatus($request);
        Log::debug("paymentReturnStatus Callback Status - ".json_encode($result));
        $transactionObj = $result['transactionTable'];
        $this->userId = $transactionObj->user_id;
        $this->gatewayId = $transactionObj->gateway_id;
        $this->transactionId = $transactionObj->id;
        if($result['status']===true){
            //@pram will be Result of previous result
            $paymentMethodType = $module->getCurrentPaymentType($result['transactionTable']);
            //dd($paymentMethodType);
            $rateRow = $this->getRateOfPaymentType($paymentMethodType);
            $isAmountDeposited = $this->updateAmountAfterCommission($rateRow);
            if($isAmountDeposited){
            //Send Email Confirmation to User and Admin
            //$this->pdfGeneratorService->pdfGenerationAndSave($this->transactionId);
            EmailController::trasncationNotificationEmail($this->transactionId);
            //return Redirect::route('payment_success',['ltid'=>encryptString($this->transactionId)])->with('status', 'Payment Success.');
            }
        
        }else{
            //return Redirect::route('payment_failed',['ltid'=>encryptString($this->transactionId)])->with('status', 'Payment Success.');
            parent::writeError('Error paymentReturnStatusURL() Transaction Not Completed or not Success.');
        }
    }

}
