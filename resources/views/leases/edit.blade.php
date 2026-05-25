<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Update Lease Agreement') }}
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

                <form action="{{ route('leases.update', $lease->lease_no) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Section 1: Locked Context (Read-Only) --}}
                    <h3 class="mb-4 text-lg font-semibold text-dh-forest border-b pb-2">Agreement Overview (Locked)</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-8 bg-gray-50 p-6 rounded-lg border border-gray-100">
                        
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase">Lease Number</span>
                            <span class="block text-lg font-bold text-gray-900">{{ $lease->lease_no }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase">Renter</span>
                            <span class="block text-base font-medium text-gray-900">{{ $client->first_name }} {{ $client->last_name }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase">Property</span>
                            <span class="block text-base font-medium text-gray-900">{{ $property->property_no }} ({{ $property->street }})</span>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase">Monthly Rent</span>
                            <span class="block text-base font-medium text-gray-900">€{{ number_format($lease->monthly_rent, 2) }}</span>
                        </div>

                    </div>

                    {{-- Section 2: Updatable Financials --}}
                    <h3 class="mb-4 text-lg font-semibold text-dh-forest border-b pb-2">Update Financial Status</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-8">
                        
                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <select name="payment_method" id="payment_method" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="Bank Transfer" {{ $lease->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="Credit Card" {{ $lease->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="Cheque" {{ $lease->payment_method == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                                <option value="Cash" {{ $lease->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                        </div>

                        <div>
                            <label for="deposit_paid" class="block text-sm font-medium text-gray-700">Deposit Paid?</label>
                            <select name="deposit_paid" id="deposit_paid" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-dh-forest focus:border-dh-forest">
                                <option value="0" {{ $lease->deposit_paid == false ? 'selected' : '' }}>No (Pending)</option>
                                <option value="1" {{ $lease->deposit_paid == true ? 'selected' : '' }}>Yes (Cleared)</option>
                            </select>
                        </div>

                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center justify-between pt-4 mt-6 border-t border-gray-200">
                        
                        <a href="{{ route('leases.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:text-dh-forest focus:outline-none focus:ring-2 focus:ring-dh-forest focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Cancel Changes
                        </a>

                        <button type="submit" class="px-6 py-3 font-bold text-white transition-colors rounded-lg shadow-md bg-dh-charcoal hover:bg-gray-800">
                            Save Updates
                        </button>
                        
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>