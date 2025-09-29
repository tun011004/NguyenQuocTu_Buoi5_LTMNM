@extends('layouts.app')
@section('title', 'Chi tiết bài viết')

@section('content')
  <h2 style="margin-bottom:8px">{{ $article->title }}</h2>

  <div style="white-space:pre-line; line-height:1.6">{{ $article->body }}</div>

  <hr style="margin:16px 0">
  <a href="{{ route('articles.index') }}">← Quay lại danh sách</a>
@endsection
