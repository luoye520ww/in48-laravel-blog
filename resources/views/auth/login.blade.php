@extends('layouts.app')

@section('title', 'Login - Laravel Blog')

@section('content')
<div class="flex min-h-[70vh] items-center justify-center">
    <div class="w-full max-w-md rounded-[2rem] border border-gray-100 bg-white p-8 shadow-sm">
        <div class="mb-8">
            <p class="text-sm font-medium text-blue-600">Backend Access</p>
            <h1 class="mt-2 text-4xl font-bold tracking-tight">Sign In</h1>
            <p class="mt-2 text-sm text-gray-500">使用管理员账号进入后台。</p>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <div>
                <label for="email" class="text-lg font-semibold">Email</label>
                <input type="email" name="email" id="email" class="mt-3 w-full rounded-3xl border-0 bg-gray-100 px-5 py-4 text-gray-900 outline-none ring-1 ring-transparent placeholder:text-gray-500 focus:bg-white focus:ring-blue-500" value="{{ old('email') }}" placeholder="Enter your email">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="text-lg font-semibold">Password</label>
                <input type="password" name="password" id="password" class="mt-3 w-full rounded-3xl border-0 bg-gray-100 px-5 py-4 text-gray-900 outline-none ring-1 ring-transparent placeholder:text-gray-500 focus:bg-white focus:ring-blue-500" placeholder="Enter your password">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button class="mt-2 rounded-3xl bg-blue-600 px-5 py-4 text-lg font-semibold text-white transition hover:bg-blue-700">Sign In</button>
        </form>
    </div>
</div>
@endsection
