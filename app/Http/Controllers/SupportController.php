<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
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
    public function overview(Request $request): View
    {
        if(getAuthValue('role')=='Admin'){
            $ticketList = Ticket::with('Replies','Replies.user')->orderBy('id','DESC')->paginate(10);
        }elseif(getAuthValue('role')=='Distributor'){
            $userIds = User::where('parent_id', getAuthValue('id'))->pluck('id');
            $ticketList = Ticket::with('Replies','Replies.user')->whereIn('user_id',$userIds)->orderBy('id','DESC')->paginate(10);
        }else{
            $ticketList = Ticket::with('Replies','Replies.user')->where('user_id',Auth::id())->orderBy('id','DESC')->paginate(10);
        }
        return view('Support.ticketList',[
            'pageTitle'=>'Support Center',
            'ticketList'=>$ticketList
        ]);
    }


     /**
     * Payment Link
     */
    public function allTicketList(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'All Ticket'
            
        ]);
    }


     /**
     * Payment Link
     */
    public function createNewTicket(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'Create New Ticket'
            
        ]);
    }



    /**
     * Save New Ticket
     */
    public function saveNewTicket(TicketRequest $request)
    {
         // Assign the user_id from the authenticated user
        $ticket = new Ticket();
        $ticket->user_id = Auth::id(); // Set the user ID based on the authenticated user
        $ticket->subject = $request->input('subject');
        $ticket->description = $request->input('description');
        $ticket->issue_type = $request->input('issue_type');
        $filename = '';
        if ($request->hasFile('document_file')) {
            $request->validate([
                'document_file' => 'required|mimes:pdf,doc,docx,jpeg,png,gif|max:2048',
            ]);
            // Store the uploaded file
            $imagePath = $request->file('document_file')->store('document', 'public');
            $filename = basename($imagePath);
            $ticket->document_file = $filename;
        }
        if($ticket->save()){
            return redirect()->back()->with('success', "Your Request has been submitted successfully.");
        }else{
            return redirect()->back()->with('error', "Somthing Went Wrong, Please Try After Somthing");
        }
    }



    
    /**
     * Save New Ticket
     */
    public function replyOnTicket(Request $request)
    {
        //dd($request->all());
        if($request->isMethod('post')){
            if($request->get('user_id')==Auth::id()){
                $user_id = Auth::id();
                $ticket_id = $request->get('ticket_id');
                $message = $request->get('message');
                if($message!=''){
                    $reply = new Reply();
                    $reply->ticket_id = $ticket_id;
                    $reply->user_id = $user_id;
                    $reply->message = $message;
                    if ($request->hasFile('document_file')) {
                        $request->validate([
                            'document_file' => 'required|mimes:pdf,doc,docx,jpeg,png,gif|max:2048',
                        ]);
                        // Store the uploaded file
                        $imagePath = $request->file('document_file')->store('document', 'public');
                        $filename = basename($imagePath);
                        $reply->document_file = $filename;
                    }
                    DB::beginTransaction();
                    try {
                        if($reply->save()){
                            if(getAuthValue('role')=='Admin'){
                                $status = $request->status; 
                                $ticketObj = Ticket::find($ticket_id);
                                $ticketObj->status = $status;
                                //dd($ticketObj);
                                if ($ticketObj->save()) {
                                    DB::commit();
                                    return redirect()->back()->with('success', "Your comment submitted successfully.");
                                }
                            }else{
                                DB::commit();
                                return redirect()->back()->with('success', "Your comment submitted successfully.");
                            }
                        }else{
                            return redirect()->back()->with('error', "Somthing Went Wrong, Please Try After Somthing");
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                        return redirect()->back()->with('error', "Something went wrong, please try again later.");
                    }
                }else{
                    return redirect()->back()->with('error', "Comment should not be empty.");
                }
            }else{
                return redirect()->back()->with('error', "Somthing Went Wrong, Please Try After Somthing");
            }
        }
    }

}
