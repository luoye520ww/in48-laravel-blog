<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post')
            ->latest()
            ->get();

        return view('admin.comments.index', [
            'comments' => $comments,
        ]);
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);

        return redirect()
            ->route('admin.comments.index')
            ->with('success', '留言已批准');
    }

    public function unapprove(Comment $comment)
    {
        $comment->update(['is_approved' => false]);

        return redirect()
            ->route('admin.comments.index')
            ->with('success', '留言已改为待审核');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()
            ->route('admin.comments.index')
            ->with('success', '留言已删除');
    }
}
