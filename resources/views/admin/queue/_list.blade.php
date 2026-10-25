{{-- Partial for initial server-side render of queue list --}}
@if($bookings->isEmpty())
  <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-12 text-center">
    <p class="text-gray-500">Belum ada antrian hari ini</p>
  </div>
@else
  <div class="space-y-3">
    @foreach($bookings as $booking)
      <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-4 sm:p-5 hover:border-gray-600/50 transition-all">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div class="flex items-start gap-4">
            <div
              class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
              {{ $booking->queue_number }}
            </div>
            <div class="min-w-0">
              <h4 class="text-white font-semibold">{{ $booking->customer_name }}</h4>
              <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1 text-sm text-gray-400">
                <span>📱 {{ $booking->wa_number }}</span>
                <span>✂️ {{ $booking->service->name }}</span>
                <span>👤 {{ $booking->barber->name }}</span>
                <span>🕐 {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} -
                  {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-3 sm:flex-col sm:items-end">
            @php
              $statusMap = [
                'menunggu' => ['bg' => 'bg-amber-500/20', 'text' => 'text-amber-400', 'border' => 'border-amber-500/30'],
                'proses' => ['bg' => 'bg-blue-500/20', 'text' => 'text-blue-400', 'border' => 'border-blue-500/30'],
                'selesai' => ['bg' => 'bg-emerald-500/20', 'text' => 'text-emerald-400', 'border' => 'border-emerald-500/30'],
                'batal' => ['bg' => 'bg-red-500/20', 'text' => 'text-red-400', 'border' => 'border-red-500/30'],
              ];
              $s = $statusMap[$booking->status];
            @endphp
            <span
              class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $s['bg'] }} {{ $s['text'] }} border {{ $s['border'] }}">
              {{ ucfirst($booking->status) }}
            </span>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif