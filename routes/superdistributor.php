<?php

use App\Http\Controllers\SuperDistributorController;
use App\Http\Controllers\PaymentPageController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillPaymentController;
use App\Http\Controllers\InboxMessageController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\FaqsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



Route::middleware(['auth','verified','2fa','role:superdistributor'])->group(function () {
    Route::get('/sds/dashboard', [SuperDistributorController::class, 'dashboard'])->name('sds.dashboard');

    Route::get('/sds/profile', [SuperDistributorController::class, 'profile'])->name('sds.profile');
    Route::any('/sds/kyc-update', [SuperDistributorController::class, 'editProfileKYC'])->name('sds.kyc-update');
    Route::any('/sds/kyc-update-save', [SuperDistributorController::class, 'editProfileKYCSave'])->name('sds.kyc-update-save');
    Route::get('/sds/change-password', [SuperDistributorController::class, 'changePassword'])->name('sds.change-password');
    Route::any('/sds/verify-email', [SuperDistributorController::class, 'verifyEmailAction'])->name('sds.verify-email');
    Route::any('/sds/verify-mobile', [SuperDistributorController::class, 'verifyMobileAction'])->name('sds.verify-mobile');
    Route::any('/sds/two-factor-auth', [SuperDistributorController::class, 'twoFactorAuthAction'])->name('sds.two-factor-auth');
    Route::any('/sds/add-factor-auth', [SuperDistributorController::class, 'addAuthenticator'])->name('sds.add-authenticator');
    Route::any('/sds/update_two_step_auth', [SuperDistributorController::class, 'updateTwoStepAuthenticator'])->name('sds.update_two_step_auth');
    Route::any('/sds/bank-account', [SuperDistributorController::class, 'bankAccount'])->name('sds.bank-account');
    Route::any('/sds/bank-account-save', [SuperDistributorController::class, 'bankAccountSave'])->name('sds.bank-account-save');
    Route::get('/sds/edit-profile', [SuperDistributorController::class, 'editProfile'])->name('sds.edit-profile');
    Route::any('/sds/edit-profile-save', [SuperDistributorController::class, 'editProfileSave'])->name('sds.edit-profile-save');
   
    Route::prefix('sds')->middleware('checkUserStatus')->group(function () {
        Route::get('profile_view/{user}', [CustomerController::class, 'profileView'])->name('sds.profile_view');
        Route::any('kyc-update/{user}', [CustomerController::class, 'editProfileKYC'])->name('sds.profile-kyc-update');
        Route::any('profile_edit/{user}', [CustomerController::class, 'editProfile'])->name('sds.profile_edit');
        Route::post('profile_edit_save', [CustomerController::class, 'saveEditedProfile'])->name('sds.profile_edit_save');
        Route::post('profile_kyc_save', [CustomerController::class, 'profileKYCSave'])->name('sds.profile_kyc_save');
        Route::get('profile-password/{user}', [CustomerController::class, 'changePassword'])->name('sds.profile-change-password');
        Route::post('profile-password_action', [CustomerController::class, 'updateChangePassword'])->name('sds.change-password-save');
        Route::get('profile-verify-email/{user}', [CustomerController::class, 'verifyEmailAction'])->name('sds.profile-verify-email');
        Route::post('send-verify-email', [CustomerController::class, 'sendEmailAction'])->name('sds.profile-send-email');
        Route::get('profile-verify-mobile/{user}', [CustomerController::class, 'verifyEmailAction'])->name('sds.profile-verify-mobile');
        Route::get('profile-two-factor-auth/{user}', [CustomerController::class, 'verifyEmailAction'])->name('sds.profile-two-factor-auth');
        Route::any('profile-bank-account/{user}', [CustomerController::class, 'bankAccount'])->name('sds.profile-bank-account');
        Route::any('profile-bank-account-save/{user}', [CustomerController::class, 'bankAccountSave'])->name('sds.profile-bank-account-save');
        Route::any('profile-tpin-setting/{user}', [CustomerController::class, 'tpinSetting'])->name('sds.profile-tpin-setting');
        Route::any('profile-tpin-save/{user}', [CustomerController::class, 'tpinSettingSave'])->name('sds.profile-tpin-save');
        Route::any('rocommission/{user}', [SuperDistributorController::class, 'myRetailerCommissionList'])->name('sds.ro_commission');
        Route::any('search-commission-setting/{user}', [SuperDistributorController::class, 'addGatewayCommission'])->name('sds.profile_addcommission');

         // Additional routes
        Route::any('ro_dashboard/{user}', [RetailerController::class, 'retailerAdminDashboard'])->name('sds.profile_ro_dashboard');
        Route::any('ro_wallet_transfer/{user}', [SuperDistributorController::class, 'retailerAdminWalletTransfer'])->name('sds.wallet_transfer');
        Route::any('transfer_to_wallet/{user}', [SuperDistributorController::class, 'walletToWalletTransfer'])->name('sds.transfer_to_wallet');
        //Route::any('ro_wallet_transactions/{user}', [SuperDistributorController::class, 'walletTransactionList'])->name('sds.wallet_transactions');
        Route::any('user_permission/{user}', [SuperDistributorController::class, 'userProfilePermissions'])->name('sds.user_permission');
        Route::any('profile_payment_page/{user}', [SuperDistributorController::class, 'userProfilePaymentPage'])->name('sds.profile_payment_page');
        Route::any('ro_transaction_list/{user}', [SuperDistributorController::class, 'userProfileTransactionList'])->name('sds.ro_transaction_list');
        Route::any('retailer_transaction_report/{user}', [SuperDistributorController::class, 'userTransactionList'])->name('sds.retailer_transaction_report');
        Route::any('ro_transactions_details', [SuperDistributorController::class, 'getTransactionDetails'])->name('sds.ro-transaction-details');
        Route::get('transactions-view/{tid}', [SuperDistributorController::class, 'getTransactionDetailsInView'])->name('sds.ro_transaction_view');
        Route::any('comming_soon/{user}', [SuperDistributorController::class, 'profileElementPaymentPage'])->name('sds.comming_soon');
        Route::any('ro_wallet_transactions/{user}', [RetailerController::class, 'myWalletTransactionsList'])->name('sds.wallet_transactions');
        Route::any('ro_settalment/{user}', [SuperDistributorController::class, 'getAllSettalment'])->name('sds.settalment-report');
        Route::any('ro_allcontactlist/{user}', [ContactController::class, 'getAllContactListInDistributor'])->name('sds.rocontactlist');
        Route::any('ro_viewcontact/{id}', [ContactController::class, 'getContactDetailsInDistributor'])->name('sds.view-contact');
        Route::delete('ro_delete-contact/{id}', [ContactController::class, 'destroy'])->name('sds.delete-contact');
        Route::post('ro_addbeneficiary', [ContactController::class, 'saveaddBeneficiaryDetails'])->name('sds.save-beneficiary-details');
        Route::any('ro_view-beneficiary/{id}', [ContactController::class, 'viewBeneficiaryListForUserContact'])->name('sds.view-beneficiary');
        Route::delete('ro_delete-contact/{id}', [ContactController::class, 'destroy'])->name('sds.delete-contact');
    
    
        
        //Additional List For Ditributor in SuperDistributor Account
        Route::any('alldistributor', [SuperDistributorController::class, 'allSuperDistributorList'])->name('sds.alldistributor');
        Route::any('/distributor-commission-setting/{user}', [SuperDistributorController::class, 'distributorcommissionList'])->name('sds.profile_commission');
        Route::any('/search-commission-setting/{user}', [SuperDistributorController::class, 'addGatewayCommission'])->name('sds.profile_addcommission');
        Route::any('/search-commission-setting/{user}/{gatewayname}', [SuperDistributorController::class, 'addGatewayCommission'])->name('sds.profile_editcommission');
        Route::any('/save_payment_type_to_profile/{user}', [SuperDistributorController::class, 'saveProfilePaymentTypeGateway'])->name('sds.save_payment_type_to_profile');
       
        
        
        
        // Additional SuperDistributorController routes
        Route::any('allretailer', [SuperDistributorController::class, 'allDsRetailerList'])->name('sds.allretailer');
        Route::any('allretailers/{user}', [SuperDistributorController::class, 'allRetailerList'])->name('sds.profile_retailers');
        Route::any('ro-search-commission-setting/{user}', [SuperDistributorController::class, 'addRetailerGatewayCommission'])->name('sds.retailer_addcommission');
        Route::any('rocommissionsetting/{user}', [SuperDistributorController::class, 'retailerCommissionList'])->name('sds.profile_ro_commission');
        Route::any('save_payment_type_to_profile/{user}', [SuperDistributorController::class, 'saveProfilePaymentTypeGateway'])->name('sds.save_payment_type_to_profile');
        Route::any('qrcode', [SuperDistributorController::class, 'qrcodeAction'])->name('sds.qrcode');

         // PaymentPageController routes
        Route::any('profile_payment_links/{user}', [PaymentPageController::class, 'retailerPaymentLinks'])->name('sds.profile_payment_links');
        Route::any('generate_payment_link/{user}', [PaymentPageController::class, 'generatePaymentLinkForRetailer'])->name('sds.generate-payment-link');
        Route::any('savepaymentlink/{user}', [PaymentPageController::class, 'savePaymentLinkForRetailer'])->name('sds.rosavePaymentLink');
        Route::any('mypaymentlink', [PaymentPageController::class, 'myPaymentLink'])->name('sds.mypaymentlink');
        Route::any('editlink/{id}', [PaymentPageController::class, 'editlinkMyPaymentLink'])->name('sds.editLink');
        Route::delete('payment-links/{paymentLink}', [PaymentPageController::class, 'destroy'])->name('ds-payment-links.destroy');

        Route::any('myroi', [SuperDistributorController::class, 'myCommissionList'])->name('sds.my_commission_setting');
        Route::any('allcustomer', [CustomerController::class, 'allCustomerList'])->name('sds.allcustomer');
    
        //All wallets Routes
        Route::get('wallettransfer', [WalletController::class, 'walletTransfer'])->name('sds.wallettransfer');

        //All Payment Pages
        Route::get('paymentpage', [PaymentPageController::class, 'paymentPage'])->name('sds.paymentpage');
        Route::get('paymentlink', [PaymentPageController::class, 'paymentLink'])->name('sds.paymentlink');
        //All Contact Route
        Route::get('contactlist', [ContactController::class, 'contactList'])->name('sds.contactlist');
        Route::get('addcontact', [ContactController::class, 'contactAdd'])->name('sds.addcontact');
    });
   
    //all Transaction Related Route
    Route::any('/sds/transaction_list/', [SuperDistributorController::class, 'AllTransactionList'])->name('sds.transactions-list');
    //Login History
    Route::any('/sds/myloginhistory', [SuperDistributorController::class, 'myLoginHistory'])->name('sds.login_history');
    
    //all transaction
    Route::get('/sds/transactions', [SuperDistributorController::class, 'transaction'])->name('sds.transactions');
    Route::get('/sds/settalment', [SuperDistributorController::class, 'settalment'])->name('sds.settalment');
    Route::get('/sds/paymentcreditreport', [SuperDistributorController::class, 'paymentCreditReport'])->name('sds.paymentcreditreport');
    Route::get('/sds/paymentdebitreport', [SuperDistributorController::class, 'paymentDebitReport'])->name('sds.paymentdebitreport');
    Route::any('/sds/wallet_transactions', [SuperDistributorController::class, 'MyWalletTransactionList'])->name('sds.wallettransaction');

    //All Bill Payment
    Route::get('/sds/mobilrecharge', [BillPaymentController::class, 'MobileBill'])->name('sds.mobilrecharge');
    Route::get('/sds/phonebill', [BillPaymentController::class, 'PhoneBill'])->name('sds.phonebill');
    Route::get('/sds/landlinebill', [BillPaymentController::class, 'LandlineBill'])->name('sds.landlinebill');
    Route::get('/sds/gasbill', [BillPaymentController::class, 'GasBill'])->name('sds.gasbill');
    
    //All Message Routes Here
    Route::get('/sds/messageadd', [InboxMessageController::class, 'addMessage'])->name('sds.messageadd');
    Route::get('/sds/messageinbox', [InboxMessageController::class, 'inboxMessageList'])->name('sds.messageinbox');
    Route::get('/sds/messagesent', [InboxMessageController::class, 'allMessageSent'])->name('sds.messagesent');
    Route::get('/sds/messagedeleted', [InboxMessageController::class, 'allMessageDeleted'])->name('sds.messagedeleted');
});