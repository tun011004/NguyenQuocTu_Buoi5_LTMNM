@extends('layouts.app')
@section('content')
<article class="max-w-3xl">
  <h1 class="text-2xl font-bold tracking-tight">{{ $article->title }}</h1>
  <div class="mt-2 text-sm text-gray-500 flex items-center gap-3">
    <span>Người viết: {{ optional($article->user)->name ?? 'Ẩn danh' }}</span>
    <span>•</span>
    <span>{{ $article->created_at->format('d/m/Y H:i') }}</span>
  </div>

  @if($article->image_path)
    <img src="{{ asset('storage/'.$article->image_path) }}" class="mt-4 rounded-xl border">
  @endif

  <div class="prose max-w-none mt-6">
    {!! nl2br(e($article->body)) !!}
  </div>

  <div class="mt-6 flex items-center gap-3">
    <a href="{{ route('articles.index') }}" class="rounded-lg px-3 py-2 text-sm border hover:bg-gray-50">← Danh sách</a>

    @can('update', $article)
      <a href="{{ route('articles.edit', $article) }}" class="rounded-lg px-3 py-2 text-sm bg-indigo-600 text-white hover:bg-indigo-700">Sửa</a>
    @endcan

    @can('delete', $article)
      <form action="{{ route('articles.destroy', $article) }}" method="post" onsubmit="return confirm('Xóa bài viết này?')">
        @csrf @method('DELETE')
        <button class="rounded-lg px-3 py-2 text-sm bg-red-600 text-white hover:bg-red-700">Xóa</button>
      </form>
    @endcan
  </div>

  {{-- LIÊN QUAN THEO TIÊU ĐỀ --}}
  <section class="mt-10">
    <h2 class="text-lg font-semibold">Bài viết liên quan</h2>
    @if($related->count())
      <ul class="mt-3 space-y-2">
        @foreach($related as $r)
          <li>
            <a href="{{ route('articles.show',$r) }}" class="group flex items-center justify-between rounded-lg border bg-white px-4 py-2 hover:shadow">
              <span class="group-hover:text-indigo-600 font-medium">{{ $r->title }}</span>
              <span class="text-xs text-gray-500">{{ $r->created_at->diffForHumans() }}</span>
            </a>
          </li>
        @endforeach
      </ul>
    @else
      <p class="text-sm text-gray-500 mt-2">Chưa tìm thấy bài liên quan.</p>
    @endif
  </section>
</article>
@endsection
