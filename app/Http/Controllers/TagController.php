<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::paginate(3);
        $trashes = Tag::onlyTrashed()->paginate(4);
        return view('dashboard.tag.tag',compact('tags','trashes'));
    }

    function tag_insert(Request $request){
        $request->validate([
            'title' => 'required',
        ]);

        Tag::create([
            'title' => $request->title,
            'created_at' => now(),
        ]);
        return redirect()->route('tag')->with('success',"Update Successful");
    }


    // tag edit post

    function tag_edit($title){
        $tag = Tag::where('title',$title)->first();
        return view('dashboard.tag.edit',compact('tag'));
    }

    function tag_edit_update(Request $request, $id) {
        // Validate the request
        $request->validate([
            'title' => 'required',
        ]);

        // Find the tag by ID and update it
        Tag::findOrFail($id)->update([
            'title' => $request->title,
            'updated_at' => now(),
        ]);

        // Redirect with a success message
        return redirect()->route('tag')->with('success', "Update Successful");
    }

    // changing status

    function tag_edit_status($id){
        $tag = Tag::where('id',$id)->first();

        if($tag->status == 'active'){
            
            Tag::find($id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return back()->with('success', "Dective Successful👍🏻");
        }else{
            Tag::find($id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return back()->with('success', "Active Successful👍🏻");
        }
    }

    // tag delete
    function tag_edit_delete($id){
        Tag::findOrFail($id)->delete();
        return back()->with('success', "Update Successful");
    }

    // restore data
    function tag_edit_restore($id){
        Tag::where('id',$id)->restore();
        return back()->with('success','Successfully Restore Item🔥');
    }

    // permanent delete
    function tag_edit_forcedelete($id){
        Tag::where('id',$id)->forceDelete();
        return back()->with('success','Successfully Restore Item🔥');
    }

}
