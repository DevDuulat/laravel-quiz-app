<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::latest()->paginate(50);
        return view('tests.index', compact('tests'));
    }

    public function create()
    {
        return view('tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|nullable',
        ]);

        Test::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'time_to_answer' => $request->input('time_to_answer'),
        ]);

        return redirect()->route('tests.index')
            ->with('success', 'Test created successfully.');
    }

    public function show(Test $test)
    {
        return view('tests.show', compact('test'));
    }

    public function edit(Test $test)
    {
        return view('tests.edit', compact('test'));
    }

    public function update(Request $request, Test $test)
    {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|nullable',
        ]);

        $test->update($request->all());

        return redirect()->route('tests.index')
            ->with('success', 'Test updated successfully');
    }

    public function destroy(Test $test)
    {
        $test->delete();

        return redirect()->route('tests.index')
            ->with('success', 'Test deleted successfully');
    }
}
