<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\c;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontContactController extends Controller
{

    public function contact_view(){
        return view('frontend.contact.index');
    }


    function contact_post(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::insert([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),
        ]);

        $image = base_path('public/uploads/bloger/bloger.png');
        Mail::to($request->email)->send(new ContactMail($request->except('_token'),$image));
        return back()->with('success', "Message Send Successful👍🏻");
    }


}
