<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        {{-- ============================================================== --}}
        {{-- MAIN WELCOME BANNER                                            --}}
        {{-- ============================================================== --}}
        <div class="p-8 mb-8 bg-white border border-gray-200 shadow-sm rounded-2xl bg-gradient-to-r from-white to-gray-50">
            <h1 class="text-3xl font-black text-gray-800 md:text-4xl">
                Welcome back, {{ $user->name }}! 👋
            </h1>
            @if(isset($profile) && $profile)
                <p class="mt-2 text-sm font-bold tracking-widest text-[#C9956A] uppercase">
                    {{ $profile->job_title }} &nbsp;|&nbsp; Branch: {{ $profile->branch_no }}
                </p>
            @endif
            <p class="mt-4 text-gray-500">Here is what is happening across your operations today.</p>
        </div>

        {{-- ============================================================== --}}
        {{-- SUPER ADMIN DASHBOARD                                          --}}
        {{-- ============================================================== --}}
        @role('Super Admin')
            <div class="mb-4"><h3 class="text-lg font-bold text-gray-800 border-b pb-2">Global System Overview</h3></div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-4 mb-8">
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl border-l-4 border-l-[#5C5047] hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-gray-400 uppercase">Total Branches</div>
                    <div class="mt-2 text-3xl font-black text-gray-800">{{ $stats['branches'] }}</div>
                </div>
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl border-l-4 border-l-teal-600 hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-gray-400 uppercase">Total Staff</div>
                    <div class="mt-2 text-3xl font-black text-gray-800">{{ $stats['staff'] }}</div>
                </div>
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl border-l-4 border-l-[#C9956A] hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-gray-400 uppercase">Total Properties</div>
                    <div class="mt-2 text-3xl font-black text-gray-800">{{ $stats['properties'] }}</div>
                </div>
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl border-l-4 border-l-green-600 hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-gray-400 uppercase">Active Leases</div>
                    <div class="mt-2 text-3xl font-black text-gray-800">{{ $stats['leases'] }}</div>
                </div>
            </div>
        @endrole

        {{-- ============================================================== --}}
        {{-- MANAGER DASHBOARD (Branch Reports)                             --}}
        {{-- ============================================================== --}}
        @role('Manager')
            <div class="mb-4"><h3 class="text-lg font-bold text-gray-800 border-b pb-2">Branch {{ $stats['branch_no'] }} Report</h3></div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mb-8">
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-gray-400 uppercase">My Assigned Staff</div>
                    <div class="mt-2 text-4xl font-black text-teal-700">{{ $stats['staff'] }}</div>
                </div>
                <div class="p-6 bg-green-50 border border-green-200 shadow-sm rounded-xl hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-green-600 uppercase">Properties Available</div>
                    <div class="mt-2 text-4xl font-black text-green-800">{{ $stats['available_props'] }}</div>
                </div>
                <div class="p-6 bg-red-50 border border-red-200 shadow-sm rounded-xl hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-red-600 uppercase">Properties Rented</div>
                    <div class="mt-2 text-4xl font-black text-red-800">{{ $stats['rented_props'] }}</div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('properties.index') }}" class="inline-block px-6 py-3 font-bold text-white rounded-lg shadow bg-[#5C5047] hover:bg-gray-800 transition">
                    View Branch Properties →
                </a>
            </div>
        @endrole

        {{-- ============================================================== --}}
        {{-- SUPERVISOR DASHBOARD                                           --}}
        {{-- ============================================================== --}}
        @role('Supervisor')
            <div class="mb-4"><h3 class="text-lg font-bold text-gray-800 border-b pb-2">Operations Summary</h3></div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mb-8">
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-gray-400 uppercase">Total Adverts Placed</div>
                    <div class="mt-2 text-4xl font-black text-[#C9956A]">{{ $stats['adverts'] }}</div>
                </div>
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-gray-400 uppercase">Inspections Logged</div>
                    <div class="mt-2 text-4xl font-black text-teal-700">{{ $stats['inspections'] }}</div>
                </div>
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md transition">
                    <div class="text-sm font-bold tracking-wider text-gray-400 uppercase">Client Viewings</div>
                    <div class="mt-2 text-4xl font-black text-gray-800">{{ $stats['viewings'] }}</div>
                </div>
            </div>
        @endrole

        {{-- ============================================================== --}}
        {{-- STANDARD STAFF / SALESPERSON DASHBOARD                         --}}
        {{-- ============================================================== --}}
        @if(!auth()->user()->hasAnyRole(['Super Admin', 'Manager', 'Supervisor']))
            <div class="mb-4"><h3 class="text-lg font-bold text-gray-800 border-b pb-2">My Upcoming Schedule</h3></div>
            
            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                @if(isset($my_viewings) && $my_viewings->count() > 0)
                    <ul class="space-y-4">
                        @foreach($my_viewings as $viewing)
                            <li class="flex items-center justify-between p-4 border rounded-lg bg-gray-50 border-gray-100 hover:bg-white hover:shadow-sm transition">
                                <div>
                                    <span class="block font-bold text-teal-700">{{ \Carbon\Carbon::parse($viewing->viewing_date)->format('l, F jS, Y') }}</span>
                                    <span class="text-sm text-gray-600">Property: <strong>{{ $viewing->property_no }} - {{ $viewing->street }}</strong></span>
                                </div>
                                <a href="{{ route('viewings.edit', $viewing->viewing_no) }}" class="px-5 py-2 text-sm font-bold text-white bg-[#C9956A] rounded-full hover:bg-[#b07d55] transition">
                                    Log Feedback
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="py-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="font-semibold text-lg">Your schedule is clear.</p>
                        <p class="text-sm">No upcoming viewings assigned to you at the moment.</p>
                    </div>
                @endif
            </div>
        @endif

    </div>
</x-app-layout>