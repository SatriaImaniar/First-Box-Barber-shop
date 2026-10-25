@extends('admin.layouts.app')
@section('page-title', 'Dashboard')

@section('content')
  <div class="space-y-8">
    <!-- Toggle Booking -->
    <div class="bg-gray-800/50 backdrop-blur-xl border border-gray-700/50 rounded-2xl p-6">
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
          <h3 class="text-lg font-semibold text-white">Status Booking Online</h3>
          <p class="text-sm text-gray-400 mt-1">Aktifkan atau nonaktifkan fitur booking online untuk customer</p>
        </div>
        <form method="POST" action="{{ route('admin.toggle-booking') }}">
          @csrf
          <button type="submit" class="relative inline-flex h-8 w-16 items-center rounded-full transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-gray-900
                      {{ $isBookingOpen ? 'bg-emerald-500' : 'bg-gray-600' }}">
            <span class="inline-block h-6 w-6 transform rounded-full bg-white shadow-lg transition-transform duration-300
                          {{ $isBookingOpen ? 'translate-x-9' : 'translate-x-1' }}"></span>
          </button>
          <span class="ml-3 text-sm font-medium {{ $isBookingOpen ? 'text-emerald-400' : 'text-gray-400' }}">
            {{ $isBookingOpen ? 'AKTIF' : 'NONAKTIF' }}
          </span>
        </form>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="bg-gradient-to-br from-blue-500/10 to-blue-600/5 border border-blue-500/20 rounded-2xl p-5">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-blue-300/70">Total Antrian</p>
            <p class="text-3xl font-bold text-blue-400 mt-1">{{ $stats['total'] }}</p>
          </div>
          <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-gradient-to-br from-amber-500/10 to-amber-600/5 border border-amber-500/20 rounded-2xl p-5">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-amber-300/70">Menunggu</p>
            <p class="text-3xl font-bold text-amber-400 mt-1">{{ $stats['menunggu'] }}</p>
          </div>
          <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-600/5 border border-emerald-500/20 rounded-2xl p-5">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-emerald-300/70">Selesai</p>
            <p class="text-3xl font-bold text-emerald-400 mt-1">{{ $stats['selesai'] }}</p>
          </div>
          <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-gradient-to-br from-red-500/10 to-red-600/5 border border-red-500/20 rounded-2xl p-5">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-red-300/70">Batal</p>
            <p class="text-3xl font-bold text-red-400 mt-1">{{ $stats['batal'] }}</p>
          </div>
          <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      <a href="{{ route('admin.queue.index') }}"
        class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-6 hover:border-amber-500/30 transition-all duration-300 group">
        <div
          class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
        </div>
        <h3 class="text-white font-semibold">Kelola Antrian</h3>
        <p class="text-gray-400 text-sm mt-1">Lihat & atur antrian hari ini</p>
      </a>

      <a href="{{ route('admin.queue.walkin') }}"
        class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-6 hover:border-emerald-500/30 transition-all duration-300 group">
        <div
          class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </div>
        <h3 class="text-white font-semibold">Walk-in</h3>
        <p class="text-gray-400 text-sm mt-1">Tambah pelanggan langsung</p>
      </a>

      <a href="{{ route('admin.services.index') }}"
        class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-6 hover:border-blue-500/30 transition-all duration-300 group">
        <div
          class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <h3 class="text-white font-semibold">Master Data</h3>
        <p class="text-gray-400 text-sm mt-1">Kelola layanan & kapster</p>
      </a>
    </div>
  </div>
@endsection