<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\StoreFaqRequest;
use App\Models\Faq;
use Illuminate\Support\Facades\Storage;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $category=null)
    {
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
        
        return view('Admin.FAQ.faqslist',[
            'pageTitle'=>'FAQs',
            'categories'=>$finalFaqArray,
            'categoryName'=>$categories,
            'mastercategories'=>$mastercategories
            
        ]);
    }


    /**
     * Method Name: Add New Item To FAQs
     * 
     */
    public function addNewItem()
    {
        return view('Admin.FAQ.addFaqItem',[
            'pageTitle'=>'Add FAQs Item'
            
        ]);
    }


       /**
     * Method Name: Add New Item To FAQs
     * 
     */
    public function editFAQ(Request $request,$id)
    {
        $id = DecryptString($id);
        $faq = Faq::find($id);
        return view('Admin.FAQ.editFaqItem',[
            'pageTitle'=>'edit FAQs Item',
            'faq'=>$faq
            
        ]);
    }


    
    /**
     * Method Name: Save Edit FQA
     */
    public function saveEditFAQ(Request $request, $id)
    {
       
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'boolean',
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
        ]);


        $id = DecryptString($id);
        $faq = Faq::find($id);
        //$faq->title = $request->title;
        
        if ($request->hasFile('status')) {
            $status = 1;
        }else{
            $status = 0;
        }
         // Process the uploaded file
         if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file in the 'public/avatars' directory
            $imagePath = $request->file('avatar')->store('faq', 'public');
            $filename = basename($imagePath);
       
            $faq->banner = $filename;
           
        }
        // Save the FAQ
        $faq->title = $validatedData['title'];
        $faq->content = $validatedData['content'];
        $faq->status = $status;
        $faq->category = $validatedData['category'];
        $faq->subcategory = $validatedData['subcategory'];
        $faq->save();
        return redirect()->route('admin.faqs')->with('success', 'FAQ updated Successfully.');

    }

    public function saveNewItem(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'boolean',
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
        ]);
        
        if ($request->hasFile('status')) {
            $status = 1;
        }else{
            $status = 0;
        }
         // Process the uploaded file
         if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            // Store the uploaded file in the 'public/avatars' directory
            $imagePath = $request->file('avatar')->store('faq', 'public');
            $filename = basename($imagePath);
            // Create the FAQ
            
            $faq = Faq::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'status' => $status,
                'banner' => $filename,
                'category' => $validatedData['category'],
                'subcategory' => $validatedData['subcategory'],
            ]);
        }
        $faq = Faq::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'status' => $status,
            'category' => $validatedData['category'],
            'subcategory' => $validatedData['subcategory'],
        ]);

      

        return redirect()->route('admin.faqs')->with('success', 'FAQ created successfully.');

    }

    
    

    public function getSubcategory(Request $request){
        $key = $request->get('cat_id');
        $categoryList = config('global.FAQ_CATEGORY_LIST');
        $str = '<option></option>';
        foreach($categoryList[$key] as $k=>$item){
            $str .= '<option value="'.$k.'">'.$item.'</option>';
        }
        return $str;
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
    public function Faqs(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'FAQs'
            
        ]);
    }
}
