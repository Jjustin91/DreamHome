<nav x-data="{ open: false }" class="bg-[#5c4f4a] text-[#ede9e6] w-64 min-h-screen flex flex-col justify-between shadow-xl z-20">
    <div>
        <div class="h-16 flex items-center px-6 border-b border-[#c9996b]/30">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold text-xl text-white tracking-wide">
                <svg class="w-6 h-6 text-[#c9996b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                DreamHome
            </a>
        </div>

        <div class="flex flex-col mt-6 px-3 space-y-1">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center px-3 py-2.5 bg-[#c9996b]/20 text-[#c9996b] rounded-lg group transition-all duration-200 font-medium border border-[#c9996b]/30">
                {{ __('Dashboard') }}
            </x-nav-link>
            
            <x-nav-link href="#" class="flex items-center px-3 py-2.5 text-[#ede9e6]/80 hover:text-white hover:bg-[#5c766d]/50 rounded-lg group transition-all duration-200 font-medium">
                {{ __('Properties') }}
            </x-nav-link>

            <x-nav-link href="#" class="flex items-center px-3 py-2.5 text-[#ede9e6]/80 hover:text-white hover:bg-[#5c766d]/50 rounded-lg group transition-all duration-200 font-medium">
                {{ __('Owners') }}
            </x-nav-link>

            <x-nav-link href="#" class="flex items-center px-3 py-2.5 text-[#ede9e6]/80 hover:text-white hover:bg-[#5c766d]/50 rounded-lg group transition-all duration-200 font-medium">
                {{ __('Clients') }}
            </x-nav-link>
            
            <x-nav-link :href="route('leases.index')" :active="request()->routeIs('leases.*')" class="flex items-center px-3 py-2.5 text-[#ede9e6]/80 hover:text-white hover:bg-[#5c766d]/50 rounded-lg group transition-all duration-200 font-medium">
                {{ __('Leases') }}
            </x-nav-link>

            <x-nav-link :href="route('viewings.index')" :active="request()->routeIs('viewings.*')" class="flex items-center px-3 py-2.5 text-[#ede9e6]/80 hover:text-white hover:bg-[#5c766d]/50 rounded-lg group transition-all duration-200 font-medium">
                {{ __('Property Viewings') }}
            </x-nav-link>

            <x-nav-link :href="route('inspections.index')" :active="request()->routeIs('inspections.*')" class="flex items-center px-3 py-2.5 text-[#ede9e6]/80 hover:text-white hover:bg-[#5c766d]/50 rounded-lg group transition-all duration-200 font-medium">
                {{ __('Property Inspections') }}
            </x-nav-link>
        </div>
    </div>

    <div class="p-4 border-t border-[#c9996b]/30">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-3 py-2.5 text-sm font-medium text-[#ede9e6]/80 hover:text-white hover:bg-[#c9996b]/80 rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</nav>