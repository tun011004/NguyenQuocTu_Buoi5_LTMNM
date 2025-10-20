@extends('layouts.app')

@section('content')
  <h2>Danh mục</h2>
  <p><a class="btn primary" href="{{ route('categories.create') }}">+ Thêm danh mục</a></p>

  <table>
    <thead>
      <tr>
        <th>#</th><th>Tên</th><th>Mô tả</th><th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      @forelse($categories as $c)
        <tr>
          <td>{{ $c->id }}</td>
          <td>{{ $c->name }}</td>
          <td>{{ $c->description }}</td>
          <td class="actions">
            <a class="btn" href="{{ route('categories.edit',$c) }}">Sửa</a>
            <form class="inline" method="POST" action="{{ route('categories.destroy',$c) }}" onsubmit="return confirm('Xóa danh mục này?')">
              @csrf @method('DELETE')
              <button class="btn" type="submit">Xóa</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="4">Chưa có dữ liệu</td></tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top:12px;">{{ $categories->links() }}</div>
@endsection
