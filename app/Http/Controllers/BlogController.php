<?php

namespace App\Http\Controllers;


use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function index()
    {
        $blogs = Blog::latest()->paginate(5);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(BlogRequest $request)
    {
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
            ->with('success', 'Блог успешно создан.');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');

            Storage::disk('public')->delete($blog->cover);

            $blog->cover = $coverPath;
        }

        $blog->fill($request->only('title', 'description', 'publication_date', 'content'));

        $blog->save();

        return redirect()->route('blogs.index')
            ->with('success', 'Блог успешно обновлен.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Блог успешно удален.');
    }
}
