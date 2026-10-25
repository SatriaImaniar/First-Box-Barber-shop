@extends('admin.layouts.app')
@section('page-title', 'Walk-in Customer')

@section('content')
  <div class="max-w-2xl">
    <a href="{{ route('admin.queue.index') }}"
      class="inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm mb-6 transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Kembali ke Antrian
    </a>

    <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-6">
      <div class="mb-6">
        <h3 class="text-lg font-semibold text-white">Tambah Pelanggan Walk-in</h3>
        <p class="text-sm text-gray-400 mt-1">Masukkan data pelanggan yang datang langsung ke toko</p>
      </div>

      <form action="{{ route('admin.queue.store-walkin') }}" method="POST" class="space-y-5">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Nama Pelanggan</label>
          <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
            class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors"
            placeholder="Nama pelanggan">
          @error('customer_name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Nomor WhatsApp <span
              class="text-gray-500">(opsional)</span></label>
          <input type="text" name="wa_number" value="{{ old('wa_number') }}"
            class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors"
            placeholder="08xxxxxxxxxx">
          @error('wa_number') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Layanan</label>
          <select name="service_id" required
            class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-xl text-white focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors">
            <option value="">Pilih layanan</option>
            @foreach($services as $service)
              <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                {{ $service->name }} — {{ $service->formatted_price }} ({{ $service->duration_minutes }} menit)
              </option>
            @endforeach
          </select>
          @error('service_id') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Kapster</label>
          <select name="barber_id" required
            class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-xl text-white focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors">
            <option value="">Pilih kapster</option>
            @foreach($barbers as $barber)
              <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                {{ $barber->name }}
              </option>
            @endforeach
          </select>
          @error('barber_id') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
          class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg shadow-emerald-500/25">
          Tambah ke Antrian
        </button>
      </form>
    </div>
  </div>
@endsection