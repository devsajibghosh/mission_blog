<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index_home(){
        $blog_features = Blog::where('feature','active')->get();
        $Categories = Category::all();
        return view('frontend.root.index',[
            'blog_features' => $blog_features,
            'Categories' => $Categories,
        ]);
    }


}
