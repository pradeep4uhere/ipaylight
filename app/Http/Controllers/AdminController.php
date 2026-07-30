<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserKycUpdateRequest;
use App\Http\Requests\UserBankAccountUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\LoginHistory;
use App\Models\Gateway;
use App\Models\Transaction;
use App\Models\SettlementSetting;
use App\Models\Settlement;

use App\Models\UserCommissionSetting;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use DateTime; // Make sure to include this
use DateInterval;
use DatePeriod;
use App\Models\Ticket;





class AdminController extends Controller
{

    protected $roleDirectory = 'Admin';


    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
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
    public function destroy(string $id)
    {
        //
    }



    /**
     * Admin Dashboard.
     */
    public function dashboard(Request $request)
    {
        $dashboardItem = [];
        $user = Auth::user();

        //Total Amount
        $transactionList = Transaction::getTransactionList('all');
        $totalAmount = $transactionList->sum('amount');
        $totalCount = $transactionList->count();

         //Total Today
        $transactionTodayList = Transaction::getTransactionList('today');
        $totalToday = $transactionTodayList->sum('amount');
        $totalTodayCount = $transactionTodayList->count();

        //Total Week
        $transactionWeekList = Transaction::getTransactionList('week');
        $totalOfWeek = $transactionWeekList->sum('amount');
        $totalWeekCount = $transactionWeekList->count();

        //Total Month
        $transactionMonthList = Transaction::getTransactionList('month');
        $totalOfMonth = $transactionMonthList->sum('amount');
        $totalMonthCount = $transactionMonthList->count();

        // Total Failed Amount
        $transactionFailedList = Transaction::getTransactionList('all','failed');
        $totalFailedAmount = $transactionFailedList->sum('amount');
        $totalFailedCount = $transactionFailedList->count();

        //Get Total User
        $userList= User::where('role','!=','admin')->get();
        $totalUserCount = $userList->count();


         //Total Amount
         $latesttransactionList = Transaction::getTransactionList('all')->take(10);
         //dd($latesttransactionList);
         if ($latesttransactionList->count() > 0) {
            $lastPaymentDetails = $latesttransactionList->first();
         }else{
            $lastPaymentDetails = [];
         }
         //dd($lastPaymentDetails);
         //Get {{getLocalText('latest_wallet_transaction')}}s
         $last30DaysTransaction = Transaction::getSaleLast30Days();
         $dataOfAmountValues = array_values($last30DaysTransaction);
         $salesPerDays = json_encode($dataOfAmountValues);

         //Get {{getLocalText('latest_support_ticket')}}s
         $ticketList = Ticket::getLatestSupportTickets();

         $allwalletTransactions = $this->getWalletTransactionsList($user,10);
         if(!empty($allwalletTransactions)){
            $lastWalletTransactions = $this->getLastCommission($user);
         }else{
            $allwalletTransactions = [];
         }

        $dashboardItem = [
            'user'=> $user,
            'walletTransactions' => $this->getWalletTransactionsList($user,10),
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
            'TotalRecivedAmount'=> $totalAmount,
            'totalCount'=>$totalCount,
            'TotalRecivedTodayAmount'=> $totalToday,
            'totalTodayCount'=>$totalTodayCount,
            'TotalRecivedWeekAmount'=>$totalOfWeek,
            'totalWeekCount'=>$totalWeekCount,
            'TotalFailedAmount'=>$totalFailedAmount,
            'totalFailedCount'=>$totalFailedCount,
            'totalOfMonthAmount'=>$totalOfMonth,
            'totalMonthCount'=>$totalMonthCount,
            'totalUserCount'=>$totalUserCount,
            'transactionList'=>$latesttransactionList,
            'chartItem'=>['days'=>$this->getLastTenDays(),'sales'=>$salesPerDays],
            'lastPayment'=>$lastPaymentDetails,
            'ticketList'=>$ticketList,
        ];
        //dd($dashboardItem['chartItem']['days']);
        return view('Admin.dashboard',[
            'dashboardItem' => $dashboardItem
        ]);
    }


    
  /**
     * Method Name: Today Commission getLastCommission()
     * @param user_id
     * @return interger
     */
    private function getLastCommission(User $user){
        return WalletTransaction::getLastWalletTransaction($user->id);
    }
    


