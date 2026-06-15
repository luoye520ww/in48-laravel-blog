@extends('layouts.admin')

@section('title', 'Manage Users - Backend')

@section('content')
<section class="flex flex-1 flex-col gap-4">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold">Users</h1>
    <a href="{{ route('admin.users.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Create User</a>
  </div>

  <div class="rounded border bg-white">
    @forelse ($users as $user)
    <div class="flex items-center justify-between border-b p-4 last:border-b-0">
      <div>
        <h2 class="font-semibold">{{ $user->name }}</h2>
        <p class="mt-1 text-gray-800 text-sm">{{ $user->email }}</p>
      </div>
      <div class="flex items-center gap-3 text-sm">
        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600">Edit</a>

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onSubmit="return confirm('Are you sure to delete this?')">
          @csrf
          @method('DELETE')
          <button class="text-red-600">Delete</button>
        </form>
      </div>
    </div>
    @empty
    <div class="p-4 text-gray-600">No users.</div>
    @endforelse
  </div>
</section>
@endsection