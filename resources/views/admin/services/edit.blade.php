@extends('admin.layouts.app')
@section('page-title', 'Edit Layanan')

@section('content')
  <div class="max-w-2xl">
    <a href="{{ route('admin.services.index') }}"
      class="inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm mb-6 transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Kembali
    </a>

    <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-6">
      <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Nama Layanan</label>
          <input type="text" name="name" value="{{ old('name', $service->name) }}" required
            class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors">
          @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Harga (Rp)</label>
          <input type="number" name="price" value="{{ old('price', $service->price) }}" required min="0"
            class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors">
          @error('price') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Durasi (menit)</label>
          <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}"
            required min="5"
            class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors">
          @error('duration_minutes') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>
        <button type="submit"
          class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg shadow-amber-500/25">
          Update Layanan
        </button>
      </form>
    </div>
  </div>
@endsection