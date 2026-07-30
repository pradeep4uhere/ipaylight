<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\DsController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\PDFController;





Route::middleware(['auth', '2fa','role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::any('/kyc-update', [AdminController::class, 'editProfileKYC'])->name('admin.kyc-update');
    Route::any('/kyc-update-save', [AdminController::class, 'editProfileKYCSave'])->name('admin.kyc-update-save');
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
    Route::any('/verify-email', [AdminController::class, 'verifyEmailAction'])->name('admin.verify-email');
    Route::any('/verify-mobile', [AdminController::class, 'verifyMobileAction'])->name('admin.verify-mobile');
    Route::any('/two-factor-auth', [AdminController::class, 'twoFactorAuthAction'])->name('admin.two-factor-auth');
    Route::any('/add-factor-auth', [AdminController::class, 'addAuthenticator'])->name('admin.add-authenticator');
    Route::any('/update_two_step_auth', [AdminController::class, 'updateTwoStepAuthenticator'])->name('admin.update_two_step_auth');

    Route::any('/bank-account', [AdminController::class, 'bankAccount'])->name('admin.bank-account');
    Route::any('/bank-account-save', [AdminController::class, 'bankAccountSave'])->name('admin.bank-account-save');
    Route::get('/edit-profile', [AdminController::class, 'editProfile'])->name('admin.edit-profile');
    Route::any('/edit-profile-save', [AdminController::class, 'editProfileSave'])->name('admin.edit-profile-save');
    Route::any('/alladminlist', [AdminController::class, 'allAdminList'])->name('admin.alladminlist');
    Route::any('/loginhistory', [AdminController::class, 'allLoginHistory'])->name('admin.loginhistory');
   
    //All SubAdmin Module
    Route::any('/editprofile/{user}', [AdminController::class, 'editSubAdminProfile'])->name('subadmin.profile_edit');
    Route::get('/viewprofile/{user}', [AdminController::class, 'viewSubAdminProfile'])->name('subadmin.profile_view');
    Route::any('/kycupdate/{user}', [AdminController::class, 'editSubAdminProfileKYC'])->name('subadmin.profile_kyc_update');
    Route::get('/profilepassword/{user}', [AdminController::class, 'changeSubAdminPassword'])->name('subadmin.profile_change_password');
    Route::get('/profileverifyemail/{user}', [AdminController::class, 'verifySubAdminEmailAction'])->name('subadmin.profile_verify_email');
    Route::get('/profilepermissionsetting/{user}', [AdminController::class, 'profilePermissionSetting'])->name('subadmin.profile_permission_setting');
    



  
    //All Customer Routes
    Route::any('/allcustomer', [CustomerController::class, 'allCustomerList'])->name('admin.allcustomer');
    Route::get('/profile_view/{user}', [CustomerController::class, 'profileView'])->name('admin.profile_view');
    Route::any('/kyc-update/{user}', [CustomerController::class, 'editProfileKYC'])->name('admin.profile-kyc-update');
    Route::any('/profile_edit/{user}', [CustomerController::class, 'editProfile'])->name('admin.profile_edit');
    Route::post('/profile_edit_save', [CustomerController::class, 'saveEditedProfile'])->name('admin.profile_edit_save');
    
    Route::post('/profile_kyc_save', [CustomerController::class, 'profileKYCSave'])->name('admin.profile_kyc_save');
    Route::get('/profile-password/{user}', [CustomerController::class, 'changePassword'])->name('admin.profile-change-password');
    Route::post('/profile-password_action', [CustomerController::class, 'updateChangePassword'])->name('admin.change-password-save');
    Route::get('/profile-verify-email/{user}', [CustomerController::class, 'verifyEmailAction'])->name('admin.profile-verify-email');
    Route::post('/send-verify-email', [CustomerController::class, 'sendEmailAction'])->name('admin.profile-send-email');
    Route::get('/profile-verify-mobile/{user}', [CustomerController::class, 'verifyEmailAction'])->name('admin.profile-verify-mobile');
    Route::get('/profile-two-factor-auth/{user}', [CustomerController::class, 'verifyEmailAction'])->name('admin.profile-two-factor-auth');
    Route::any('/profile-bank-account/{user}', [CustomerController::class, 'bankAccount'])->name('admin.profile-bank-account');
    Route::any('/profile-bank-account-save/{user}', [CustomerController::class, 'bankAccountSave'])->name('admin.profile-bank-account-save');
    Route::any('/profile-tpin-setting/{user}', [CustomerController::class, 'tpinSetting'])->name('admin.profile-tpin-setting');
    Route::any('/profile-tpin-save/{user}', [CustomerController::class, 'tpinSettingSave'])->name('admin.profile-tpin-save');
    Route::any('/profile-deactive/{user}', [CustomerController::class, 'profilActivateDeactivateUpdate'])->name('admin.profile-deactivate');
   


   
    
    //All Retailer Routes
    Route::any('/allretailer', [RetailerController::class, 'allRetailerList'])->name('admin.allretailer');

    
    //All Distributor Routes
    Route::any('/alldistributor', [DsController::class, 'allDistributorList'])->name('admin.alldistributor');
    Route::any('/distributor-commission-setting/{user}', [AdminController::class, 'distributorcommissionList'])->name('admin.profile_commission');
    Route::any('/search-commission-setting/{user}', [AdminController::class, 'addGatewayCommission'])->name('admin.profile_addcommission');
    Route::any('/save_payment_type_to_profile/{user}', [AdminController::class, 'saveProfilePaymentTypeGateway'])->name('admin.save_payment_type_to_profile');
    
    Route::any('/allretailers/{user}', [AdminController::class, 'allRetailerList'])->name('admin.profile_retailers');
    Route::any('/ro-search-commission-setting/{user}', [AdminController::class, 'addRetailerGatewayCommission'])->name('admin.retailer_addcommission');
    Route::any('/rocommissionsetting/{user}/', [AdminController::class, 'retailerCommissionList'])->name('admin.profile_ro_commission');

    //User Dashboard
    Route::any('/profile_ro_dashboard/{user}/', [RetailerController::class, 'retailerAdminDashboard'])->name('admin.profile_ro_dashboard');
    Route::any('/wallet_transfer/{user}/', [RetailerController::class, 'retailerAdminWalletTransfer'])->name('admin.wallet_transfer');
    Route::any('/transfer_to_wallet/{user}/', [RetailerController::class, 'walletToWalletTransfer'])->name('admin.transfer_to_wallet');
    Route::any('/wallet_transactions/{user}/', [RetailerController::class, 'walletTransactionList'])->name('admin.wallet_transactions');
    Route::any('/user_permission/{user}/', [RetailerController::class, 'userProfilePermissions'])->name('admin.user_permission');
    Route::any('/profile_payment_page/{user}/', [RetailerController::class, 'userProfilePaymentPage'])->name('admin.profile_payment_page');
    Route::any('/comming_soon/{user}/', [RetailerController::class, 'userProfilePaymentPage'])->name('admin.comming_soon');

    Route::any('/save-domestic-settalment', [SettlementController::class, 'saveDomesticSettalmentPermissions'])->name('admin.save-domestic-settalment');
    Route::any('/save-international-settalment', [SettlementController::class, 'saveInternationalSettalmentPermissions'])->name('admin.save-international-settalment');
    Route::any('/save-permission-setting/{user}', [RetailerController::class, 'saveProfileSettingPermissions'])->name('admin.save-permission-setting');
    Route::any('/save-gateway-permission/{user}', [RetailerController::class, 'savePaymentGatewaySettingPermissions'])->name('admin.save-gateway-permission');
    Route::post('/profile-removeegateway', [RetailerController::class, 'removePaymentGatewayFromProfile'])->name('admin.removeegateway');
   

    
    

    //All Transaction route history
    Route::any('/transactions', [AdminController::class, 'transaction'])->name('admin.transactions');
    Route::post('/transactions-details', [AdminController::class, 'getTransactionDetails'])->name('admin.get-transaction-details');
    Route::get('/transactions-view/{tid}', [AdminController::class, 'getTransactionDetailsInView'])->name('admin.transaction-view');


   
    //All Invoice Route
    Route::get('/invoices', [PDFController::class, 'getAllInvoiceList'])->name('admin.invoice');
    Route::get('/invoices-file/{dir}', [PDFController::class, 'getAllInvoiceFileList'])->name('admin.invoice-file');
    Route::get('/view-pdf/{filename}', [PDFController::class,'viewPDF'])->name('view.pdf');

    //All Wallet Related Routes
    Route::any('/wallet_transactions', [AdminController::class, 'allWalletTransactionsList'])->name('admin.wallet_transactions');


    Route::any('/settalment', [SettlementController::class, 'getAllSettalment'])->name('admin.settalment');
    Route::any('/settalment_details/{id}', [SettlementController::class, 'viewSettalmentDetailsInRetailerProfile'])->name('admin.view-settalment');
    

    //All Announcement Routes
    Route::get('/roannouncement', [CustomerController::class, 'CreateAnnouncement'])->name('admin.roannouncement');
    Route::post('/saveannouncement', [CustomerController::class, 'SaveAnnouncement'])->name('save.announcement');
    Route::any('/announcements', [CustomerController::class, 'ListAnnouncement'])->name('list.announcement');
    Route::any('/editannouncements/{id}', [CustomerController::class, 'UpdateAnnouncement'])->name('edit.announcment');
    Route::any('/updateannouncements/{id}', [CustomerController::class, 'SaveUpdateAnnouncement'])->name('update.announcment');
    
   
    Route::get('/dsannouncement', [AdminController::class, 'dashboard'])->name('admin.dsannouncement');
    Route::get('/announcement', [AdminController::class, 'dashboard'])->name('admin.announcement');

    //All Profile Routes
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::delete('/admin/profile', [AdminController::class, 'destroy'])->name('admin.destroy');
    
    
    
    Route::any('/admin/add-authenticator', [AdminController::class, 'addAuthenticator'])->name('admin.add-authenticator');
    Route::any('/admin/qrcode', [AdminController::class, 'qrcodeAction'])->name('admin.qrcode');

    

    //All Routes Related With Gateways
    Route::get('/addgateway', [GatewayController::class, 'addNewPaymentGateways'])->name('addgateway');
    Route::get('/editgateway/{id}', [GatewayController::class, 'editPaymentGateways'])->name('editgateway');
    Route::post('/updategateway', [GatewayController::class, 'updatePaymentGateways'])->name('updategateway');
    Route::post('/deletegateway', [GatewayController::class, 'deletePaymentGateways'])->name('deletegateway');
    
    
    
    Route::post('/addgateway', [GatewayController::class, 'savePaymentGateways'])->name('savegateway');
    Route::any('/allgateway', [GatewayController::class, 'allGatewaysList'])->name('allgateway');
    Route::any('/loginhistory', [AdminController::class, 'myLoginHistory'])->name('admin.loginhistory');
    


    //FAQs Module
    Route::any('/faqs', [FaqsController::class, 'index'])->name('admin.faqs');
    Route::any('/faqs/{category}', [FaqsController::class, 'index'])->name('admin.faqscat');
    Route::any('/edit-faqs/{id}', [FaqsController::class, 'editFAQ'])->name('faq.edit');
    Route::any('/save-faqs/{id}', [FaqsController::class, 'saveEditFAQ'])->name('faq.saveedit');
    Route::any('/getsubcategory', [FaqsController::class, 'getSubcategory'])->name('faqs.getsubcategory');
    
    Route::any('/faqs_add_item', [FaqsController::class, 'addNewItem'])->name('faq.add_new_item');
    Route::post('/faqs_save', [FaqsController::class, 'saveNewItem'])->name('faq.save');
    










});