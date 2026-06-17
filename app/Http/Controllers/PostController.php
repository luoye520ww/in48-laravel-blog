<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request) {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $selectedCategory = $request->query('category');
        $selectedTag = $request->query('tag');
        $selectedTags = array_values(array_filter((array) $request->query('tags', [])));

        $posts = Post::where('is_published', true)
                     ->when($selectedCategory, function ($query, $categoryId) {
                        $query->where('category_id', $categoryId);
                     })
                     ->when($selectedTags, function ($query, $tagIds) {
                        $query->whereHas('tags', function ($tagQuery) use ($tagIds) {
                            $tagQuery->whereIn('tags.id', $tagIds);
                        });
                     })
                     ->latest()
                     ->get();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'selectedCategory' => $selectedCategory,
            'selectedTag' => $selectedTag,
            'selectedTags' => $selectedTags,
        ]);
    }

    public function show(Post $post) {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}