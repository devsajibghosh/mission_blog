<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
     public function registration(){
        return view('frontend.author.register');
     }
     public function loginer(){
        return view('frontend.author.login');
     }

     function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'author',
            'approve_status' => false,
            'created_at' => now(),
        ]);
        return redirect()->route('author.loginer')->with('success','Registration Success')->with('s_email',$request->email)->with('s_password',$request->password);
     }


    //  author login
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' =>$request->password , 'approve_status' => 1])) {
            return redirect()->route('home')->with('success','Login Success');
        }else{
            return view('frontend.noticePage.notice');
        }
    }


}
