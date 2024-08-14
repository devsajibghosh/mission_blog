<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use League\CommonMark\Node\NodeWalkerEvent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $author_req = User::where('role','author')->get();
        // $trashes = User::onlyTrashed()->paginate(4);
        if(auth()->user()->role == 'admin' || auth()->user()->role == 'author' ){
            if(auth()->user()->approve_status == true){
                return view('dashboard.root.home',compact('author_req'));
            }else{
                abort(419);
            }
        }
    }


    // accept and rejecet post

    public function approve($id){
        $author = User::where('id',$id)->first();
        if($author->approve_status == false){
            User::find($id)->update([
                'approve_status' => true,
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('home')->with('success',"Accept $author->name");
    }

// force deleted
    public function rejecet($id){
        User::findOrFail($id)->forceDelete();
        return redirect()->route('home')->with('success',"Permanent Deleted");
    }


    // block auth


    public function block($id){
        $author = User::where('id',$id)->first();
        if($author->block_status == false){
            User::find($id)->update([
                'block_status' => true,
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('home')->with('success','Blocked');
    }





}
