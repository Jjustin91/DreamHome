<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Client Details
        </h2>
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('clients.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900">
            ← Back to Clients List
        </a>
    </div>

    <div class="grid grid-cols-3 gap-6">
        {{-- Left: Profile Card --}}
        <div class="flex flex-col items-center col-span-1 p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="flex items-center justify-center w-24 h-24 mb-4 text-3xl font-bold text-white rounded-full bg-[#C9956A] shadow-md">
                {{ strtoupper(substr($client->first_name, 0, 1)) }}{{ strtoupper(substr($client->last_name, 0, 1)) }}
            </div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $client->first_name }} {{ $client->last_name }}</h3>
            <div class="mt-1 text-sm font-bold text-[#4F7C72]">Client ID: {{ $client->renter_no }}</div>
            
            <div class="w-full mt-6 space-y-4 text-sm">
                <div><strong class="block text-xs uppercase text-gray-400">Telephone</strong> <span class="font-semibold text-gray-700">{{ $client->telephone_no }}</span></div>
                <div><strong class="block text-xs uppercase text-gray-400">Address</strong> <span class="text-gray-700">{{ $client->address }}</span></div>
                <div><strong class="block text-xs uppercase text-gray-400">Date Registered</strong> <span class="text-gray-700">{{ $client->date ?? 'N/A' }}</span></div>
            </div>

            @hasanyrole('Super Admin|Manager|Supervisor')
                <div class="flex flex-col w-full gap-3 mt-8">
                    <a href="{{ route('clients.edit', $client->renter_no) }}" class="w-full py-2 text-center text-white bg-[#C9956A] rounded-lg font-semibold hover:bg-[#b07d55] transition">Edit Client Info</a>
                </div>
            @endhasanyrole
        </div>

        {{-- Right: Requirements & Assignments --}}
        <div class="flex flex-col col-span-2 gap-6">
            
            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Rental Requirements</h3>
                
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div class="p-4 rounded-lg bg-gray-50 border border-gray-100">
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-wide">Preferred Property</div>
                        <div class="mt-1 text-xl font-bold text-gray-800">{{ $client->pref_property ?? 'Any' }}</div>
                    </div>
                    <div class="p-4 rounded-lg bg-teal-50 border border-teal-100">
                        <div class="text-xs font-bold text-teal-600 uppercase tracking-wide">Max Budget (Monthly)</div>
                        <div class="mt-1 text-xl font-bold text-teal-800">₱{{ number_format($client->max_rent, 2) }}</div>
                    </div>
                </div>

                @if($client->comments)
                    <div class="mt-4">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-400 uppercase">Special Requirements / Comments</label>
                        <div class="p-4 text-sm text-gray-700 bg-gray-50 rounded-lg italic border border-gray-200">
                            "{{ $client->comments }}"
                        </div>
                    </div>
                @endif
            </div>

            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Assignment Details</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Registering Branch</span>
                        <span class="font-semibold text-gray-700">{{ $client->branch_no }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Assigned Agent / Staff</span>
                        <span class="font-semibold text-gray-700">{{ $client->staff_no }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>