    /**
     * Admin Transction List.
     */
    public function transaction(Request $request)
    {
       

        //dd($transactionList);
        $transactionSucessList = Transaction::where('status', 'Success')
        ->orderBy('id','DESC')
        ->get();
        $totalAmount = $transactionSucessList->sum('amount');
        $transactionsummary['TotalAmount'] = $totalAmount;

        // Get the current date
        $currentDate = Carbon::now()->toDateString();
        $transactionTodaySucessList = Transaction::where('status', 'Success')
        ->whereDate('created_at', $currentDate)
        ->orderBy('id','DESC')
        ->get();
        $totalTodayAmount = $transactionTodaySucessList->sum('amount');
        $transactionsummary['TotalTodayAmount'] = $totalTodayAmount;


        //Calculate Failed Payments
        $transactionFailedList = Transaction::where('status', 'Success')
        ->orderBy('id','DESC')
        ->get();
        $totalFailedAmount = $transactionFailedList->sum('amount');
        $transactionsummary['TotalFailedAmount'] = $totalFailedAmount;

        if($request->isMethod('post')){
            $mobile = $request->get('mobile');
            $txn_number = $request->get('txn_number');
            $date_range = $request->get('date_range');
            $status = $request->get('status');
            $query = Transaction::with(['User','Gateway'])->orderBy('id', 'DESC');

            if($mobile!=''){
                $query->where('customer_mobile',$mobile);
            }

            if($txn_number!=''){
                $query->where('txn_id',$txn_number);
            }

            if($date_range!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' to ', $date_range);

                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereBetween('transactions.created_at', [$startDateFormatted, $endDateFormatted]);
            }
            $transactionList = $query->get();

        }else{
            $transactionList = Transaction::with(['User','Gateway'])->orderBy('id','DESC')->get();
        }

