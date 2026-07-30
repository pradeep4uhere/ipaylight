<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserKycUpdateRequest;
use App\Http\Requests\UserBankAccountUpdateRequest;
use App\Http\Requests\WalletTransferRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;
use App\Models\Gateway;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\UserCommissionSetting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Services\WalletService;
use App\Models\Transaction;
use App\Models\SettlementSetting;
use DateTime; // Make sure to include this
use Carbon\Carbon;
use App\Models\LoginHistory;
use App\Models\Settlement;




class SuperDistributorController extends Controller
{
    

    protected $roleDirectory = 'Distributor';
    protected $roleSDSDirectory = 'SuperDistributor';
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
     * All Transaction List
     */
    public function transaction(Request $request): View
    {
        return view($this->roleDirectory.'.Transaction.transactionList',[
            'pageTitle'=>'Transaction List'
        ]);
    }



    /**
     * All Settalment List
     */
    public function settalment(Request $request): View
    {
        return view($this->roleDirectory.'.Settalment.settalmentList',[
            'pageTitle'=>'Settalment List'
        ]);
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
     * Change Password
     */
    public function profileKYC(Request $request): View
    {
        return view($this->roleDirectory.'.Profile.updateKYC',[
            'pageTitle'=>'Profile KYC'
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
     * Profile
     */
    public function dashboard(Request $request): View
    {
        //dD('dsd');
        $userProfile = Auth::user()->load('Wallet');
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

         $allwalletTransactions = $this->getWalletTransactionsList($user,10);
         if(!empty($allwalletTransactions)){
            $lastWalletTransactions = $this->getLastCommission($user);
         }else{
            $allwalletTransactions = [];
         }
         //dd($lastWalletTransactions);

        $dashboardItem = [
            'user'=> $user,
            'walletTransactions' => $allwalletTransactions,
            'lastWalletTransactions'=>$lastWalletTransactions,
            'todayCommission'=>$this->getTodayCommission($user),
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
            'userPermissionArr'=>$userPermissionArr
        ];
        return view($this->roleDirectory.'.dashboard',[
            'pageTitle'=>'Dashboard',
            'element'=>'Dashboard',
            'userProfile'=>$userProfile,
            'dashboardItem'=>$dashboardItem
        ]);
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
     * Method Name: Today Commission getTodayCommission()
     * @param user_id
     * @return interger
     */
    private function getLastCommission(User $user){
        return WalletTransaction::getLastWalletTransaction($user->id);
    }






    
    /**
     * Edit Profile Page
     */
    public function editProfile(Request $request): View
    {
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
        //dd("dasd");
        //dd( $request->user());
        //$status = Auth::user()->status;
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->address = $request->get('address');
        $request->user()->city_name = $request->get('city_name');
        $request->user()->zipcode = $request->get('zipcode');
        if(Auth::user()->id!=1){
            $request->user()->status = Auth::user()->status;
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

        $request->user()->save();
        return Redirect::route('ds.edit-profile')->with('success', 'Profile Updated.');
    }



    /**
     * Edit KYC Profile Page
     */
    public function editProfileKYC(Request $request): View
    {   $userProfile = Auth::user();
        //dd($userProfile);
        if($userProfile->is_kyc_completed == 1){
            $element = 'viewKYC';
        }else{
            $element = 'editKYCForm';
        }
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Update KYC',
            'element'=>$element,
            'userProfile'=>$userProfile
        ]);
    }


     /**
     * Edit Profile Page
     */
    public function editProfileKYCSave(UserKycUpdateRequest $request): RedirectResponse
    {
       //dd($request->all());
        $request->user()->fill($request->validated());
        // Check if a file has been uploaded with the name 'image'
      
        if ($request->hasFile('photograph')) {
            $request->validate([
                'photograph' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file
            $imagePath = $request->file('photograph')->store('avatars', 'public');
            $filename = basename($imagePath);
            $request->user()->photograph = $filename;
        }
        
        if ($request->hasFile('aadhar_front_pic')) {
            $request->validate([
                'aadhar_front_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file
            $imagePath = $request->file('aadhar_front_pic')->store('ekyc', 'public');
            $filename = basename($imagePath);
            $request->user()->aadhar_front_pic = $filename;
        }
        if ($request->hasFile('aadhar_back_pic')) {
            $request->validate([
                'aadhar_back_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file
            $imagePath = $request->file('aadhar_back_pic')->store('ekyc', 'public');
            $filename = basename($imagePath);
            $request->user()->aadhar_back_pic = $filename;
        }

        if ($request->hasFile('pan_card_pic')) {
            $request->validate([
                'pan_card_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file
            $imagePath = $request->file('pan_card_pic')->store('ekyc', 'public');
            $filename = basename($imagePath);
            $request->user()->pan_card_pic = $filename;
        }
       
        //$request->user()->role = Auth::user()->role;
        //dd($request->user());
        $request->user()->save();
        return Redirect::route('ds.kyc-update')->with('success', 'KYC Of Profile Updated.');
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
    public function twoFactorAuthAction(Request $request): View
    {
       

        $google2fa = new Google2FA();
        $secerteKey = $google2fa->generateSecretKey();
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            env('APP_URL'),
            AUTH::user()->email,
            $secerteKey
        );
        return view($this->roleSDSDirectory.'.Profile.profilePage',[
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
     * Add Bank Account Details
     */
    public function bankAccount(Request $request): View
    {
        if(getAuthValue('is_account_verified')==1){
            $element = 'ViewBankAccountForm';
        }else{
            $element = 'editBankAccountForm';
        }
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Edit Bank Details',
            'element'=>$element
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
            $imagePath = $request->file('cancle_cheque')->store('ekyc', 'public');
            $filename = basename($imagePath);
            $request->user()->cancle_cheque = $filename;
        }
        $request->user()->save();
        return Redirect::route('ds.bank-account')->with('success', 'Profile Updated.');
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

    

    function allDsRetailerList(Request $request){
        $userProfile = Auth::user();
        $superDistributorId = $userProfile->id;
        $retailers = [];
        // Get the superdistributor
        $superDistributor = User::find($superDistributorId);
        if($superDistributor){
             // Retrieve all distributor IDs
            $distributorIds = $superDistributor->distributors()->pluck('id')->toArray();
            if(!empty($distributorIds)){
                // Find all retailers where parent_id is in $distributorIds
                $retailers = User::where('role', 'retailer')
                ->whereIn('parent_id', $distributorIds)
                ->get();
            }
        }else {
            // Handle case where superdistributor with given ID is not found
            echo "Superdistributor not found.";
        }
        return view($this->roleDirectory.'.Retailer.allRetailerList',[
            'pageTitle'=> "All Retailer",
            'userList'=>$retailers,
            'userProfile'=>$userProfile
        ]);
   }


    /****
     * Distributor Method 
     * Retialer Dashboard In Distributor Section
     * This Dashboard only can seen in distributor profile
     */
    function retailerDashboard(Request $request, User $user){
        //Get All Retailer List
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2)
        ];
        $user->dashboardItem = (object) $dashboardItem;
        $viewElement = 'Distributor.Retailer.dashboard';
        //dd($viewElement);
        return view($viewElement,[
            'pageTitle'=> "Retailer Dashboard",
            'userProfile'=>$user
            
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
            $viewPage = 'Distributor.Retailer.profilePage';
            $element = "Distributor.Retailer.walletTransfer";
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
     * DISTRIBUTOR SECTION Method
     * Wallet Transaction List In DISTRIBUTOR Section
     * This Dashboard only can seen in DISTRIBUTOR
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
        //dd($dashboardItem['walletTransactions']);
        $user->dashboardItem = (object) $dashboardItem;
        if(getAuthValue('role')=='Distributor'){
            $viewPage = 'Distributor.Retailer.profilePage';
            $element = "Distributor.Retailer.walletTransactionsList";
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
     * distributor Section Module
     * 
     * 
     * View retailer Commission List
     */
    function myRetailerCommissionList(Request $request, User $user){
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
            $viewPage = 'allGatewayListFromSuperDistributorAccount';
        }

        //dd($userCommissionList);
        return view($this->roleDirectory.'.Commission.'.$viewPage,[
            'pageTitle'=> "User Commission List",
            'userProfile'=>$user,
            'userCommissionList'=>$userCommissionList
        ]);
   }




   /****
     * Admin Section Module
     * Add Distributor Commission Setting For Gateway
     */
    function addGatewayCommission(Request $request, User $user){
        $paymentGatewayList = getPaymentGatewayListOptions();
        $superDistributorUserCommissionList = [];
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
       
        //$viewPage = 'blankPage';
        if($userProfile->role == 'distributor'){ 
            $roleTitle = 'Distributor';
            $viewPage = 'addGatewayForCommissionFromSuperDS';
            if($request->isMethod('post')){
                if($userProfile->parent_id > 0){
                    if($gatewayDetails){
                        //Get SuperDistributor Commission Details from Base Controller Calling
                        $superDistributorUserCommissionList  = $this->getParentUserCommissionBaseRate($userProfile, $gatewayDetails->id);
                        if(!empty($superDistributorUserCommissionList )){
                            $viewPage = 'addGatewayForCommissionFromSuperDS';
                        }
                    }else{
                        //return 'sds.profile_addcommission'
                        return redirect()->route('sds.ro_commission',[ 'user' => Crypt::encryptString($user->id)])
                        ->with('error', "No Gateway Commission found For ".$gateway_name." Gateway, Please contact your administrator OR write us email on ".env('APP_SUPPORT_EMAIL'));
                    }
                }
            }
        }
        if($userProfile->role == 'retailer'){ 
            $roleTitle = 'Retailer';
            $viewPage = 'addGatewayForCommissionRetailer';
            if($request->isMethod('post')){
                if($userProfile->parent_id > 0){
                    //Get SuperDistributor Commission Details from Base Controller Calling
                    $superDistributorUserCommissionList  = $this->getParentUserCommissionBaseRate($userProfile, $gatewayDetails->id);
                    if(!empty($superDistributorUserCommissionList )){
                        $viewPage = 'addGatewayForCommissionFromSuperDS';
                    }
                }
            }
        }
        if($userProfile->role == 'superdistributor'){ 
            $roleTitle = 'Retailer';
            $viewPage = 'addGatewayForCommissionRetailer';
        }
        $paymentTypeList = getPaymentTypeList();
        //dd($this->roleDirectory.'.Commission.'.$viewPage);
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




   /****
     * Admin Section Module
     * Add Distributor Commission Setting For Gateway
     */
    function editGatewayCommission(Request $request, User $user, $gatewayname){
        $paymentGatewayList = getPaymentGatewayListOptions();
        $superDistributorUserCommissionList = [];
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
       
        //$viewPage = 'blankPage';
        if($userProfile->role == 'distributor'){ 
            $roleTitle = 'Distributor';
            $viewPage = 'addGatewayForCommissionFromSuperDS';
            if($request->isMethod('post')){
                if($userProfile->parent_id > 0){
                    //Get SuperDistributor Commission Details from Base Controller Calling
                    $superDistributorUserCommissionList  = $this->getParentUserCommissionBaseRate($userProfile, $gatewayDetails->id);
                    if(!empty($superDistributorUserCommissionList )){
                        $viewPage = 'addGatewayForCommissionFromSuperDS';
                    }
                }
            }
        }
        if($userProfile->role == 'retailer'){ 
            $roleTitle = 'Retailer';
            $viewPage = 'addGatewayForCommissionRetailer';
            if($request->isMethod('post')){
                if($userProfile->parent_id > 0){
                    //Get SuperDistributor Commission Details from Base Controller Calling
                    $superDistributorUserCommissionList  = $this->getParentUserCommissionBaseRate($userProfile, $gatewayDetails->id);
                    if(!empty($superDistributorUserCommissionList )){
                        $viewPage = 'addGatewayForCommissionFromSuperDS';
                    }
                }
            }
        }
        if($userProfile->role == 'superdistributor'){ 
            $roleTitle = 'Retailer';
            $viewPage = 'addGatewayForCommissionRetailer';
        }
        $paymentTypeList = getPaymentTypeList();
        //dd($this->roleDirectory.'.Commission.'.$viewPage);
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



    /****
     * Distributor Module
     * View Distributor Commission List
     * Distributor can view his own Commission Setting
     */
    function myCommissionList(Request $request){
        
        //Get All Gateway List for Distributor
        $viewPage = 'blankPage';
        $userCommissionList = [];
        $user = Auth::user();
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
            $viewPage = 'myAllGatewayList';
        }else{
            $viewPage = 'NoRecordPage';
        }
        //dd($this->roleDirectory.'.Commission.'.$viewPage);
        return view($this->roleDirectory.'.Commission.'.$viewPage,[
            'pageTitle'=> "My Commission List",
            'userProfile'=>$user,
            'userCommissionList'=>$userCommissionList
        ]);
   }



    /****
     * Admin Method
     * Wallet Transaction List In Admin Section
     * This Dashboard only can seen in admin
     */
    public function userProfilePermissions(Request $request, User $user){
        $element = $this->roleDirectory.".Retailer.userProfilePermissionSetting";
        $gatewayActiveList = Gateway::getAllActiveGatewaysForUser($user->id);
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
            'gatewayActiveList'=>$gatewayActiveList
        ];
        //dd($dashboardItem['walletTransactions']);
        $user->dashboardItem = (object) $dashboardItem;
        return view($this->roleDirectory.'.Retailer.profilePage',[
            'pageTitle'=> "Retailer Profile Permission",
            'userProfile'=>$user,
            'element'=>$element
        ]);
        
    }


      
    /****
     * Admin Method
     * Retailer Payment Page Transaction List In Admin Section
     * This Dashboard only can seen in admin
     */
    public function profileElementPaymentPage(Request $request, User $user){
        return view('Retailer.CommingSoon',[
            'pageTitle'=> "Comming Soon",
            'userProfile'=>$user
        ]);
        
    }
   



    /****
     * distributor Method
     * Wallet Transaction List In Admin Section
     * This Dashboard only can seen in admin
     */
    public function MyWalletTransactionList(Request $request){
        $user = Auth::user();
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
            'walletTransactions' => WalletTransaction::getWalletTransactionsList($user),
            'totalWalletCredit'=> number_format($this->getWalletTotalAmount($user, 'Credit'),2),
            'totalWalletDebit'=> number_format($this->getWalletTotalAmount($user, 'Debit'),2),
            'totalWalletPending'=> number_format($this->getWalletTotalAmount($user, 'Pending'),2),
            'totalWalletReversal'=> number_format($this->getWalletTotalAmount($user, 'Reversal'),2),
        ];
       
        $user->dashboardItem = (object) $dashboardItem;
        //dd($dashboardItem['walletTransactions']);
        if(getAuthValue('role')=='Superdistributor'){
            $viewPage = 'Distributor.profilePage';
            $element = "Distributor.Wallet.walletTransactionsList";
        }
        return view($viewPage,[
            'pageTitle'=> "My Wallet Transactions",
            'userProfile'=>$user,
            'element'=>$element
        ]);
        
    }



    /**
     * For Retailer Profile into Distributor Account
     * Method Name: userProfileTransactionList()
     * this  method is used to get the list of transactions 
     * for retailers who are connected with a distributor
     * Created by Pradeep Kumar
     * @param Request $req
     * @param UserId
     */
    public  function userProfileTransactionList(Request $request, User $user){
        $transactionsummary = [];
        $user_id = $user->id;
        $transactionList = Transaction::getAllTransactionList($user_id);

        //Get Total Transaction Amount
        $totalAmount = Transaction::getTotalTransactionList($user_id);
        $transactionsummary['TotalAmount'] = $totalAmount;

        // Get the current date, Today Payment
        $totalTodayPayment = Transaction::getTotalTodayTransactionList($user_id);
        $transactionsummary['TotalTodayAmount'] = $totalTodayPayment;


        //Calculate Failed Payments
        $totalFailedAmount = Transaction::getTotalFailedTransactionList($user_id);
        $transactionsummary['TotalFailedAmount'] = $totalFailedAmount;

        return view($this->roleDirectory.'.Retailer.Transaction.transactionList',[
            'pageTitle'=> "Transaction List",
            'transactionList'=>$transactionList,
            'transactionsummary'=>$transactionsummary
        ]);
    }



     /**
     * All Transaction List
     */
    public function userTransactionList(Request $request , User $user)
    {
        
        $user_id = $user->id;
        $transactionList = Transaction::with('Gateway')->where('user_id', $user_id)->orderBy('id','DESC')->get();

        //dd($transactionList);
        $transactionSucessList = Transaction::where('user_id', $user_id)
        ->where('status', 'Success')
        ->orderBy('id','DESC')
        ->get();
        $totalAmount = $transactionSucessList->sum('amount');
        $transactionsummary['TotalAmount'] = $totalAmount;

        // Get the current date
        $currentDate = Carbon::now()->toDateString();
        $transactionTodaySucessList = Transaction::where('user_id', $user_id)
        ->where('status', 'Success')
        ->whereDate('created_at', $currentDate)
        ->orderBy('id','DESC')
        ->get();
        $totalTodayAmount = $transactionTodaySucessList->sum('amount');
        $transactionsummary['TotalTodayAmount'] = $totalTodayAmount;


        //Calculate Failed Payments
        $transactionFailedList = Transaction::where('user_id', $user_id)
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
            ->where('user_id', $user_id)
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
        //dd($transactionList);
        return view('Retailer.Transaction.transactionList',[
            'pageTitle'=>'Transaction List',
            'transactionList'=>$transactionList,
            'transactionsummary'=>$transactionsummary,
            'searchFilter'=>$searchFilter,
            'userProfile'=>$user
        ]);
    }




    /**
     * Method Name: userTransactionList()
     * Retailer Transaction List with Reporting
     */
    public function userTsransactionList(Request $request, User $user){
        $transactionsummary = [];
        $user_id = $user->id;
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

        //Get All Retailer List
        $dashboardItem = [
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
            'transactionList'=>$transactionList,
        ];
        $user->dashboardItem = (object) $dashboardItem;

        return view($this->roleDirectory.'.Retailer.Transaction.transactionListReporting',[
            'pageTitle'=> "Transaction List",
            'dashboardItem'=>$dashboardItem,
            'transactionList'=>$dashboardItem['transactionList']
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
                    }else if($transactionDetails->gateway_name=='RAZORPAY'){
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
                    }else{
                        $nameOnCard = '-NA-';
                        $last4digitCard = '-NA-';
                        $cardBankType = '-NA-';
                        $cardType = '-NA-';
                        $cardInternational = false;
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
                return view($this->roleDirectory.'.Retailer.Transaction.TransactionDetails',[
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
                return view($this->roleDirectory.'.Retailer.Transaction.TransactionViewPage',[
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
     * Method Name: All Transaction List For Distributor Account
     * AllTransactionList()
     */

     public function AllTransactionList(Request $request){
        //dd(getAuthValue('id'));
        $retailerids = $this->getAllRetailerIdsOfSuperDistributor(getAuthValue('id'));
        $userIds = $retailerids;
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
            ->whereIn('user_id', $userIds)
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
                    //dd($date_range_advance);
                    $startDateStr = $date_range_advance;
                    $endDateStr = $date_range_advance;
                }
                // Convert string to DateTime objects
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
        }else{
            //dd($userIds);
            $transactionList = Transaction::with('User')->whereIn('user_id',$userIds)->orderBy('id', 'DESC')->get();
            // $query = Transaction::with('User')
            // ->whereIn('user_id', $userIds)
            // ->orderBy('id', 'DESC');
            //dd($query->toSql());
        }


        //dd($transactionList);
        $transactionSucessList = Transaction::whereIn('user_id', $userIds)
        ->where('status', 'Success')
        ->orderBy('id','DESC')
        ->get();
        $totalAmount = $transactionSucessList->sum('amount');
        $transactionsummary['TotalAmount'] = $totalAmount;

        // Get the current date
        $currentDate = Carbon::now()->toDateString();
        $transactionTodaySucessList = Transaction::whereIn('user_id', $userIds)
        ->where('status', 'Success')
        ->whereDate('created_at', $currentDate)
        ->orderBy('id','DESC')
        ->get();
        $totalTodayAmount = $transactionTodaySucessList->sum('amount');
        $transactionsummary['TotalTodayAmount'] = $totalTodayAmount;


        //Calculate Failed Payments
        $transactionFailedList = Transaction::whereIn('user_id', $userIds)
        ->where('status', 'Failed')
        ->whereOr('status', 'Cancle')
        ->orderBy('id','DESC')
        ->get();
        $totalFailedAmount = $transactionFailedList->sum('amount');
        $transactionsummary['TotalFailedAmount'] = $totalFailedAmount;


        //echo $transactionList->toSql();
        //dd($transactionList->toSql());
        //dd($transactionList);
        return view($this->roleSDSDirectory.'.Transaction.allTransactionList',[
            'pageTitle'=>'All Transaction List',
            'transactionList'=>$transactionList,
            'transactionsummary'=>$transactionsummary,
        ]);
     }



     















    /********************************Admin Section********************/
    
   



   



    
    /****
     * Admin Method
     * All Distributor List
     */
    function allDistributorList(Request $request){
        //Get All Retailer List
        $userList = User::where(function($query) {
            $query->where('role', 'distributor')
                  ->orWhere('role', 'superdistributor');
        })->get();
        return view($this->roleDirectory.'.index',[
            'pageTitle'=> "All Distributor",
            'userList'=>$userList
        ]);
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
        return view($this->roleSDSDirectory.'.Commission.'.$viewPage,[
            'pageTitle'=> "Distributor Commission List",
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
        
        if($request->isMethod('post')){
            $gateway_name = $request->get('gateway_name');
            $agent_code = $request->get('agent_code');
            //Get Distributor Commission Setting
            $distributor_id = $user->parent_id;
            $gatewayDetails = Gateway::with('PaymentGatewayRate')->where('gateway_name',$gateway_name)->first(); 
            $filterData = ['user_id'=>$distributor_id, 'gateway_id'=>$gatewayDetails->id];
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
                //dd($userPaymentTypeList);
            }else{
                $gatewayDetails = [];
                $userPaymentTypeList=[];
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
                 return redirect()->route('sds.ro_commission',[ 'user' => Crypt::encryptString($user->id)])
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
                    return redirect()->route('sds.profile_commission',[ 'user' => Crypt::encryptString($user->id)])
                    ->with('success', $mesasge);
                }else{
                    $error_mesasge = "somthing went wrong, Please try after sometime.";
                    return redirect()->route('sds.profile_commission',[ 'user' => Crypt::encryptString($user->id)])
                    ->with('error', $error_mesasge);
                }
            }else{

            }

        }
    }



   


    /****
     * Admin Method
     * Distributor Wallet Balance In Admin Section
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
            $this->walletService->debit($amount, $sender_id, $receiver_id, $description,'Success');
            return  back()->with('success', __('Wallet With Credit Transaction Successfully.'));
        }else if($payment_type=='debit'){
            // Debit $20 from user with ID 2
            $this->walletService->debit($amount, $sender_id, $receiver_id, $description,'Success');
            $this->walletService->credit($amount, $receiver_id, $sender_id, $description,'Success');
            return  back()->with('success', __('Wallet With Debit Transaction Successfully.'));
        }else{
            return  back()->with('error', __('Wallet Transaction UnSuccessfull.'));
        }
        

   }


     /**
     * Profile Login History
     */
    public function myLoginHistory(Request $request): View
    {
        $loginHistory = LoginHistory::where('user_id',Auth::User()->id)->orderBy('created_at','desc')->paginate(10);
        return view($this->roleDirectory.'.LoginHistory.loginHistoryList',[
            'pageTitle'=>'Login History',
            'list'=>$loginHistory
        ]);
    }

    



    /**
    * Method Name: getAllSettalment()
    * Author Name: Pradeep Kumar
    * Description: getAllSettalment
    * Return: List
    */

    public function getAllSettalment(Request $request, User $user){
        $user_id = $user->id;
        $gatewaySettalment = SettlementSetting::getSettlementSettingForUser($user_id);
        //dd($gatewaySettalment);
        $retailerGatewayList = parent::getRetailerPaymentGatewaysList();
        $request_gateway_id = '';
        $gateway_name = "";
        if($request->isMethod('post')){
            $date_range = $request->get('date_range');
            $settlement_id = $request->get('settalment_id');
            $utr_number = $request->get('utr_number');
            $status = $request->get('status');
            $query = Settlement::where('user_id', $user_id);
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
                $settlementList = Settlement::where('user_id',$user_id)
                    ->where('gateway_id',$request_gateway_id)
                    ->orderBy('id','DESC')
                    ->get();
            }else{
                $settlementList = Settlement::where('user_id',$user_id)
                ->orderBy('id','DESC')
                ->get();
            }
           
        }
        $totalAmount = Settlement::where('user_id', getAuthValue('id'))->where('is_settled',0)->sum('net_amount');
        $upcommingSettalmentAmount = Settlement::getUpcomingSettalment($user_id,'Amount');
        $upcommingSettalmentTime = Settlement::getUpcomingSettalment($user_id,'Time');
        $prevousSettalAmount = Settlement::getPreviousSettalment($user_id,'Amount');
        $prevousSettaltime = Settlement::getPreviousSettalment($user_id,'Time');
        $todayTotalSettalment = Settlement::getTodaySettalment($user_id); 
        //dd($todayTotalSettalment);
        $viewPage = 'settalmentList';
        //dd($this->roleDirectory);
        return view('Retailer.Settalment.'.$viewPage,[
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



   

    /**
     * All Distributor List in SuperDistributor Account
     */
    public function allSuperDistributorList(Request $request){
        $userProfile = Auth::user();
        $userList = User::where('role','distributor')->where('parent_id',$userProfile->id)->get();
        return view($this->roleSDSDirectory.'.Distributor.allDistributorList',[
            'pageTitle'=> "All Retailer",
            'userList'=>$userList,
            'userProfile'=>$userProfile
        ]);
    }






}
