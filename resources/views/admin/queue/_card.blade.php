{{-- Reusable card partial for queue items --}}
@php
  $statusMap = [
    'menunggu' => ['bg' => 'bg-amber-500/20', 'text' => 'text-amber-400', 'border' => 'border-amber-500/30'],
    'proses' => ['bg' => 'bg-blue-500/20', 'text' => 'text-blue-400', 'border' => 'border-blue-500/30'],
    'selesai' => ['bg' => 'bg-emerald-500/20', 'text' => 'text-emerald-400', 'border' => 'border-emerald-500/30'],
    'batal' => ['bg' => 'bg-red-500/20', 'text' => 'text-red-400', 'border' => 'border-red-500/30'],
  ];
  $s = $statusMap[$booking->status];
@endphp

<div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-4 sm:p-5 hover:border-gray-600/50 transition-all">
  <div class="flex items-start gap-4">
    <div
      class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
      {{ $booking->queue_number }}
    </div>
    <div class="min-w-0 flex-1">
      <div class="flex items-start justify-between gap-2">
        <h4 class="text-white font-semibold">{{ $booking->customer_name }}</h4>
        <span
          class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $s['bg'] }} {{ $s['text'] }} border {{ $s['border'] }}">
          {{ ucfirst($booking->status) }}
        </span>
      </div>
      <div class="flex flex-wrap gap-x-3 gap-y-1 mt-2 text-xs text-gray-400">
        <span>📱 {{ $booking->wa_number }}</span>
        <span>✂️ {{ $booking->service->name }}</span>
        <span>👤 {{ $booking->barber->name }}</span>
        <span>🕐 {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} -
          {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</span>
      </div>

      @if($showActions)
        <div class="flex flex-wrap gap-2 mt-2">
          @if($booking->status === 'menunggu')
            <button onclick="updateStatus({{ $booking->id }}, 'proses')"
              class="px-3 py-1.5 text-xs font-medium bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-lg hover:bg-blue-500/30 transition-colors">▶
              Proses</button>
            <button onclick="updateStatus({{ $booking->id }}, 'batal')"
              class="px-3 py-1.5 text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30 rounded-lg hover:bg-red-500/30 transition-colors">✕
              Batal</button>
          @elseif($booking->status === 'proses')
            <button onclick="updateStatus({{ $booking->id }}, 'selesai')"
              class="px-3 py-1.5 text-xs font-medium bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-lg hover:bg-emerald-500/30 transition-colors">✓
              Selesai</button>
            <button onclick="updateStatus({{ $booking->id }}, 'batal')"
              class="px-3 py-1.5 text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30 rounded-lg hover:bg-red-500/30 transition-colors">✕
              Batal</button>
          @endif
        </div>
      @endif
    </div>
  </div>
</div>