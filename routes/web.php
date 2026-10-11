<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentPageController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BillPaymentController;
use App\Http\Controllers\InboxMessageController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\User;
use App\Models\Transaction;
use App\Mail\TransactionNotification;
use App\Mail\SettalmentNotification;
use App\Http\Controllers\CsvExportController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\EmailController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [PageController::class, 'PageAction'])->name('home');


Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);
Route::get('lang/{locale}', function ($locale) {
    if (array_key_exists($locale, config('locales.available_locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('change_language');

Route::any('/send-notification', [FirebaseController::class, 'sendNotification']);
Route::get('/mail', function () {
    $settalmentObj = App\Models\Settlement::with(['Transaction','User'])->find(28);
    $user = $settalmentObj['User'];
    //dd($user);
    $s = Mail::to($user)->send(new SettalmentNotification($settalmentObj));
    //return view('Emails.SettalmentNotification');
    //$user = User::find(2);
    //$transactionData = Transaction::find(43);
    //EmailController::trasncationNotificationEmail(43);
    //$mailTransaction = new MailTransaction($transactionData->toArray());
    // try {
    //     $s = Mail::to(env('ADMIN_EMAIL_ADDRESS'))->send(new TransactionNotification($transactionData));
    //     // Email sent successfully
    // } catch (\Exception $e) {
    //     // Error occurred during email sending
    //     \Log::error('Email sending failed: ' . $e->getMessage());
    // }

});

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
->name('login');


Route::get('/pdf/{transactionId}', [PDFController::class, 'pdfGenerationTesting'])->name('pdf.generate');
Route::get('/contactus', [PageController::class, 'contactUsPage'])->name('page.contactus');
Route::get('/2fa', [AuthenticatedSessionController::class, 'showTwoAuthView'])->name('2fa');
Route::post('/2fa', [AuthenticatedSessionController::class, 'verify'])->name('2fa.verify');
Route::get('/forgot-password', [ProfileController::class, 'forgotPasswordView'])
            ->name('password.request');


Route::get('/checkout/{link}', [PaymentController::class, 'checkoutPage'])->name('checkout');
Route::post('/checkout-initiating', [PaymentController::class, 'checkoutInitiating'])->name('pay');
Route::any('/order_confirmation', [PaymentController::class, 'orderConfirmationBeforePayment'])->name('order_confirmation');

Route::any('/payemnt_status', [PaymentController::class, 'paymentReturnStatusURL'])->name('payemnt_return_url');
Route::any('/payment_success/{ltid}', [PaymentController::class, 'paymentSuccess'])->name('payment_success');
Route::any('/payment_failed/{ltid}', [PaymentController::class, 'paymentSuccess'])->name('payment_failed');
Route::any('/payment_callback', [PaymentController::class, 'paymentCallBackStatus'])->name('payment_callback');


//Settalment Webhook Using CronJOB
Route::any('/make-settalment', [SettlementController::class, 'makeSettalment'])->name('make-settalment');

//This Route Used In Admin Section for Manual Settalemnt of the Retialer
Route::any('/payload-process', [SettlementController::class, 'instantSettalmentProcess'])->name('settalment.process');







Route::middleware(['auth','verified','role:user'])->group(function () {

    Route::get('user/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    Route::get('dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.profile');
    Route::any('/kyc-update', [ProfileController::class, 'editProfileKYC'])->name('profile.kyc-update');
    Route::any('/kyc-update-save', [ProfileController::class, 'editProfileKYCSave'])->name('profile.kyc-update-save');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::any('/verify-emails', [ProfileController::class, 'verifyEmailAction'])->name('profile.verify-email');
    Route::any('/verify-mobile', [ProfileController::class, 'verifyMobileAction'])->name('profile.verify-mobile');
    Route::any('/two-factor-auth', [ProfileController::class, 'twoFactorAuthAction'])->name('profile.two-factor-auth');
    Route::any('/add-factor-auth', [ProfileController::class, 'addAuthenticator'])->name('profile.add-authenticator');
    Route::any('/bank-account', [ProfileController::class, 'bankAccount'])->name('profile.bank-account');
    Route::any('/bank-account-save', [ProfileController::class, 'bankAccountSave'])->name('profile.bank-account-save');
    Route::get('/edit-profile', [ProfileController::class, 'editProfile'])->name('profile.edit-profile');
    Route::any('/edit-profile-save', [ProfileController::class, 'editProfileSave'])->name('profile.edit-profile-save');
    Route::any('/alladminlist', [ProfileController::class, 'allAdminList'])->name('profile.alladminlist');
    Route::any('/loginhistory', [ProfileController::class, 'allLoginHistory'])->name('profile.loginhistory');
    Route::any('/loginhistory', [ProfileController::class, 'allLoginHistory'])->name('profile.qrcode');
    Route::any('/myloginhistory', [ProfileController::class, 'myLoginHistory'])->name('profile.login_history');






    //all transaction
    Route::get('/transaction', [ProfileController::class, 'transaction'])->name('user.transactions');
    Route::get('/settalment', [ProfileController::class, 'settalment'])->name('user.settalment');
    Route::any('/wallet_transactions', [ProfileController::class, 'myWalletTransactionsList'])->name('user.wallet_transactions');
    Route::get('/paymentcreditreport', [ProfileController::class, 'paymentCreditReport'])->name('user.paymentcreditreport');
    Route::get('/paymentdebitreport', [ProfileController::class, 'paymentDebitReport'])->name('user.paymentdebitreport');

    //All Payment Pages
    Route::get('/paymentpage', [PaymentPageController::class, 'paymentPage'])->name('user.paymentpage');
    Route::get('/paymentlink', [PaymentPageController::class, 'paymentLink'])->name('user.paymentlink');
    //All wallets Routes
    Route::get('/wallettransfer', [WalletController::class, 'walletTransfer'])->name('user.wallettransfer');
    //All Contact Route
    Route::get('/contactlist', [ContactController::class, 'contactList'])->name('user.contactlist');
    Route::get('/addcontact', [ContactController::class, 'contactAdd'])->name('user.addcontact');
    //All Bill Payment
    Route::get('/mobilrecharge', [BillPaymentController::class, 'MobileBill'])->name('user.mobilrecharge');
    Route::get('/phonebill', [BillPaymentController::class, 'PhoneBill'])->name('user.phonebill');
    Route::get('/landlinebill', [BillPaymentController::class, 'LandlineBill'])->name('user.landlinebill');
    Route::get('/gasbill', [BillPaymentController::class, 'GasBill'])->name('user.gasbill');

    //All Message Routes Here
    Route::get('/messageadd', [InboxMessageController::class, 'addMessage'])->name('user.messageadd');
    Route::get('/messageinbox', [InboxMessageController::class, 'inboxMessageList'])->name('user.messageinbox');
    Route::get('/messagesent', [InboxMessageController::class, 'allMessageSent'])->name('user.messagesent');
    Route::get('/messagedeleted', [InboxMessageController::class, 'allMessageDeleted'])->name('user.messagedeleted');
});


Route::middleware(['auth'])->group(function () {

    //saveNewTicket
    Route::any('/save-ticket', [SupportController::class, 'saveNewTicket'])->name('support.create-ticket');
    Route::any('/reply-ticket', [SupportController::class, 'replyOnTicket'])->name('support.reply-on-ticket');





    //Export Routes
    Route::any('/export-csv', [CsvExportController::class, 'exportTransaction'])->name('export.transaction');
    Route::any('/wallet-export-csv', [CsvExportController::class, 'exportWalletTransaction'])->name('export.wallet-transaction');
    //All Admin Section Route
    Route::any('/admin-export-csv', [CsvExportController::class, 'exportAdminTransaction'])->name('export.admin_transaction');
    Route::any('/admin-wallet-export-csv', [CsvExportController::class, 'exportAdminWalletTransaction'])->name('export.admin_wallet-transaction');

    //All Payout Transaction Export
    Route::any('/export-payout', [CsvExportController::class, 'exportPayoutTransaction'])->name('export.payout_transaction');


    Route::get('/overview', [SupportController::class, 'overview'])->name('support.overview');
    Route::get('/allticket', [SupportController::class, 'allTicketList'])->name('support.allticket');
    Route::get('/createticket', [SupportController::class, 'createNewTicket'])->name('support.createticket');
    Route::get('/faqs', [FaqsController::class, 'Faqs'])->name('support.faqs');
});



require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/distributor.php';
require __DIR__.'/retailer.php';
require __DIR__.'/service.php';
require __DIR__.'/superdistributor.php';

Route::get('/faq-help', [PageController::class, 'PageFAQ'])->name('page.help');
Route::get('/faq-help/{category}', [PageController::class, 'PageFAQ'])->name('page.helpwithcat');

//Route::get('/{page_slug}', [PageController::class, 'PageAction'])->name('page.action');
Route::get('/aboutus', function () { return view('Page.aboutus');})->name('aboutus');

Route::get('/{page_slug}', [PageController::class, 'ipayLightPageAction'])->name('page.action');

