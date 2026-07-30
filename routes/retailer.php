<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\PaymentPageController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BillPaymentController;
use App\Http\Controllers\InboxMessageController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\DMTController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/2fa', [AuthenticatedSessionController::class, 'showTwoAuthView'])->name('2fa.show');
Route::post('/2fa', [AuthenticatedSessionController::class, 'verifyTwoFactorAuth'])->name('2fa.verify');

Route::middleware(['auth','verified', '2fa', 'role:retailer'])->group(function () {
    Route::get('/ro/unauthorized', function () { return view('unauthorized');})->name('ro.unauthorized');
    Route::get('/ro/dashboard', [RetailerController::class, 'dashboard'])->name('ro.dashboard');
    
    Route::get('/ro/profile', [RetailerController::class, 'profile'])->name('ro.profile');
    Route::any('/ro/kyc-update', [RetailerController::class, 'editProfileKYC'])->name('ro.kyc-update');
    Route::any('/ro/kyc-update-save', [RetailerController::class, 'editProfileKYCSave'])->name('ro.kyc-update-save');
    Route::get('/ro/change-password', [RetailerController::class, 'changePassword'])->name('ro.change-password');
    Route::any('/ro/verify-email', [RetailerController::class, 'verifyEmailAction'])->name('ro.verify-email');
    Route::any('/ro/verify-mobile', [RetailerController::class, 'verifyMobileAction'])->name('ro.verify-mobile');
    Route::any('/ro/two-factor-auth', [RetailerController::class, 'twoFactorAuthAction'])->name('ro.two-factor-auth');
    Route::any('/add-factor-auth', [RetailerController::class, 'addAuthenticator'])->name('ro.add-authenticator');
    Route::any('/update_two_step_auth', [RetailerController::class, 'updateTwoStepAuthenticator'])->name('ro.update_two_step_auth');
    
    Route::any('/ro/bank-account', [RetailerController::class, 'bankAccount'])->name('ro.bank-account');
    Route::any('/ro/bank-account-save', [RetailerController::class, 'bankAccountSave'])->name('ro.bank-account-save');
    Route::get('/ro/edit-profile', [RetailerController::class, 'editProfile'])->name('ro.edit-profile');
    Route::any('/ro/edit-profile-save', [RetailerController::class, 'editProfileSave'])->name('ro.edit-profile-save');
    Route::any('/ro/alladminlist', [RetailerController::class, 'allAdminList'])->name('ro.alladminlist');
    Route::any('/ro/loginhistory', [RetailerController::class, 'allLoginHistory'])->name('ro.loginhistory');
    Route::any('/ro/qrcode', [RetailerController::class, 'qrcodeAction'])->name('ro.qrcode');
    Route::any('/ro/myloginhistory', [RetailerController::class, 'myLoginHistory'])->name('ro.login_history');
    

    Route::any('/ro/wallet_transfer', [RetailerController::class, 'walletTransferPage'])->name('ro.wallet_transfer');
    
    Route::any('/ro/transfer_to_wallet', [RetailerController::class, 'retialerWalletToWalletTransfer'])->name('ro.transfer_to_wallet');
    Route::any('/ro/wallet_transactions', [RetailerController::class, 'myWalletTransactionsList'])->name('ro.wallet_transactions');
    Route::any('/ro/comming_soon/{user}/', [RetailerController::class, 'userProfilePaymentPage'])->name('ro.comming_soon');

   
    //all transaction
    Route::any('/ro/rocommission/', [RetailerController::class, 'myCommissionList'])->name('ro.ro_commission');
    Route::any('/ro/othersetting/', [RetailerController::class, 'myOtherSetting'])->name('ro.ro_other_setting');
    
    //All Contact Routes For Retailer
    Route::any('/ro/searchcontacts/', [ContactController::class, 'searchContacts'])->name('ro.ro_contacts');
    Route::any('/ro/addnewcontact/', [ContactController::class, 'addNewContact'])->name('ro.add-new-contact');
    Route::any('/ro/savenewcontact/', [ContactController::class, 'saveNewContact'])->name('ro.save-new-contact');
    Route::any('/ro/allcontactlist/', [ContactController::class, 'getAllContactList'])->name('ro.rocontactlist');
    Route::any('/ro/viewcontact/{id}', [ContactController::class, 'getContactDetails'])->name('ro.view-contact');
    Route::post('/ro/addbeneficiary', [ContactController::class, 'saveaddBeneficiaryDetails'])->name('ro.save-beneficiary-details');
    Route::any('/ro/view-beneficiary/{id}', [ContactController::class, 'viewBeneficiaryListForUserContact'])->name('ro.view-beneficiary');
    Route::any('/ro/beneficiary/{servicecontactid}', [ContactController::class, 'viewBeneficiaryListForVerification'])->name('ro.verify-beneficiary');
    
    Route::delete('/ro/delete-contact/{id}', [ContactController::class, 'destroy'])->name('ro.delete-contact');
    
    
    //All route for Payment Link
    Route::any('/ro/generate_payment_link', [PaymentPageController::class, 'generatePaymentLink'])->name('ro.generate-payment-link'); 
    Route::any('/ro/savepaymentlink', [PaymentPageController::class, 'savePaymentLink'])->name('ro.rosavePaymentLink'); 
    Route::any('/ro/mypaymentlink', [PaymentPageController::class, 'myPaymentLink'])->name('ro.mypaymentlink'); 
    Route::any('/ro/editlink/{id}', [PaymentPageController::class, 'editlinkMyPaymentLink'])->name('ro.editLink'); 
    Route::delete('/ro/payment-links/{paymentLink}', [PaymentPageController::class, 'destroy'])->name('payment-links.destroy');
    
    //Money Transfer OR Payout Routes
    Route::any('/ro/tatkaltransfer', [RetailerController::class, 'walletTransferPage'])->name('ro.tatkaltransfer'); 


    
    //all Settalment Routes goes Here
    Route::any('/ro/settalment', [RetailerController::class, 'getAllSettalment'])->name('ro.settalment');
    Route::any('/ro/settalment_details/{id}', [SettlementController::class, 'viewSettalmentDetailsInRetailerProfile'])->name('ro.view-settalment');
    
    
    Route::any('/ro/transactions', [RetailerController::class, 'transaction'])->name('ro.transactions');
    Route::post('/ro/transactions-details', [RetailerController::class, 'getTransactionDetails'])->name('ro.get-transaction-details');
    Route::get('/ro/transactions-view/{tid}', [RetailerController::class, 'getTransactionDetailsInView'])->name('ro.transaction-view');
    
    
    Route::get('/ro/paymentcreditreport', [RetailerController::class, 'paymentCreditReport'])->name('ro.paymentcreditreport');
    Route::get('/ro/paymentdebitreport', [RetailerController::class, 'paymentDebitReport'])->name('ro.paymentdebitreport');


    //Payout Report
    Route::any('/ro/payoutreport', [RetailerController::class, 'retailerPayoutReport'])->name('ro.payout_report');
    
    
    //All Payment Pages
    Route::get('/ro/paymentpage', [PaymentPageController::class, 'paymentPage'])->name('ro.paymentpage');
    Route::get('/ro/paymentlink', [PaymentPageController::class, 'paymentLink'])->name('ro.paymentlink');
    
    
    
    
    //All wallets Routes
    Route::get('/ro/wallettransfer', [WalletController::class, 'walletTransfer'])->name('ro.wallettransfer');
    
    
    //All Contact Route
    Route::get('/ro/contactlist', [ContactController::class, 'contactList'])->name('ro.contactlist');
    Route::get('/ro/addcontact', [ContactController::class, 'contactAdd'])->name('ro.addcontact');
    
    
    
    
    //All Bill Payment
    Route::get('/ro/mobilrecharge', [BillPaymentController::class, 'MobileBill'])->name('ro.mobilrecharge');
    Route::get('/ro/phonebill', [BillPaymentController::class, 'PhoneBill'])->name('ro.phonebill');
    Route::get('/ro/landlinebill', [BillPaymentController::class, 'LandlineBill'])->name('ro.landlinebill');
    Route::get('/ro/gasbill', [BillPaymentController::class, 'GasBill'])->name('ro.gasbill');
    
    //All Message Routes Here
    Route::get('/ro/messageadd', [InboxMessageController::class, 'addMessage'])->name('ro.messageadd');
    Route::get('/ro/messageinbox', [InboxMessageController::class, 'inboxMessageList'])->name('ro.messageinbox');
    Route::get('/ro/messagesent', [InboxMessageController::class, 'allMessageSent'])->name('ro.messagesent');
    Route::get('/ro/messagedeleted', [InboxMessageController::class, 'allMessageDeleted'])->name('ro.messagedeleted');



    /**  DMT Module Start Here  */
    Route::get('/ro/tatkal_transfer', [DMTController::class, 'tatkalTransfer'])->name('dmt.tatkal_transfer');
    Route::post('/ro/get_beneficiary_list', [DMTController::class, 'getAllBeneficiaryList'])->name('dmt.get_beneficiary_list');
    Route::any('/ro/add_beneficiary/{cid}', [DMTController::class, 'addNewBeneficiary'])->name('dmt.addnewbeneficiary');




    /**  DMT Module Start Here  */
    Route::get('/ro/search_benificiery', [DMTController::class, 'searchaBeneficiaryForPayout'])->name('payout.tatkal_transfer');
    Route::post('/ro/payout_get_beneficiary_list', [DMTController::class, 'getPayoutAllBeneficiaryList'])->name('payout.get_beneficiary_list');
    Route::any('/ro/add_beneficiary/{cid}', [DMTController::class, 'addNewBeneficiary'])->name('dmt.addnewbeneficiary');
    
    
    
});
