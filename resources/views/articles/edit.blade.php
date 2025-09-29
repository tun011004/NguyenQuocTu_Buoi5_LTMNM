@extends('layouts.app')
@section('title','Sửa bài viết')

@section('content')
<h2>Sửa bài viết #{{ $article['id'] }}</h2>

<form action="{{ route('articles.update',$article['id']) }}" method="post">
  @csrf
  @method('PUT')

  <x-input name="title" label="Tiêu đề" :value="$article['title']" />

  <label style="display:block;margin:8px 0 4px">Nội dung</label>
  <textarea name="body" rows="6" style="width:100%;padding:8px;border:1px solid #e5e7eb;border-radius:6px">{{ old('body',$article['body']) }}</textarea>
  @error('body')
    <div style="color:#991B1B;margin-top:4px">{{ $message }}</div>
  @enderror

  <x-button variant="primary" style="margin-top:10px">Cập nhật</x-button>
</form>

@push('styles')
<style>
  /* Bài 08: style riêng trang edit */
  h2 { letter-spacing: .2px; }
</style>
@endpush
@endsection
