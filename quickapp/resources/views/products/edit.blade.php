@extends('layouts.app')

@section('content')
  <h2>Sửa sản phẩm</h2>
  <form method="POST" action="{{ route('products.update',$product) }}">
    @csrf @method('PUT')
    <div class="field">
      <label>Tên</label>
      <input type="text" name="name" value="{{ old('name', $product->name) }}">
      @error('name') <div style="color:#c00">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label>Giá</label>
      <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">
      @error('price') <div style="color:#c00">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label>Danh mục</label>
      <select name="category_id">
        @foreach($categories as $id => $name)
          <option value="{{ $id }}" @selected(old('category_id',$product->category_id)==$id)>{{ $name }}</option>
        @endforeach
      </select>
      @error('category_id') <div style="color:#c00">{{ $message }}</div> @enderror
    </div>

    <button class="btn primary" type="submit">Cập nhật</button>
    <a class="btn" href="{{ route('products.index') }}">Hủy</a>
  </form>
@endsection
