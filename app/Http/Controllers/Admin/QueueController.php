<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QueueController extends Controller
{
  public function index()
  {
    $today = Carbon::today();

    $activeQueues = Booking::with(['service', 'barber'])
      ->where('booking_date', $today)
      ->whereIn('status', ['menunggu', 'proses'])
      ->orderBy('start_time', 'asc')
      ->get();

    $historyQueues = Booking::with(['service', 'barber'])
      ->where('booking_date', $today)
      ->whereIn('status', ['selesai', 'batal'])
      ->orderBy('updated_at', 'desc')
      ->get();

    $services = Service::all();
    $barbers = Barber::all();

    return view('admin.queue.index', compact('activeQueues', 'historyQueues', 'services', 'barbers'));
  }

  public function apiToday()
  {
    $today = Carbon::today();

    $activeQueues = Booking::with(['service', 'barber'])
      ->where('booking_date', $today)
      ->whereIn('status', ['menunggu', 'proses'])
      ->orderBy('start_time', 'asc')
      ->get();

    $historyQueues = Booking::with(['service', 'barber'])
      ->where('booking_date', $today)
      ->whereIn('status', ['selesai', 'batal'])
      ->orderBy('updated_at', 'desc')
      ->get();

    return response()->json([
      'active' => $activeQueues,
      'history' => $historyQueues,
    ]);
  }

  public function updateStatus(Request $request, Booking $booking)
  {
    $request->validate([
      'status' => 'required|in:menunggu,proses,selesai,batal',
    ]);

    $booking->update(['status' => $request->status]);

    return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui!']);
  }

  public function walkin()
  {
    $services = Service::all();
    $barbers = Barber::all();

    return view('admin.queue.walkin', compact('services', 'barbers'));
  }

  public function storeWalkin(Request $request)
  {
    $request->validate([
      'customer_name' => 'required|string|max:255',
      'wa_number' => 'nullable|string|max:20',
      'service_id' => 'required|exists:services,id',
      'barber_id' => 'required|exists:barbers,id',
    ]);

    $today = Carbon::today();
    $now = Carbon::now();
    $service = Service::findOrFail($request->service_id);

    // Find the next available slot for this barber
    $startTime = $now->copy();
    if ($startTime->format('H:i') < '09:00') {
      $startTime->setTime(9, 0);
    }

    // Round up to next 5-minute mark
    $minutes = $startTime->minute;
    $roundedMinutes = ceil($minutes / 5) * 5;
    $startTime->setTime($startTime->hour, 0)->addMinutes($roundedMinutes);

    $endTime = $startTime->copy()->addMinutes($service->duration_minutes);

    // Check for conflicts and find next available slot
    $existingBookings = Booking::where('barber_id', $request->barber_id)
      ->where('booking_date', $today)
      ->whereIn('status', ['menunggu', 'proses'])
      ->orderBy('start_time')
      ->get();

    foreach ($existingBookings as $existing) {
      $existingStart = Carbon::parse($existing->start_time);
      $existingEnd = Carbon::parse($existing->end_time);

      if ($startTime->lt($existingEnd) && $endTime->gt($existingStart)) {
        $startTime = $existingEnd->copy();
        $endTime = $startTime->copy()->addMinutes($service->duration_minutes);
      }
    }

    // Check if the slot is within operating hours
    if ($endTime->format('H:i') > '21:00') {
      return back()->with('error', 'Tidak ada slot waktu tersedia untuk hari ini. Jam operasional sudah berakhir.');
    }

    $queueNumber = Booking::getNextQueueNumber($today);

    Booking::create([
      'queue_number' => $queueNumber,
      'customer_name' => $request->customer_name,
      'wa_number' => $request->wa_number ?? '-',
      'service_id' => $request->service_id,
      'barber_id' => $request->barber_id,
      'booking_date' => $today,
      'start_time' => $startTime->format('H:i'),
      'end_time' => $endTime->format('H:i'),
      'status' => 'menunggu',
    ]);

    return redirect()->route('admin.queue.index')
      ->with('success', "Walk-in berhasil ditambahkan! Nomor antrian: {$queueNumber}");
  }
}
