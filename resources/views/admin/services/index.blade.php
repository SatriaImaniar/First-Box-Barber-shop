@extends('admin.layouts.app')
@section('page-title', 'Kelola Layanan')

@section('content')
  <div class="space-y-6">
    <div class="flex items-center justify-between">
      <p class="text-gray-400">Kelola daftar layanan potong rambut</p>
      <a href="{{ route('admin.services.create') }}"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg shadow-amber-500/25">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Layanan
      </a>
    </div>

    <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl overflow-hidden">
      <!-- Desktop Table -->
      <div class="hidden sm:block overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="border-b border-gray-700/50">
              <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">#</th>
              <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">Nama Layanan
              </th>
              <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">Harga</th>
              <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">Durasi</th>
              <th class="text-right text-xs font-semibold text-gray-400 uppercase tracking-wider px-6 py-4">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-700/30">
            @forelse($services as $i => $service)
              <tr class="hover:bg-gray-700/20 transition-colors">
                <td class="px-6 py-4 text-sm text-gray-400">{{ $i + 1 }}</td>
                <td class="px-6 py-4 text-sm text-white font-medium">{{ $service->name }}</td>
                <td class="px-6 py-4 text-sm text-emerald-400 font-semibold">{{ $service->formatted_price }}</td>
                <td class="px-6 py-4 text-sm text-gray-300">{{ $service->duration_minutes }} menit</td>
                <td class="px-6 py-4 text-right">
                  <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('admin.services.edit', $service) }}"
                      class="p-2 text-blue-400 hover:bg-blue-500/10 rounded-lg transition-colors">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                      onsubmit="return confirm('Hapus layanan ini?')">
                      @csrf @method('DELETE')
                      <button class="p-2 text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada data layanan</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Mobile Cards -->
      <div class="sm:hidden divide-y divide-gray-700/30">
        @forelse($services as $service)
          <div class="p-4 space-y-3">
            <div class="flex items-center justify-between">
              <h3 class="text-white font-medium">{{ $service->name }}</h3>
              <div class="flex gap-1">
                <a href="{{ route('admin.services.edit', $service) }}" class="p-2 text-blue-400"><svg class="w-4 h-4"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg></a>
                <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                  onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
                  <button class="p-2 text-red-400"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg></button>
                </form>
              </div>
            </div>
            <div class="flex gap-4 text-sm">
              <span class="text-emerald-400 font-semibold">{{ $service->formatted_price }}</span>
              <span class="text-gray-400">{{ $service->duration_minutes }} menit</span>
            </div>
          </div>
        @empty
          <div class="px-4 py-12 text-center text-gray-500">Belum ada data layanan</div>
        @endforelse
      </div>
    </div>
  </div>
@endsection