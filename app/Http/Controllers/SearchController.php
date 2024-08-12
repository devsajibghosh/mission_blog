<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class SearchController extends Controller
{
    public function search (Request $request){
        $user_search = $request->search_value;
        // let's search on title and description
        $blogs = Blog::where('title','like',"%$user_search%")->orwhere('description','like',"%$user_search%")->get();
        return view('frontend.allblogs.index',compact('blogs','user_search'));
    }
}
