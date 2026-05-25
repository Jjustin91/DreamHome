<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Lease Agreements Directory') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
            
            {{-- Top Action Bar with Omni-Search --}}
            <div class="flex items-center justify-between p-6 border-b bg-gray-50/50 border-dh-sand/20">
                <form action="{{ route('leases.index') }}" method="GET" class="flex w-full max-w-md shadow-sm">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search anything (Name, Property, Date)..." class="flex-grow border-gray-300 rounded-l-lg bg-white focus:border-dh-forest focus:ring-dh-forest">
                    <button type="submit" class="px-6 py-2 font-bold text-white transition rounded-r-lg bg-dh-charcoal hover:bg-gray-800">Search</button>
                    @if(request('search'))
                        <a href="{{ route('leases.index') }}" class="flex items-center ml-3 text-sm font-bold text-gray-500 transition hover:text-gray-800">Clear</a>
                    @endif
                </form>

                <a href="{{ route('leases.create') }}" class="px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal">
                    + Create Lease
                </a>
            </div>
            
            {{-- Lease Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left whitespace-nowrap">
                    <thead class="tracking-wider text-white uppercase bg-dh-charcoal">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">Lease No</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Renter Name</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Property No</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Rent / Payment</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Status</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Rent Start</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dh-sand/30">
                        @foreach ($leases as $lease)
                            <tr class="transition-colors hover:bg-dh-light/50">
                                <td class="px-6 py-4 font-bold text-dh-forest">{{ $lease->lease_no }}</td>
                                <td class="px-6 py-4 font-medium text-dh-charcoal">{{ $lease->first_name }} {{ $lease->last_name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $lease->property_no }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">€{{ number_format($lease->monthly_rent, 2) }}</div>
                                    <div class="text-xs text-gray-500">{{ $lease->payment_method }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($lease->deposit_paid == 'Y')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Deposit Paid</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Pending Deposit</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900">{{ \Carbon\Carbon::parse($lease->rent_start)->format('M d, Y') }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('leases.show', $lease->lease_no) }}" class="font-medium text-dh-sand hover:text-dh-forest">View</a>
                                    <span class="mx-2 text-gray-300">|</span>
                                    <a href="{{ route('leases.edit', $lease->lease_no) }}" class="font-medium text-blue-600 hover:text-blue-800">Edit</a>
                                    
                                    @if(auth()->user()->hasRole('Super Admin'))
                                        <span class="mx-2 text-gray-300">|</span>
                                        <form action="{{ route('leases.destroy', $lease->lease_no) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this lease?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- ADDED: Pagination Links --}}
            @if($leases->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 sm:px-6">
                    {{ $leases->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>