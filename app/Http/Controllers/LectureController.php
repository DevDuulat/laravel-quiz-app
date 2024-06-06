<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware(['permission:lecture-list|lecture-create|lecture-edit|lecture-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:lecture-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:lecture-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:lecture-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $lectures = Lecture::latest()->paginate(5);
        return view('lectures.index', compact('lectures'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lectures.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'image_url' => 'nullable|file|max:2048|mimes:jpeg,png,jpg',

        ]);

        if ($request->hasFile('image_url')) {
            $coverPath = $request->file('image_url')->store('covers', 'public');
            $image = $request->file('image_url');
            Log::info('Uploaded file name: ' . $image->getClientOriginalName());

            $requestData = $request->except('image_url');
            $requestData['image_url'] = $coverPath;
        } else {
            $requestData = $request->all();
        }

        Lecture::create($requestData);

        return redirect()->route('lectures.index')
            ->with('success', 'Лекция успешно создана.');
    }



    public function show(Lecture $lecture)
    {
        return view('lectures.show', compact('lecture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecture $lecture)
    {
        return view('lectures.edit', compact('lecture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecture $lecture)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'publication_date' => 'required|date',
            'image_url' => 'nullable|file|max:2048|mimes:jpeg,png,jpg',
        ]);

        $requestData = $request->except('image_url');

        if ($request->hasFile('image_url')) {
            if ($lecture->image_url) {
                Storage::disk('public')->delete($lecture->image_url);
            }

            $coverPath = $request->file('image_url')->store('covers', 'public');
            $requestData['image_url'] = $coverPath;
        }

        $lecture->fill($requestData);
        $lecture->save();

        return redirect()->route('lectures.index')
            ->with('success', 'Лекция успешно обновлена.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();

        return redirect()->route('lectures.index')
            ->with('success', 'Lecture deleted successfully');
    }

}
