<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {
        // dd($request->all());

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

        $post->comments()->create($data);

        // $comment = new Comment;
        // $comment->post_id = $post->id;
        // $comment->name = $data['name'];

        return redirect()->route('posts.show', $post);
    }
}
