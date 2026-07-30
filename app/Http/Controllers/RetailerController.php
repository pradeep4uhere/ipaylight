<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\WalletTransferRequest;
use App\Http\Requests\UserKycUpdateRequest;
use App\Http\Requests\UserBankAccountUpdateRequest;
use App\Http\Requests\CreateUserContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Gateway;
use App\Models\LoginHistory;
use App\Models\WalletTransaction;
use App\Models\Transaction;
use App\Models\Settlement;
use App\Models\SettlementSetting;
use Illuminate\Support\Facades\Crypt;
use App\Services\WalletService;
use App\Rules\MobileNumber;
use App\Models\Permission;
use App\Models\UserCommissionSetting;
use App\Models\UserContact;
use App\Helpers\CustomHelper;
use App\Models\Ticket;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use DateTime;
use Illuminate\Support\Facades\Log;
use App\Events\ProcessSettlements;
use App\Models\RetailerCommissionSetting;
use App\Models\PayoutTransfer;





class RetailerController extends Controller
{
    protected $roleDirectory = 'Retailer';

    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }
    
    /**
     * Display the user's profile form.
     */
    public function forgotPasswordView(Request $request): View
    {
        return view('auth.forgotPasswordView', ['request' => $request]);
    }
    
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
       
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


     /**
     * Edit Profile Page
     */
    public function editProfileSave(ProfileUpdateRequest $request): RedirectResponse
    {
        //dd("dasd");
        //dd( $request->user());
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->address = $request->get('address');
        $request->user()->city_name = $request->get('city_name');
        $request->user()->zipcode = $request->get('zipcode');
        //$request->user()->status = Auth::user()->status;
       
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
        //dd($request->user());
        $request->user()->save();
        return Redirect::route('ro.edit-profile')->with('success', 'Profile Updated.');
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
        return Redirect::route('ro.edit-profile')->with('success', 'KYC Of Profile Updated.');
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
        return Redirect::route('ro.edit-profile')->with('success', 'Profile Updated.');
    }







    /**
     * All Transaction List
     */
    public function transaction(Request $request): View
    {
        $transactionList = Transaction::with('Gateway')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();

        //dd($transactionList);
        $transactionSucessList = Transaction::where('user_id', Auth::user()->id)
        ->where('status', 'Success')
        ->orderBy('id','DESC')
        ->get();
        $totalAmount = $transactionSucessList->sum('amount');
        $transactionsummary['TotalAmount'] = $totalAmount;

        // Get the current date
        $currentDate = Carbon::now()->toDateString();
        $transactionTodaySucessList = Transaction::where('user_id', Auth::user()->id)
        ->where('status', 'Success')
        ->whereDate('created_at', $currentDate)
        ->orderBy('id','DESC')
        ->get();
        $totalTodayAmount = $transactionTodaySucessList->sum('amount');
        $transactionsummary['TotalTodayAmount'] = $totalTodayAmount;


        //Calculate Failed Payments
        $transactionFailedList = Transaction::where('user_id', Auth::user()->id)
        ->where('status', 'Failed')
        ->whereOr('status', 'Cancle')
        ->orderBy('id','DESC')
        ->get();
        $totalFailedAmount = $transactionFailedList->sum('amount');
        $transactionsummary['TotalFailedAmount'] = $totalFailedAmount;
        $searchFilter = []; 
        if($request->isMethod('post')){
            //dd($request->all());
            $mobile = $request->get('mobile');
            $txn_number = $request->get('txn_number');
            $date_range = $request->get('date_range');   
            $status = $request->get('status');
            $gateway_name = $request->get('gateway_name');
            $past_date = $request->get('past_date');
            $date_range_advance = $request->get('date_range_advance');  
          
           

            $query = Transaction::with(['User','Gateway'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC');

            if($mobile!=''){
                $query->where('customer_mobile',$mobile);
                $searchFilter['Mobile']= $mobile;
            }
            if($status!=''){
                $query->where('status',$status);
                $searchFilter['Status']= $status;
            }
            if($txn_number!=''){
                $query->where('txn_id',$txn_number);
                $searchFilter['TxnID']= $txn_number;
            }

            if($date_range!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' - ', $date_range);
                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereDate('transactions.created_at', '>=', $startDateFormatted);
                $query->whereDate('transactions.created_at', '<=', $endDateFormatted);
            }

            // Advance Search Filter Start Here
            if ($gateway_name != '') {
                $query->whereHas('gateway', function ($query) use ($gateway_name) {
                    $query->where('gateway_name', $gateway_name);
                });
                $searchFilter['GatewayName']= $gateway_name;
            }
            if($past_date!=''){
                $pattern = '/^\d{4}-\d{4}$/';
                if($past_date==0){
                    $query->whereDate('transactions.created_at', '=', date('Y-m-d'));
                }else if(preg_match($pattern, $past_date)) {
                    // Get the current date
                    $currentYear = date('Y');
                    $currentMonth = date('m');
                    $currentDay = date('d');

                    // Determine the start date of the financial year
                    if ($currentMonth >= 4) {
                        // If the current month is April (4) or later, the financial year starts in the current year
                        $financialYearStart = $currentYear . '-04-01';
                    } else {
                        // Otherwise, the financial year starts in the previous year (April of the previous year)
                        $financialYearStart = ($currentYear - 1) . '-04-01';
                    }

                    // Determine the end date of the financial year
                    $yearStart = intval(substr($financialYearStart, 0, 4));
                    $yearEnd = $yearStart + 1;
                    $financialYearEnd = $yearEnd . '-03-31';
                    // Format the financial year
                    $query->whereDate('transactions.created_at', '>=', $financialYearStart);
                    $query->whereDate('transactions.created_at', '<=', $financialYearEnd);
                    
                }else{
                    // Get today's date
                    $endDate = new DateTime();
                    // Calculate the start date for the last 90 days
                    $startDate = (new DateTime())->modify($past_date);
                    // Format the dates
                    $startDateFormatted = $startDate->format('Y-m-d');
                    $endDateFormatted = $endDate->format('Y-m-d');
                    $query->whereDate('transactions.created_at', '>=', $startDateFormatted);
                    $query->whereDate('transactions.created_at', '<=', $endDateFormatted);
                }
                $searchFilter['PastDate']= $past_date;
            }

            if($date_range_advance!=''){
                if (strpos($date_range_advance, 'to') == true) {
                    // Split the date range by ' to ' to get start and end dates
                    list($startDateStr, $endDateStr) = explode(' to ', $date_range_advance);
                }else{
                    $startDateStr = $date_range_advance;
                    $endDateStr = $date_range_advance;
                }
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereDate('transactions.created_at', '>=', $startDateFormatted);
                $query->whereDate('transactions.created_at', '<=', $endDateFormatted);
                $searchFilter['DateRange']= $date_range_advance;
            }
            // Advance Search Filter End Here

           
            $transactionList = $query->get();
            $sql = $query->toSql();
            //dd($sql);
        }
       
        
        return view('Retailer.Transaction.transactionList',[
            'pageTitle'=>'Transaction List',
            'transactionList'=>$transactionList,
            'transactionsummary'=>$transactionsummary,
            'searchFilter'=>$searchFilter
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
                        }elseif($transactionDetails->gateway_name=='EASEBUZZ'){
                            $nameOnCard = '';
                            $last4digitCard = $cardArray['card_number'];
                            $cardBankType = $cardArray['card_network'] .' | '. $cardArray['card_bank_name'];
                            $cardType = $cardArray['card_type'];
                            $cardInternational = false;
                        }elseif($transactionDetails->gateway_name=='RAZORPAY'){
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
                    return view('Retailer.Transaction.TransactionDetails',[
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
                return view('Retailer.Transaction.TransactionViewPage',[
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



   


    /**
     * All Settalment List
     */
    public function settalment(Request $request): View
    {
        return view('Retailer.Settalment.settalmentList',[
            'pageTitle'=>'Settalment List'
        ]);
    }




    /**
     * Change Password
     */
    public function changePassword(Request $request): View
    {
        return view('Retailer.Profile.profilePage',[
            'pageTitle'=>'Change Password',
            'element'=>'ChangePasswordForm'
        ]);
    }



    /**
     * Change Password
     */
    public function profileKYC(Request $request): View
    {
        return view('Retailer.Profile.updateKYC',[
            'pageTitle'=>'Profile KYC'
        ]);
    }



    /**
     * Profile
     */
    public function profile(Request $request): View
    {
        return view('Retailer.Profile.profilePage',[
            'pageTitle'=>'Profile View',
            'element'=>'ProfileView'
        ]);
    }


    
     /**
     * Profile Login History
     */
    public function myLoginHistory(Request $request): View
    {
        $loginHistory = LoginHistory::where('user_id',Auth::User()->id)->orderBy('created_at','desc')->paginate(10);
        
        return view('Retailer.LoginHistory.loginHistoryList',[
            'pageTitle'=>'Login History',
            'list'=>$loginHistory
        ]);
    }



    /**
     * Retailer Profile Dashboard
     */
    public function dashboard(Request $request): View
    {
        
        $dashboardItem = [];
        $user = Auth::user();
        $userPermissionArr = [];
        $userPermissionArr = $this->getUserPermissionSettingDetails($user->id);

        //dd($userPermissionArr);

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
         if($latesttransactionList->count()){
            $lastPaymentDetails = $latesttransactionList[0];
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
         //dd($lastWalletTransactions);

         
         //all Login History
         $userLoginActivities = $user->loginHistories()
         ->orderBy('created_at', 'desc')
         ->paginate(5)
         ->toArray();

         //All Latest Contacts
         $latestContacts = $user->userContacts()
         ->orderBy('created_at', 'desc')
         ->paginate(10)
         ->toArray();
        



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
            'userPermissionArr'=>$userPermissionArr,
            'ticketList'=>$ticketList,
            'lastWalletTransactions'=>$lastWalletTransactions,
            'todayCommission'=>$this->getTodayCommission($user),
            'userLoginActivities'=>$userLoginActivities['data'],
            'userContacts'=>$latestContacts['data']
        ];
        //dd($dashboardItem);
        return view($this->roleDirectory.'.dashboard',[
            'pageTitle'=>'Dashboard',
            'element'=>'Dashboard',
            'dashboardItem'=>$dashboardItem
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
     * Method Name: Today Commission getTodayCommission()
     * @param user_id
     * @return interger
     */
    private function getTodayCommission(User $user){
        return WalletTransaction::getTotalWalletTransaction($user->id);
    }




    
    /**
     * Edit Profile Page
     */
    public function editProfile(Request $request): View
    {
        if(Auth::user()->status=='active'){
            $element = 'ProfileView';
            $pageTitle = 'View Profile';
        }else{
            $element = 'editProfileForm';
            $pageTitle= 'Edit Profile';
        }
        return view('Retailer.Profile.profilePage',[
            'pageTitle'=>$pageTitle,
            'element'=>$element
        ]);
    }


    /**
     * Edit KYC Profile Page
     */
    public function editProfileKYC(Request $request): View
    {
        if(Auth::user()->status == 'active'){
            $viewelement = 'viewKYC';
            $title = "KYC Details";
        }else{
            $viewelement = 'editKYCForm';
            $title = "Update KYC Details";
        }
        return view('Retailer.Profile.profilePage',[
            'pageTitle'=>$title,
            'element'=>$viewelement
        ]);
    }


    /**
     * Edit KYC Profile Page
     */
    public function verifyEmailAction(Request $request): View
    {
        return view('Retailer.Profile.profilePage',[
            'pageTitle'=>'Verify Email',
            'element'=>'verifyEmailPage'
        ]);
    }


    /**
     * Edit KYC Profile Page
     */
    public function verifyMobileAction(Request $request): View
    {
        return view('Retailer.Profile.profilePage',[
            'pageTitle'=>'Verify Mobile',
            'element'=>'verifyMobilePage'
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
        return view('Retailer.Profile.profilePage',[
            'pageTitle'=>'Add Two Factor Authentication',
            'element'=>'addTwoFactorAuthPage',
            'qrCodeUrl'=>$qrCodeUrl,
            'secerteKey'=>$secerteKey
        ]);
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
     * Two Factor Authetication
     */
    public function qrcodeAction(Request $request): View
    {
        return view('Retailer.Profile.profilePage',[
            'pageTitle'=>'Get Your QR Code',
            'element'=>'qrcodePage'
        ]);
    }



    /**
     * Payment Credit Report
     */
    public function paymentCreditReport(Request $request): View
    {
        
        return view('blankPage',[
            'pageTitle'=>'Payment Credit Report'
            
        ]);
    }


    /**
     * Payment Debit Report
     */
    public function paymentDebitReport(Request $request): View
    {
        
        return view('blankPage',[
            'pageTitle'=>'Payment Debit Report'
            
        ]);
    }


    
    /**
     * Retailer Wallet to Wallet Transfer
     * Retailer can transfer the amount to wallet to other retialer 
     * or user.
     */
    public function walletTransferPage(Request $request)
    {
        if(!$this->isPermittedAction('WALLET_TO_WALLET_TRANSFER')){
            return view('unauthorizedPage');
        }
        $element = 'Retailer.Wallet.walletTransfer';
        $viewAPge ='Retailer.retailerContentBodyPage'; 
        $userDetailsCard = '';
        $user = '';
        if($request->isMethod('post')){
            $request->validate([
                'mobile' => ['required', 'digits:10'],
            ]);
            $mobile = $request->get('mobile');
            $user = User::where('mobile',$mobile)->where('status','Active')->first();
            if(!empty($user)){
                $viewAPge ='Retailer.retailerContentBodyPage'; 
                $element = 'Retailer.Wallet.walletTransferForm';
                $userDetailsCard = 'Retailer.Wallet.userProfileCard';
            }else{
                return  back()->with('error', __('User Not Found.'));
            }
        }
        return view($viewAPge,[
            'pageTitle'=>'Wallet Transfer',
            'element'=>$element,
            'userDetailsCard'=>$userDetailsCard,
            'user'=>$user
        ]);
    }


    /****
     * Admin Method
     * Retialer Wallet Transfer In Admin Section
     * This Dashboard only can seen in admin
     */
    function retialerWalletToWalletTransfer(Request $request, User $user){
        $request->validate([
            'amount' => ['required'],
            'description'=> ['required'],
        ]); 
        
        $sender_id = Auth::user()->id;
        $user_id = decryptString($request->get('user_id'));
        //dd($user_id);
        $receiver_id = $user_id;
        $payment_type = 'Debit';
        $amount = $request->amount;
        $description = $request->description;
        //dd($this->getWalletBalance(Auth::user()));
       
        $walletBalance = getWalletBalance();
        if ((float)$amount > (float)$walletBalance) {
            return back()->with('error', __('Insufficient Balance into your wallet.'));
        }
       // die;
        //For Reciver User Payment Should be Credit
        if($receiver_id!=='' && $sender_id!==''){
            $this->walletService->credit($amount, $receiver_id, $sender_id,  $description,'Success');
            $this->walletService->debit($amount, $sender_id, $receiver_id, $description,'Success');
        } 
        
        return  back()->with('success', __('Wallet Transaction Successfull.'));
   }



    /****
     * Retailer Section Module
     * Wallet Transaction List In Admin Section
     * This Dashboard only can seen in admin
     */
    public function myWalletTransactionsList(Request $request){
        $user = Auth::user();
        if($request->isMethod('post')){
            $reference_number = $request->get('reference_number');
            $transaction_id = $request->get('transaction_id');
            $date_range = $request->get('date_range');
            $transaction_type = $request->get('transaction_type');
            $status = $request->get('status');
            $query = WalletTransaction::where('sender_id', $user->id)->OrderBy('id', 'DESC');
            if($reference_number!=''){
                $query->where('reference_number',$reference_number);
            }
            if($transaction_id!=''){
                $query->where('transaction_id',$transaction_id);
            }
            if($transaction_type!=''){
                $query->where('transaction_type',$transaction_type);
            }
            if($status!=''){
                $query->where('status',$status);
            }
            if($date_range!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' - ', $date_range);
                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereDate('created_at', '>=', $startDateFormatted);
                $query->whereDate('created_at', '<=', $endDateFormatted);
            }
            //dd($query->toSql());
            $walletTransactions = $query->get();
            
        }else{
            $walletTransactions = $this->getWalletTransactionsList($user);
        }
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
            'walletTransactions' => $walletTransactions,
            'totalWalletCredit'=> number_format($this->getWalletTotalAmount($user, 'Credit'),2),
            'totalWalletDebit'=> number_format($this->getWalletTotalAmount($user, 'Debit'),2),
            'totalWalletPending'=> number_format($this->getWalletTotalAmount($user, 'Pending'),2),
            'totalWalletReversal'=> number_format($this->getWalletTotalAmount($user, 'Reversal'),2),
        ];
        //dd($dashboardItem);
        $user->dashboardItem = (object) $dashboardItem;
        $viewPage ='Retailer.retailerListingPage'; 
        $element = 'Retailer.Wallet.walletTransactionsList';
        return view($viewPage,[
            'pageTitle'=> "Retailer Wallet Transactions",
            'userProfile'=>$user,
            'element'=>$element
        ]);
        
    }


     /****
     * Retailer Section Module
     * View Retailer Commission List
     */
    function myCommissionList(Request $request){
        $user = Auth::user();
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



   function myOtherSetting(Request $request){
    $user = Auth::user();
    $viewPage = 'allSettingList';
    return view($this->roleDirectory.'.Commission.'.$viewPage,[
        'pageTitle'=> "Retailer Setting Details",
        'userProfile'=>$user
    ]);
   }






   /**
    * Method Name: getAllSettalment()
    * Author Name: Pradeep Kumar
    * Description: getAllSettalment
    * Return: List
    */

    public function getAllSettalment(Request $request){
        $gatewaySettalment = SettlementSetting::getSettlementSettingForUser(getAuthValue('id'));
        //dd($gatewaySettalment);
        $retailerGatewayList = parent::getRetailerPaymentGatewaysList();
        $request_gateway_id = '';
        $gateway_name = "";
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
                //dd($retailerGatewayList);
                $gatewayDetails = $retailerGatewayList[$request_gateway_name];
                $request_gateway_id = $gatewayDetails['gateway_id'];
                $gateway_name = $request_gateway_name;
                $settlementList = Settlement::where('user_id',getAuthValue('id'))
                    ->where('gateway_id',$request_gateway_id)
                    ->orderBy('id','DESC')
                    ->get();
            }else{
                $settlementList = Settlement::where('user_id',getAuthValue('id'))
                ->orderBy('id','DESC')
                ->get();
            }
           
        }
        $totalAmount = Settlement::where('user_id', getAuthValue('id'))->where('is_settled',0)->sum('net_amount');
        $upcommingSettalmentAmount = Settlement::getUpcomingSettalment(getAuthValue('id'),'Amount');
        $upcommingSettalmentTime = Settlement::getUpcomingSettalment(getAuthValue('id'),'Time');
        $prevousSettalAmount = Settlement::getPreviousSettalment(getAuthValue('id'),'Amount');
        $prevousSettaltime = Settlement::getPreviousSettalment(getAuthValue('id'),'Time');
        $todayTotalSettalment = Settlement::getTodaySettalment(getAuthValue('id')); 
        //dd($todayTotalSettalment);
        $viewPage = 'settalmentList';
        //dd($this->roleDirectory);
        return view($this->roleDirectory.'.Settalment.'.$viewPage,[
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
            'gatewaySettalment'=>$gatewaySettalment,
            'todayTotalSettalment'=>$todayTotalSettalment
        ]);
    }

   


       












    /********************************Admin Section********************/
    /****
     * Admin Method
     * All Retialer List
     */
    function allRetailerList(Request $request){
         //Get All Retailer List
         $userList = User::where('role','retailer')->get();
         return view('Admin.Retailer.allRetailerList',[
             'pageTitle'=> "All Retailer",
             'userList'=>$userList
         ]);
    }


    /****
     * Admin Method
     * Retialer Dashboard In Admin Section
     * This Dashboard only can seen in admin
     */
    function retailerAdminDashboard(Request $request, User $user){
         $settalemntSettingList = SettlementSetting::where('user_id',$user->id)->get();
         //dd($settalemntSettingList);
         $userPermissionArr = $this->getUserPermissionSettingDetails($user->id);
         $userPermissionArr['settalemntSettingList'] = $settalemntSettingList;
        
         //Total Amount
         $transactionList = Transaction::getRetailerTransactionList($user->id,'all');
         $totalAmount = $transactionList->sum('amount');
         $totalCount = $transactionList->count();
 
          //Total Today
         $transactionTodayList = Transaction::getRetailerTransactionList($user->id,'today');
         $totalToday = $transactionTodayList->sum('amount');
         $totalTodayCount = $transactionTodayList->count();
 
         //Total Week
         $transactionWeekList = Transaction::getRetailerTransactionList($user->id,'week');
         $totalOfWeek = $transactionWeekList->sum('amount');
         $totalWeekCount = $transactionWeekList->count();
 
         //Total Month
         $transactionMonthList = Transaction::getRetailerTransactionList($user->id,'month');
         $totalOfMonth = $transactionMonthList->sum('amount');
         $totalMonthCount = $transactionMonthList->count();
 
         // Total Failed Amount
         $transactionFailedList = Transaction::getRetailerTransactionList($user->id,'all','failed');
         $totalFailedAmount = $transactionFailedList->sum('amount');
         $totalFailedCount = $transactionFailedList->count();
 
         //Get Total User
         $userList= User::where('role','!=','admin')->get();
         $totalUserCount = $userList->count();
 
 
          //Total Amount
          $latesttransactionList = Transaction::getRetailerTransactionList($user->id,'all')->take(10);
          if($latesttransactionList->count()){
             $lastPaymentDetails = $latesttransactionList[0];
          }else{
             $lastPaymentDetails = [];
          }
          //dd($lastPaymentDetails);
          //Get {{getLocalText('latest_wallet_transaction')}}s
          $last30DaysTransaction = Transaction::getSaleLast30Days();
          $dataOfAmountValues = array_values($last30DaysTransaction);
          $salesPerDays = json_encode($dataOfAmountValues);

          $allwalletTransactions = $this->getWalletTransactionsList($user,10);
          if(!empty($allwalletTransactions)){
            $lastWalletTransactions = $this->getLastCommission($user);
         }else{
            $allwalletTransactions = [];
         }

         //all Login History
         $userLoginActivities = $user->loginHistories()
         ->orderBy('created_at', 'desc')
         ->paginate(5)
         ->toArray();

         //All Latest Contacts
         $latestContacts = $user->userContacts()
         ->orderBy('created_at', 'desc')
         ->paginate(10)
         ->toArray();

         //Get {{getLocalText('latest_support_ticket')}}s
         $ticketList = Ticket::getLatestSupportTickets();
        
        //Get All Retailer List
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'walletTransactions' => $this->getWalletTransactionsList($user,10),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
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
            'userPermissionArr'=>$userPermissionArr,
            'lastPayment'=>$lastPaymentDetails,
            'lastWalletTransactions'=>$lastWalletTransactions,
            'todayCommission'=>$this->getTodayCommission($user),
            'userLoginActivities'=>$userLoginActivities['data'],
            'userContacts'=>$latestContacts['data'],
            'ticketList'=>$ticketList,
            'chartItem'=>['days'=>$this->getLastTenDays(),'sales'=>$salesPerDays],
        ];
        $user->dashboardItem = (object) $dashboardItem;
        if(getAuthValue('role')=='Distributor'){
            $viewElement = 'Retailer.Distributor.dashboard';
        }elseif(getAuthValue('role')=='Admin'){
            $viewElement = 'Retailer.Admin.dashboard';
        }else{
            $viewElement = 'Retailer.dashboard';
        }
        //dd($viewElement);
        return view($viewElement,[
            'pageTitle'=> "Retailer Dashboard",
            'userProfile'=>$user,
            'dashboardItem'=>$dashboardItem
            
        ]);
   }


   /****
     * Admin Method
     * Retialer Wallet Transfer In Admin Section
     * This Dashboard only can seen in admin
     */
    function retailerAdminWalletTransfer(Request $request, User $user){
        //Get All Retailer List
       
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2)
        ];
        $user->dashboardItem = (object) $dashboardItem;
        if(getAuthValue('role')=='Distributor'){
            $viewPage = 'Retailer.Distributor.profilePage';
            $element = "Retailer.Distributor.walletTransfer";
        }elseif(getAuthValue('role')=='Admin'){
            $viewPage = 'Retailer.Admin.profilePage';
            $element = "Retailer.Admin.walletTransfer";
        }else{
            $viewPage = 'Retailer.profilePage';
            $element = "Retailer.walletTransfer";
        }
        return view($viewPage,[
            'pageTitle'=> "Retailer Wallet Transfer",
            'userProfile'=>$user,
            'element'=>$element
        ]);
   }


   /****
     * Admin Method
     * Retialer Wallet Transfer In Admin Section
     * This Dashboard only can seen in admin
     */
    function walletToWalletTransfer(WalletTransferRequest $request, User $user){
        $sender_id = Auth::user()->id;
        $receiver_id = $user->id;
        $payment_type = $request->payment_type;
        $amount = $request->amount;
        $description = $request->description;
        if($payment_type=='credit'){
            // Credit $50 to user with ID 1
            $this->walletService->credit($amount, $receiver_id, $sender_id, $description,'Success');
            return  back()->with('success', __('Wallet With Crdeit Transaction Successfully.'));
        }else if($payment_type=='debit'){
            // Debit $20 from user with ID 2
            $this->walletService->debit($amount, $receiver_id, $sender_id, $description,'Success');
            return  back()->with('success', __('Wallet With Debit Transaction Successfully.'));
        }else{
            return  back()->with('error', __('Wallet Transaction UnSuccessfull.'));
        }
        

   }

    /****
     * Admin Method
     * Wallet Transaction List In Admin Section
     * This Dashboard only can seen in admin
     */
    public function walletTransactionList(Request $request, User $user){
       
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
            'walletTransactions' => $this->getWalletTransactionsList($user),
            'totalWalletCredit'=> number_format($this->getWalletTotalAmount($user, 'Credit'),2),
            'totalWalletDebit'=> number_format($this->getWalletTotalAmount($user, 'Debit'),2),
            'totalWalletPending'=> number_format($this->getWalletTotalAmount($user, 'Pending'),2),
            'totalWalletReversal'=> number_format($this->getWalletTotalAmount($user, 'Reversal'),2),
        ];
       
        $user->dashboardItem = (object) $dashboardItem;
        if(getAuthValue('role')=='Distributor'){
            $viewPage = 'Retailer.Distributor.profilePage';
            $element = "Retailer.Distributor.walletTransactionsList";
        }elseif(getAuthValue('role')=='Admin'){
            $viewPage = 'Retailer.Admin.profilePage';
            $element = "Retailer.Admin.walletTransactionsList";
        }else{
            $viewPage = 'Retailer.profilePage';
            $element = "Retailer.walletTransactionsList";
        }
        return view($viewPage,[
            'pageTitle'=> "Retailer Wallet Transactions",
            'userProfile'=>$user,
            'element'=>$element
        ]);
        
    }



    
    /****
     * Admin Method
     * user Profile Permission Setting In Admin Section
     * This Dashboard only can seen in admin
     */
    public function userProfilePermissions(Request $request, User $user){
        $element = "userProfilePermissionSetting";
        $permissionTitleList = Permission::getAllPermissionList();
        $gatewayActiveList = Gateway::getAllActiveGatewaysForUser($user->id);
        $settalmentSettings = SettlementSetting::where('user_id',$user->id)->get();
        foreach($gatewayActiveList as $key=>$item){
            $gatewayActiveList[$key]['SettalemntSettings'] = $this->getSettalmentSettingsDetails($item->id, $settalmentSettings);
        }
        //dd($gatewayActiveList);
        $userPermissionArray = [];
        if($user->permissions!="null"){
            $userPermissionArray = json_decode($user->permissions,true);
        }
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
            'gatewayActiveList'=>$gatewayActiveList,
            'settalmentSettings'=>$settalmentSettings,
            'permissionTitleList'=>$permissionTitleList,
            'userPermissionArray'=>$userPermissionArray
        ];
       //dd($dashboardItem['userPermissionArray']);
        $user->dashboardItem = (object) $dashboardItem;
        return view('Admin.Retailer.profilePage',[
            'pageTitle'=> "Retailer Profile Permission",
            'userProfile'=>$user,
            'element'=>$element
        ]);
        
    }



    private function getSettalmentSettingsDetails($gateway_id, $settalmentSettings){
        foreach($settalmentSettings as $key=>$itemIndex){
            if($itemIndex['gateway_id']==$gateway_id){
                return $itemIndex;
            }
        }
    }



    /**
     * Admin Method
     * Retailer Permission Setting From Admin Panel
     */
    public function saveProfileSettingPermissions(Request $request, User $user){
       $allPermissionList = Permission::getAllPermissionList();
       $permissionKey = [];
        if(!empty($allPermissionList)){
            foreach($allPermissionList as $key=>$permission){
                if($request->get('action')==$permission->permission_type){
                    $permissionKey[$permission->permission_key] = false;
                }
            }
            $profilePermissionSetting = $request->get('profilePermissionSetting');
            if($profilePermissionSetting == null){
                return  back()->with('error', __('Select atleast one module for permission.'));
            }
            $finalArray = array_merge($permissionKey,$profilePermissionSetting);
            $permissionJson = [];
            if($request->get('action')=='EMAIL'){
                $permissionJson['EMAIL'] = $finalArray;
            }
            if($request->get('action')=='ACTION'){
                $permissionJson['ACTION'] = $finalArray;
            }
            //dd($permissionJson);
            if($user){
                $userObj = User::find($user->id);
                $oldPermission = json_decode($userObj->permissions,true);
                if($oldPermission!=null){
                     $newpermissionJsonArr = array_merge($oldPermission, $permissionJson);
                }else{
                    $newpermissionJsonArr = $permissionJson;
                }
                $userObj->permissions = json_encode($newpermissionJsonArr);
                if($userObj->save()){
                    return  back()->with('success', __('Permission Saved Successfully.'));
                }else{
                    return  back()->with('error', __('Permission Not Saved.'));
                }
            }else{
                return  back()->with('error', __('Invalid Payload, Please try again'));
            }
        }else{
            return  back()->with('error', __('Permission Records not found.'));
        }
       
    }



    
    /****
     * Admin Method
     * Retailer Payment Page Transaction List In Admin Section
     * This Dashboard only can seen in admin
     */
    public function userProfilePaymentPage(Request $request, User $user){
        return view('Retailer.CommingSoon',[
            'pageTitle'=> "Comming Soon",
            'userProfile'=>$user
        ]);
        
    }
   


    
    /****
     * Admin Method
     * Retialer Wallet Balance In Admin Section
     * This Dashboard only can seen in admin
     */
    private function getWalletTransactionsList(User $user, $all=null){
        if($all!=''){
            return WalletTransaction::getWalletTransactionList($user->id)->take($all);
        }else{
            return WalletTransaction::getWalletTransactionList($user->id);
        }
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
     * Admin Method
     * Method Name: savePaymentGatewaySettingPermissions
     * Save Retailer Payment Gateway Setting Permissions
     * This Dashboard only can seen in admin
     */
    public function savePaymentGatewaySettingPermissions(Request $request, User $user){
        $defaultSetting =  [
            "gateway_name" => false,
            "gateway_settalment_instant" => false,
            "gateway_settalment_next_day" => false,
            "gateway_settalment_next_week" => false,
            "gateway_payout" => false
        ];
        $inputArr = $request->all(); 
        $finalArray = [];  
           
        $gatewayList = $this->getRetailerPaymentGatewaysList($user);
        $gatewayListAsKeys = array_keys($gatewayList);
        if(request()->has($gatewayListAsKeys)) {
        foreach($inputArr as $key=>$item){
            if($key=='_token' || $key == 'action'){ continue;}
                $finalArray[$key] = array_merge( $defaultSetting,$item);
            } 
        }else if(request()->hasAny($gatewayListAsKeys)) {
            foreach ($gatewayListAsKeys as $gateway) {
                if (isset($inputArr[$gateway])) {
                    $finalArray[$gateway] = array_merge($defaultSetting, $inputArr[$gateway]);
                } else {
                    $finalArray[$gateway] = $defaultSetting;
                }
            }
        }else{
            foreach ($gatewayListAsKeys as $gateway) {
                $finalArray[$gateway] = $defaultSetting;
            }
        }

        $userPermissionJson = $user->permissions;
        $userPermissionArr = [];
        if($userPermissionJson!=''){
            $userPermissionArr = json_decode($userPermissionJson, true);
            $userPermissionArr['GATEWAY'] = $finalArray;
        }
        $userObj = User::find($user->id);
        $userObj->permissions = json_encode($userPermissionArr);
        if($userObj->save()){
            return  back()->with('success', __('Payment Gateway Permission Saved Successfully.'));
        }else{
            return  back()->with('error', __('Payment Gateway Permission Not Saved.'));
        }
   }


    
   


   /**
    * Method Name; removePaymentGatewayFromProfile()
    * @param user_id, id - Gateway Id
    * @return redirect back
    */
    public function removePaymentGatewayFromProfile(Request $request){
        $user_id = $request->get('user_id');
        $gateway_id = $request->get('gateway_id');
        dd($request->all());
    }
   
    


    /**
     * Method Name: retailerPayoutReport()
     */
    public function retailerPayoutReport(Request $request, User $user){
        $user = Auth::user();
        $user_id = $user->id;
        $payoutTransaction = PayoutTransfer::with('BeneficiaryAccount')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        //dd($payoutTransaction);
        $searchFilter = []; 
        return view('Retailer.Payout.payoutTransactionList',[
            'pageTitle'=>'Payout Transaction List',
            'transactionList'=>$payoutTransaction,
            'searchFilter'=>$searchFilter
        ]);
    }
     
    
}
