<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
  protected $fillable = [
    'queue_number',
    'customer_name',
    'wa_number',
    'service_id',
    'barber_id',
    'booking_date',
    'start_time',
    'end_time',
    'status',
  ];

  protected $casts = [
    'booking_date' => 'date',
  ];

  public function service(): BelongsTo
  {
    return $this->belongsTo(Service::class);
  }

  public function barber(): BelongsTo
  {
    return $this->belongsTo(Barber::class);
  }

  public static function getNextQueueNumber(\Carbon\Carbon $date): int
  {
    $maxQueue = self::where('booking_date', $date->toDateString())
      ->max('queue_number');

    return ($maxQueue ?? 0) + 1;
  }
}
