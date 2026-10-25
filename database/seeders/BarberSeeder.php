<?php

namespace Database\Seeders;

use App\Models\Barber;
use Illuminate\Database\Seeder;

class BarberSeeder extends Seeder
{
  public function run(): void
  {
    Barber::create(['name' => 'Kapster Andi']);
    Barber::create(['name' => 'Kapster Budi']);
  }
}
