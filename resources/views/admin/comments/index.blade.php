@extends('layouts.admin')

@section('title', 'Manage Comments - Backend')

@section('content')
<section class="flex flex-1 flex-col gap-6">
  <div class="flex items-center justify-between">
    <div>
      <p class="text-sm font-medium text-blue-600">Page 9 Challenge</p>
      <h1 class="text-2xl font-bold">留言审核</h1>
    </div>
    <span class="rounded-full bg-gray-100 px-4 py-2 text-sm text-gray-700">{{ $comments->count() }} comments</span>
  </div>

  @if (session('success'))
  <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
    {{ session('success') }}
  </div>
  @endif

  <div class="rounded-3xl border bg-gray-50 p-5">
    <h2 class="font-semibold">挑战任务说明</h2>
    <div class="mt-4 grid gap-3 md:grid-cols-2">
      <div class="rounded-2xl bg-white p-4 text-sm text-gray-700 shadow-sm">留言预设待审核</div>
      <div class="rounded-2xl bg-white p-4 text-sm text-gray-700 shadow-sm">前台只显示已批准</div>
      <div class="rounded-2xl bg-white p-4 text-sm text-gray-700 shadow-sm">后台批准 / 取消批准</div>
      <div class="rounded-2xl bg-white p-4 text-sm text-gray-700 shadow-sm">管理留言状态</div>
    </div>
  </div>

  <div class="rounded-3xl border bg-white">
    <div class="border-b px-5 py-4">
      <h2 class="font-semibold">留言列表</h2>
      <p class="mt-1 text-sm text-gray-500">最新留言会排在最前面，可以在这里完成批准、取消批准或删除。</p>
    </div>

    @forelse ($comments as $comment)
    <div class="flex flex-col gap-4 border-b p-5 last:border-b-0 lg:flex-row lg:items-center lg:justify-between">
      <div class="min-w-0 flex-1">
        <div class="flex flex-wrap items-center gap-2">
          <strong>{{ $comment->name }}</strong>
          @if ($comment->is_approved)
          <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">已批准</span>
          @else
          <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">待审核</span>
          @endif
          <span class="text-xs text-gray-400">{{ $comment->created_at->format('Y-m-d H:i') }}</span>
        </div>

        <p class="mt-2 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($comment->content, 100) }}</p>

        <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-gray-500">
          <span>所属文章：</span>
          @if ($comment->post)
          <a href="{{ route('posts.show', $comment->post) }}" class="text-blue-600 hover:underline" target="_blank">
            {{ $comment->post->title }}
          </a>
          @else
          <span>文章已删除</span>
          @endif

          @if ($comment->image_path)
          <span class="rounded-full bg-gray-100 px-2 py-1">有图片</span>
          @endif
        </div>
      </div>

      <div class="flex shrink-0 flex-wrap items-center gap-3 text-sm">
        @if ($comment->is_approved)
        <form method="POST" action="{{ route('admin.comments.unapprove', $comment) }}">
          @csrf
          @method('PATCH')
          <button class="rounded-full bg-gray-100 px-4 py-2 text-gray-700 hover:bg-gray-200">取消批准</button>
        </form>
        @else
        <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
          @csrf
          @method('PATCH')
          <button class="rounded-full bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">批准</button>
        </form>
        @endif

        <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onSubmit="return confirm('Are you sure to delete this comment?')">
          @csrf
          @method('DELETE')
          <button class="rounded-full bg-red-50 px-4 py-2 text-red-600 hover:bg-red-100">删除</button>
        </form>
      </div>
    </div>
    @empty
    <div class="p-5 text-gray-600">No comments.</div>
    @endforelse
  </div>
</section>
@endsection
