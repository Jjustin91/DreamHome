<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Property Inspection Record') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-4xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
            
            {{-- Header Banner --}}
            <div class="flex items-center justify-between px-8 py-6 text-white bg-dh-charcoal">
                <div>
                    <p class="text-sm font-medium tracking-wider uppercase text-dh-sand">Inspection Reference</p>
                    <h3 class="text-3xl font-bold">#{{ $inspection->id ?? 'Record' }}</h3>
                </div>
                <div>
                    <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-600 rounded-full shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Official Log
                    </span>
                </div>
            </div>

            <div class="p-8">
                {{-- Read-Only Context --}}
                <h3 class="mb-4 text-lg font-semibold border-b text-dh-forest pb-2">Inspection Details</h3>
                <div class="grid grid-cols-1 gap-6 p-6 mb-8 border border-gray-100 rounded-lg bg-gray-50 md:grid-cols-2">
                    
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Date of Inspection</span>
                        <span class="block text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($inspection->inspection_date)->format('l, F j, Y') }}</span>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Property Inspected</span>
                        <span class="block text-base font-medium text-gray-900">{{ $property->street ?? 'N/A' }}</span>
                        <span class="block text-sm text-gray-600">{{ $property->city ?? '' }} ({{ $inspection->property_no }})</span>
                    </div>

                    <div class="md:col-span-2">
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Supervising Inspector</span>
                        <span class="block text-base font-medium text-gray-900">{{ $staff->first_name ?? 'N/A' }} {{ $staff->last_name ?? '' }}</span>
                        <span class="block text-sm text-gray-600">Staff ID: {{ $inspection->staff_no }}</span>
                    </div>
                </div>

                {{-- Findings & Comments --}}
                <h3 class="mb-4 text-lg font-semibold border-b text-dh-forest pb-2">Official Findings</h3>
                <div class="p-6 mb-8 bg-white border border-gray-200 rounded-lg shadow-sm">
                    @if($inspection->comments)
                        <p class="text-gray-800 whitespace-pre-wrap">{{ $inspection->comments }}</p>
                    @else
                        <p class="italic text-gray-400">No specific findings or comments were recorded for this inspection.</p>
                    @endif
                    
                    <p class="flex items-center mt-6 text-xs font-bold text-red-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        This is an immutable historical record and cannot be edited.
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between pt-6 mt-10 border-t border-gray-200">
                    <a href="{{ route('inspections.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:text-dh-forest focus:outline-none focus:ring-2 focus:ring-dh-forest focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Directory
                    </a>
                    
                    <button onclick="window.print()" class="px-6 py-2 text-sm font-bold text-gray-700 transition bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                        Print Report
                    </button>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>