<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-white">Login Admin</h2>
        <p class="text-gray-400 text-sm mt-1">Masuk ke dashboard admin</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors"
                placeholder="admin@firstbox.com" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <input id="password" type="password" name="password"
                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors"
                placeholder="••••••••" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mt-4">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 rounded bg-gray-900 border-gray-600 text-amber-500 focus:ring-amber-500 focus:ring-offset-gray-900">
            <label for="remember_me" class="ms-2 text-sm text-gray-400">Ingat saya</label>
        </div>

        <button type="submit"
            class="w-full mt-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg shadow-amber-500/25">
            Masuk
        </button>
    </form>
</x-guest-layout>