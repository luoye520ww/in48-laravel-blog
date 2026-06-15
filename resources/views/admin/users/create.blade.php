@extends('layouts.admin')

@section('title', 'Create User - Backend')

@section('content')
<section class="flex flex-1 flex-col gap-4">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold">Create User</h1>
    <a href="{{ route('admin.users.index') }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Back</a>
  </div>

  <form method="POST" action="{{ route('admin.users.store') }}" class="flex flex-col gap-4 rounded border bg-gray-100 p-5">
    @csrf

    <div>
      <label class="text-sm font-medium" for="name">Name</label>
      <input id="name" name="name" value="{{ old('name') }}" class="mt-1 w-full rounded border px-3 py-2">
      @error('name')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="text-sm font-medium" for="email">Email</label>
      <input id="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded border px-3 py-2">
      @error('email')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="text-sm font-medium" for="password">Password</label>
      <input type="password" id="password" name="password" class="mt-1 w-full rounded border px-3 py-2">
      @error('password')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="text-sm font-medium" for="password_confirmation">Password (Confirmation)</label>
      <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 w-full rounded border px-3 py-2">
      @error('password_confirmation')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>  

    <button class="rounded bg-gray-900 px-4 py-2 text-white">Save</button>
  </form>
</section>
@endsection