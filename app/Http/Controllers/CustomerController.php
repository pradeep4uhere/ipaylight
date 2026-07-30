<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserKycUpdateRequest;
use App\Http\Requests\UserBankAccountUpdateRequest;
use App\Http\Requests\BankAccountUpdateRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Helpers;
use Illuminate\Http\RedirectResponse;
use App\Helpers\FileUploadHelper;
use App\Helpers\CustomHelper;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Services\ProfileData;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;

class CustomerController extends Controller 
{
    
    protected $userModel;

    protected $profileImageDir; 

    protected $roleDirectory = 'Customer';

    //Get Role Name, This Role Name represent the current Directory
    protected $getRoleDir = '';


    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }



     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function validated(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'mobile' => ['required', 'integer', 'email', 'digits:10', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    
    /**
     * Display a listing of the resource.
     */
    public function allCustomerList():View
    {
        //Get All Customer List
        $userList = $this->userModel->getAllCustomerList();
        return view('Customer.index',[
            'pageTitle'=> "All Customer",
            'userList'=>$userList
        ]);
    }



    /**
     * Customer Profile View for Distributor and Admin Profile 
     * where Distributor and admin can view and edit profile
     * Distributor can only edit the profile of user status is not 
     * active, else he won't be able to edit the user profiile
     * Admin can Edit the profile either user is active and inactive
     */
    public function profileView(Request $request, User $user) : View
    {   
        $userProfile = $user;
        //dd($userProfile );
        if(isSuperDistributor()){
            $elements = "SuperDistributor.Profile.ProfileView"; 
        }else{
            $elements = "Customer.Profile.ProfileView";
        }
        
        return view('Customer.Profile.profilePage',[
            'pageTitle'=> "Profile Page",
            'userProfile'=>$userProfile,
            'elements'=> $elements
        ]);
    }

    
     /**
     * Customer Profile View
     */
    public function saveEditedProfile(ProfileUpdateRequest $request) : RedirectResponse
    {   
        if($request->isMethod('post')){
            
            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                $file = $request->file('avatar');
                $image_name = $file->hashName(); // Generate a unique, random name...
                $path = $file->storePublicly('avatars', 'public');
                
            }
            
        
            $request->user()->fill($request->validated());
            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            if($request->get('avatar_remove')==1){
                $request->user()->picture = '';
            }
            
            // Update user attributes
            $userId = $request->input('id');
            $user = User::find($userId);
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile  = $request->input('mobile');
            $user->address = $request->input('address');
            $user->city_name  = $request->input('city');
            $user->state   = $request->input('state');
            $user->zipcode = $request->input('zipcode');
            $user->status  = $request->input('status');
            if($request->input('role')=='user'){
                $user->parent_id = 0;
            }else if($request->input('role')=='distributor'){
                if($request->get('is_superdistributor')=='yes'){
                    $user->parent_id = $request->get('super_user_id');
                }else{
                    $user->parent_id = 0;
                }
            }else if($request->input('role')=='retailer'){
                $user->parent_id = $request->input('user_id');
            }else if($request->input('role')=='sudadmin'){
                $user->parent_id = 1;
            }else{
                $user->parent_id = 0;
            }
            if(Auth::user()->role == 'admin'){
                $user->role   = $request->input('role');
            }
            if($user->agent_code==''){
                $user->agent_code       = generateAgentCode($user->id);
            }
            if($request->input('status') == 'active'){
                $user->status_reason_code   = 0;
                $user->status_reason        = "Profile Active Now.";
            }else{
                $user->status_reason_code   = $request->input('status_reason_code');
                $user->status_reason        = $request->input('status_reason');
            }
            //dd($request->all());
            //dd($user);
            //Upload Image If Image file is uplaoded by the user
            $dynamicPath = config('global.PROFILE_PICTURE_PATH'); // Example: dynamic storage path
            $inputFileElementName = 'avatar'; // Example: dynamic file name
            $image_name = FileUploadHelper::uploadFile($request, $dynamicPath, $inputFileElementName);
            if ($image_name !== null) {
                $user->picture = $image_name;
            }


            // If email is changed, reset email verification
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }
            if($request->get('avatar_remove')==1){
                $user->picture = '';
            }

            if($request->get('is_mobile_verified')==1){
                $user->is_mobile_verified = 1;
                $user->mobile_verified_at = date('Y-m-d H:i:s');
            }else{
                $user->is_mobile_verified = 0;
            }

            if($request->get('is_email_verified')==1){
                $user->is_email_verified = 1;
                $user->email_verified_at = date('Y-m-d H:i:s');
            }else{
                $user->is_email_verified = 0;
               
            }
            
            //dd($user);
            //dd($request->all());


            if($user->save()){
                return redirect()->back()->with('success', 'Profile updated successfully.');
            }
            
        }
    }


    

    /**
     * Customer Profile Edit for Distributor and Admin Profile 
     * where Distributor and admin can view and edit profile
     * Distributor can only edit the profile of user status is not 
     * active, else he won't be able to edit the user profiile
     * Admin can Edit the profile either user is active and inactive
     */
    public function editProfile(Request $request, User $user) : View
    {   
        $userProfile = $user;
        $dsList = User::where('role','distributor')->get();
        $sdsList = User::where('role','superdistributor')->get();
        
        if(Auth::user()->role == 'distributor'){
            if( $userProfile->status!='active'){
                $elements = "Customer.Profile.editRetailerProfileForm";
            }else{
                $elements = "Customer.Profile.ProfileView";
            }
        }else{
            $elements = "Customer.Profile.editProfileForm";
        }
       //dd(Auth::user()->role);
        return view('Customer.Profile.profilePage',[
            'pageTitle'=> "Profile Edit",
            'userProfile'=>$userProfile,
            'dsList'=>$dsList,
            'elements'=> $elements,
            'sdsList'=>$sdsList
        ]);
    }


      /**
     * Customer Profile View
     */
    public function editProfileKYC(Request $request, $id) : View
    {   
        
        $user_id = Crypt::decryptString($id);
        //Get All Customer List
        $dsList = User::where('role','distributor')->get();
        $sdsList = User::where('role','superdistributor')->get();
        $userProfile = User::find($user_id);
        if(Auth::user()->role == 'distributor'){
            if( $userProfile->status!='active'){
                $elements = 'editKYCFormForDistributorAccount';
            }else{
                $elements = "viewKYCForm";
            }
        }else if(isSuperDistributor()){
            $elements = 'viewKYCForm';
        }else if(Auth::user()->role == 'retialer'){
            $elements = 'editKYCForm';
        }else if(Auth::user()->role == 'admin'){
            $elements = 'editKYCForm';
        }else{
            $elements = "viewKYCForm";
        }

        
        return view('Customer.Profile.profilePage',[
            'pageTitle'=> "User KYC Update",
            'userProfile'=>$userProfile,
            'elements'=> "Customer.Profile.".$elements,
            'dsList'=>$dsList,
            'sdsList'=>$sdsList
        ]);
    }

    
     /**
     * Customer Profile View From Admin Panel
     * Admin Can Update User Profile From Admin Panel
     * Created By: Pradeep Kumar
     */
    public function profileKYCSave(UserKycUpdateRequest $request) : RedirectResponse
    {   
        if($request->isMethod('post')){
            //dd($request->all());
            $request->user()->fill($request->validated());
            if($request->get('avatar_remove')==1){
                $request->user()->photograph = '';
            }
            if($request->get('aadhar_back_pic_remove')==1){
                $request->user()->aadhar_back_pic = '';
            }
            if($request->get('aadhar_front_pic_remove')==1){
                $request->user()->aadhar_front_pic = '';
            }
            if($request->get('pan_card_pic_remove')==1){
                $request->user()->pan_card_pic_remove = '';
            }
            // Update user attributes
            $userId                     = $request->input('id');
            $user                       = User::find($userId);
            $user->name                 = $request->input('name');
            $user->last_name            = $request->input('last_name');
            $user->aadhar_card_number   = $request->input('aadhar_card_number');
            $user->pan_card_number      = $request->input('pan_card_number');
            
           
            //Upload Image If Image file is uplaoded by the user
            $dynamicEkycPath = config('global.PROFILE_EKYC_PATH'); // Example: dynamic storage path
            $avatarPath = config('global.PROFILE_PICTURE_PATH');
            $photographInputElementName = 'photograph'; // Example: dynamic file name 
            $photograph_image_name = FileUploadHelper::uploadFile($request, $avatarPath, $photographInputElementName);
            if ($photograph_image_name !== null) {
               echo  $user->photograph = $photograph_image_name; 
               if($user->picture==''){
               echo  $user->picture = $photograph_image_name; 
               }
            }

            $aadharFrontPicInputElementName = 'aadhar_front_pic'; // Example: dynamic file name
            $aadhar_front_pic_image_name = FileUploadHelper::uploadFile($request, $dynamicEkycPath, $aadharFrontPicInputElementName);
            if ($aadhar_front_pic_image_name !== null) {
                $user->aadhar_front_pic = $aadhar_front_pic_image_name;
            }


            $aadharBackPicInputElementName = 'aadhar_back_pic'; // Example: dynamic file name
            $aadhar_back_pic_image_name = FileUploadHelper::uploadFile($request, $dynamicEkycPath, $aadharBackPicInputElementName);
            if ($aadhar_back_pic_image_name !== null) {
                $user->aadhar_back_pic = $aadhar_back_pic_image_name;
            }


            $panCardPicElementName = 'pan_card_pic'; // Example: dynamic file name
            $pan_card_pic_image_name = FileUploadHelper::uploadFile($request, $dynamicEkycPath, $panCardPicElementName);
            if ($aadhar_back_pic_image_name !== null) {
                $user->pan_card_pic = $pan_card_pic_image_name;
            }
            if($request->get('avatar_remove')==1){
                $user->photograph = '';
            }
            if($request->get('aadhar_front_pic_remove')==1){
                $user->aadhar_front_pic = '';
            }
            if($request->get('avatar_back_pic_remove')==1){
                $user->aadhar_back_pic = '';
            }
            if($request->get('user_id')!=""){
                $user->parent_id = $request->get('user_id');
            }

            if($request->get('pan_card_pic_remove')==1){
                $user->pan_card_pic = '';
            }

            //dd($request->get('is_kyc_completed'));
            if($request->get('is_kyc_completed')=="true"){
                $user->is_kyc_completed = 1;
            }else{
                $user->is_kyc_completed = 0;
            }

            
            //dd($user);
            if($user->save()){
                return redirect()->back()->with('success', 'Profile KYC updated successfully.');
            }else{
                return redirect()->back()->with('error', 'Profile KYC not updated.');
            }
            
        }
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
     * Customer Profile View
     */
    public function changePassword(Request $request, $id) : View
    {   
        
        $user_id = Crypt::decryptString($id);
        $userProfile = User::find($user_id);
        return view('Customer.Profile.profilePage',[
            'userProfile'=>$userProfile,
            'pageTitle'=>'Change Password',
            'elements'=>'Customer.Profile.ChangePasswordForm'
        ]);
    }


    /**
     * Verify Email Address
     */
    public function verifyEmailAction(Request $request, $id) : View
    {
        
        $user_id = Crypt::decryptString($id);
        $userProfile = User::find($user_id);
        return view('Customer.Profile.profilePage',[
            'userProfile'=>$userProfile,
            'pageTitle'=>'Verify Email Address',
            'elements'=>'Customer.Profile.verifyEmailPage'
        ]);
    }



    /**
     * Verify Email Address
     */
    public function sendEmailAction(Request $request) : RedirectResponse
    {
        $user_id = $request->get('id');
        $user = User::findOrFail($user_id);
        //dd($user);
        // Check if the user email is already verified
        if (!$user->hasVerifiedEmail()) {
            // Send email verification notification
            $user->sendEmailVerificationNotification();
            return redirect()->back()->with('success', 'Email verification sent successfully.');
        } else {
            return redirect()->back()->with('info', 'Email is already verified.');
        }

    }



    /**
     * Update the user's password.
     */
    public function updateChangePassword(Request $request): RedirectResponse
    {
        $user_id = $request->get('id');
        $user = User::findOrFail($user_id);
        $oldPassword = $user->password;
        $validator = Validator::make($request->all(), [
            'current_password' => [ 'required'],
            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //dd($user->password);
        if (Hash::check($request->get('current_password'), $user->password)) {
            $password_confirmation = $request->get('password_confirmation');
            $user->password = Hash::make($password_confirmation);
            if($user->save()){
                return redirect()->back()->with('success', 'Profile Passowrd updated successfully.');
            }else{
                return redirect()->back()->with('error', 'Profile Passowrd not updated.');
            }
        }else{
            return redirect()->back()->with('error', 'Current Passowrd not valid.');
        }
    }



    

    /**
     * Add TPIN Account Setting Details
     */
    public function tpinSetting(Request $request,User $user): View
    {
        $userProfile = $user;
        //dd($userProfile);
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>'TPIN Setting',
            'elements'=>'Customer.Profile.tpinSettingForm',
            'userProfile'=>$userProfile
        ]);
    }

    
     /**
     * Update the user's TPIN Password.
     */
    public function tpinSettingSave(Request $request, User $user): RedirectResponse
    {
        $user_id = $user->id;
        $user = User::findOrFail($user_id);
        $validator = Validator::make($request->all(), [
            'confirm_tpin' => [ 'required','min:6'],
            'tpin' => [
                'required',
                'min:6',
                'same:confirm_tpin'
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $user->tpin = $request->get('tpin');
            //dd($user);
            if($user->save()){
                return redirect()->back()->with('success', 'Profile TPIN updated successfully.');
            }else{
                return redirect()->back()->with('error', 'Profile TPIN not updated.');
            }
        }
    
    }

    
    /**
     * Add Bank Account Details
     */
    public function bankAccount(Request $request,User $user): View
    {
        $userProfile = $user;
        if(Auth::user()->role == 'distributor'){
            if( $userProfile->status=='active'){
                $pageTitle = 'Bank Account Details';
                $elements = 'viewBankAccountForm';
            }else{
                $pageTitle = 'Edit Bank Account Details';
                $elements = "editBankAccountForm";
            }
        }else if(Auth::user()->role == 'admin'){
            $pageTitle = 'Edit Bank Account Details';
            $elements = "editBankAccountForm";
        }else{
            $pageTitle = 'Bank Account Details';
            $elements = 'viewBankAccountForm';
        }
      
        //dd($pageTitle);
        return view($this->roleDirectory.'.Profile.profilePage',[
            'pageTitle'=>$pageTitle,
            'elements'=>'Customer.Profile.'.$elements ,
            'userProfile'=>$userProfile
        ]);
    }



     /**
     * Add Bank Account Details
     */
    public function bankAccountSave(BankAccountUpdateRequest $request, User $user): RedirectResponse
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
            $imagePath = $request->file('cancle_cheque')->store('ekyc', 'public');
            $filename = basename($imagePath);
            $request->user()->cancle_cheque = $filename;
        }
        $user_id = $user->id;
        $user = User::findOrFail($user_id);
        $user->account_number = $request->get('account_number');
        $user->bank_name = $request->get('bank_name');
        $user->bank_ifsc_code = $request->get('bank_ifsc_code');
        $user->is_account_verified = $request->get('is_account_verified');
        $dynamicEkycPath = config('global.PROFILE_EKYC_PATH'); // Example: dynamic storage path
        $cancleChequeInputElementName = 'cancle_cheque'; // Example: dynamic file name
        if ($request->hasFile('cancle_cheque')) {
            $cancle_cheque_name = FileUploadHelper::uploadFile($request, $dynamicEkycPath, $cancleChequeInputElementName);
            if ($cancle_cheque_name !== '') {
                $user->cancle_cheque = $cancle_cheque_name;
            }
        }
       
        
        $user->save();
        return redirect()->back()->with('success', 'Profile Bank Account Updated.');
    }





    /**
     * Admin Method: profilActivateDeactivateUpdate()
     * @param User
     * @return redirect to previous page
     */
    public function profilActivateDeactivateUpdate(Request $request, User $user){
        $userObj  = User::find($user->id);
        if($request->has('deactivate')){
            $userObj->status = "inactive";
            if($userObj->save()){
                return redirect()->back()->with('error', 'Profile Account is Deactivated Now Successfully.');
            }else{
                return redirect()->back()->with('error', 'Profile is Account Deactivation Failed');
            }
        }else{
            $userObj->status = "active";
            if($userObj->save()){
                return redirect()->back()->with('success', 'Profile Account is Activated Successfully.');
            }else{
                return redirect()->back()->with('error', 'Profile Account Activation Failed');
            }
        }
    }






/**
 * Method Name :: CreateAnnouncement()
 */
public function CreateAnnouncement(Request $request){
    if(Auth::user()->role=='admin'){
        $viewPage = "AdminAnnouncementPage";
        $element = "Form";
    }if(Auth::user()->role=='distributor'){
        $viewPage = "DistributorAnnouncementPage";
        $element = "Form";
    }
    return view($this->roleDirectory.'.Announcement.'.$viewPage,[
        'pageTitle'=>'Announcement',
        'element'=>$element
    ]);

}




/**
 * Method Name :: SaveAnnouncement()
 */
public function SaveAnnouncement(AnnouncementRequest $request){
    //dd($request->all());
    $filename = '';
    if ($request->hasFile('document_file')) {
        $request->validate([
            'document_file' => 'required|mimes:pdf,doc,docx|max:2048',// Example validation rules
        ]);
        // Store the uploaded file
        $imagePath = $request->file('document_file')->store('document', 'public');
        $filename = basename($imagePath);
        $request->merge(['document' => $filename]);
    }
    $save = [];
    $save['title'] = $request->get('title');
    $save['content'] = $request->get('content');
    $save['start_date'] = $request->get('start_date');
    $save['end_date'] = $request->get('end_date');
    $save['is_active'] = $request->get('is_active');
    $save['document_file']=$filename;
    //dd($save);
    if(Announcement::create($save)){
        return redirect()->back()->with('success', 'Announcement Updated Sucessfully');
    }else{
        return redirect()->back()->with('error', 'Announcement Not Updated');
    }

}

/**
 * Method Name: ListAnnouncement()
 */
public function ListAnnouncement(Request $request){
    $announcementList = Announcement::paginate(20);
    if(Auth::user()->role=='admin'){
        $viewPage = "AnnouncementList";
    }if(Auth::user()->role=='distributor'){
       
        $viewPage = "AnnouncementList";
    }
    return view($this->roleDirectory.'.Announcement.'.$viewPage,[
        'pageTitle'=>'Announcement List',
        'list'=>$announcementList
    ]);

}




/**
 * Method Name: Edit Announcement
 */
public function UpdateAnnouncement(Request $request,$id){
    $id = decryptString($id);
    if($id){
        $announcement = Announcement::find($id);
        $viewPage = "AdminAnnouncementPage";
        $element = "EditForm";
    }
    return view($this->roleDirectory.'.Announcement.'.$viewPage,[
        'pageTitle'=>'Update Announcement',
        'announcement'=>$announcement,
        'element'=>$element
    ]);
}



/**
 * Method Name: Edit Announcement
 */
public function SaveUpdateAnnouncement(Request $request,$id){
    try {
            $id = decryptString($id);
            $announcementObj = Announcement::find($id);
            $filename = '';
            if ($request->hasFile('document_file')) {
                $request->validate([
                    'document_file' => 'required|mimes:pdf,doc,docx|max:2048',// Example validation rules
                ]);
                // Store the uploaded file
                $imagePath = $request->file('document_file')->store('document', 'public');
                $filename = basename($imagePath);
                $request->merge(['document' => $filename]);
                $announcementObj->document_file=$filename;
            }
            $announcementObj->title = $request->get('title');
            $announcementObj->content = $request->get('content');
            $announcementObj->start_date = $request->get('start_date');
            $announcementObj->end_date = $request->get('end_date');
            $announcementObj->is_active = $request->get('is_active');
            if($announcementObj->save()){
                return redirect()->back()->with('success', 'Announcement Updated Sucessfully');
            }else{
                return redirect()->back()->with('error', 'Announcement Not Updated');
            }
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return redirect()->back()->with('error', 'Error decrypting the ID');
    }

}












}
