@extends('layouts.admin')

@section('title', 'Manage Posts - Backend')

@section('content')
<section class="flex flex-1 flex-col gap-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Create Post</a>
    </div>

    @foreach ($posts as $post)
    <div class="bg-gray-100 rounded p-4">
        <h2 class="text-lg font-bold">{{ $post->title }}</h2>
        <p class="mb-4">{{ $post->content }}</p>
        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-0.5 inline-block rounded text-sm">Edit</a>
    </div>
    @endforeach
</section>
@endsection