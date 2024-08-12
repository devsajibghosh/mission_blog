<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class FrontBlogsController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->paginate(10);
        $paginate_blogs = Blog::paginate(5);
        return view('frontend.allblogs.index',compact('blogs','paginate_blogs'));
    }
}
