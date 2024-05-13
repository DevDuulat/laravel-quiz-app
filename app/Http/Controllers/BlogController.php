<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }
    public function BlogUser()
    {
        $blogs = Blog::all();
        return view('blog', compact('blogs'));
    }
    public function BlogDetail(Blog $blog)
    {
        return view('blog-detail', compact('blog'));
    }

    public function create()
    {
        return view('blogs.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_date' => 'required|date',
            'cover' => 'nullable|file|max:2048|mimes:jpeg,png,jpg',
            'content' => 'required|string',
        ]);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $requestData = $request->except('cover');
            $requestData['cover'] = $coverPath;
        } else {
            $requestData = $request->all();
        }

        $requestData['user_id'] = Auth::id();

        Blog::create($requestData);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog created successfully.');
    }



    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_date' => 'required|date',
            'cover' => 'nullable|file|max:2048|mimes:jpeg,png,jpg',
            'content' => 'required|string',
        ]);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');

            Storage::disk('public')->delete($blog->cover);

            $blog->cover = $coverPath;
        }

        $blog->fill($request->only('title', 'description', 'publication_date', 'content'));

        $blog->save();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
