<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#5c4f4a]" />
            <x-text-input id="email" class="block mt-1 w-full border-[#5c4f4a]/20 focus:border-[#c9996b] focus:ring-[#c9996b]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#5c4f4a]" />
            <x-text-input id="password" class="block mt-1 w-full border-[#5c4f4a]/20 focus:border-[#c9996b] focus:ring-[#c9996b]" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-[#5c4f4a]/20 text-[#c9996b] focus:ring-[#c9996b]" name="remember">
                <span class="ms-2 text-sm text-[#5c766d]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#5c766d] hover:text-[#c9996b] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c9996b]" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-[#5c4f4a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#5c766d] focus:bg-[#5c766d] active:bg-[#5c4f4a] focus:outline-none focus:ring-2 focus:ring-[#c9996b] focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>