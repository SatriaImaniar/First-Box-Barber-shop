<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Berhasil - FIRSTBOX BARBER SHOP</title>
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

    .ticket-border {
      border: 2px dashed rgba(245, 158, 11, 0.3);
    }

    @keyframes checkmark {
      0% {
        transform: scale(0) rotate(45deg);
        opacity: 0;
      }

      50% {
        transform: scale(1.2) rotate(0deg);
      }

      100% {
        transform: scale(1) rotate(0deg);
        opacity: 1;
      }
    }

    .check-animation {
      animation: checkmark 0.6s ease-out 0.3s forwards;
      opacity: 0;
    }

    @keyframes confetti-fall {
      0% {
        transform: translateY(-100%) rotate(0deg);
        opacity: 1;
      }

      100% {
        transform: translateY(100vh) rotate(720deg);
        opacity: 0;
      }
    }
  </style>
</head>

<body class="bg-[#0a0a0a] text-white min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-md">
    <!-- Success Icon -->
    <div class="text-center mb-8">
      <div
        class="w-20 h-20 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4 check-animation">
        <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
        </svg>
      </div>
      <h1 class="text-2xl font-bold">Booking Berhasil! 🎉</h1>
      <p class="text-gray-400 mt-2 text-sm">Simpan tiket ini sebagai bukti booking Anda</p>
    </div>

    <!-- Digital Ticket -->
    <div class="glass rounded-3xl overflow-hidden">
      <!-- Ticket Header -->
      <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-6 text-center">
        <p class="text-amber-100 text-xs font-semibold tracking-widest uppercase mb-1">FIRSTBOX BARBER SHOP</p>
        <p class="text-5xl font-black text-white">{{ str_pad($booking->queue_number, 3, '0', STR_PAD_LEFT) }}</p>
        <p class="text-amber-100 text-sm font-medium mt-1">Nomor Antrian</p>
      </div>

      <!-- Ticket Body -->
      <div class="p-6 space-y-4">
        <div class="ticket-border rounded-xl p-4 space-y-3">
          <div class="flex justify-between items-center">
            <span class="text-gray-400 text-sm">Nama</span>
            <span class="text-white font-semibold">{{ $booking->customer_name }}</span>
          </div>
          <hr class="border-gray-800">
          <div class="flex justify-between items-center">
            <span class="text-gray-400 text-sm">WhatsApp</span>
            <span class="text-white font-semibold">{{ $booking->wa_number }}</span>
          </div>
          <hr class="border-gray-800">
          <div class="flex justify-between items-center">
            <span class="text-gray-400 text-sm">Layanan</span>
            <span class="text-white font-semibold">{{ $booking->service->name }}</span>
          </div>
          <hr class="border-gray-800">
          <div class="flex justify-between items-center">
            <span class="text-gray-400 text-sm">Kapster</span>
            <span class="text-white font-semibold">{{ $booking->barber->name }}</span>
          </div>
          <hr class="border-gray-800">
          <div class="flex justify-between items-center">
            <span class="text-gray-400 text-sm">Tanggal</span>
            <span class="text-white font-semibold">{{ $booking->booking_date->translatedFormat('d F Y') }}</span>
          </div>
          <hr class="border-gray-800">
          <div class="flex justify-between items-center">
            <span class="text-gray-400 text-sm">Jam Estimasi</span>
            <span class="text-amber-400 font-bold text-lg">
              {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} -
              {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
            </span>
          </div>
          <hr class="border-gray-800">
          <div class="flex justify-between items-center">
            <span class="text-gray-400 text-sm">Harga</span>
            <span class="text-emerald-400 font-bold">{{ $booking->service->formatted_price }}</span>
          </div>
        </div>

        <div class="text-center pt-2">
          <p class="text-gray-500 text-xs">ID Booking: #{{ $booking->id }}</p>
          <p class="text-gray-500 text-xs mt-1">{{ now()->translatedFormat('d M Y, H:i') }} WIB</p>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="mt-6 space-y-3">
      <a href="{{ route('home') }}"
        class="block w-full py-3 glass text-center rounded-2xl text-white font-semibold hover:bg-white/10 transition-colors">
        ← Kembali ke Beranda
      </a>
    </div>
  </div>

</body>

</html>