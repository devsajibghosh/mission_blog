<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index_home(){
        $blog_features = Blog::where('feature','active')->get();
        $popular_post = Blog::orderBy('visitor_count','desc')->get();
        $recent_post = Blog::latest()->take(3)->get();
        $Categories = Category::all();
        return view('frontend.root.index',[
            'blog_features' => $blog_features,
            'Categories' => $Categories,
            'popular_post' => $popular_post,
            'recent_post' => $recent_post,
        ]);
    }


}
