<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BillPaymentController extends Controller
{
    
    /**
     * Payment Debit Report
     */
    public function MobileBill(Request $request): View
    {
        
        return view('blankPage',[
            'pageTitle'=>'Mobile Bill Payment'
            
        ]);
    }


    /**
     * Payment Debit Report
     */
    public function GasBill(Request $request): View
    {
        
        return view('blankPage',[
            'pageTitle'=>'Gas Bill Payment'
            
        ]);
    }


    /**
     * Payment Debit Report
     */
    public function LandlineBill(Request $request): View
    {
        
        return view('blankPage',[
            'pageTitle'=>'Landline Bill Payment'
            
        ]);
    }


    /**
     * Payment Debit Report
     */
    public function PhoneBill(Request $request): View
    {
        
        return view('blankPage',[
            'pageTitle'=>'Phone Bill Payment'
            
        ]);
    }
}
