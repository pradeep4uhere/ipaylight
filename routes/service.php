<?php
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DMTController;


Route::middleware(['auth','verified','role:retailer'])->group(function () {
    Route::prefix('ro')->middleware('checkUserStatus')->group(function () {
        Route::post('/verify_beneficiary', [PayoutController::class, 'verifyBeneficiary'])->name('payout.verifyaccount');
        Route::any('/gettransferform', [ContactController::class, 'getTransferFormforModleBox'])->name('payout.gettransferform');
        Route::any('/prevalidate', [PayoutController::class, 'verifyBeforeTransfer'])->name('payout.verify-before-transfer');
        Route::any('/transferprocess', [PayoutController::class, 'transferMoneyProcess'])->name('payout.transferprocess');
        Route::any('/transferstatus/{identifier}', [PayoutController::class, 'transferSuccessRecipet'])->name('payout.transfersuccess'); 
        Route::post('/save-screenshot', [PayoutController::class, 'saveScreenshot'])->name('payout.screenshot');

        //Domestic Money Transfer Service
        Route::any('/gettransferform/{identifire}', [ContactController::class, 'getTransferFormforModleBoxForDMT'])->name('dmtpayout.gettransferform');
        Route::any('/transfervalidate', [DMTController::class, 'verifyBeforeTransfer'])->name('dmtpayout.verify-before-transfer');
        Route::any('/transfermoney', [PayoutController::class, 'transferDMTMoneyProcess'])->name('dmtpayout.transferprocess');
        Route::any('/transferconfirmation/{source}', [PayoutController::class, 'dmtTransferConfirmationRecipet'])->name('dmtpayout.transfersuccess'); 

        //Paygenius Payout From Runpaisa
        Route::any('/payoutprevalidate', [PayoutController::class, 'verifyBeforeTransferForPaygeniusPayout'])->name('payout.verify_before_pg_transfer');
        Route::any('/updatepayoutorderstatus', [PayoutController::class, 'updatePayoutOrderStatus'])->name('payout.payout_callback');
        

    });
});