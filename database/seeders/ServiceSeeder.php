<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
  public function run(): void
  {
    $services = [
      ['name' => 'Potong Rambut', 'price' => 35000, 'duration_minutes' => 30],
      ['name' => 'Potong + Cuci Rambut', 'price' => 50000, 'duration_minutes' => 45],
      ['name' => 'Cukur Jenggot', 'price' => 20000, 'duration_minutes' => 20],
    ];

    foreach ($services as $service) {
      Service::create($service);
    }
  }
}
