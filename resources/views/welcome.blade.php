<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="FIRSTBOX BARBER SHOP - Barbershop terbaik dengan layanan potong rambut profesional. Booking online & antrian digital.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FIRSTBOX BARBER SHOP</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a2e 50%, #16213e 100%);
        }

        .gold-gradient {
            background: linear-gradient(135deg, #f59e0b, #ef4722, #f59e0b);
            background-size: 200% 200%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="bg-[#0a0a0a] text-white">

    <!-- Flash Messages -->
    @if(session('error'))
        <div class="fixed top-4 right-4 z-50 max-w-sm p-4 bg-red-500/20 border border-red-500/30 backdrop-blur-xl rounded-2xl text-red-300 text-sm"
            id="flashMsg">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        <script>setTimeout(() => { const el = document.getElementById('flashMsg'); if (el) el.style.display = 'none'; }, 6000);</script>
    @endif

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-40 bg-black/30 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('logo-barber.jpg') }}" alt="Logo" class="w-9 h-9 rounded-lg object-cover">
                    <span class="font-extrabold text-lg tracking-tight">FIRSTBOX</span>
                </div>
                <div class="flex items-center gap-4">
                    @if($isBookingOpen)
                        <a href="{{ route('booking') }}"
                            class="px-5 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-full hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg shadow-amber-500/25">
                            Booking Now
                        </a>
                    @endif
                    <a href="{{ route('login') }}"
                        class="text-gray-400 hover:text-white text-sm transition-colors">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient min-h-screen flex items-center relative overflow-hidden">
        <!-- Decorations -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-orange-500/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 glass rounded-full text-sm text-amber-400 mb-6">
                            <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                            Barbershop Premium
                        </div>
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black leading-tight">
                            FIRSTBOX
                            <span
                                class="block text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">BARBER
                                SHOP</span>
                        </h1>
                        <p class="text-gray-400 text-lg mt-6 max-w-lg leading-relaxed">
                            Tampil keren dengan potongan rambut terbaik dari kapster profesional kami. Booking sekarang,
                            potong tanpa antri!
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        @if($isBookingOpen)
                            <a href="{{ route('booking') }}"
                                class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-2xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-2xl shadow-amber-500/30 text-lg group">
                                Booking Sekarang
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        @endif
                        <a href="#services"
                            class="inline-flex items-center gap-2 px-8 py-4 glass text-white font-semibold rounded-2xl hover:bg-white/10 transition-all text-lg">
                            Lihat Layanan
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="flex gap-8 pt-4">
                        <div>
                            <p class="text-3xl font-bold text-amber-400">5+</p>
                            <p class="text-sm text-gray-500">Tahun Pengalaman</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-amber-400">1000+</p>
                            <p class="text-sm text-gray-500">Pelanggan Puas</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-amber-400">4.9</p>
                            <p class="text-sm text-gray-500">Rating ⭐</p>
                        </div>
                    </div>
                </div>

                <!-- Hero visual -->
                <div class="hidden lg:flex items-center justify-center">
                    <div class="relative float-animation">
                        <div class="w-80 h-80 rounded-3xl glass flex items-center justify-center">
                            <div class="text-center space-y-4">
                                <img src="{{ asset('logo-barber.jpg') }}" alt="Firstbox Barber Shop"
                                    class="w-32 h-32 mx-auto rounded-3xl object-cover shadow-2xl shadow-amber-500/30 border-2 border-amber-500/20">
                                <p class="text-2xl font-black tracking-wider">FIRSTBOX</p>
                                <p class="text-gray-400 text-sm">BARBER SHOP</p>
                                <div class="flex justify-center gap-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <span class="text-amber-400">★</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center rotate-12">
                            <span class="text-2xl">✂️</span>
                        </div>
                        <div
                            class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-2xl flex items-center justify-center -rotate-12">
                            <span class="text-xl">💈</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 relative">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-amber-500/[0.02] to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <p class="text-amber-400 font-semibold text-sm tracking-widest uppercase mb-3">Layanan Kami</p>
                <h2 class="text-4xl sm:text-5xl font-black">Pilih Gaya <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Terbaikmu</span>
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="glass rounded-3xl p-8 hover:border-amber-500/30 transition-all duration-300 group">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-amber-400/20 to-orange-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <span class="text-2xl">✂️</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-400 text-sm mb-6">Durasi: {{ $service->duration_minutes }} menit</p>
                        <div class="flex items-center justify-between">
                            <p
                                class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">
                                {{ $service->formatted_price }}
                            </p>
                            @if($isBookingOpen)
                                <a href="{{ route('booking') }}"
                                    class="px-4 py-2 bg-amber-500/10 text-amber-400 text-sm font-semibold rounded-xl border border-amber-500/20 hover:bg-amber-500/20 transition-colors">
                                    Book
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Booking Status -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($isBookingOpen)
                <div class="glass rounded-3xl p-8 sm:p-12 text-center border-amber-500/20">
                    <div class="w-16 h-16 bg-emerald-500/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold mb-3">Booking Online Tersedia!</h2>
                    <p class="text-gray-400 mb-8 max-w-lg mx-auto">Booking sekarang untuk mendapatkan slot waktu terbaik.
                        Tidak perlu login, langsung booking!</p>
                    <a href="{{ route('booking') }}"
                        class="inline-flex items-center gap-3 px-10 py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-2xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-2xl shadow-amber-500/30 text-lg">
                        Booking Sekarang →
                    </a>
                </div>
            @else
                <div class="glass rounded-3xl p-8 sm:p-12 text-center border-red-500/20">
                    <div class="w-16 h-16 bg-red-500/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Booking Online Ditutup</h2>
                    <p class="text-gray-400 max-w-2xl mx-auto leading-relaxed">
                        Mohon maaf, fitur booking online saat ini ditutup dan hanya tersedia pada event tertentu (Ramadhan,
                        Tahun Baru, dll). Silakan datang langsung ke lokasi.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-16 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <p class="text-amber-400 font-semibold text-sm tracking-widest uppercase mb-3">Info & Kontak</p>
                <h2 class="text-3xl sm:text-4xl font-black">Temukan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Kami</span>
                </h2>
            </div>

            <div class="grid sm:grid-cols-3 gap-6">
                <!-- Lokasi -->
                <a href="https://www.google.com/maps/place/FIRSTBOX+BARBERSHOP/@-6.9589289,109.0045311,21z/data=!4m16!1m9!3m8!1s0x2e6fbd0075810c15:0x607469f65d3bd7b3!2sFIRSTBOX+BARBERSHOP!8m2!3d-6.9587331!4d109.0044684!9m1!1b1!16s%2Fg%2F11y5sbn_cn!3m5!1s0x2e6fbd0075810c15:0x607469f65d3bd7b3!8m2!3d-6.9587331!4d109.0044684!16s%2Fg%2F11y5sbn_cn?entry=ttu&g_ep=EgoyMDI2MDMwNS4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank"
                    class="glass rounded-2xl p-8 text-center group hover:border-red-500/30 transition-all duration-300 block">
                    <div
                        class="w-14 h-14 bg-red-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Lokasi</h3>
                    <p class="text-gray-400 text-sm mb-3">Firstbox Barber Shop</p>
                    <span
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-400 group-hover:gap-2.5 transition-all">
                        Buka Google Maps
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </span>
                </a>

                <!-- Jam Operasional -->
                <div class="glass rounded-2xl p-8 text-center">
                    <div class="w-14 h-14 bg-amber-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Jam Operasional</h3>
                    <p class="text-gray-400 text-sm mb-1">Setiap Hari</p>
                    <p
                        class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">
                        09:00 - 21:00</p>
                    <p class="text-gray-500 text-xs mt-1">WIB</p>
                </div>

                <!-- WhatsApp -->
                <a href="https://wa.me/6285727131379?text=Halo%20Admin%20Firstbox%20Barbershop,%20saya%20mau%20tanya..."
                    target="_blank"
                    class="glass rounded-2xl p-8 text-center group hover:border-emerald-500/30 transition-all duration-300 block">
                    <div
                        class="w-14 h-14 bg-emerald-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">WhatsApp</h3>
                    <p class="text-gray-400 text-sm mb-3">Chat langsung dengan kami</p>
                    <span
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-400 group-hover:gap-2.5 transition-all">
                        Chat Sekarang
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} FIRSTBOX BARBER SHOP. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>