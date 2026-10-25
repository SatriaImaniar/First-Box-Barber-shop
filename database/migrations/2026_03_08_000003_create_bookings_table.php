<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('bookings', function (Blueprint $table) {
      $table->id();
      $table->integer('queue_number');
      $table->string('customer_name');
      $table->string('wa_number');
      $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
      $table->foreignId('barber_id')->constrained('barbers')->onDelete('cascade');
      $table->date('booking_date');
      $table->time('start_time');
      $table->time('end_time');
      $table->enum('status', ['menunggu', 'proses', 'selesai', 'batal'])->default('menunggu');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('bookings');
  }
};
