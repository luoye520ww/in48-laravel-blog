<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request) {
        $selectedCategory = $request->query('category');
        $selectedTag = $request->query('tag');
        $selectedTags = array_values(array_filter((array) $request->query('tags', [])));
        sort($selectedTags);

        $cacheKey = 'public.home.html.' . sha1(json_encode([
            'category' => $selectedCategory,
            'tag' => $selectedTag,
            'tags' => $selectedTags,
        ]));

        $html = Cache::remember($cacheKey, now()->addSeconds(60), function () use ($selectedCategory, $selectedTag, $selectedTags) {
            $categories = Category::withCount('posts')->orderBy('name')->get();
            $tags = Tag::withCount('posts')->orderBy('name')->get();

            $posts = Post::with(['category', 'tags'])
                         ->where('is_published', true)
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
            ])->render();
        });

        return response($html);
    }

    public function show(Post $post) {
        $post->load(['comments' => function ($query) {
            $query->where('is_approved', true)->latest();
        }]);

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
