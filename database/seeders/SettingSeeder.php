<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
  public function run(): void
  {
    Setting::create([
      'key' => 'is_booking_open',
      'value' => 'false',
    ]);
  }
}
