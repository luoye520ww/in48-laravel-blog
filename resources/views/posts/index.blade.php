@extends('layouts.app')

@section('title', 'Home - Laravel Blog')

@section('content')
<div class="flex flex-col gap-6">
    <div>
        <h1 class="text-2xl font-bold">Latest Posts</h1>
    </div>

    <div class="flex flex-col gap-4">
        @foreach ($posts as $post)
        <article class="rounded border bg-white p-5">
            <h2 class="text-xl font-bold">{{ $post->title }}</h2>
            <p class="mt-3 text-gray-700">{{ $post->content }}</p>
            <a href="{{ route('posts.show', $post) }}" class="mt-4 inline-block text-sm text-blue-600">Read more</a>
        </article>
        @endforeach
    </div>
</div>
@endsection