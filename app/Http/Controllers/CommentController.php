<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->blog_id = $request->blog_id;
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно добавлен!');
    }

    public function update(Request $request, Comment $comment)
    {
        if (Gate::denies('update', $comment)) {
            return redirect()->back()->with('error', 'У вас нет прав для редактирования этого комментария.');
        }
        $this->authorize('update', $comment);

        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно изменен!');
    }

    public function destroy(Comment $comment)
    {
        if (Gate::denies('delete', $comment)) {
            return redirect()->back()->with('error', 'У вас нет прав для удаления этого комментария.');
        }
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back()->with('success', 'Комментарий успешно удален!');
    }
}
