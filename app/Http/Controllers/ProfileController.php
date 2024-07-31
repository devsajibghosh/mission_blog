<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use function Laravel\Prompts\password;

class ProfileController extends Controller
{
    public function profile(){
        return view('dashboard.profile.profile');
    }

    // update name and email

    function name_update(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);
        User::find($id)->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);
        return redirect()->route('profile')->with('success', 'Name Update Success');
    }

    // email update

    function email_update(Request $request, $id){
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        User::find($id)->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);

        return redirect()->route('profile')->with('success', 'Email Update Success');
    }

    // password updated

    function password_update(Request $request, $id){
        $request->validate([
           'current_password' => 'required',
           'password' => 'required|confirmed|min:8',
        ]);

        if(Hash::check($request->current_password, auth()->user()->password)){

            User::find($id)->update([
                'password' => $request->password,
                'updated_at' => now(),
            ]);
            return redirect()->route('profile')->with('success','Your Password Update Successfully');
        }else{
            return back();
        }
    }

// image update

function image_update(Request $request,$id){

    $request->validate([
        'image' => 'required|image',
    ]);

    // set new name
    $new_name = $id.now()->format('d-M-Y').'.'.$request->file('image')->getClientOriginalExtension();

            // make image ratio
            $img = Image::make($request->file('image'))->resize(400,400);
            // save image base path or public_path
            $img->save(base_path('public/uploads/profile/'.$new_name),100);

            // jodi image thake tahole update koro
            if($request->hasFile('image')){
                // update query
                User::find($id)->update([
                    'image' => $new_name,
                    'updated_at' => now(),
                ]);
                // same image reject
                if(file_exists($img)){
                    unlink($img);
                }

                return redirect()->route('profile')->with('success','Your Image Update Successfully');
            }

}

}
