<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function role(){
        $trashes = User::onlyTrashed()->paginate(5);
        $modaretors = User::where('role','modaretor')->get();
        $specific_user = User::where('role','modaretor')
        ->orWhere('role','author')
        ->orWhere('role','member')
        ->orWhere('role','visitor')->get();

        return view('dashboard.rolemanage.index',[
            'modaretors' => $modaretors,
            'specific_user' => $specific_user,
            'trashes' => $trashes,
        ]);
    }

    public function role_modaretor(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'modaretor',
            'created_at' => now(),
        ]);

        return back()->with('success','Created');
    }


    public function role_assign(Request $request){
        $one = User::where('id',$request->user_id)->first();
        $request->validate([
            'user_id' => 'required',
            'role_name' => 'required',
        ]);

        User::find($request->user_id)->update([
            'role' => $request->role_name,
            'updated_at' => now(),
        ]);
        return back()->with('success',"Dear $one->name sir,Promoted by $request->role_name");
    }

    // soft delet
    function role_at($id){
        User::where('id',$id)->delete();
        return back()->with('success','Delete Sucessfull');
    }

    // restore data
    function role_restore($id){
        User::where('id',$id)->restore();
        return back()->with('success','Successfully Restore');
    }
    function role_forcedelete($id){
        User::where('id',$id)->forceDelete();
        return back()->with('success','Successfully Delete');
    }


}
