<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Booking - FIRSTBOX BARBER SHOP</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .glass {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .slot-btn {
      transition: all 0.2s ease;
    }

    .slot-btn:hover {
      transform: translateY(-2px);
    }

    .slot-btn.selected {
      background: linear-gradient(135deg, #f59e0b, #ea580c);
      color: white;
      border-color: transparent;
    }
  </style>
</head>

<body class="bg-[#0a0a0a] text-white min-h-screen">

  <!-- Navigation -->
  <nav class="fixed top-0 left-0 right-0 z-40 bg-black/50 backdrop-blur-xl border-b border-white/5">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
      <div class="flex items-center justify-between h-16">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
          <img src="{{ asset('logo-barber.jpg') }}" alt="Logo" class="w-8 h-8 rounded-lg object-cover">
          <span class="font-bold">FIRSTBOX</span>
        </a>
        <a href="{{ route('home') }}"
          class="text-gray-400 hover:text-white text-sm flex items-center gap-2 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>
      </div>
    </div>
  </nav>

  <div class="max-w-4xl mx-auto px-4 sm:px-6 pt-24 pb-16">
    <!-- Header -->
    <div class="text-center mb-10">
      <h1 class="text-3xl sm:text-4xl font-black">Booking <span
          class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Online</span></h1>
      <p class="text-gray-400 mt-2">Pilih layanan, kapster, dan waktu yang tersedia</p>
      <p class="text-xs text-gray-500 mt-1">Hanya berlaku untuk hari ini — {{ now()->translatedFormat('l, d F Y') }}</p>
    </div>

    <!-- Flash Messages -->
    @if(session('error'))
      <div
        class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-2xl text-red-300 text-sm flex items-start gap-3">
        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ session('error') }}
      </div>
    @endif

    <!-- Booking Form -->
    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
      @csrf

      <!-- Step 1: Service Selection -->
      <div class="glass rounded-3xl p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 bg-amber-500/20 rounded-xl flex items-center justify-center text-amber-400 font-bold">1
          </div>
          <h2 class="text-lg font-semibold">Pilih Layanan</h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
          @foreach($services as $service)
            <label class="cursor-pointer">
              <input type="radio" name="service_id" value="{{ $service->id }}"
                data-duration="{{ $service->duration_minutes }}" class="sr-only peer" {{ old('service_id') == $service->id ? 'checked' : '' }} required>
              <div
                class="p-4 rounded-2xl border-2 border-gray-700/50 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 hover:border-gray-600 transition-all">
                <p class="font-semibold text-white">{{ $service->name }}</p>
                <div class="flex items-center justify-between mt-2">
                  <span class="text-amber-400 font-bold">{{ $service->formatted_price }}</span>
                  <span class="text-gray-500 text-sm">{{ $service->duration_minutes }} menit</span>
                </div>
              </div>
            </label>
          @endforeach
        </div>
        @error('service_id') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
      </div>

      <!-- Step 2: Barber Selection -->
      <div class="glass rounded-3xl p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 bg-amber-500/20 rounded-xl flex items-center justify-center text-amber-400 font-bold">2
          </div>
          <h2 class="text-lg font-semibold">Pilih Kapster</h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
          @foreach($barbers as $barber)
            <label class="cursor-pointer">
              <input type="radio" name="barber_id" value="{{ $barber->id }}" class="sr-only peer" {{ old('barber_id') == $barber->id ? 'checked' : '' }} required>
              <div
                class="p-4 rounded-2xl border-2 border-gray-700/50 peer-checked:border-amber-500 peer-checked:bg-amber-500/10 hover:border-gray-600 transition-all flex items-center gap-4">
                <div
                  class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center text-white font-bold">
                  {{ strtoupper(substr($barber->name, 0, 1)) }}
                </div>
                <p class="font-semibold text-white">{{ $barber->name }}</p>
              </div>
            </label>
          @endforeach
        </div>
        @error('barber_id') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
      </div>

      <!-- Step 3: Time Slot -->
      <div class="glass rounded-3xl p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 bg-amber-500/20 rounded-xl flex items-center justify-center text-amber-400 font-bold">3
          </div>
          <h2 class="text-lg font-semibold">Pilih Waktu</h2>
        </div>
        <div id="slotsContainer" class="text-center py-8">
          <p class="text-gray-500">Pilih layanan dan kapster terlebih dahulu</p>
        </div>
        <input type="hidden" name="start_time" id="startTime" value="{{ old('start_time') }}">
        <input type="hidden" name="end_time" id="endTime" value="{{ old('end_time') }}">
        @error('start_time') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
      </div>

      <!-- Step 4: Customer Info -->
      <div class="glass rounded-3xl p-6 sm:p-8 mb-6">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 bg-amber-500/20 rounded-xl flex items-center justify-center text-amber-400 font-bold">4
          </div>
          <h2 class="text-lg font-semibold">Data Diri</h2>
        </div>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
              class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors"
              placeholder="Masukkan nama Anda">
            @error('customer_name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Nomor WhatsApp</label>
            <input type="text" name="wa_number" value="{{ old('wa_number') }}" required
              class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors"
              placeholder="08xxxxxxxxxx">
            @error('wa_number') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
          </div>
        </div>
      </div>

      <!-- Submit -->
      <button type="submit" id="submitBtn"
        class="w-full py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-lg rounded-2xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-2xl shadow-amber-500/30 disabled:opacity-50 disabled:cursor-not-allowed">
        Konfirmasi Booking
      </button>
    </form>
  </div>

  <script>
    const serviceInputs = document.querySelectorAll('input[name="service_id"]');
    const barberInputs = document.querySelectorAll('input[name="barber_id"]');
    const slotsContainer = document.getElementById('slotsContainer');
    const startTimeInput = document.getElementById('startTime');
    const endTimeInput = document.getElementById('endTime');

    function fetchSlots() {
      const serviceId = document.querySelector('input[name="service_id"]:checked')?.value;
      const barberId = document.querySelector('input[name="barber_id"]:checked')?.value;

      if (!serviceId || !barberId) {
        slotsContainer.innerHTML = '<p class="text-gray-500">Pilih layanan dan kapster terlebih dahulu</p>';
        return;
      }

      slotsContainer.innerHTML = '<div class="flex items-center justify-center gap-2 text-amber-400"><svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memuat slot waktu...</div>';

      fetch(`{{ route("booking.slots") }}?service_id=${serviceId}&barber_id=${barberId}`)
        .then(r => r.json())
        .then(slots => {
          if (slots.length === 0) {
            slotsContainer.innerHTML = '<div class="py-4"><p class="text-gray-400">😕 Tidak ada slot tersedia untuk hari ini.</p><p class="text-gray-500 text-sm mt-1">Semua jadwal sudah terisi atau jam operasional sudah berakhir.</p></div>';
            startTimeInput.value = '';
            endTimeInput.value = '';
            return;
          }

          let html = '<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">';
          slots.forEach(slot => {
            html += `<button type="button" onclick="selectSlot(this, '${slot.start}', '${slot.end}')"
                            class="slot-btn px-4 py-3 rounded-xl border-2 border-gray-700/50 text-sm font-medium hover:border-amber-500/50 text-gray-300 hover:text-white transition-all">
                            ${slot.label}
                        </button>`;
          });
          html += '</div>';
          slotsContainer.innerHTML = html;
        })
        .catch(() => {
          slotsContainer.innerHTML = '<p class="text-red-400">Gagal memuat slot waktu. Silakan refresh halaman.</p>';
        });
    }

    function selectSlot(btn, start, end) {
      document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('selected'));
      btn.classList.add('selected');
      startTimeInput.value = start;
      endTimeInput.value = end;
    }

    serviceInputs.forEach(input => input.addEventListener('change', fetchSlots));
    barberInputs.forEach(input => input.addEventListener('change', fetchSlots));

    // Prevent double submission
    document.getElementById('bookingForm').addEventListener('submit', function (e) {
      const btn = document.getElementById('submitBtn');
      if (btn.disabled) { e.preventDefault(); return; }
      if (!startTimeInput.value || !endTimeInput.value) {
        e.preventDefault();
        alert('Pilih slot waktu terlebih dahulu!');
        return;
      }
      btn.disabled = true;
      btn.textContent = 'Memproses...';
    });
  </script>
</body>

</html>