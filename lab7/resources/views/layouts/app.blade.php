<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>@yield('title','Articles')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }
    .container { max-width: 960px; margin: 24px auto; }
    .flash { padding: 10px; margin-bottom: 12px; background: #ECFDF5; color:#065F46; border-radius:8px; }
    nav a { margin-right: 8px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; }
    th { background: #f3f4f6; }
    .breadcrumb { font-size: 14px; color:#6b7280; margin-bottom: 12px; }
    .breadcrumb a { color:#374151; text-decoration: none; }
  </style>

  @stack('styles') {{-- Bài 08 --}}
</head>
<body>
  @include('partials.nav')

  <div class="container">
    @include('partials.breadcrumb') {{-- Bài 09 --}}
    @if(session('success'))
      <div class="flash">{{ session('success') }}</div>
    @endif

    @yield('content')
  </div>

  @include('partials.footer')
  @stack('scripts')
</body>
</html>
