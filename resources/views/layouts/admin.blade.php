<!doctype html>
<html>
<head>
    <title>@yield('title', 'Backend')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900">
    <header class="border-b bg-white/90 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="/" class="font-semibold">Laravel Blog</a>
            <nav class="flex items-center gap-4 text-sm">
                @auth
                <span class="text-gray-500">{{ Auth::user()->email }}</span>
                @endauth

                <a href="/logout" class="rounded-full bg-gray-100 px-4 py-2 text-gray-700 hover:bg-gray-200">Logout</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto flex max-w-6xl gap-6 px-4 py-8">
        @php
            $navLinks = [
                ['label' => '总览', 'route' => 'admin.dashboard', 'active' => 'admin.dashboard'],
                ['label' => '文章', 'route' => 'admin.posts.index', 'active' => 'admin.posts.*'],
                ['label' => '分类', 'route' => 'admin.categories.index', 'active' => 'admin.categories.*'],
                ['label' => '标签', 'route' => 'admin.tags.index', 'active' => 'admin.tags.*'],
                ['label' => '留言', 'route' => 'admin.comments.index', 'active' => 'admin.comments.*'],
                ['label' => '使用者', 'route' => 'admin.users.index', 'active' => 'admin.users.*'],
            ];
        @endphp

        <nav class="flex w-60 shrink-0 flex-col gap-2 rounded-3xl bg-slate-800 p-4 text-white shadow-sm">
            <div class="px-4 pb-3 pt-2">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Admin</p>
                <p class="mt-1 font-semibold">Backend</p>
            </div>

            @foreach ($navLinks as $link)
            <a href="{{ route($link['route']) }}" class="rounded-2xl px-4 py-3 text-sm transition {{ request()->routeIs($link['active']) ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-200 hover:bg-slate-700 hover:text-white' }}">
                {{ $link['label'] }}
            </a>
            @endforeach
        </nav>
        
        <div class="min-w-0 flex-1 rounded-3xl bg-white p-6 shadow-sm">
            @yield('content')
        </div>
    </main>
</body>
</html>
