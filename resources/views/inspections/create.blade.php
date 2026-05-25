<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Log Property Inspection') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-4xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
            <div class="p-8 border-b border-gray-200">
                
                {{-- Error Display Box --}}
                @if ($errors->any())
                    <div class="p-4 mb-6 text-red-700 bg-red-100 border border-red-400 rounded-lg">
                        <strong class="font-bold">Whoops! Please fix the following errors:</strong>
                        <ul class="mt-2 text-sm list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('inspections.store') }}" method="POST">
                    @csrf

                    <h3 class="mb-4 text-lg font-semibold text-dh-forest border-b pb-2">Inspection Details</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-8">
                        
                        <div>
                            <label for="property_no" class="block text-sm font-medium text-gray-700">Property</label>
                            <select name="property_no" id="property_no" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="" disabled selected>-- Choose a Property --</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->property_no }}">{{ $property->street }}, {{ $property->city }} ({{ $property->property_no }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="staff_no" class="block text-sm font-medium text-gray-700">Inspector (Staff)</label>
                            <select name="staff_no" id="staff_no" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="" disabled selected>-- Assign Inspector --</option>
                                @foreach($staff as $member)
                                    <option value="{{ $member->staff_no }}">{{ $member->first_name }} {{ $member->last_name }} ({{ $member->staff_no }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="inspection_date" class="block text-sm font-medium text-gray-700">Date of Inspection</label>
                            <input type="date" name="inspection_date" id="inspection_date" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                        </div>

                        <div class="md:col-span-2">
                            <label for="comments" class="block text-sm font-medium text-gray-700">Findings & Comments</label>
                            <textarea name="comments" id="comments" rows="4" required placeholder="Detail the condition of the property (e.g., 'Minor scuffs on living room wall, plumbing checked and clear.')..." class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest"></textarea>
                        </div>

                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center justify-between pt-4 mt-6 border-t border-gray-200">
                        <a href="{{ route('inspections.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:text-dh-forest focus:outline-none focus:ring-2 focus:ring-dh-forest focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Cancel & Go Back
                        </a>
                        <button type="submit" class="px-6 py-3 font-bold text-white transition-colors rounded-lg shadow-md bg-dh-charcoal hover:bg-gray-800">
                            Log Inspection Record
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>