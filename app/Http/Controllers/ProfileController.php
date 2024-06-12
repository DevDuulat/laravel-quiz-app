<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Lecture;
use App\Models\LectureAccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        $user = Auth::user();
        $totalLectures = Lecture::count();
        $completedLectures = LectureAccess::where('user_id', $user->id)->count();

        $progress = $totalLectures > 0 ? ($completedLectures / $totalLectures) * 100 : 0;

        return view('profile.index', compact('user','progress'));
    }

    public function edit(Request $request): View
    {
        $user = Auth::user();
        $completedLectures = LectureAccess::where('user_id', $user->id)->count();
        $totalLectures = Lecture::count();
        $progress = $totalLectures > 0 ? ($completedLectures / $totalLectures) * 100 : 0;
        return view('profile.index', [
            'user' => $request->user(),
            'progress' =>$progress
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // убедитесь, что это соответствует вашим требованиям
        ]);

        $user = auth()->user();

        $avatarPath = $request->file('avatar')->store('avatars', 'public');

        $user->avatar = $avatarPath;
        $user->save();

        return redirect()->back()->with('status', 'Фотография профиля успешно обновлена.');    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
