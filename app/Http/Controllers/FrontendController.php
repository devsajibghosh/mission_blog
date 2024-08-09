<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index_home(){
        return view('frontend.root.index');
    }
}
