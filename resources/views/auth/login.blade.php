@extends('layouts.app')

@section('title', 'Login - Laravel Blog')

@section('content')
<div class="mx-auto max-w-md rounded border bg-white p-6">
    <h1 class="text-2xl font-bold">Backend Login</h1>
    
    <form method="POST" action="{{ route('login.store') }}" class="mt-6 flex flex-col gap-4">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="mt-1 w-full rounded border px-3 py-2" value="{{ old('email') }}">
            @error('email')
                <p class="mt-1 text-sm text-red-600">1111{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="mt-1 w-full rounded border px-3 py-2">
        </div>

        <button class="rounded bg-gray-900 px-4 py-2 text-white">Login</button>
    </form>
</div>
@endsection