<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
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
use App\Models\Transaction;
use App\Models\UserKyc;
use App\Models\UserBankAccount;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\LoginHistory;



use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use DateTime;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProfileController extends Controller
{

    

    protected $roleDirectory = 'User';

    public function __construct()
    {
        $this->middleware('auth')->except(['showLinkRequestForm', 'sendResetLinkEmail','forgotPasswordView']);
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    

    public function verify(Request $request)
    {
        $user = Auth::user();
        //dd($user);
        if ($user->hasVerifiedEmail()) {
            return redirect('verify-emails');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Update additional columns
        $user->column_one = 'value_one';
        $user->column_two = 'value_two';
        //dd($user);
        $user->save();

        return redirect($this->redirectPath())->with('verified', true);
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
        ->where('status', 'Success')
        ->orderBy('id','DESC')
        ->get();
        $totalFailedAmount = $transactionFailedList->sum('amount');
        $transactionsummary['TotalFailedAmount'] = $totalFailedAmount;
       
        
        return view('User.Transaction.transactionList',[
            'pageTitle'=>'Order History',
            'transactionList'=>$transactionList,
            'transactionsummary'=>$transactionsummary
        ]);
    }



     /****
     * Admin Method
     * Wallet Transaction List In Admin Section
     * This Dashboard only can seen in admin
     */
    public function myWalletTransactionsList(Request $request){
        $user = Auth::user();
        $dashboardItem = [
            'walletBalance' => number_format($this->getWalletBalance($user),2),
            'settalmentBalance' => number_format($this->getSettalmentWalletBalance($user),2),
            'walletTransactions' => $this->getWalletTransactionsList($user),
            'totalWalletCredit'=> number_format($this->getWalletTotalAmount($user, 'Credit'),2),
            'totalWalletDebit'=> number_format($this->getWalletTotalAmount($user, 'Debit'),2),
            'totalWalletPending'=> number_format($this->getWalletTotalAmount($user, 'Pending'),2),
            'totalWalletReversal'=> number_format($this->getWalletTotalAmount($user, 'Reversal'),2),
        ];
        //dd($dashboardItem);
        $user->dashboardItem = (object) $dashboardItem;
        $viewPage = 'User.Wallet.walletTransactionsList';
        return view($viewPage,[
            'pageTitle'=> "User Wallet Transactions",
            'userProfile'=>$user
        ]);
        
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

        return view($this->roleDirectory.'.dashboard',[
            'pageTitle'=>'Dashboard',
            'element'=>'Dashboard'
        ]);
    }



    
    /**
     * Edit Profile Page
     */
    public function editProfile(Request $request): View
    {
        if(getAuthValue('status')=='Active'){
            $element = 'ProfileView';
        }else{
            $element = 'editProfileForm';
        }
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Edit Profile',
            'element'=>$element
        ]);
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
        return Redirect::route('profile.edit-profile')->with('success', 'Profile Updated.');
    }



    /**
     * Edit KYC Profile Page
     */
    public function editProfileKYC(Request $request): View
    {
        if(Auth::user()->is_kyc_completed){
            $element = 'viewKYCForm';
        }else{
            $element = 'editKYCForm';
        }
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Update KYC',
            'element'=>$element
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
        //dd( $request->user());
        // Check if a file has been uploaded with the name 'image'
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
        //dd($request->all());
        //dd($request->get('city_name'));
        $request->user()->city_name = $request->get('city_name');
        $request->user()->city = $request->get('city_name');
        $request->user()->state = $request->get('state');
        $request->user()->address = $request->get('address');
        $request->user()->zipcode = $request->get('zipcode');
        //dd( $request->user());
        $request->user()->save();
        return Redirect::route('profile.kyc-update')->with('success', 'KYC Of Profile Updated.');
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
        return view($this->roleDirectory.'.Profile.profilePage',[
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
     * Add Bank Account Details
     */
    public function bankAccount(Request $request): View
    {
        if(Auth::user()->is_account_verified==1){
            $element = 'viewBankAccountForm';
        }else{
            $element = 'editBankAccountForm';
        }
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'Edit Bank Details',
            'element'=>$element
        ]);
    }



     /**
     * Add Bank Account Details For User Profile
     */
    public function bankAccountSave(UserBankAccountUpdateRequest $request): RedirectResponse
    {
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
        if($request->has('full_name_in_bank')){
            $request->user()->full_name_in_bank = $request->get('full_name_in_bank');
        }
        if($request->has('account_number')){
            $request->user()->account_number = $request->get('account_number');
        }
        if($request->has('bank_name')){
            $request->user()->bank_name = $request->get('bank_name');
        }
        if($request->has('bank_ifsc_code')){
            $request->user()->bank_ifsc_code = $request->get('bank_ifsc_code');
        }
        $request->user()->save();
        return Redirect::route('profile.bank-account')->with('success', 'Bank Account Updated.');
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
    
    


    
     /**
     * Profile Login History
     */
    public function myLoginHistory(Request $request): View
    {
        $loginHistory = LoginHistory::where('user_id',Auth::User()->id)->orderBy('created_at','desc')->paginate(10);
        return view('User.LoginHistory.loginHistoryList',[
            'pageTitle'=>'Login History',
            'list'=>$loginHistory
        ]);
    }


    
}
