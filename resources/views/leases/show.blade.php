<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Lease Agreement Document</h2>
    </x-slot>

    <div class="mb-6"><a href="{{ route('leases.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">← Back to Leases</a></div>

    <div class="max-w-4xl p-10 mx-auto bg-white border border-gray-200 shadow-lg rounded-xl print:shadow-none print:border-none">
        <div class="flex items-center justify-between pb-6 mb-6 border-b-2 border-gray-800">
            <div>
                <h1 class="text-3xl font-black tracking-widest text-gray-800 uppercase">Dream<span class="text-[#C9956A]">Home</span></h1>
                <p class="mt-1 text-sm text-gray-500">Official Lease Agreement</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-gray-800">{{ $lease->lease_no }}</div>
                <div class="text-sm font-bold {{ $lease->deposit_paid ? 'text-green-600' : 'text-red-600' }}">
                    DEPOSIT: {{ $lease->deposit_paid ? 'PAID IN FULL' : 'PENDING' }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <h3 class="mb-2 text-xs font-bold tracking-wider text-gray-400 uppercase">Property Details</h3>
                <p class="font-semibold text-gray-800">{{ $property->property_no }} - {{ $property->type_of_property }}</p>
                <p class="text-gray-600">{{ $property->street }}</p>
                <p class="text-gray-600">{{ $property->city }}, {{ $property->postcode }}</p>
            </div>
            <div>
                <h3 class="mb-2 text-xs font-bold tracking-wider text-gray-400 uppercase">Tenant Details</h3>
                <p class="font-semibold text-gray-800">{{ $client->renter_no }} - {{ $client->first_name }} {{ $client->last_name }}</p>
                <p class="text-gray-600">{{ $client->telephone_no }}</p>
                <p class="text-gray-600">{{ $client->address }}</p>
            </div>
        </div>

        <div class="p-6 mb-8 border border-gray-200 rounded-lg bg-gray-50">
            <h3 class="mb-4 text-xs font-bold tracking-wider text-gray-400 uppercase">Agreement Terms</h3>
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Duration</p>
                    <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($lease->rent_start)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($lease->rent_finish)->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Monthly Rent</p>
                    <p class="font-bold text-[#C9956A]">₱{{ number_format($lease->monthly_rent, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Payment Method</p>
                    <p class="font-bold text-gray-800">{{ $lease->payment_method }}</p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-8 border-t border-gray-200">
            <div class="text-sm text-gray-500">Authorized by Staff: <strong class="text-gray-800">{{ $lease->staff_no }}</strong></div>
            <button onclick="window.print()" class="px-6 py-2 font-bold text-white transition rounded-lg bg-[#5C5047] hover:bg-gray-800 print:hidden">
                Print Contract
            </button>
        </div>
    </div>
</x-app-layout>