        return view($this->roleDirectory.'.Transaction.transactionList',[
            'pageTitle'=>'Transaction List',
            'transactionList'=>$transactionList,
            'transactionsummary'=>$transactionsummary
        ]);
    }


            /**
             * Method Name: Transaction Details
             * Get Transcation Details Based on Transaction id
             * @param  Request $request
             * @return \Illuminate\Http\Response
             * @param encrypted string  $trxId
             */
            public function getTransactionDetails(Request $request){
                try{
                    $transactionIdStr = $request->get('ltid');
                    $transactionId = Crypt::decryptString($transactionIdStr);
                    if (!isset($transactionId)) {
                        return response()->json([
                            'status' => false,
                            'message' => "Invalid Parameter."
                        ], 401);
                    } else {
                    
                        $transactionDetails = Transaction::select('transactions.*', 'gateways.gateway_name')
                        ->join('gateways', 'transactions.gateway_id', '=', 'gateways.id')
                        ->where('transactions.id', $transactionId)
                        ->first();
                        if($transactionDetails){
                        $taxAmount = parent::calculateTaxFromAmount($transactionDetails->amount,$transactionDetails->rate_fee);
                        $gstAmount = parent::calculateGstAmount($taxAmount);
                        $carddetails = $transactionDetails->card;
                        $cardArray = json_decode($carddetails, true);
                        //dd($cardArray);
                        if ($cardArray !== null && json_last_error() === JSON_ERROR_NONE) {
                            if($transactionDetails->gateway_name=='CASHFREE'){
                                $nameOnCard = '';
                                $last4digitCard = $cardArray['card_number'];
                                $cardBankType = $cardArray['card_network'] .' | '. $cardArray['card_bank_name'];
                                $cardType = $cardArray['card_type'];
                                $cardInternational = false;
                            }else if($transactionDetails->gateway_name=='EASEBUZZ'){
                                $nameOnCard = '';
                                $last4digitCard = $cardArray['card_number'];
                                $cardBankType = $cardArray['card_network'] .' | '. $cardArray['card_bank_name'];
                                $cardType = $cardArray['card_type'];
                                $cardInternational = false;
                            }else if($transactionDetails->gateway_name=='RAZORPAY'){
                                $nameOnCard = $cardArray['name'];
                                $last4digitCard = $cardArray['last4'];
                                $cardBankType = $cardArray['network'];
                                $cardType = $cardArray['type'];
                                $cardInternational = $cardArray['international'];
                            }else{
                                $nameOnCard = '-NA-';
                                $last4digitCard = '-NA-';
                                $cardBankType = '-NA-';
                                $cardType = '-NA-';
                                $cardInternational = '-NA-';
                            }
                        }else{
                            $nameOnCard = '-NA-';
                            $last4digitCard = '-NA-';
                            $cardBankType = '-NA-';
                            $cardType = '-NA-';
                            $cardInternational = '-NA-';
                        }
                        //Location Details
                        $locationetails = $transactionDetails->location;
                        $locationetailsArray = json_decode($locationetails, true);
                        $resultData = [
                            'paymentDate'=>$transactionDetails->created_date,
                            'amount'=> $transactionDetails->amount,
                            'customer_name'=>$transactionDetails->customer_name,
                            'customer_mobile'=>$transactionDetails->customer_mobile,
                            'customer_email'=>$transactionDetails->customer_email,
                            'company_name'=>env('APP_NAME'),
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
                            'tax_amount'=>$taxAmount,
                            'gst_amount'=>$gstAmount,
                            'rate_fee'=>$transactionDetails->rate_fee,
                            'deposite_amount'=>$transactionDetails->deposite_amount,
                            'convenience_fee'=>'0.00',
                            'totalAmount'=>$transactionDetails->amount,
                            'status'=>$transactionDetails->status,
                            'card'=>[
                                'nameOnCard'=>$nameOnCard,
                                'last4digitCard' =>$last4digitCard,
                                'cardBankType' => $cardBankType,
                                'cardType' => $cardType,
                                'cardInternational' => $cardInternational,
                            ],
                            'location'=>$locationetailsArray,
                            'user_browser'=>$transactionDetails->user_browser,
                            'user_device'=>$transactionDetails->userAgent,
                            'settalmentDate'=>$this->getSettalmentTime($transactionDetails->created_date, $transactionDetails->payment_type)
                        ];
                        }else{
                            $resultData = [];
                        }
                        return view($this->roleDirectory.'.Transaction.TransactionDetails',[
                            'pageTitle'=>'Transaction Details',
                            'resultData'=>$resultData
                        ]);
                    }
                }catch (DecryptException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => "Error: " . $e->getMessage()
                    ], 500);
                }     
        
        
        }





        /***
         * Method Name: Transcation Details In View Page
         * @params Transaction Id of the table
         * @return view page
         */
        public function getTransactionDetailsInView(Request $request, $tid){
            try{
                $transactionIdStr = $tid;
                $transactionId = Crypt::decryptString($transactionIdStr);
                if($transactionId ){
                    $transactionDetails = Transaction::getTransactionDetails($transactionId);
                    //dD($transactionDetails);
                    $transactionDetails['settalmentDate'] = $this->getSettalmentTime($transactionDetails['paymentDate'], $transactionDetails['paymentType']);
                    return view($this->roleDirectory.'.Transaction.TransactionViewPage',[
                        'pageTitle'=>'Transaction Details',
                        'resultData'=>$transactionDetails
                    ]);
                }else{
                    return  back()->with('error', __('Transaction Not Found with requested parameters.'));
                }
            }catch (DecryptException $e) {
                return  back()->with('error', __('Invalid Payload, Please try again.'));
            }  
        }





    /****
     * Admin Method
     * Wallet Transaction List In Admin Section
     * This Dashboard only can seen in admin
     */
    public function allWalletTransactionsList(Request $request){
        $user = Auth::user();
        if($request->isMethod('post')){
            //dd($request->all());
            $refernce_number = $request->get('refernce_number');
            $user_id = $request->get('user_id');
            $days = $request->get('days');
            $date_range = $request->get('date_range');
            $status = $request->get('status');
            $txn_number = $request->get('txn_number');
            $query = WalletTransaction::OrderBy('id', 'DESC');
            
            if($refernce_number!=''){
                $query->where('reference_number', 'like', '%'.$refernce_number.'%');
            }

            if($txn_number!=''){
                $query->where('transaction_id', 'like', '%'.$txn_number.'%');
            }
            
            if($user_id!=''){
                $query->where('sender_id', $user_id);
            }
            if($status!=''){
                $query->where('transaction_type', $status);
            }
            if($date_range!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' to ', $date_range);

                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereBetween('created_at', [$startDateFormatted, $endDateFormatted]);
                //dd('date_range');
            }
            $transactionList = $query->get();
            $dashboardItem = [
                'walletBalance' => number_format($this->getWalletBalance($user),2),
                'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
                'walletTransactions' => $transactionList,
                'totalWalletCredit'=> number_format($this->getWalletTotalAmount($user, 'Credit'),2),
                'totalWalletDebit'=> number_format($this->getWalletTotalAmount($user, 'Debit'),2),
                'totalWalletPending'=> number_format($this->getWalletTotalAmount($user, 'Pending'),2),
                'totalWalletReversal'=> number_format($this->getWalletTotalAmount($user, 'Reversal'),2),
            ];
            
        }else{
            //dd('dad');
            $dashboardItem = [
                'walletBalance' => number_format($this->getWalletBalance($user),2),
                'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
                'walletTransactions' => $this->getWalletTransactionsList($user,10),
                'totalWalletCredit'=> number_format($this->getWalletTotalAmount($user, 'Credit'),2),
                'totalWalletDebit'=> number_format($this->getWalletTotalAmount($user, 'Debit'),2),
                'totalWalletPending'=> number_format($this->getWalletTotalAmount($user, 'Pending'),2),
                'totalWalletReversal'=> number_format($this->getWalletTotalAmount($user, 'Reversal'),2),
            ];
        }
        //dd($dashboardItem);
        $user->dashboardItem = (object) $dashboardItem;
        $viewPage = 'Admin.Wallet.walletTransactionsList';
        return view($viewPage,[
            'pageTitle'=> "Admin Wallet Transactions",
            'userProfile'=>$user,
        ]);
        
    }


     /****
     * Admin Method
     * Retialer Wallet Balance In Admin Section
     * This Dashboard only can seen in admin
     */
    private function getWalletTransactionsList(User $user, $count=0){
        return WalletTransaction::getWalletTransactionList($user->id, $count);
    }
    
    
    /****
     * Admin Method
     * Retialer Wallet Balance In Admin Section
     * This Dashboard only can seen in admin
     */
    private function getWalletBalance(User $user){
        return Wallet::getWalletBalance($user->id);
    }


    /****
     * Admin Method
     * Retialer Wallet Balance In Admin Section
     * This Dashboard only can seen in admin
     */
    private function getSettalmentWalletBalance(User $user){
        return Wallet::getWalletBalance($user->id);
    }


     /****
     * Admin Method
     * Retialer Wallet amount based on Credit, Debit, Pending and Reversal
     * In Admin Section
     * This Dashboard only can seen in admin
     */
    private function getWalletTotalAmount(User $user, $type){
        return Wallet::getWalletTotalAmount($user->id,$type);
    }



    /**
     * Admin Settalemnt Lists.
     */
    public function settalment(Request $request)
    {
        return view($this->roleDirectory.'.blankPage',[
            'pageTitle'=> "All Settalment List"
        ]);
    }


    /**
     * Profile
     */
    public function profile(Request $request): View
    {
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Profile View',
            'element'=>'ProfileView'
        ]);
    }



    /**
     * Edit KYC Profile Page
     */
    public function editProfileKYC(Request $request): View
    {
       
        $userProfile = User::find(Auth::user()->id);
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Update KYC',
            'element'=>'editKYCForm',
            'userProfile'=>$userProfile
        ]);
    }





    /**
     * Edit Profile Page
     */
    public function editProfileKYCSave(UserKycUpdateRequest $request): RedirectResponse
    {
        //dd("dasd");
        //dd( $request->user());
        $request->user()->fill($request->validated());
        // Check if a file has been uploaded with the name 'image'
        if ($request->hasFile('aadhar_front_pic')) {
            $request->validate([
                'aadhar_front_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file
            $imagePath = $request->file('aadhar_front_pic')->store('kyc', 'public');
            $filename = basename($imagePath);
            $request->user()->aadhar_front_pic = $filename;
        }
        if ($request->hasFile('aadhar_back_pic')) {
            $request->validate([
                'aadhar_back_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file
            $imagePath = $request->file('aadhar_back_pic')->store('kyc', 'public');
            $filename = basename($imagePath);
            $request->user()->aadhar_back_pic = $filename;
        }

        if ($request->hasFile('pan_card_pic')) {
            $request->validate([
                'pan_card_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file
            $imagePath = $request->file('pan_card_pic')->store('kyc', 'public');
            $filename = basename($imagePath);
            $request->user()->pan_card_pic = $filename;
        }
        //dd( $request->user());
        $request->user()->save();
        return Redirect::route('admin.edit-profile')->with('success', 'KYC Of Profile Updated.');
    }




    /**
     * Change Password
     */
    public function changePassword(Request $request): View
    {
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Change Password',
            'element'=>'ChangePasswordForm'
        ]);
    }




    /**
     * Two Factor Authetication
     */
    public function twoFactorAuthAction(Request $request): View
    {
       

        $google2fa = new Google2FA();
        $secerteKey = $google2fa->generateSecretKey();
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            env('APP_URL'),
            AUTH::user()->email,
            $secerteKey
        );
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Add Two Factor Authentication',
            'element'=>'addTwoFactorAuthPage',
            'qrCodeUrl'=>$qrCodeUrl,
            'secerteKey'=>$secerteKey
        ]);
    }



    /**
     * Edit KYC Profile Page
     */
    public function verifyEmailAction(Request $request): View
    {
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Verify Email',
            'element'=>'verifyEmailPage'
        ]);
    }


    /**
     * Edit KYC Profile Page
     */
    public function verifyMobileAction(Request $request): View
    {
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Verify Mobile',
            'element'=>'verifyMobilePage'
        ]);
    }
    




    /**
     * Two Factor Authetication
     */
    public function qrcodeAction(Request $request): View
    {
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Get Your QR Code',
            'element'=>'qrcodePage'
        ]);
    }

     /**
     * Edit Profile Page
     */
    public function editProfile(Request $request): View
    {
        //$userProfile = User::find(Auth::user()->id);
        //dd($userProfile);
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Edit Profile',
            'element'=>'editProfileForm'
        ]);
    }



    /**
     * Edit Profile Page
     */
    public function editProfileSave(ProfileUpdateRequest $request): RedirectResponse
    {
        
        
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->address = $request->get('address');
        $request->user()->city_name = $request->get('city_name');
        $request->user()->zipcode = $request->get('zipcode');
        if(Auth::user()->id!=1){
            $request->user()->status = $request->get('status');
        }

        // Check if a file has been uploaded with the name 'image'
        if ($request->hasFile('avatar')) {
            //dd('dasd');
            // The file has been uploaded
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);

            // Store the uploaded file
            $imagePath = $request->file('avatar')->store('avatars', 'public');
            $filename = basename($imagePath);
            $request->user()->picture = $filename;
        }
        //dd( $request->user());
        $request->user()->save();
        return Redirect::route('admin.edit-profile')->with('success', 'Profile Updated.');
    }



     /**
     * Two Factor Authetication
     */
    public function addAuthenticator(Request $request): RedirectResponse
    {
        $google2fa = new Google2FA();
        $validated = $request->validate([
            'code' => 'required|string',
            'key' => 'required|string',
        ]);
        $data = [
            'uses_two_factor_auth' => 1,
            'google2fa_secret' => $request->get('key'),
        ];

        //Verify Google Auth First Before Save
        $code = $request->input('code'); 
        $valid = $google2fa->verifyKey($request->get('key'), $code);
        if($valid){
            User::saveProfileData($data);
            return  back()->with('status', __('setup-success'))
                          ->with('message', 'Second Step Authenication Setup Successfully!');
        }else{
            return  back()->with('status', __('setup-error'))
            ->with('message', 'Second Step Authenication Not Setup!');;
        }
    }



    /**
     * Update Two Step Authenticator
     */
    public function updateTwoStepAuthenticator(Request $request){
        if($request->has('uses_two_factor_auth')){
            $data = ['uses_two_factor_auth'=>1];
        }else{
            $data = ['uses_two_factor_auth'=>0];
        }
        User::saveProfileData($data);
        return  back()->with('status', __('setup-success'))
                          ->with('message', 'Second Step Authenication Updated Successfully!');
    }



    /**
     * Add Bank Account Details
     */
    public function bankAccount(Request $request): View
    {
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Edit Bank Details',
            'element'=>'editBankAccountForm'
        ]);
    }



     /**
     * Add Bank Account Details
     */
    public function bankAccountSave(UserBankAccountUpdateRequest $request): RedirectResponse
    {
        //dd("dasd");
        //dd( $request->user());
        $request->user()->fill($request->validated());
        // Check if a file has been uploaded with the name 'image'
        if ($request->hasFile('cancle_cheque')) {
            //dd('dasd');
            // The file has been uploaded
            $request->validate([
                'cancle_cheque' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);

            // Store the uploaded file
            $imagePath = $request->file('cancle_cheque')->store('kyc', 'public');
            $filename = basename($imagePath);
            $request->user()->cancle_cheque = $filename;
        }
        $request->user()->save();
        return Redirect::route('admin.edit-profile')->with('success', 'Profile Updated.');
    }




    /**
     * Display a listing of the resource.
     */
    public function allAdminList():View
    {
        //Get All Customer List
        $userList = User::where('role','admin')->get();
        return view('Admin.index',[
            'pageTitle'=> "All Admin List",
            'userList'=>$userList
        ]);
    }



     /**
     * Display a listing of the resource.
     */
    public function allLoginHistory():View
    {
        //Get All Customer List
        // $loginList = LoginHistory::where('user_id',Auth::user()->id)->get();
        // return view('Admin.loginHistory',[
        //     'pageTitle'=> "Login History",
        //     'list'=>$loginList
        // ]);

        $loginHistory = LoginHistory::where('user_id',Auth::User()->id)->orderBy('created_at','desc')->paginate(10);
        return view('Admin'.'.LoginHistory.loginHistoryList',[
            'pageTitle'=>'Login History',
            'list'=>$loginHistory
        ]);
    }



     /****
     * Admin Method
     * All Retailer List
     */
    function allRetailerList(Request $request, User $user){
        $userProfile = $user;
        $userList = User::where('role','retailer')->where('parent_id',$user->id)->get();
        return view($this->roleDirectory.'.Retailer.allRetailerList',[
            'pageTitle'=> "All Retailer",
            'userList'=>$userList,
            'userProfile'=>$userProfile
        ]);
   }



    /****
     * Admin Section Module
     * View retailer Commission List
     */
    function retailerCommissionList(Request $request, User $user){
       
        $parent_id = $user->parent_id;
        //Get All Gateway List for Distributor
        $viewPage = 'blankPage';
        $userCommissionList = [];
        // Step 1: Get the distinct gateway IDs
        $gatewayIds = UserCommissionSetting::where('user_id', $user->id)->pluck('gateway_id')->toArray();
        //dd($gatewayIds);
        // Iterate over each gateway ID
        foreach ($gatewayIds as $gatewayId) {
            // Get the UserCommissionSetting records for the current gateway ID
            $userCommissionList[$gatewayId] = UserCommissionSetting::with('Gateway')
                ->where('user_id', $user->id)
                ->where('gateway_id', $gatewayId)
                ->get();
        }
        if(!empty($userCommissionList)){
            $viewPage = 'allGatewayList';
        }
        //dd($userCommissionList);
        return view($this->roleDirectory.'.Commission.'.$viewPage,[
            'pageTitle'=> "Retailer Commission List",
            'userProfile'=>$user,
            'userCommissionList'=>$userCommissionList
        ]);
   }


    

    /****
     * Admin Section Module
     * Add Retailer Commission Setting For Gateway
     */
    function addRetailerGatewayCommission(Request $request, User $user){
        $paymentGatewayList = getPaymentGatewayListOptions();
        $userProfile = $user;
        if($userProfile->parent_id==''){
            session()->flash('error', 'Distributor\'s Comission Not Configure for this retialer');
        }
        
        if($request->isMethod('post')){
            $gateway_name = $request->get('gateway_name');
            $agent_code = $request->get('agent_code');
            //Get Distributor Commission Setting
            $distributor_id = $user->parent_id;
            $gatewayDetails = Gateway::with('PaymentGatewayRate')->where('gateway_name',$gateway_name)->first(); 
            //dd($gatewayDetails );
            if($gatewayDetails!=null){
                $filterData = ['user_id'=>$distributor_id, 'gateway_id'=>$gatewayDetails->id];
                //dd($filterData);
                $dsCommissionList = UserCommissionSetting::getGatewayPaymentTypeSettingList($filterData);
                //dd($dsCommissionList);
                if($gatewayDetails!=null){
                    $paymentGatewayList = getPaymentGatewayListOptions( $gateway_name );
                    //Get Payment Type Setting Form Database Tables based on Gatway id
                    $filterData = ['user_id'=>$user->id, 'gateway_id'=>$gatewayDetails->id];
                    $userPaymentTypeList = UserCommissionSetting::getGatewayPaymentTypeSettingList($filterData);
                    if($userPaymentTypeList == null){
                        session()->flash('error', 'No Records Found for '. $gateway_name . " payment gateway.");
                    }
                }else{
                    $gatewayDetails = [];
                    $userPaymentTypeList=[];
                }
            }else{
                $gatewayDetails = [];
                $userPaymentTypeList=[];
                $dsCommissionList=[];
            }
        }else{
            $gatewayDetails = [];
            $userPaymentTypeList=[];
            $dsCommissionList = [];
            $errorMessage = "";
        }
        if($userProfile->role == 'retailer'){ 
            $roleTitle = 'Retailer';
            $viewPage = 'addGatewayForCommissionRetailer';
        }
        //echo $this->roleDirectory.'.Commission.'.$viewPage; die;
        $paymentTypeList = getPaymentTypeList();
        return view($this->roleDirectory.'.Commission.'.$viewPage,[
            'pageTitle'=> "Search ".$roleTitle." Commission List",
            'userProfile'=>$user,
            'dsCommissionList'=>$dsCommissionList,
            'paymentGatewayList'=>$paymentGatewayList,
            'paymentTypeList'=>$paymentTypeList,
            'gatewayDetails'=>$gatewayDetails,
            'userPaymentTypeList'=>$userPaymentTypeList
            
        ]);
   }



   /****
     * Admin Section Module
     * Add Distributor Commission Setting For Gateway
     */
    function addGatewayCommission(Request $request, User $user){
        $superDistributorUserCommissionList = [];
        $paymentGatewayList = getPaymentGatewayListOptions();
        $userProfile = $user;
        if($request->isMethod('post')){
            $gateway_name = $request->get('gateway_name');
            $agent_code = $request->get('agent_code');
            $gatewayDetails = Gateway::with('PaymentGatewayRate')->where('gateway_name',$gateway_name)->first(); 
            if($gatewayDetails!=null){
                $paymentGatewayList = getPaymentGatewayListOptions( $gateway_name );
                //Get Payment Type Setting Form Database Tables based on Gatway id
                $filterData = ['user_id'=>$user->id, 'gateway_id'=>$gatewayDetails->id];
                $userPaymentTypeList = UserCommissionSetting::getGatewayPaymentTypeSettingList($filterData);
            }else{
                $gatewayDetails = [];
                $userPaymentTypeList=[];
                
            }
        }else{
            $gatewayDetails = [];
            $userPaymentTypeList=[];
        }
        //dd($userPaymentTypeList);
        //Get All Gateway List for Distributor
       //dd($gatewayDetails);
        //$viewPage = 'blankPage';
        if($userProfile->role == 'distributor'){ 
            $roleTitle = 'Distributor';
            $viewPage = 'addGatewayForCommission';
            if($request->isMethod('post')){
                if($userProfile->parent_id > 0){
                    //Get SuperDistributor Commission Details from Base Controller Calling
                    $superDistributorUserCommissionList  = $this->getParentUserCommissionBaseRate($userProfile, $gatewayDetails->id);
                    if(!empty($superDistributorUserCommissionList )){
                        $viewPage = 'addGatewayForCommissionForSuperDistributor';
                    }
                }
            }
            
        }
        if($userProfile->role == 'retailer'){ 
            $roleTitle = 'Retailer';
            $viewPage = 'addGatewayForCommissionRetailer';
        }
        if($userProfile->role == 'superdistributor'){ 
            $roleTitle = 'Super Distributor';
            $viewPage = 'addGatewayForCommission';
            
        }
       
        
       //dd($superDistributorUserCommissionList);
        $paymentTypeList = getPaymentTypeList();
        return view($this->roleDirectory.'.Commission.'.$viewPage,[
            'pageTitle'=> "Search ".$roleTitle." Commission List",
            'userProfile'=>$user,
            'paymentGatewayList'=>$paymentGatewayList,
            'paymentTypeList'=>$paymentTypeList,
            'gatewayDetails'=>$gatewayDetails,
            'userPaymentTypeList'=>$userPaymentTypeList,
            'superDistributorUserCommissionList'=>$superDistributorUserCommissionList
            
        ]);
   }

   

   /**
    * Save Payment Type  & Percentage For Each GateWay 
    * Save Agent Code and Commission Percentage in DB
    * @param Request $request
    * @return type redirect to list page
    */
    function saveProfilePaymentTypeGateway(Request $request, User $user){
       
        $basePaymentTypeValues          = $request->get('base_payment_type_value');
        $paymentTypeValue               = $request->get('payment_type_value');
        $nextDayPaymentTypeValue        = $request->get('next_day_payment_type_value');
        $nextWeekPaymentTypeValue       = $request->get('next_week_payment_type_value');
        $paymentRateType                = $request->get('payment_rate_type');
        $paymentTypeStatus              = $request->get('payment_type_status');
        $gateway_name                   = $request->get('gateway_name');
        $gateway_id                     = $request->get('gateway_id');
        $error = false;
        //check If payment_type_value is less than base_payment_type_value
        foreach ($basePaymentTypeValues as $paymentType => $value) {
            if ((float) $value <= (float) $paymentTypeValue[$paymentType]) {
                // Value is not greater than base value for this payment type
                $error = false;
            } else {
                // Value is greater than base value for this payment type
                $error_mesasge=  "Opps, Payment type ".\Str::replace("_"," ", $paymentType)." value is greater than base value of $gateway_name.\n";
                // Simulate a POST request to your controller action
                $postData = [
                    'user' => Crypt::encryptString($user->id),
                    'gateway_name' => $request->get('gateway_name'),
                    'agent_code'=>$user->agent_code
                ];
                 // Perform assertions on the response
                 return redirect()->route('admin.profile_addcommission',[ 'user' => Crypt::encryptString($user->id)])
                 ->with('error', $error_mesasge)
                 ->withInput($postData);
            }
        }

        if($error === false){
           // dd($request->all());
            if(!empty($basePaymentTypeValues)){
                foreach($basePaymentTypeValues as $k=>$v){
                    if (array_key_exists($k, $paymentTypeStatus)) {
                        $is_active = 1;
                    } else {
                        $is_active = 0;
                    }
                    $saveData = [
                        "user_id" => $user->id,
                        "gateway_id"=>$gateway_id,
                        "payment_type"=> $k,
                        "rate"=>$paymentTypeValue[$k],
                        "next_day_rate"=>$nextDayPaymentTypeValue[$k],
                        "next_week_rate"=>$nextWeekPaymentTypeValue[$k],
                        "rate_type"=>$paymentRateType[$k],
                        "is_active"=>$is_active
                    ];
                    if(UserCommissionSetting::validateUserCommissionSettingRow($saveData)){
                        $saveResult[] = UserCommissionSetting::create($saveData);
                    }
                    //dd($saveResult);
                }

                if(count($saveResult) === count($basePaymentTypeValues )){
                    $mesasge = "Payment commission  settings has been updated successfully.";
                    return redirect()->route('admin.profile_addcommission',[ 'user' => Crypt::encryptString($user->id)])
                    ->with('success', $mesasge);
                }else{
                    $error_mesasge = "somthing went wrong, Please try after sometime.";
                    return redirect()->route('admin.profile_addcommission',[ 'user' => Crypt::encryptString($user->id)])
                    ->with('error', $error_mesasge);
                }
            }else{

            }

        }
    }



     /****
     * Admin Section Module
     * View Distributor Commission List
     */
    function distributorCommissionList(Request $request, User $user){
        //Get All Gateway List for Distributor
        $viewPage = 'blankPage';
        $userCommissionList = [];
        // Step 1: Get the distinct gateway IDs
        $gatewayIds = UserCommissionSetting::where('user_id', $user->id)->pluck('gateway_id')->toArray();
        // Iterate over each gateway ID
        foreach ($gatewayIds as $gatewayId) {
            // Get the UserCommissionSetting records for the current gateway ID
            $userCommissionList[$gatewayId] = UserCommissionSetting::with('Gateway')
                ->where('user_id', $user->id)
                ->where('gateway_id', $gatewayId)
                ->get();
        }
        if(!empty($userCommissionList)){
            $viewPage = 'allGatewayList';
        }
        return view($this->roleDirectory.'.Commission.'.$viewPage,[
            'pageTitle'=> "Distributor Commission List",
            'userProfile'=>$user,
            'userCommissionList'=>$userCommissionList
        ]);
   }



    
   /**
     * Customer Profile View
     */
    public function viewSubAdminProfile(Request $request, User $user) : View
    {   
        $userProfile = $user;
        //dd($userProfile );
        return view('Admin.Profile.SubAdmin.profilePage',[
            'pageTitle'=> "Profile Page",
            'userProfile'=>$userProfile,
            'element'=> "SubAdmin.profileView"
        ]);
    }



    
     /**
     * Customer Profile View
     */
    public function editSubAdminProfile(Request $request, User $user) : View
    {   
        $userProfile = $user;
        $userProfile = $user;
        $dsList = User::where('role','distributor')->get();
        $elements = "SubAdmin.editProfileForm";
       //dd(Auth::user()->role);
        return view('Admin.Profile.SubAdmin.profilePage',[
            'pageTitle'=> "Profile Edit",
            'userProfile'=>$userProfile,
            'dsList'=>$dsList,
            'element'=> $elements,
        ]);
    }



      /**
     * Customer Profile View
     */
    public function editSubAdminProfileKYC(Request $request, $id) : View
    {   
        
        $user_id = Crypt::decryptString($id);
        //Get All Customer List
        $dsList = User::where('role','distributor')->get();
        $userProfile = User::find($user_id);
        $elements = 'editKYCForm';
        return view('Admin.Profile.SubAdmin.profilePage',[
            'pageTitle'=> "User KYC Update",
            'userProfile'=>$userProfile,
            'element'=> "SubAdmin.".$elements,
            'dsList'=>$dsList
        ]);
    }




     /**
     * Customer Profile View
     */
    public function changeSubAdminPassword(Request $request, $id) : View
    {   
        
        $user_id = Crypt::decryptString($id);
        $userProfile = User::find($user_id);
        return view('Admin.Profile.SubAdmin.profilePage',[
            'userProfile'=>$userProfile,
            'pageTitle'=>'Change Password',
            'element'=>'SubAdmin.ChangePasswordForm'
        ]);
    }





    /**
     * Verify Email Address
     */
    public function verifySubAdminEmailAction(Request $request, $id) : View
    {
        $user_id = Crypt::decryptString($id);
        $userProfile = User::find($user_id);
        return view('Admin.Profile.SubAdmin.profilePage',[
            'userProfile'=>$userProfile,
            'pageTitle'=>'Verify Email Address',
            'element'=>'SubAdmin.verifyEmailPage'
        ]);
    }


    

    /**
     * Method Name: profilePermissionSetting()
     * 
     */
    public function profilePermissionSetting(Request $request, User $user){
        
        $userProfile = $user;
        return view('Admin.Profile.SubAdmin.profilePage',[
            'userProfile'=>$userProfile,
            'pageTitle'=>'Comming Soon',
            'element'=>'SubAdmin.CommingSoon'
        ]);
    }


      
     /**
     * Profile Login History
     */
    public function myLoginHistory(Request $request): View
    {
        $loginHistory = LoginHistory::where('user_id',Auth::User()->id)->orderBy('created_at','desc')->paginate(10);
        return view('Admin.LoginHistory.loginHistoryList',[
            'pageTitle'=>'Login History',
            'list'=>$loginHistory
        ]);
    }
   

}
