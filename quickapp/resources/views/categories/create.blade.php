@extends('layouts.app')

@section('content')
  <h2>Thêm danh mục</h2>
  <form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <div class="field">
      <label>Tên</label>
      <input type="text" name="name" value="{{ old('name') }}">
      @error('name') <div style="color:#c00">{{ $message }}</div> @enderror
    </div>
    <div class="field">
      <label>Mô tả</label>
      <textarea name="description">{{ old('description') }}</textarea>
      @error('description') <div style="color:#c00">{{ $message }}</div> @enderror
    </div>
    <button class="btn primary" type="submit">Lưu</button>
    <a class="btn" href="{{ route('categories.index') }}">Hủy</a>
  </form>
@endsection
