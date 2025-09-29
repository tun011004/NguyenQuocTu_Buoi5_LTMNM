@php
  // Rất gọn: dựa vào route hiện tại
  $map = [
    'articles.index'   => 'Danh sách bài viết',
    'articles.create'  => 'Tạo bài viết',
    'articles.edit'    => 'Sửa bài viết',
    'articles.show'    => 'Chi tiết bài viết',
    'articles.page'    => 'Trang paginated',
    'admin.articles.index' => 'Quản trị bài viết',
    'articles.binding.show' => 'Binding demo',
  ];
  $name = optional(request()->route())->getName();
@endphp

<div class="breadcrumb">
  <a href="{{ url('/') }}">Trang chủ</a> / 
  @if($name && isset($map[$name]))
    <span>{{ $map[$name] }}</span>
  @else
    <span>{{ ucfirst(request()->path()) }}</span>
  @endif
</div>
