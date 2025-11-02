<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Lab 9' }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])

  {{-- === Theme boot ===
       Ưu tiên localStorage.theme; nếu chưa có thì theo hệ thống (prefers-color-scheme) --}}
  <script>
    (function() {
      try {
        const ls = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const enableDark = (ls === 'dark') || (ls === null && prefersDark);
        document.documentElement.classList.toggle('dark', enableDark);
      } catch(e) {}
    })();
  </script>
</head>
<body class="h-full bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
  <header class="border-b bg-white/80 dark:bg-gray-900/70 backdrop-blur sticky top-0 z-40">
    <nav class="mx-auto max-w-6xl px-4">
      <div class="flex items-center justify-between h-14">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
          <x-application-logo class="w-6 h-6 text-indigo-600 dark:text-indigo-400" />
          <span class="font-semibold">Laravel Lab 9</span>
        </a>

        <div class="flex items-center gap-3">
          <a href="{{ route('articles.index') }}" class="text-sm hover:text-indigo-600 dark:hover:text-indigo-400">Bài viết</a>

          {{-- Theme toggle --}}
          <button id="themeToggle" class="rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-800" title="Toggle theme" type="button" aria-label="Toggle theme">
            {{-- sun/moon icons (swap bằng CSS) --}}
            <svg id="icon-sun" class="h-5 w-5 hidden dark:inline" viewBox="0 0 24 24" fill="currentColor"><path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z"/><path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
            <svg id="icon-moon" class="h-5 w-5 dark:hidden" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/></svg>
          </button>

          @auth
            {{-- Avatar + dropdown --}}
            @php
              $user = auth()->user();
              $email = strtolower(trim($user->email ?? ''));
              $hash  = $email ? md5($email) : null;
              $gravatar = $hash ? "https://www.gravatar.com/avatar/{$hash}?s=64&d=404" : null;
              $uiAvatar = "https://ui-avatars.com/api/?name=".urlencode($user->name ?? 'User')."&size=64&background=4f46e5&color=fff&bold=true";
              $avatarUrl = $gravatar ?: $uiAvatar;
            @endphp

            @can('admin')
              <a href="{{ route('admin.articles.index') }}" class="hidden sm:inline text-sm hover:text-indigo-600 dark:hover:text-indigo-400">Quản trị</a>
            @endcan

            <x-dropdown align="right" width="56">
              <x-slot name="trigger">
                <button class="inline-flex items-center gap-2 text-sm">
                  <img src="{{ $avatarUrl }}"
                       onerror="this.onerror=null; this.src='{{ $uiAvatar }}';"
                       alt="avatar" class="w-7 h-7 rounded-full ring-2 ring-white/70 dark:ring-gray-800 object-cover">
                  <span class="hidden sm:inline">{{ $user->name }}</span>
                  <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.94a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                </button>
              </x-slot>
              <x-slot name="content">
                <x-dropdown-link href="{{ route('profile.edit') }}">Hồ sơ</x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    Đăng xuất
                  </x-dropdown-link>
                </form>
              </x-slot>
            </x-dropdown>
          @endauth

          @guest
            <a href="{{ route('login') }}" class="text-sm hover:text-indigo-600 dark:hover:text-indigo-400">Đăng nhập</a>
            <a href="{{ route('register') }}" class="rounded-lg px-3 py-1.5 text-sm bg-indigo-600 text-white hover:bg-indigo-700">Đăng ký</a>
          @endguest
        </div>
      </div>
    </nav>
  </header>

  {{-- flash messages --}}
  @if(session('success') || session('error'))
    <div class="mx-auto max-w-6xl px-4 mt-4">
      @if(session('success'))
        <div class="rounded-lg bg-green-50 text-green-800 px-4 py-3 border border-green-200 dark:bg-green-950/40 dark:text-green-200 dark:border-green-800/50">
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="rounded-lg bg-red-50 text-red-800 px-4 py-3 border border-red-200 dark:bg-red-950/40 dark:text-red-200 dark:border-red-800/50">
          {{ session('error') }}
        </div>
      @endif
    </div>
  @endif

  <main class="mx-auto max-w-6xl px-4 py-6">
    @yield('content')
  </main>

  <footer class="border-t py-6 text-center text-sm text-gray-500 dark:text-gray-400 dark:border-gray-800">
    Laravel v{{ app()->version() }} • PHP {{ PHP_VERSION }}
  </footer>

  {{-- Toggle script: lưu localStorage.theme = 'dark' | 'light' --}}
  <script>
    document.getElementById('themeToggle')?.addEventListener('click', () => {
      const html = document.documentElement;
      const isDark = html.classList.toggle('dark');
      try { localStorage.setItem('theme', isDark ? 'dark' : 'light'); } catch(e) {}
    });
  </script>
</body>
</html>
