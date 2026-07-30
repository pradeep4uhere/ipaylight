<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\CreateUserContactRequest;
use App\Http\Requests\CreateBeneficiaryAccountRequest;
use App\Models\BeneficiaryAccount;
use App\Models\UserContact;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class ContactController extends Controller
{

    protected $roleDirectory = 'Retailer';

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
    public function destroy(UserContact $userContact, $id)
    {
        // Decrypt the ID if needed
        $user_contact_id = decryptstring($id);

        // Find the user contact by ID
        $userContact = UserContact::findOrFail($user_contact_id);

        // Perform soft delete
        $userContact->delete();

        // Redirect back or wherever appropriate
        return redirect()->back()->with('success', 'User contact deleted successfully.');
    }


    /**
     * Payment Debit Report
     */
    public function contactList(Request $request): View
    {
        
        return view('blankPage',[
            'pageTitle'=>'All Contact List'
            
        ]);
    }


    /**
     * Payment Debit Report
     */
    public function contactAdd(Request $request): View
    {
        
        return view('blankPage',[
            'pageTitle'=>'Add Contact'
            
        ]);
    }



    /**
    * Retailer Profile Methods
    * This Methods List down all the contacts
    * where Retailer can transfer the amount to
    * their bank account
    */
   function searchContacts(Request $request){
    $user = Auth::user();
    $viewPage = 'searchContact';
    $element = '';
    $UserContactList = [];
    $UserContactListCount = 0;

    if($request->isMethod('post')){
        $mobile = $request->get('mobile');
        $name = $request->get('name');
        $UserContactListCount = UserContact::where('user_id', $user->id)->count();
        if($mobile!=null &&  $name!=null){
            $UserContactList = UserContact::with('beneficiaryAccounts')->where(function ($query) use ($name) {
                $query->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%');
            })
            ->where('mobile_number', $mobile)
            ->where('user_id', $user->id)
            ->get();
        }
        if($mobile!=null && $name==null){
            $UserContactList = UserContact::with('beneficiaryAccounts')->where(function ($query) use ($mobile) {
                $query->where('mobile_number', 'like', '%' . $mobile . '%');
            })
            ->where('user_id', $user->id)
            ->get();
        }

        if($mobile==null &&  $name!=null){
            $UserContactList = UserContact::with('beneficiaryAccounts')->where(function ($query) use ($name) {
                $query->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%');
            })
            ->where('user_id', $user->id)
            ->get();
           
        }
        //dd($UserContactList);
        $element = 'Retailer.Contacts.searchResultContactList';
    }
    return view($this->roleDirectory.'.Contacts.'.$viewPage,[
        'pageTitle'=> "Retailer All Contacts",
        'userProfile'=>$user,
        'userContactList'=>$UserContactList,
        'element'=>$element,
        'UserContactListCount'=>$UserContactListCount
    ]);
   }



   
   /**
    * Retailer Profile Methods
    * This Methods {{getLocalText('add_new_contact')}}s to Retailer Profile
    * where Retailer can transfer the amount to
    * their bank account
    */
    function addNewContact(Request $request){
        if(!$this->isPermittedAction('ADD_NEW_CONTACT')){
            return view('unauthorizedPage');
        }
        $user = Auth::user();
        $viewPage = 'addNewContact';
        return view($this->roleDirectory.'.Contacts.'.$viewPage,[
            'pageTitle'=> "Add New Contact",
            'userProfile'=>$user
        ]);
       }
   

  /**
    * Retailer Save New Contact Method
    * This Methods {{getLocalText('add_new_contact')}}s to Retailer Profile
    * where Retailer can transfer the amount to
    * their bank account
    */
    public function saveNewContact(CreateUserContactRequest $request)
{
    try {
        // Create a new UserContact instance
        $userContact = new UserContact();

        // Fill the UserContact instance with the validated data
        $userContact->fill($request->validated());

        // Set the user_id and status attributes
        $userContact->user_id = Auth::user()->id;
        $userContact->status = 'Active';
        $userContact->contact_id = 'contact_'.generateRefernceNumber(10);

        // Save the UserContact instance
        $userContact->save();

        // Redirect back with success message
        return back()->with('success', __('Contact added successfully.'));
    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return back()->with('error', __('Failed to add contact: ') . $e->getMessage());
    }
}



    /**
    * Retailer Profile Methods
    * This Methods List down all the contacts
    * where Retailer can transfer the amount to
    * their bank account
    */
    function getAllContactList(Request $request){
        $user = Auth::user();
        $userContactList = UserContact::where('user_id',$user->id)->orderBy('id','DESC')->get();
        $viewPage = 'allContactList';
        return view($this->roleDirectory.'.Contacts.'.$viewPage,[
            'pageTitle'=> "Retailer All Contacts",
            'userProfile'=>$user,
            'userContactList'=>$userContactList
        ]);
    }



    /**
    * Retailer Profile Methods for Distributor  Account
    * This Methods List down all the contacts
    * where Retailer can transfer the amount to
    * their bank account
    */
    function getAllContactListInDistributor(Request $request, User $user){
        $user = $user;
        $userContactList = UserContact::where('user_id',$user->id)->orderBy('id','DESC')->get();
        $viewPage = 'allContactList';
        return view($this->roleDirectory.'.Contacts.'.$viewPage,[
            'pageTitle'=> "Retailer All Contacts",
            'userProfile'=>$user,
            'userContactList'=>$userContactList
        ]);
    }



    /**
    * Retailer Profile Methods
    * This Methods Show the Details of the Contact
    */
    function getContactDetails(Request $request, $id){
        //dd($id);
        if(!$this->isPermittedAction('ADD_NEW_BENIFICERIES')){
            return view('unauthorizedPage');
        }
        $user_contact_id = decryptString($id);
        $user = Auth::user();
        $userContactDetails = UserContact::find($user_contact_id);
        $viewPage = 'addPayoutToContact';
        return view($this->roleDirectory.'.Contacts.'.$viewPage,[
            'pageTitle'=> "Retailer All Contacts",
            'userProfile'=>$user,
            'userContactDetails'=>$userContactDetails
        ]);
    }
       


    

    /**
    * Retailer Contact View Methods in Distributor Profile
    * This Methods Show the Details of the Contact
    */
    function getContactDetailsInDistributor(Request $request, $id){
        $user_contact_id = decryptString($id);
        
        $userContactDetails = UserContact::find($user_contact_id);
        $user = User::find($userContactDetails['user_id']);
        $viewPage = 'addPayoutToContact';
        
        return view($this->roleDirectory.'.Contacts.'.$viewPage,[
            'pageTitle'=> "Retailer All Contacts",
            'userProfile'=>$user,
            'userContactDetails'=>$userContactDetails
        ]);
    }
       


    
     /**
    * Retailer Save New Contact Method
    * This Methods {{getLocalText('add_new_contact')}}s to Retailer Profile
    * where Retailer can transfer the amount to
    * their bank account
    */
    public function saveaddBeneficiaryDetails(CreateBeneficiaryAccountRequest $request)
{
    if(!$this->isPermittedAction('ADD_NEW_CONTACT')){
        return view('unauthorizedPage');
    }
    try {
        // Create a new UserContact instance
        $beneficiaryAccountObj = new BeneficiaryAccount();
        // Fill the UserContact instance with the validated data
        $beneficiaryAccountObj->fill($request->validated());
        // Set the user_id and status attributes
        $beneficiaryAccountObj->user_id = Auth::user()->id;
        $beneficiaryAccountObj->status = 'Active';
        $beneficiaryAccountObj->beneficiary_id = 'beneficiary_'.generateRefernceNumber(10);
        $beneficiaryAccountObj->bank_id = $request->get('bank_name');

        //getMasterBankList form Helper
        $beneficiaryAccountObj->bank_name = getMasterBankName($request->get('bank_name'));
        // Save the UserContact instance
       // dd( $beneficiaryAccountObj);
        $beneficiaryAccountObj->save();
        // Redirect back with success message
        return back()->with('success', __('Beneficiary added successfully.'));
    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return back()->with('error', __('Failed to add contact: ') . $e->getMessage());
    }
}






    /**
    * Retailer Profile Methods
    * This Methods List down all the Benificary List
    * @param $id will be user contact id
    */
    function viewBeneficiaryListForUserContact(Request $request, $id){
        $user = Auth::user();
        $user_contact_id = decryptstring($id);
        $beneficiaryAccountList = BeneficiaryAccount::where('user_id',$user->id)
        ->where('user_contact_id',$user_contact_id)
        ->get();
        $viewPage = 'beneficiaryAccountList';
        $userContactDetails = UserContact::find($user_contact_id);
        return view($this->roleDirectory.'.Contacts.'.$viewPage,[
            'pageTitle'=> "Beneficiary List",
            'userProfile'=>$user,
            'listData'=>$beneficiaryAccountList,
            'userContactDetails'=>$userContactDetails
        ]);
    }

    


    /**
    * Retailer View Benificieries Methods
    * This Methods List down all the Benificary List Of the Contact
    * @param serviceid as payout key i.e CF, RZ, PT, PU
    * @param $id will be user contact id
    */
    public function viewBeneficiaryListForVerification(Request $request, $servicecontactid){
        try {
            $input = decryptstring($servicecontactid);
            if (preg_match('/^([A-Za-z]+)(\d+)$/', $input, $matches)) {
                $serviceName = $matches[1]; // Extracted letters (CF)
                $contact_id  = $matches[2];  // Extracted digits (10)
                $user = Auth::user();
                $user_contact_id = $contact_id;
                $beneficiaryAccountList = BeneficiaryAccount::select(
                    'beneficiary_accounts.*',
                    'payout_beneficiaries.api_contact_id',
                    'payout_beneficiaries.api_id',
                    'payout_beneficiaries.payout_name',
                    'payout_beneficiaries.is_payout_beneficiary_added',
                    'payout_beneficiaries.is_beneficiary_verified',
                    'master_banks.icon'
                )
                ->Join('master_banks', 'beneficiary_accounts.bank_id', '=', 'master_banks.id')
                ->leftJoin('payout_beneficiaries', 'beneficiary_accounts.id', '=', 'payout_beneficiaries.beneficiary_account_id')
                ->where('beneficiary_accounts.user_id', $user->id)
                ->where('beneficiary_accounts.user_contact_id', $user_contact_id)
                ->where(function ($query) use ($serviceName) {
                    $query->where('payout_beneficiaries.payout_name', $serviceName)
                          ->orWhereNull('payout_beneficiaries.payout_name');
                })
                ->get();
            
                //dd($beneficiaryAccountList);
                $viewPage = 'beneficiaryAccountList';
                $userContactDetails = UserContact::find($user_contact_id);
                return view($this->roleDirectory.'.Contacts.'.$viewPage,[
                    'pageTitle'=> "Beneficiary List",
                    'userProfile'=>$user,
                    'listData'=>$beneficiaryAccountList,
                    'userContactDetails'=>$userContactDetails,
                    'serviceName'=>$serviceName
                ]);
            }
        } catch (DecryptException $e) {
            // Handle the decryption error
            return response()->json(['error' => 'Invalid payload, Please try after somtime'], 400);
            //return redirect()->back()->withErrors(['error' => 'Invalid encrypted data. Please try again.']);
        }
    }





    /**
     * Method Name: getTransferFormforModleBox()
     * This method is called form ajax for open Model box
     * Start Transfer Money
     * @param string encrypted benificieery_id 
     * @return view
     */
    public function getTransferFormforModleBox(Request $request){
        if ($request->ajax()) {
            try {
                //echo "<pre>";
                //print_r($request->all());
                //die;
                $serviceType = $request->get('service') ?? 'payout';
                $indentifier = $request->get('indentifier');
                $beneficiaryString = decryptstring($indentifier);
                $beneficiaryArr = explode('|',$beneficiaryString);
                $serviceName = $beneficiaryArr[0];
                $beneficiary_id = $beneficiaryArr[1];
               
                $beneficiaryAccountDetails = BeneficiaryAccount::with('masterBank')->find($beneficiary_id);
                if($serviceType=='DMT'){
                    $route = route('payout.verify-before-transfer');
                    $indentifierType = encryptString($serviceType);
                    $viewPage = $this->roleDirectory.'.DMT.'.'transferModelBox';
                }else if($serviceType=='PAYOUT'){
                    if($serviceName=='PG'){
                        $route = route('payout.verify_before_pg_transfer');
                    }else{
                        $route = route('payout.verify-before-transfer');
                    }
                    $indentifierType = encryptString($serviceType);
                    $viewPage = $this->roleDirectory.'.Payout.'.'transferModelBox';
                }else{
                    $indentifierType = "";
                    $route = route('payout.verify-before-transfer');
                    $viewPage = $this->roleDirectory.'.Payout.'.'transferModelBox';
                }
                //dd($beneficiaryAccountDetails);
                return view($viewPage,[
                    'data'=> $beneficiaryAccountDetails,
                    'indentifier'=>$indentifier,
                    'indentifierType'=>$indentifierType,
                    'route'=>$route
                ]);
            } catch (DecryptException $e) {
                // Handle the decryption error
                return response()->json(['error' => 'Invalid payload, Please try after somtime'], 400);
                //return redirect()->back()->withErrors(['error' => 'Invalid encrypted data. Please try again.']);
            }
        } else {
            // If it's not an AJAX request, handle it accordingly
            abort(403, 'Unauthorized');
        }
    }

}
