<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
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
            'cover' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update($request->all());

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
