<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $blogs = Blog::latest()->get();
        return view('home', ['blogs' => $blogs]);
    }
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
}
