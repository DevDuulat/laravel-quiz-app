<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['permission:lecture-list|lecture-create|lecture-edit|lecture-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:lecture-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:lecture-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:lecture-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $lectures = Lecture::latest()->paginate(50);
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
            'title' => 'required',
            'text' => 'required',
            'publication_date' => 'required|date',
            'image_url' => 'nullable|url',
        ]);

        Lecture::create($request->all());

        return redirect()->route('lectures.index')
            ->with('success', 'Lecture created successfully.');
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
        request()->validate([
            'title' => 'required',
            'text' => 'required',
            'publication_date' => 'required|date',
            'image_url' => 'nullable|url',
        ]);

        $lecture->update($request->all());

        return redirect()->route('lectures.index')
            ->with('success', 'Lecture updated successfully');
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
