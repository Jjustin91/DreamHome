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

        {{-- ========================================================= --}}
        {{-- SUPER ADMIN VIEW --}}
        {{-- ========================================================= --}}
        @role('Super Admin')
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="p-6 transition-transform duration-300 bg-white shadow-md rounded-xl hover:-translate-y-1">
                    <p class="text-sm font-bold tracking-wider text-gray-500 uppercase">Total Branches</p>
                    <h4 class="mt-2 text-4xl font-black text-dh-charcoal">{{ $stats['total_branches'] }}</h4>
                </div>
                <div class="p-6 transition-transform duration-300 bg-white shadow-md rounded-xl hover:-translate-y-1">
                    <p class="text-sm font-bold tracking-wider text-gray-500 uppercase">Total Staff</p>
                    <h4 class="mt-2 text-4xl font-black text-dh-charcoal">{{ $stats['total_staff'] }}</h4>
                </div>
                <div class="p-6 transition-transform duration-300 bg-white shadow-md rounded-xl hover:-translate-y-1">
                    <p class="text-sm font-bold tracking-wider text-gray-500 uppercase">Active Managers</p>
                    <h4 class="mt-2 text-4xl font-black text-dh-charcoal">{{ $stats['total_managers'] }}</h4>
                </div>
            </div>
        @endrole

        {{-- ========================================================= --}}
        {{-- MANAGER VIEW --}}
        {{-- ========================================================= --}}
        @role('Manager')
            <div class="mb-6 flex items-center justify-between">
                <h3 class="text-lg font-bold text-dh-charcoal">
                    Branch Command Center: <span class="text-dh-forest">{{ $managerProfile->branch->city }} ({{ $managerProfile->branch_no }})</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="p-6 transition-transform duration-300 bg-white shadow-md rounded-xl hover:-translate-y-1 border-t-4 border-dh-forest">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold tracking-wider text-gray-500 uppercase">My Team Members</p>
                            <h4 class="mt-2 text-4xl font-black text-dh-charcoal">{{ $stats['my_staff_count'] }}</h4>
                        </div>
                        <div class="p-3 rounded-full bg-dh-sand/20">
                            <svg class="w-8 h-8 text-dh-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="p-6 transition-transform duration-300 bg-white shadow-md rounded-xl border-t-4 border-dh-sand opacity-50 cursor-not-allowed">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold tracking-wider text-gray-500 uppercase">Properties Managed</p>
                            <h4 class="mt-2 text-4xl font-black text-dh-charcoal">--</h4>
                        </div>
                        <div class="p-3 rounded-full bg-gray-100">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs text-center text-gray-400 mt-4">Property Module Coming Soon</p>
                </div>
            </div>
        @endrole

    </div>
</x-app-layout>