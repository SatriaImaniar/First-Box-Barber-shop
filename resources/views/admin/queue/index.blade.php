@extends('admin.layouts.app')
@section('page-title', 'Antrian Hari Ini')

@section('content')
  <div class="space-y-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
      <div>
        <p class="text-gray-400">{{ now()->translatedFormat('l, d F Y') }}</p>
        <p class="text-xs text-gray-500 mt-1" id="lastUpdate">Memuat data...</p>
      </div>
      <a href="{{ route('admin.queue.walkin') }}"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg shadow-emerald-500/25">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
        Walk-in
      </a>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Left Column: Active Queue -->
      <div>
        <div class="flex items-center gap-2 mb-4">
          <div class="w-3 h-3 bg-amber-400 rounded-full animate-pulse"></div>
          <h3 class="text-lg font-semibold text-white">Antrian Aktif</h3>
          <span class="text-xs text-gray-500" id="activeCount">({{ $activeQueues->count() }})</span>
        </div>
        <div id="activeContainer" class="space-y-3">
          @forelse($activeQueues as $booking)
            @include('admin.queue._card', ['booking' => $booking, 'showActions' => true])
          @empty
            <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-10 text-center">
              <div class="w-14 h-14 bg-gray-700/50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-7 h-7 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <p class="text-gray-500 text-sm">Belum ada antrian aktif</p>
            </div>
          @endforelse
        </div>
      </div>

      <!-- Right Column: History -->
      <div class="opacity-75">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
          <h3 class="text-lg font-semibold text-white">Riwayat Hari Ini</h3>
          <span class="text-xs text-gray-500" id="historyCount">({{ $historyQueues->count() }})</span>
        </div>
        <div id="historyContainer" class="space-y-3">
          @forelse($historyQueues as $booking)
            @include('admin.queue._card', ['booking' => $booking, 'showActions' => false])
          @empty
            <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-10 text-center">
              <div class="w-14 h-14 bg-gray-700/50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-7 h-7 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <p class="text-gray-500 text-sm">Belum ada riwayat hari ini</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    function updateStatus(bookingId, newStatus) {
      fetch(`/admin/queue/${bookingId}/status`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ status: newStatus })
      })
        .then(r => r.json())
        .then(data => {
          if (data.success) fetchQueue();
        })
        .catch(err => console.error(err));
    }

    function fetchQueue() {
      fetch('{{ route("admin.queue.api-today") }}')
        .then(r => r.json())
        .then(data => {
          renderColumn('activeContainer', data.active, true);
          renderColumn('historyContainer', data.history, false);
          document.getElementById('activeCount').textContent = `(${data.active.length})`;
          document.getElementById('historyCount').textContent = `(${data.history.length})`;
          document.getElementById('lastUpdate').textContent = 'Terakhir diperbarui: ' + new Date().toLocaleTimeString('id-ID');
        })
        .catch(err => console.error(err));
    }

    function getStatusBadge(status) {
      const map = {
        'menunggu': { bg: 'bg-amber-500/20', text: 'text-amber-400', border: 'border-amber-500/30', label: 'Menunggu' },
        'proses': { bg: 'bg-blue-500/20', text: 'text-blue-400', border: 'border-blue-500/30', label: 'Proses' },
        'selesai': { bg: 'bg-emerald-500/20', text: 'text-emerald-400', border: 'border-emerald-500/30', label: 'Selesai' },
        'batal': { bg: 'bg-red-500/20', text: 'text-red-400', border: 'border-red-500/30', label: 'Batal' }
      };
      const s = map[status];
      return `<span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full ${s.bg} ${s.text} border ${s.border}">${s.label}</span>`;
    }

    function getActionButtons(booking) {
      let html = '<div class="flex flex-wrap gap-2 mt-2">';
      if (booking.status === 'menunggu') {
        html += `<button onclick="updateStatus(${booking.id}, 'proses')" class="px-3 py-1.5 text-xs font-medium bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-lg hover:bg-blue-500/30 transition-colors">▶ Proses</button>`;
        html += `<button onclick="updateStatus(${booking.id}, 'batal')" class="px-3 py-1.5 text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30 rounded-lg hover:bg-red-500/30 transition-colors">✕ Batal</button>`;
      } else if (booking.status === 'proses') {
        html += `<button onclick="updateStatus(${booking.id}, 'selesai')" class="px-3 py-1.5 text-xs font-medium bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-lg hover:bg-emerald-500/30 transition-colors">✓ Selesai</button>`;
        html += `<button onclick="updateStatus(${booking.id}, 'batal')" class="px-3 py-1.5 text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30 rounded-lg hover:bg-red-500/30 transition-colors">✕ Batal</button>`;
      }
      html += '</div>';
      return html;
    }

    function renderCard(b, showActions) {
      const startTime = b.start_time ? b.start_time.substring(0, 5) : '';
      const endTime = b.end_time ? b.end_time.substring(0, 5) : '';
      return `
          <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-4 sm:p-5 hover:border-gray-600/50 transition-all">
              <div class="flex items-start gap-4">
                  <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                      ${b.queue_number}
                  </div>
                  <div class="min-w-0 flex-1">
                      <div class="flex items-start justify-between gap-2">
                          <h4 class="text-white font-semibold">${b.customer_name}</h4>
                          ${getStatusBadge(b.status)}
                      </div>
                      <div class="flex flex-wrap gap-x-3 gap-y-1 mt-2 text-xs text-gray-400">
                          <span>📱 ${b.wa_number}</span>
                          <span>✂️ ${b.service ? b.service.name : '-'}</span>
                          <span>👤 ${b.barber ? b.barber.name : '-'}</span>
                          <span>🕐 ${startTime} - ${endTime}</span>
                      </div>
                      ${showActions ? getActionButtons(b) : ''}
                  </div>
              </div>
          </div>`;
    }

    function renderEmptyState(icon, message) {
      return `
          <div class="bg-gray-800/50 border border-gray-700/50 rounded-2xl p-10 text-center">
              <div class="w-14 h-14 bg-gray-700/50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                  <svg class="w-7 h-7 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${icon}"/></svg>
              </div>
              <p class="text-gray-500 text-sm">${message}</p>
          </div>`;
    }

    function renderColumn(containerId, bookings, showActions) {
      const container = document.getElementById(containerId);
      if (bookings.length === 0) {
        const icon = showActions
          ? 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'
          : 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z';
        const msg = showActions ? 'Belum ada antrian aktif' : 'Belum ada riwayat hari ini';
        container.innerHTML = renderEmptyState(icon, msg);
        return;
      }
      container.innerHTML = bookings.map(b => renderCard(b, showActions)).join('');
    }

    // Initial load & poll every 10 seconds
    fetchQueue();
    setInterval(fetchQueue, 10000);
  </script>
@endpush