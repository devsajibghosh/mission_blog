<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontCategoryBlogController extends Controller
{
    public function category_blogs($id){
        $blog = Blog::where('category_id',$id)->get();
        $category_name = Category::where('id',$id)->first();
        return view('frontend.frontblogs.index',compact('blog','category_name'));
    }
    public function single_blogs($id){
        $blog = Blog::where('id',$id)->first();
        return view('frontend.frontblogs.singlepost',compact('blog'));
    }
}
