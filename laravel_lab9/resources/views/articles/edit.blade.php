@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Sửa bài</h1>

<form action="{{ route('articles.update', $article) }}" method="post" enctype="multipart/form-data" class="space-y-4 max-w-3xl">
  @csrf @method('PUT')

  <div>
    <label class="block text-sm font-medium">Tiêu đề</label>
    <input name="title" value="{{ old('title', $article->title) }}" class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium">Nội dung</label>
    <textarea name="body" rows="8" class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('body', $article->body) }}</textarea>
    @error('body') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium">Ảnh minh hoạ (tuỳ chọn)</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png" class="mt-1 block w-full text-sm">
    @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror

    @if($article->image_path)
      <div class="mt-3">
        <p class="text-sm text-gray-600">Ảnh hiện tại:</p>
        <img src="{{ asset('storage/'.$article->image_path) }}" class="rounded-lg border mt-1 max-h-56">
      </div>
    @endif
  </div>

  <div class="flex items-center gap-2">
    <button class="rounded-lg px-4 py-2 bg-indigo-600 text-white hover:bg-indigo-700">Cập nhật</button>
    <a href="{{ route('articles.show', $article) }}" class="text-sm text-gray-600 hover:text-gray-900">Hủy</a>
  </div>
</form>
@endsection
