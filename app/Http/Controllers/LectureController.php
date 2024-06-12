<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectureRequest;
use App\Models\Lecture;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LectureController extends Controller
{

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


    public function create()
    {
        return view('lectures.create');
    }

    public function store(LectureRequest $request)
    {
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

    public function edit(Lecture $lecture)
    {
        return view('lectures.edit', compact('lecture'));
    }

    public function update(LectureRequest $request, Lecture $lecture)
    {
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

    public function destroy(Lecture $lecture)
    {
        $lecture->delete();

        return redirect()->route('lectures.index')
            ->with('success', 'Лекция успешно удалена');
    }
}
