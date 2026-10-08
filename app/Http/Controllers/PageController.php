<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Faq;

class PageController extends Controller
{
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
    public function destroy(string $id)
    {
        //
    }



      /**
     * Payment Link
     */
    public function contactUsPage(Request $request): View
    {

        return view('Page.blankPage',[
            'pageTitle'=>'Contact Us'

        ]);
    }


    public function PageAction(Request $request, $page_slug=''){

        //$page_slug = "";
        if($page_slug == 'aboutus'){
            $pagetitle = "About Us";
            $page = 'aboutus';
        }
        elseif($page_slug =='payment-gateway-apis'){
            $pagetitle = "Payment Gateway APIs";
            $page = 'Service.paymentGatewayApis';
        }
        elseif($page_slug =='payout-apis'){
            $pagetitle = "Payout APIs";
            $page = 'Service.payoutApis';
        }
        elseif($page_slug =='merchant-dashboard'){
            $pagetitle = "Seller Dashboard";
            $page = 'Service.merchantDashboard';
        }
        elseif($page_slug =='fraud-risk'){
            $pagetitle = "Fraud & Risk";
            $page = 'Service.fraudRisk';
        }
        elseif($page_slug =='store-page'){
            $pagetitle = "Store Page";
            $page = 'Product.storePage';
        }
        elseif($page_slug =='payment-link'){
            $pagetitle = "Payment Link";
            $page = 'Product.paymentLink';
        }
        elseif($page_slug =='payment-page'){
            $pagetitle = "Payment Page";
            $page = 'Product.paymentPage';
        }
        elseif($page_slug =='checkout-page'){
            $pagetitle = "Checkout Page";
            $page = 'Product.checkoutPage';
        }
        elseif($page_slug =='invoice-payment'){
            $pagetitle = "Invoice Payment";
            $page = 'Product.invoice';
        }elseif($page_slug =='contact_us'){
            $pagetitle = "Contact Us";
            $page = 'contactus';
        }elseif($page_slug =='terms-conditions'){
            $pagetitle = " Terms & Conditions";
            $page = 'termsconditions';
        }
        elseif($page_slug =='privacy-policy'){
            $pagetitle = "Privacy Policy";
            $page = 'privacypolicy';
        }
        elseif($page_slug =='grievance-redressal'){
            $pagetitle = "Grievance Redressal";
            $page = 'grievanceredressal';
        }
        elseif($page_slug =='refund-cancellation'){
            $pagetitle = "Refund Cancellation";
            $page = 'refundcancellation';
        }elseif($page_slug =='shop'){
            $pagetitle = "Shop";
            $page = 'Shop.shop';
        }elseif($page_slug =='customer-support'){
            $pagetitle = "Customer Support";
            $page = 'customersupport';
        }elseif($page_slug =='customer-registration'){
            $pagetitle = "Customer Registration";
            $page = 'customer_registration';
        }elseif($page_slug =='superdistributor'){
            $pagetitle = "Agent : Super Distributor";
            $page = 'super_distributor';
        }elseif($page_slug =='distributor'){
            $pagetitle = "Agent : Distributor";
            $page = 'distributor';
        }elseif($page_slug =='retailer'){
            $pagetitle = "Agent : Retailer";
            $page = 'retailer';
        }elseif($page_slug =='api-services'){
            $pagetitle = "Api Services";
            $page = 'api-service';
        }elseif($page_slug =='domestic_money_transfer'){
            $pagetitle = "Domestic Money Transfer";
            $page = 'domestic_money_transfer';
        }elseif($page_slug =='aadhaar_enabled_payment_system'){
            $pagetitle = "Aadhaar Enabled Payment system";
            $page = 'aadhaar_enabled_payment_system';
        }elseif($page_slug =='bill_payment'){
            $pagetitle = "Bill Payment - BBPS";
            $page = 'bbps_page';
        }else{
            $pagetitle = "Home";
            $page = 'welcome';
            $page_slug = 'home';
        }



        //dd($page_slug);
        return view('ipaylight.'.$page,[
            'pagetitle'=>$pagetitle,
            'page_slug'=>$page_slug

        ]);
    }





    /**
     * FAQ Page
     */
    public function PageFAQ(Request $request, $category=null){

        if (!empty($category)) {
            // If a specific category is provided, filter by that category
            $categories = Faq::where('category', $category)->get()->groupBy('category');
        } else {
            // If no specific category is provided, get all FAQs grouped by category
            $categories = Faq::all()->groupBy('category');
        }
        $finalFaqArray = [];
        foreach($categories as $k=>$itemArr){
            foreach($itemArr as $kk=>$item)
            if($k==$item['category']){
                $finalFaqArray[$k][$item['subcategory']][] = $item->toArray();
            }
        }
        $mastercategories = Faq::all()->groupBy('category');
        return view('Faq.faqslist',[
            'pageTitle'=>'FAQs',
            'categories'=>$finalFaqArray,
            'categoryName'=>$categories,
            'mastercategories'=>$mastercategories

        ]);
    }
}
