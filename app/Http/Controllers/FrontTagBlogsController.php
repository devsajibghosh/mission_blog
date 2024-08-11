<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;


class FrontTagBlogsController extends Controller
{
    public function tag_blog_post($id){
        $tag = Tag::with('relationwithblog')->where('id',$id)->get();
        $tag_name = Tag::where('id',$id)->first();

        $blog = $tag[0]->relationwithblog;

        return view('frontend.tagblogs.index',compact('blog','tag_name'));

    }
}
