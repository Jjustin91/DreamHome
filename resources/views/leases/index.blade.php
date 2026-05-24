<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Lease Agreements</h2>
    </x-slot>

    <div class="flex items-center justify-between mb-6">
        {{-- The Search Bar --}}
        <form action="{{ route('leases.index') }}" method="GET" class="flex w-full max-w-md shadow-sm">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Lease ID or Renter Last Name..." class="flex-grow border-gray-300 rounded-l-lg bg-gray-50 focus:ring-[#C9956A]">
            <button type="submit" class="px-6 py-2 font-bold text-white transition rounded-r-lg bg-[#5C5047] hover:bg-gray-800">Search</button>
            @if(request('search'))
                <a href="{{ route('leases.index') }}" class="flex items-center ml-3 text-sm font-bold text-gray-500 hover:text-gray-800">Clear</a>
            @endif
        </form>
        @hasanyrole('Super Admin|Manager|Supervisor')
        {{-- The Action Button --}}
        <a href="{{ route('leases.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase rounded-md bg-teal-600 hover:bg-teal-700 shadow-sm">
            + Create Lease
        </a>
        @endhasanyrole
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead class="text-white" style="background: #5C5047;">
                <tr>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Lease No</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Property</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Client</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Term Dates</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Status</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leases as $lease)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold text-[#C9956A]">{{ $lease->lease_no }}</td>
                    <td class="p-4 font-semibold text-gray-800">{{ $lease->property_no }} - {{ $lease->street }}</td>
                    <td class="p-4 text-gray-700">{{ $lease->first_name }} {{ $lease->last_name }}</td>
                    <td class="p-4 text-sm text-gray-700">
                        {{ \Carbon\Carbon::parse($lease->rent_start)->format('M Y') }} - 
                        {{ \Carbon\Carbon::parse($lease->rent_finish)->format('M Y') }}
                    </td>
                    <td class="p-4">
                        @if(\Carbon\Carbon::parse($lease->rent_finish)->isPast())
                            <span class="px-2 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-full">Expired</span>
                        @else
                            <span class="px-2 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">Active</span>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex items-center gap-3 text-sm font-bold">
                            @hasanyrole('Super Admin|Manager|Supervisor')
                                <form action="{{ route('leases.destroy', $lease->lease_no) }}" method="POST" onsubmit="return confirm('Terminate this lease early?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">TERMINATE</button>
                                </form>
                            @endhasanyrole
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $leases->links() }}</div>
</x-app-layout>