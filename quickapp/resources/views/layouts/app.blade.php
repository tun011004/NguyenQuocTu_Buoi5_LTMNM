<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QuickApp</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    body{max-width:1000px;margin:24px auto;font-family:system-ui,Segoe UI,Roboto,Arial}
    nav a{margin-right:12px;text-decoration:none}
    .flash{padding:10px;border:1px solid #ddd;background:#f6ffed;margin:12px 0}
    table{width:100%;border-collapse:collapse}
    th,td{border:1px solid #ddd;padding:8px;text-align:left}
    form.inline{display:inline}
    .actions a, .actions button{margin-right:8px}
    .field{margin:8px 0}
    input[type=text], input[type=number], textarea, select{width:100%;padding:8px;border:1px solid #ccc;border-radius:6px}
    .btn{padding:8px 12px;border:1px solid #333;border-radius:6px;background:#fff;cursor:pointer}
    .btn.primary{background:#111;color:#fff;border-color:#111}

    /* Fix phóng to icon pagination khi chưa dùng Tailwind */
    nav[role="navigation"] svg{width:16px;height:16px;display:inline-block;}
    nav[role="navigation"] a, nav[role="navigation"] span{font-size:14px;line-height:1;}
    nav[role="navigation"] .hidden{display:none;}
  </style>
</head>
<body>
  <nav>
    <a href="{{ route('products.index') }}">Sản phẩm</a>
    <a href="{{ route('categories.index') }}">Danh mục</a>
  </nav>

  @if(session('success'))
    <div class="flash">{{ session('success') }}</div>
  @endif

  @yield('content')
</body>
</html>
