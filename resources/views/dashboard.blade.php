<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg mb-8 border-l-4 border-dh-forest">
            <div class="p-6 text-dh-charcoal">
                <h3 class="text-lg font-bold">Welcome back, {{ Auth::user()->name }}!</h3>
                <p class="text-sm text-gray-600 mt-1">Here is the latest system overview for DreamHome Property Management.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            
            <div class="p-6 transition-transform duration-300 bg-white shadow-md rounded-xl hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold tracking-wider text-gray-500 uppercase">Total Branches</p>
                        <h4 class="mt-2 text-4xl font-black text-dh-charcoal">{{ $stats['total_branches'] }}</h4>
                    </div>
                    <div class="p-3 rounded-full bg-dh-sand/20">
                        <svg class="w-8 h-8 text-dh-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
            </div>

            <div class="p-6 transition-transform duration-300 bg-white shadow-md rounded-xl hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold tracking-wider text-gray-500 uppercase">Total Staff</p>
                        <h4 class="mt-2 text-4xl font-black text-dh-charcoal">{{ $stats['total_staff'] }}</h4>
                    </div>
                    <div class="p-3 rounded-full bg-dh-sand/20">
                        <svg class="w-8 h-8 text-dh-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="p-6 transition-transform duration-300 bg-white shadow-md rounded-xl hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold tracking-wider text-gray-500 uppercase">Active Managers</p>
                        <h4 class="mt-2 text-4xl font-black text-dh-charcoal">{{ $stats['total_managers'] }}</h4>
                    </div>
                    <div class="p-3 rounded-full bg-dh-forest/10">
                        <svg class="w-8 h-8 text-dh-sand" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>