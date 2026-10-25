<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
  protected $fillable = ['name', 'price', 'duration_minutes'];

  public function bookings(): HasMany
  {
    return $this->hasMany(Booking::class);
  }

  public function getFormattedPriceAttribute(): string
  {
    return 'Rp ' . number_format($this->price, 0, ',', '.');
  }
}
