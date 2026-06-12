@extends('layouts.app')

@section('title', $post->title . ' - Laravel Blog')

@section('content')
<div class="flex flex-col gap-6">
    <a href="{{ route('posts.index') }}">Back to Home</a>

    <article class="rounded border bg-white p-6">
        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
        <p class="text-gray-500 text-sm mt-2">{{ $post->created_at->format('Y-m-d H:i') }}</p>
        <div class="mt-6 text-gray-800">{{ $post->content }}</div>
    </article>
</div>
@endsection