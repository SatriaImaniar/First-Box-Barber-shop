# 💈 FIRSTBOX BARBER SHOP

<p align="center">
  <img src="https://shields.io" alt="Laravel">
  <img src="https://shields.io" alt="Tailwind CSS">
  <img src="https://shields.io" alt="PHP">
</p>

**FIRSTBOX BARBER SHOP** merupakan solusi digital berbasis web yang mengintegrasikan halaman *landing page* interaktif dengan sistem pemesanan (*booking system*) waktu nyata. Proyek ini bertujuan untuk menjembatani kebutuhan kapster profesional dan pelanggan yang menginginkan efisiensi waktu.

---

## ✨ Fitur Utama

*   **Landing Page Interaktif** – Menyajikan informasi layanan, peringkat, testimoni, dan keunggulan barbershop secara menarik.
*   **Sistem Booking Online** – Memungkinkan pelanggan memilih jadwal secara langsung untuk memotong antrean.
*   **Panel Admin Terintegrasi** – Memudahkan pengelolaan data pelanggan, layanan, kapster, dan jadwal operasional.

## 🛠️ Tech Stack

*   **Backend & Framework:** Laravel (PHP)
*   **Frontend:** Blade Templating Engine
*   **Styling:** Tailwind CSS
*   **Build Tool:** Vite

## 🚀 Cara Menjalankan Proyek Secara Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer Anda:

1. **Clone Repositori**
   ```bash
   git clone https://github.com
   cd First-Box-Barber-shop
   ```

2. **Install Dependensi PHP & JavaScript**
   ```bash
   composer install
   npm install
   ```

3. **Salin File Environment**
   ```bash
   cp .env.example .env
   ```
   *Sesuaikan pengaturan database di dalam file `.env` Anda.*

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migrasi Database**
   ```bash
   php artisan migrate
   ```

6. **Jalankan Server Lokal**
   ```bash
   npm run dev
   # Buka terminal baru
   php artisan serve
   ```
   Aplikasi dapat diakses melalui browser di `http://127.0.0.1:8000`.
