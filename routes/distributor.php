<?php

use App\Http\Controllers\DsController;
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



Route::middleware(['auth','verified','2fa','role:distributor'])->group(function () {
    Route::get('/ds/dashboard', [DsController::class, 'dashboard'])->name('ds.dashboard');

    Route::get('/ds/profile', [DsController::class, 'profile'])->name('ds.profile');
    Route::any('/ds/kyc-update', [DsController::class, 'editProfileKYC'])->name('ds.kyc-update');
    Route::any('/ds/kyc-update-save', [DsController::class, 'editProfileKYCSave'])->name('ds.kyc-update-save');
    Route::get('/ds/change-password', [DsController::class, 'changePassword'])->name('ds.change-password');
    Route::any('/ds/verify-email', [DsController::class, 'verifyEmailAction'])->name('ds.verify-email');
    Route::any('/ds/verify-mobile', [DsController::class, 'verifyMobileAction'])->name('ds.verify-mobile');
    Route::any('/ds/two-factor-auth', [DsController::class, 'twoFactorAuthAction'])->name('ds.two-factor-auth');
    Route::any('/ds/add-factor-auth', [DsController::class, 'addAuthenticator'])->name('ds.add-authenticator');
    Route::any('/ds/update_two_step_auth', [DsController::class, 'updateTwoStepAuthenticator'])->name('ds.update_two_step_auth');

    Route::any('/ds/bank-account', [DsController::class, 'bankAccount'])->name('ds.bank-account');
    Route::any('/ds/bank-account-save', [DsController::class, 'bankAccountSave'])->name('ds.bank-account-save');
    Route::get('/ds/edit-profile', [DsController::class, 'editProfile'])->name('ds.edit-profile');
    Route::any('/ds/edit-profile-save', [DsController::class, 'editProfileSave'])->name('ds.edit-profile-save');
   
    Route::prefix('ds')->middleware('checkUserStatus')->group(function () {
        Route::get('profile_view/{user}', [CustomerController::class, 'profileView'])->name('ds.profile_view');
        Route::any('kyc-update/{user}', [CustomerController::class, 'editProfileKYC'])->name('ds.profile-kyc-update');
        Route::any('profile_edit/{user}', [CustomerController::class, 'editProfile'])->name('ds.profile_edit');
        Route::post('profile_edit_save', [CustomerController::class, 'saveEditedProfile'])->name('ds.profile_edit_save');
        Route::post('profile_kyc_save', [CustomerController::class, 'profileKYCSave'])->name('ds.profile_kyc_save');
        Route::get('profile-password/{user}', [CustomerController::class, 'changePassword'])->name('ds.profile-change-password');
        Route::post('profile-password_action', [CustomerController::class, 'updateChangePassword'])->name('ds.change-password-save');
        Route::get('profile-verify-email/{user}', [CustomerController::class, 'verifyEmailAction'])->name('ds.profile-verify-email');
        Route::post('send-verify-email', [CustomerController::class, 'sendEmailAction'])->name('ds.profile-send-email');
        Route::get('profile-verify-mobile/{user}', [CustomerController::class, 'verifyEmailAction'])->name('ds.profile-verify-mobile');
        Route::get('profile-two-factor-auth/{user}', [CustomerController::class, 'verifyEmailAction'])->name('ds.profile-two-factor-auth');
        Route::any('profile-bank-account/{user}', [CustomerController::class, 'bankAccount'])->name('ds.profile-bank-account');
        Route::any('profile-bank-account-save/{user}', [CustomerController::class, 'bankAccountSave'])->name('ds.profile-bank-account-save');
        Route::any('profile-tpin-setting/{user}', [CustomerController::class, 'tpinSetting'])->name('ds.profile-tpin-setting');
        Route::any('profile-tpin-save/{user}', [CustomerController::class, 'tpinSettingSave'])->name('ds.profile-tpin-save');
        Route::any('rocommission/{user}', [DsController::class, 'myRetailerCommissionList'])->name('ds.ro_commission');
        Route::any('search-commission-setting/{user}', [DsController::class, 'addGatewayCommission'])->name('ds.profile_addcommission');

         // Additional routes
        Route::any('ro_dashboard/{user}', [RetailerController::class, 'retailerAdminDashboard'])->name('ds.profile_ro_dashboard');
        Route::any('ro_wallet_transfer/{user}', [DsController::class, 'retailerAdminWalletTransfer'])->name('ds.wallet_transfer');
        Route::any('transfer_to_wallet/{user}', [DsController::class, 'walletToWalletTransfer'])->name('ds.transfer_to_wallet');
        //Route::any('ro_wallet_transactions/{user}', [DsController::class, 'walletTransactionList'])->name('ds.wallet_transactions');
        Route::any('user_permission/{user}', [DsController::class, 'userProfilePermissions'])->name('ds.user_permission');
        Route::any('profile_payment_page/{user}', [DsController::class, 'userProfilePaymentPage'])->name('ds.profile_payment_page');
        Route::any('ro_transaction_list/{user}', [DsController::class, 'userProfileTransactionList'])->name('ds.ro_transaction_list');
        Route::any('retailer_transaction_report/{user}', [DsController::class, 'userTransactionList'])->name('ds.retailer_transaction_report');
        Route::any('ro_transactions_details', [DsController::class, 'getTransactionDetails'])->name('ds.ro-transaction-details');
        Route::get('transactions-view/{tid}', [DsController::class, 'getTransactionDetailsInView'])->name('ds.ro_transaction_view');
        Route::any('comming_soon/{user}', [DsController::class, 'profileElementPaymentPage'])->name('ds.comming_soon');
        Route::any('ro_wallet_transactions/{user}', [RetailerController::class, 'myWalletTransactionsList'])->name('ds.wallet_transactions');
        Route::any('ro_settalment/{user}', [DsController::class, 'getAllSettalment'])->name('ds.settalment-report');
        Route::any('ro_allcontactlist/{user}', [ContactController::class, 'getAllContactListInDistributor'])->name('ds.rocontactlist');
        Route::any('ro_viewcontact/{id}', [ContactController::class, 'getContactDetailsInDistributor'])->name('ds.view-contact');
        Route::delete('ro_delete-contact/{id}', [ContactController::class, 'destroy'])->name('ds.delete-contact');
        Route::post('ro_addbeneficiary', [ContactController::class, 'saveaddBeneficiaryDetails'])->name('ds.save-beneficiary-details');
        Route::any('ro_view-beneficiary/{id}', [ContactController::class, 'viewBeneficiaryListForUserContact'])->name('ds.view-beneficiary');
        Route::delete('ro_delete-contact/{id}', [ContactController::class, 'destroy'])->name('ds.delete-contact');
    
    
        

        
        


        // Additional DsController routes
        Route::any('allretailer', [DsController::class, 'allDsRetailerList'])->name('ds.allretailer');
        Route::any('allretailers/{user}', [DsController::class, 'allRetailerList'])->name('ds.profile_retailers');
        Route::any('ro-search-commission-setting/{user}', [DsController::class, 'addRetailerGatewayCommission'])->name('ds.retailer_addcommission');
        Route::any('rocommissionsetting/{user}', [DsController::class, 'retailerCommissionList'])->name('ds.profile_ro_commission');
        Route::any('save_payment_type_to_profile/{user}', [DsController::class, 'saveProfilePaymentTypeGateway'])->name('ds.save_payment_type_to_profile');
        Route::any('qrcode', [DsController::class, 'qrcodeAction'])->name('ds.qrcode');

         // PaymentPageController routes
        Route::any('profile_payment_links/{user}', [PaymentPageController::class, 'retailerPaymentLinks'])->name('ds.profile_payment_links');
        Route::any('generate_payment_link/{user}', [PaymentPageController::class, 'generatePaymentLinkForRetailer'])->name('ds.generate-payment-link');
        Route::any('savepaymentlink/{user}', [PaymentPageController::class, 'savePaymentLinkForRetailer'])->name('ds.rosavePaymentLink');
        Route::any('mypaymentlink', [PaymentPageController::class, 'myPaymentLink'])->name('ds.mypaymentlink');
        Route::any('editlink/{id}', [PaymentPageController::class, 'editlinkMyPaymentLink'])->name('ds.editLink');
        Route::delete('payment-links/{paymentLink}', [PaymentPageController::class, 'destroy'])->name('ds-payment-links.destroy');

        Route::any('myroi', [DsController::class, 'myCommissionList'])->name('ds.my_commission_setting');
        Route::any('allcustomer', [CustomerController::class, 'allCustomerList'])->name('ds.allcustomer');
    
        //All wallets Routes
        Route::get('wallettransfer', [WalletController::class, 'walletTransfer'])->name('ds.wallettransfer');

        //All Payment Pages
        Route::get('paymentpage', [PaymentPageController::class, 'paymentPage'])->name('ds.paymentpage');
        Route::get('paymentlink', [PaymentPageController::class, 'paymentLink'])->name('ds.paymentlink');
        //All Contact Route
        Route::get('contactlist', [ContactController::class, 'contactList'])->name('ds.contactlist');
        Route::get('addcontact', [ContactController::class, 'contactAdd'])->name('ds.addcontact');
    });
   
    //all Transaction Related Route
    Route::any('/ds/transaction_list/', [DsController::class, 'AllTransactionList'])->name('ds.transactions-list');
    
    //Login History
    Route::any('/ds/myloginhistory', [DsController::class, 'myLoginHistory'])->name('ds.login_history');
    
    //all transaction
    Route::get('/ds/transactions', [DsController::class, 'transaction'])->name('ds.transactions');
    Route::any('/ds/settalment', [DsController::class, 'settalment'])->name('ds.settalment');
    Route::get('/ds/paymentcreditreport', [DsController::class, 'paymentCreditReport'])->name('ds.paymentcreditreport');
    Route::get('/ds/paymentdebitreport', [DsController::class, 'paymentDebitReport'])->name('ds.paymentdebitreport');
    Route::any('/ds/wallet_transactions', [DsController::class, 'MyWalletTransactionList'])->name('ds.wallettransaction');

    //All Bill Payment
    Route::get('/ds/mobilrecharge', [BillPaymentController::class, 'MobileBill'])->name('ds.mobilrecharge');
    Route::get('/ds/phonebill', [BillPaymentController::class, 'PhoneBill'])->name('ds.phonebill');
    Route::get('/ds/landlinebill', [BillPaymentController::class, 'LandlineBill'])->name('ds.landlinebill');
    Route::get('/ds/gasbill', [BillPaymentController::class, 'GasBill'])->name('ds.gasbill');
    
    //All Message Routes Here
    Route::get('/ds/messageadd', [InboxMessageController::class, 'addMessage'])->name('ds.messageadd');
    Route::get('/ds/messageinbox', [InboxMessageController::class, 'inboxMessageList'])->name('ds.messageinbox');
    Route::get('/ds/messagesent', [InboxMessageController::class, 'allMessageSent'])->name('ds.messagesent');
    Route::get('/ds/messagedeleted', [InboxMessageController::class, 'allMessageDeleted'])->name('ds.messagedeleted');
});