<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $blogs = Blog::latest()->get();
        return view('home', ['blogs' => $blogs]);
    }
    public function BlogUser()
    {
        $blogs = Blog::all();
        return view('blog', compact('blogs'));
    }
    public function BlogDetail(Blog $blog)
    {
        $randomBlogs = Blog::inRandomOrder()->limit(5)->get();
        return view('blog-detail', compact('blog', 'randomBlogs'));
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
