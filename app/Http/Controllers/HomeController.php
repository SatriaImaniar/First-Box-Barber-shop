<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $isBookingOpen = Setting::isBookingOpen();
    $services = Service::all();
    return view('welcome', compact('isBookingOpen', 'services'));
  }

  public function booking()
  {
    if (!Setting::isBookingOpen()) {
      return redirect()->route('home')->with('error', 'Booking sedang ditutup.');
    }

    $services = Service::all();
    $barbers = Barber::all();

    return view('booking', compact('services', 'barbers'));
  }

  public function getSlots(Request $request)
  {
    $request->validate([
      'service_id' => 'required|exists:services,id',
      'barber_id' => 'required|exists:barbers,id',
    ]);

    $service = Service::findOrFail($request->service_id);
    $barber = Barber::findOrFail($request->barber_id);
    $today = Carbon::today();
    $now = Carbon::now();

    // Operating hours: 09:00 - 21:00
    $openHour = 9;
    $closeHour = 21;

    // Get existing bookings for this barber today (not cancelled)
    $existingBookings = Booking::where('barber_id', $barber->id)
      ->where('booking_date', $today)
      ->whereIn('status', ['menunggu', 'proses'])
      ->orderBy('start_time')
      ->get();

    $duration = $service->duration_minutes;
    $slots = [];

    // Generate all possible slots
    $slotStart = Carbon::today()->setTime($openHour, 0);
    $closingTime = Carbon::today()->setTime($closeHour, 0);

    while ($slotStart->copy()->addMinutes($duration)->lte($closingTime)) {
      $slotEnd = $slotStart->copy()->addMinutes($duration);

      // Skip past slots
      if ($slotEnd->lte($now)) {
        $slotStart->addMinutes(30);
        continue;
      }

      // Skip if slot starts in the past
      if ($slotStart->lt($now)) {
        $slotStart->addMinutes(30);
        continue;
      }

      // Check for conflicts
      $hasConflict = false;
      foreach ($existingBookings as $booking) {
        $bookingStart = Carbon::parse($today->toDateString() . ' ' . $booking->start_time);
        $bookingEnd = Carbon::parse($today->toDateString() . ' ' . $booking->end_time);

        if ($slotStart->lt($bookingEnd) && $slotEnd->gt($bookingStart)) {
          $hasConflict = true;
          break;
        }
      }

      if (!$hasConflict) {
        $slots[] = [
          'start' => $slotStart->format('H:i'),
          'end' => $slotEnd->format('H:i'),
          'label' => $slotStart->format('H:i') . ' - ' . $slotEnd->format('H:i'),
        ];
      }

      $slotStart->addMinutes(30);
    }

    return response()->json($slots);
  }

  public function store(Request $request)
  {
    if (!Setting::isBookingOpen()) {
      return redirect()->route('home')->with('error', 'Booking sedang ditutup.');
    }

    $request->validate([
      'customer_name' => 'required|string|max:255',
      'wa_number' => 'required|string|max:20',
      'service_id' => 'required|exists:services,id',
      'barber_id' => 'required|exists:barbers,id',
      'start_time' => 'required',
      'end_time' => 'required',
    ]);

    $today = Carbon::today();

    // Anti-spam: check if WA number already has a pending booking today
    $existingBooking = Booking::where('wa_number', $request->wa_number)
      ->where('booking_date', $today)
      ->where('status', 'menunggu')
      ->first();

    if ($existingBooking) {
      return back()->withInput()->with(
        'error',
        'Nomor WhatsApp ini sudah memiliki booking yang sedang menunggu hari ini. Silakan tunggu hingga booking Anda selesai atau dibatalkan.'
      );
    }

    // Double-check slot availability
    $conflict = Booking::where('barber_id', $request->barber_id)
      ->where('booking_date', $today)
      ->whereIn('status', ['menunggu', 'proses'])
      ->where(function ($query) use ($request) {
        $query->where(function ($q) use ($request) {
          $q->where('start_time', '<', $request->end_time)
            ->where('end_time', '>', $request->start_time);
        });
      })->exists();

    if ($conflict) {
      return back()->withInput()->with(
        'error',
        'Slot waktu yang Anda pilih sudah tidak tersedia. Silakan pilih slot lain.'
      );
    }

    $queueNumber = Booking::getNextQueueNumber($today);

    $booking = Booking::create([
      'queue_number' => $queueNumber,
      'customer_name' => $request->customer_name,
      'wa_number' => $request->wa_number,
      'service_id' => $request->service_id,
      'barber_id' => $request->barber_id,
      'booking_date' => $today,
      'start_time' => $request->start_time,
      'end_time' => $request->end_time,
      'status' => 'menunggu',
    ]);

    return redirect()->route('booking.success', $booking->id);
  }

  public function success(Booking $booking)
  {
    $booking->load(['service', 'barber']);
    return view('success', compact('booking'));
  }
}
