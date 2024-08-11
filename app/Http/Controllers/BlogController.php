<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\str;

class BlogController extends Controller
{
    public function index(){
        $admin_blog = Blog::all();
        $blogs = Blog::where('user_id',auth()->id())->get();
        $trashes = Blog::onlyTrashed()->paginate(4);
        return view('dashboard.blog.index',compact('blogs','trashes','admin_blog'));
    }
    public function blog_create(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.blog.create',compact('categories','tags'));
    }

    function create(Request $request){

        if($request->hasFile('image')){

            $new_name = auth()->id().time().'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->resize(400, 400);
            $img->save(public_path('uploads/blogs/'.$new_name), 80);

           $blog = Blog::create([
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'title' => $request->title,
                'image' => $new_name,
                'description' => $request->description,
                'date' => $request->date,
                'created_at' => now(),
            ]);

            $blog->RelationshipWithTag()->attach($request->tag_id);
            $blog->save();
            return redirect()->route('blog')->with('success','Create at Success');
        }else{
            return back()->with('error','Kindly Created');
        }
    }

// delete blogs
 function delete($id){
    Blog::findOrFail($id)->delete();
    return redirect()->route('blog')->with('success','Create at Success');
 }

// restore blogs

function restore($id){
    Blog::where('id',$id)->restore();
    return redirect()->route('blog')->with('success','Create at Success');
 }

//  permanent delete
function forcedelete($id){
    Blog::where('id',$id)->forceDelete();
    return redirect()->route('blog')->with('success','Create at Success');
 }

//  chnaging status
function status($id){
    $blog = Blog::where('id',$id)->first();

    if($blog->status == 'active'){
        Blog::find($id)->update([
            'status' => 'deactive',
            'updated_at' => now(),
        ]);
        return back()->with('success', "Dective Successful👍🏻");
    }else{
        Blog::find($id)->update([
            'status' => 'active',
            'updated_at' => now(),
        ]);
        return back()->with('success', "Active Successful👍🏻");
    }
}

// edit blogs area
function edit_blog($id){
    $categories = Category::all();
    $tags = Tag::all();
    $blog = Blog::where('id',$id)->first();
    return view('dashboard.blog.edit',[
        'categories' => $categories,
        'tags' => $tags,
        'blog' => $blog,
    ]);
}

// update forms of blogs edite
function edit(Request $request, $id){

    if($request->hasFile('image')){
        $blog = Blog::where('id',$id)->first();
            unlink(public_path('uploads/blogs/'.$blog->image));
            $new_name = $id.$request->title.'.'.$request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->resize(400, 400);
            $img->save(public_path('uploads/blogs/'.$new_name), 80);

            $blog = Blog::find($id);
            $blog->image = $new_name;
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            $blog->user_id = auth()->id();
            $blog->date = $request->date;
            $blog->updated_at = now();
            $blog->RelationshipWithTag()->sync($request->tag_id);

            $blog->save();
            return redirect()->route('blog')->with('success', "Update Successful👍🏻");
        }else{
            $blog = Blog::find($id);
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            $blog->user_id = auth()->id();
            $blog->date = $request->date;
            $blog->updated_at = now();
            $blog->RelationshipWithTag()->sync($request->tag_id);
            $blog->save();

            return redirect()->route('blog')->with('success', "Update Successful👍🏻");
        }
}

// feature button add

function feature($id){
    $blog = Blog::where('id',$id)->first();

    if($blog->feature == 'active'){
        Blog::find($id)->update([
            'feature' => 'deactive',
            'updated_at' => now(),
        ]);
        return back()->with('success','Feature Hide');
    }else{
        Blog::find($id)->update([
            'feature' => 'active',
            'updated_at' => now(),
        ]);
        return back()->with('success','Feature Show');
    }
}


}
