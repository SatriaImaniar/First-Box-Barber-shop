<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Setting;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
  {
    $today = Carbon::today();
    $isBookingOpen = Setting::isBookingOpen();

    $stats = [
      'total' => Booking::where('booking_date', $today)->count(),
      'menunggu' => Booking::where('booking_date', $today)->where('status', 'menunggu')->count(),
      'proses' => Booking::where('booking_date', $today)->where('status', 'proses')->count(),
      'selesai' => Booking::where('booking_date', $today)->where('status', 'selesai')->count(),
      'batal' => Booking::where('booking_date', $today)->where('status', 'batal')->count(),
    ];

    return view('admin.dashboard', compact('isBookingOpen', 'stats'));
  }

  public function toggleBooking()
  {
    $current = Setting::isBookingOpen();
    Setting::setValue('is_booking_open', $current ? 'false' : 'true');

    return back()->with('success', 'Status booking berhasil diubah!');
  }
}
