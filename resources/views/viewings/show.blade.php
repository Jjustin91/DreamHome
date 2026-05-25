<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Property Viewing Record') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-4xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
            
            {{-- Header Banner --}}
            <div class="flex items-center justify-between px-8 py-6 text-white bg-dh-charcoal">
                <div>
                    <p class="text-sm font-medium tracking-wider uppercase text-dh-sand">Viewing Number</p>
                    <h3 class="text-3xl font-bold">{{ $viewing->viewing_no }}</h3>
                </div>
                <div>
                    @if($viewing->feedback)
                        <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-green-500 rounded-full shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Completed & Logged
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-yellow-500 rounded-full shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Pending Feedback
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-8">
                {{-- Read-Only Context --}}
                <h3 class="mb-4 text-lg font-semibold border-b text-dh-forest pb-2">Appointment Details</h3>
                <div class="grid grid-cols-1 gap-6 p-6 mb-8 border border-gray-100 rounded-lg bg-gray-50 md:grid-cols-2">
                    
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Scheduled Date</span>
                        <span class="block text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($viewing->viewing_date)->format('l, F j, Y') }}</span>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Property Location</span>
                        <span class="block text-base font-medium text-gray-900">{{ $property->street ?? 'N/A' }}</span>
                        <span class="block text-sm text-gray-600">{{ $property->city ?? '' }} ({{ $viewing->property_no }})</span>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Prospective Renter</span>
                        <span class="block text-base font-medium text-gray-900">{{ $client->first_name ?? 'N/A' }} {{ $client->last_name ?? '' }}</span>
                        <span class="block text-sm text-gray-600">ID: {{ $viewing->renter_no }}</span>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Assigned Staff</span>
                        <span class="block text-base font-medium text-gray-900">{{ $staff->first_name ?? 'N/A' }} {{ $staff->last_name ?? '' }}</span>
                        <span class="block text-sm text-gray-600">ID: {{ $viewing->staff_no }}</span>
                    </div>
                </div>

                {{-- Client Feedback Log --}}
                <h3 class="mb-4 text-lg font-semibold border-b text-dh-forest pb-2">Client Feedback Log</h3>
                <div class="p-6 mb-8 bg-white border border-gray-200 rounded-lg shadow-sm">
                    @if($viewing->feedback)
                        <p class="text-gray-800 whitespace-pre-wrap">{{ $viewing->feedback }}</p>
                        <p class="flex items-center mt-4 text-xs font-bold text-red-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            This record is permanently locked for auditing purposes.
                        </p>
                    @else
                        <p class="italic text-gray-400">No feedback has been logged for this viewing yet.</p>
                        <div class="mt-4">
                            <a href="{{ route('viewings.edit', $viewing->viewing_no) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                                &rarr; Log Feedback Now
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between pt-6 mt-10 border-t border-gray-200">
                    <a href="{{ route('viewings.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:text-dh-forest focus:outline-none focus:ring-2 focus:ring-dh-forest focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Directory
                    </a>
                    
                    <button onclick="window.print()" class="px-6 py-2 text-sm font-bold text-gray-700 transition bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                        Print Record
                    </button>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>