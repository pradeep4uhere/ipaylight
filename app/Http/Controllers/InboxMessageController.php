<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InboxMessageController extends Controller
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
    public function addMessage(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'Compose New Message'
            
        ]);
    }


     /**
     * Payment Link
     */
    public function inboxMessageList(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'All Inbox'
            
        ]);
    }

     /**
     * Payment Link
     */
    public function allMessageSent(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'All Sent Messeges'
            
        ]);
    }

     /**
     * Payment Link
     */
    public function allMessageDeleted(Request $request): View
    {
        return view('blankPage',[
            'pageTitle'=>'All Deleted Message'
            
        ]);
    }
}
