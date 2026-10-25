@extends('admin.layouts.app')
@section('page-title', 'Kelola Kapster')

@section('content')
  <div class="space-y-6">
    <div class="flex items-center justify-between">
      <p class="text-gray-400">Kelola daftar kapster barbershop</p>
      <a href="{{ route('admin.barbers.create') }}"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg shadow-amber-500/25">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Kapster
      </a>
    </div>

    <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl overflow-hidden">
      <div class="divide-y divide-gray-700/30">
        @forelse($barbers as $barber)
          <div class="flex items-center justify-between p-5 hover:bg-gray-700/20 transition-colors">
            <div class="flex items-center gap-4">
              <div
                class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr($barber->name, 0, 1)) }}
              </div>
              <div>
                <p class="text-white font-medium">{{ $barber->name }}</p>
                <p class="text-gray-500 text-xs">ID: {{ $barber->id }}</p>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <a href="{{ route('admin.barbers.edit', $barber) }}"
                class="p-2 text-blue-400 hover:bg-blue-500/10 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </a>
              <form action="{{ route('admin.barbers.destroy', $barber) }}" method="POST"
                onsubmit="return confirm('Hapus kapster ini?')">
                @csrf @method('DELETE')
                <button class="p-2 text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </form>
            </div>
          </div>
        @empty
          <div class="px-6 py-12 text-center text-gray-500">Belum ada data kapster</div>
        @endforelse
      </div>
    </div>
  </div>
@endsection