@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Hồ sơ</h1>

@if(session('success'))
  <div class="mb-4 rounded-lg bg-green-50 text-green-800 px-4 py-3 border border-green-200">
    {{ session('success') }}
  </div>
@endif

<form method="post" action="{{ route('profile.update') }}" class="space-y-4 max-w-xl">
  @csrf @method('patch')

  <div>
    <label class="block text-sm font-medium">Tên</label>
    <input name="name" value="{{ old('name', $user->name) }}" class="mt-1 w-full rounded-lg border-gray-300">
    @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium">Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full rounded-lg border-gray-300">
    @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-sm font-medium">Mật khẩu (để trống nếu không đổi)</label>
    <input type="password" name="password" class="mt-1 w-full rounded-lg border-gray-300">
    @error('password') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
  </div>

  <button class="rounded-lg px-4 py-2 bg-indigo-600 text-white">Lưu</button>
</form>
@endsection
