<?php

namespace App\Http\Controllers;

use App\Models\LectureAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LectureAccessController extends Controller
{
    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'lecture_id' => 'required|exists:lectures,id',
            ]);

            $user = Auth::user();

            $lectureAccess = LectureAccess::create([
                'lecture_id' => $validated['lecture_id'],
                'user_id' => $user->id,
            ]);

            return response()->json($lectureAccess, 201);
        } catch (\Exception $e) {
            Log::error('Error saving lecture access: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred. Please try again.'], 500);
        }
    }
}
