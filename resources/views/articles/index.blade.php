@extends('layouts.app')

@section('content')
@php($title = 'Bài viết')

<div class="flex items-center justify-between mb-4">
  <h1 class="text-xl font-semibold">Bài viết</h1>
  @auth
    <a href="{{ route('articles.create') }}" class="rounded-lg px-3 py-2 text-sm bg-indigo-600 text-white hover:bg-indigo-700">Viết bài</a>
  @endauth
</div>



<form action="{{ route('articles.index') }}" method="get" class="mb-4">
  <div class="flex gap-2">
    <input type="text" name="q" value="{{ $q }}" placeholder="Tìm tiêu đề..."
           class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    <button class="rounded-lg px-3 py-2 text-sm bg-gray-900 text-white hover:bg-black">Tìm</button>
  </div>
</form>

@if($articles->count())
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($articles as $a)
      <a href="{{ route('articles.show',$a) }}" class="block rounded-xl border border-gray-200 bg-white p-4 hover:shadow-lg transition">
        <div class="flex items-start justify-between gap-3">
          <h3 class="font-semibold line-clamp-2">{{ $a->title }}</h3>
          {{-- badge: số bài liên quan theo TÁC GIẢ --}}
          <span class="shrink-0 rounded-full bg-indigo-50 text-indigo-700 text-xs px-2 py-1 border border-indigo-200">
            Liên quan: {{ $a->related_count }}
          </span>
        </div>
        <p class="mt-2 text-sm text-gray-600 line-clamp-3">{{ Str::limit(strip_tags($a->body), 140) }}</p>
        <div class="mt-3 text-xs text-gray-500 flex items-center justify-between">
          <span>{{ optional($a->user)->name ?? 'Ẩn danh' }}</span>
          <span>{{ $a->created_at->diffForHumans() }}</span>
        </div>
      </a>
    @endforeach
  </div>

  <div class="mt-6">
    {{ $articles->appends(['q'=>request('q')])->links() }}
  </div>
@else
  <div class="rounded-lg border border-dashed p-8 text-center text-gray-500">
    Chưa có bài viết nào.
  </div>
@endif
@endsection
