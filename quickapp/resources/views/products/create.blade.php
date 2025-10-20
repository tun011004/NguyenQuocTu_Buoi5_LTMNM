@extends('layouts.app')

@section('content')
  <h2>Thêm sản phẩm</h2>
  <form method="POST" action="{{ route('products.store') }}">
    @csrf
    <div class="field">
      <label>Tên</label>
      <input type="text" name="name" value="{{ old('name') }}">
      @error('name') <div style="color:#c00">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label>Giá</label>
      <input type="number" step="0.01" name="price" value="{{ old('price') }}">
      @error('price') <div style="color:#c00">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label>Danh mục</label>
      <select name="category_id">
        <option value="">-- Chọn --</option>
        @foreach($categories as $id => $name)
          <option value="{{ $id }}" @selected(old('category_id')==$id)>{{ $name }}</option>
        @endforeach
      </select>
      @error('category_id') <div style="color:#c00">{{ $message }}</div> @enderror
    </div>

    <button class="btn primary" type="submit">Lưu</button>
    <a class="btn" href="{{ route('products.index') }}">Hủy</a>
  </form>
@endsection
