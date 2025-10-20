@extends('layouts.app')

@section('content')
  <h2>Sản phẩm</h2>
  <p><a class="btn primary" href="{{ route('products.create') }}">+ Thêm sản phẩm</a></p>

  <table>
    <thead>
      <tr>
        <th>#</th><th>Tên</th><th>Giá</th><th>Danh mục</th><th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->name }}</td>
          <td>{{ number_format($p->price) }} đ</td>
          <td>{{ $p->category?->name }}</td>
          <td class="actions">
            <a class="btn" href="{{ route('products.edit',$p) }}">Sửa</a>
            <form class="inline" method="POST" action="{{ route('products.destroy',$p) }}" onsubmit="return confirm('Xóa sản phẩm này?')">
              @csrf @method('DELETE')
              <button class="btn" type="submit">Xóa</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5">Chưa có dữ liệu</td></tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top:12px;">{{ $products->links() }}</div>
@endsection
