<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Lease Agreement Details') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-5xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
            
            {{-- Header Banner --}}
            <div class="px-8 py-6 text-white bg-dh-charcoal flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-dh-sand uppercase tracking-wider">Agreement Number</p>
                    <h3 class="text-3xl font-bold">{{ $lease->lease_no }}</h3>
                </div>
                <div>
                    @if($lease->deposit_paid == 'Y')
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-500 text-white shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Active & Secured
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-500 text-white shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Pending Deposit
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    {{-- Left Column: Entities --}}
                    <div class="space-y-8">
                        {{-- Property Info --}}
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <h4 class="text-lg font-bold text-dh-forest mb-4 border-b pb-2">Property Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-xs font-semibold text-gray-500 uppercase">Property Ref No.</span>
                                    <span class="block text-base font-medium text-gray-900">{{ $lease->property_no }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-gray-500 uppercase">Location</span>
                                    <span class="block text-base font-medium text-gray-900">{{ $property->street }}</span>
                                    <span class="block text-sm text-gray-600">{{ $property->city }} {{ $property->postcode }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Renter Info --}}
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <h4 class="text-lg font-bold text-dh-forest mb-4 border-b pb-2">Renter Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-xs font-semibold text-gray-500 uppercase">Renter Ref No.</span>
                                    <span class="block text-base font-medium text-gray-900">{{ $lease->renter_no }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-gray-500 uppercase">Primary Tenant</span>
                                    <span class="block text-base font-medium text-gray-900">{{ $client->first_name }} {{ $client->last_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Terms & Financials --}}
                    <div class="space-y-8">
                        {{-- Lease Terms --}}
                        <div>
                            <h4 class="text-lg font-bold text-dh-forest mb-4 border-b pb-2">Lease Terms</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <span class="block text-xs font-semibold text-gray-500 uppercase">Start Date</span>
                                    <span class="block text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($lease->rent_start)->format('d M, Y') }}</span>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <span class="block text-xs font-semibold text-gray-500 uppercase">Finish Date</span>
                                    <span class="block text-lg font-bold text-dh-charcoal">{{ \Carbon\Carbon::parse($lease->rent_finish)->format('d M, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Financials --}}
                        <div>
                            <h4 class="text-lg font-bold text-dh-forest mb-4 border-b pb-2">Financial Ledger</h4>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Monthly Rent</span>
                                    <span class="text-lg font-bold text-gray-900">€{{ number_format($lease->monthly_rent, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Payment Method</span>
                                    <span class="text-sm font-semibold text-gray-700">{{ $lease->payment_method }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Deposit Cleared</span>
                                    <span class="text-sm font-bold {{ $lease->deposit_paid == 'Y' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $lease->deposit_paid == 'Y' ? 'YES' : 'NO' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="mt-10 pt-6 border-t border-gray-200 flex justify-between items-center">
                    
                    {{-- Left Side: Back Button --}}
                    <a href="{{ route('leases.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:text-dh-forest focus:outline-none focus:ring-2 focus:ring-dh-forest focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Directory
                    </a>

                    {{-- Right Side: Primary Actions --}}
                    <div class="flex space-x-4">
                        <button onclick="window.print()" class="px-6 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-bold text-gray-700 hover:bg-gray-50 transition">
                            Print Record
                        </button>
                        <a href="{{ route('leases.edit', $lease->lease_no) }}" class="px-6 py-2 bg-dh-forest text-white rounded-lg shadow-md text-sm font-bold hover:bg-dh-charcoal transition">
                            Edit Agreement
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>