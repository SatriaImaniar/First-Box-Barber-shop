<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Firstbox Barber Shop</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="font-sans antialiased bg-[#0a0a0a] text-white">
    <!-- Background decorations -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 -right-20 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 -left-20 w-80 h-80 bg-orange-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 px-4">
        <!-- Logo -->
        <div class="mb-6">
            <a href="/" class="flex flex-col items-center gap-4">
                <img src="{{ asset('logo-barber.jpg') }}" alt="Firstbox Barber Shop"
                    class="w-24 h-24 rounded-2xl object-cover shadow-2xl shadow-amber-500/20 border-2 border-amber-500/30">
                <div class="text-center">
                    <h1 class="text-2xl font-extrabold tracking-tight">FIRSTBOX</h1>
                    <p class="text-amber-400 text-xs font-semibold tracking-widest">BARBER SHOP</p>
                </div>
            </a>
        </div>

        <!-- Login Card -->
        <div class="w-full sm:max-w-md glass rounded-3xl p-8">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <p class="mt-8 text-gray-600 text-xs">© {{ date('Y') }} Firstbox Barber Shop</p>
    </div>
</body>

</html>