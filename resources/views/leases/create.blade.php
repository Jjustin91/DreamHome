<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Create Lease Agreement') }}
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
                
                <form action="{{ route('leases.store') }}" method="POST">
                    @csrf
                    {{-- Section 1: Core Details --}}
                    <h3 class="mb-4 text-lg font-semibold text-dh-forest border-b pb-2">Agreement Details</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-8">
                        
                        {{-- FIXED: Now using $clients instead of $renters --}}
                        <div>
                            <label for="renter_no" class="block text-sm font-medium text-gray-700">Select Renter</label>
                            <select name="renter_no" id="renter_no" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="" disabled selected>-- Choose a Prospective Renter --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->renter_no }}">{{ $client->first_name }} {{ $client->last_name }} ({{ $client->renter_no }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="property_no" class="block text-sm font-medium text-gray-700">Select Property</label>
                            <select name="property_no" id="property_no" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="" disabled selected>-- Choose a Property --</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->property_no }}">{{ $property->street }}, {{ $property->city }} ({{ $property->property_no }})</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ADDED: The missing Staff Member dropdown required by your controller --}}
                        <div>
                            <label for="staff_no" class="block text-sm font-medium text-gray-700">Supervising Staff</label>
                            <select name="staff_no" id="staff_no" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="" disabled selected>-- Assign Supervising Staff --</option>
                                @foreach($staff as $member)
                                    <option value="{{ $member->staff_no }}">{{ $member->first_name }} {{ $member->last_name }} ({{ $member->staff_no }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="rent_start" class="block text-sm font-medium text-gray-700">Rent Start Date</label>
                            <input type="date" name="rent_start" id="rent_start" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                        </div>

                        <div>
                            <label for="rent_finish" class="block text-sm font-medium text-gray-700">Rent Finish Date</label>
                            <input type="date" name="rent_finish" id="rent_finish" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                        </div>
                    </div>

                    {{-- Section 2: Financials --}}
                    <h3 class="mb-4 text-lg font-semibold text-dh-forest border-b pb-2">Financial Information</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-8">
                        
                        <div>
                            <label for="monthly_rent" class="block text-sm font-medium text-gray-700">Monthly Rent (€)</label>
                            <input type="number" step="0.01" name="monthly_rent" id="monthly_rent" required placeholder="0.00" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                        </div>

                        {{-- ADDED: The missing Deposit Amount required by your Controller --}}
                        <div>
                            <label for="deposit_amount" class="block text-sm font-medium text-gray-700">Deposit Amount (€)</label>
                            <input type="number" step="0.01" name="deposit_amount" id="deposit_amount" required placeholder="0.00" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                        </div>

                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <select name="payment_method" id="payment_method" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>

                        <div>
                            <label for="deposit_paid" class="block text-sm font-medium text-gray-700">Deposit Paid?</label>
                            {{-- FIXED: Values changed from Y/N to 1/0 to pass Laravel's boolean validation --}}
                            <select name="deposit_paid" id="deposit_paid" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="0">No (Pending)</option>
                                <option value="1">Yes (Paid)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center justify-between pt-4 mt-6 border-t border-gray-200">
                        
                        {{-- Left Side: Cancel / Back Button --}}
                        <a href="{{ route('leases.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:text-dh-forest focus:outline-none focus:ring-2 focus:ring-dh-forest focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Cancel & Go Back
                        </a>

                        {{-- Right Side: Submit Button --}}
                        <button type="submit" class="px-6 py-3 font-bold text-white transition-colors rounded-lg shadow-md bg-dh-charcoal hover:bg-gray-800">
                            Generate Lease Agreement
                        </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>