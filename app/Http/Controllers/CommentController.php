<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'content' => ['required'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        # remember to create the symbolic link of the storage folder, with:
        # php artisan storage:link
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('comments', 'public');
        }

        unset($data['image']);
        $data['is_approved'] = false;

        $post->comments()->create($data);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', '留言已送出，等待审核');
    }
}
