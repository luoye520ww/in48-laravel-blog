<!doctype html>
<html>
<head>
    <title>@yield('title', 'Laravel Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900">
    <header class="border-b bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4">
            <a href="/">Laravel Blog</a>
            <nav class="flex items-center gap-4 text-sm">
                <a href="/" class="text-gray-700 hover:text-gray-950">Home</a>

                @auth
                <a href="{{ route('admin.posts.index') }}" class="text-gray-700 hover:text-gray-950">Backend</a>
                <a href="/logout" class="text-gray-700 hover:text-gray-950">Logout</a>
                @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-950">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8">
        @yield('content')
    </main>
</body>
</html>