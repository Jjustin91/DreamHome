<x-guest-layout>
    <div class="w-full px-8 py-10 bg-white shadow-2xl sm:max-w-md sm:rounded-2xl border-t-4 border-dh-forest">
        
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-black tracking-widest uppercase text-dh-charcoal">
                Staff <span class="text-dh-sand">Portal</span>
            </h2>
            <p class="mt-2 text-sm text-gray-500">Enter your credentials to access the system.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="staff_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Staff Number</label>
                <input id="staff_no" type="text" name="staff_no" value="{{ old('staff_no') }}" required autofocus autocomplete="username"
                    class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                <x-input-error :messages="$errors->get('staff_no')" class="mt-2" />
            </div>

            <div class="mt-6">
                <label for="password" class="block text-sm font-bold tracking-wide text-dh-charcoal">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="text-dh-forest border-gray-300 rounded shadow-sm focus:ring-dh-forest" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-8">
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium transition-colors text-dh-sand hover:text-dh-forest focus:outline-none" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="px-6 py-3 text-sm font-bold tracking-widest text-white uppercase transition-colors rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>