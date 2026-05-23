<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Prospective Renters (Clients)
        </h2>
    </x-slot>

    <style>
        :root { --cream:#EEEAE4; --tan:#C9956A; --brown:#5C5047; --teal:#4F7C72; }
        .client-table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; border: 1px solid rgba(0,0,0,0.1); }
        .client-table th { background: var(--brown); color: white; padding: 12px; text-align: left; font-size: 13px; text-transform: uppercase; }
        .client-table td { padding: 15px 12px; border-bottom: 1px solid #eee; font-size: 14px; }
    </style>

    <div class="flex justify-end mb-6">
        @hasanyrole('Super Admin|Manager|Supervisor')
            <a href="{{ route('clients.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-teal-600 hover:bg-teal-700">
                + Add New Client
            </a>
        @endhasanyrole
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-5 mb-6 bg-white border border-gray-200 rounded-xl">
        <form action="{{ route('clients.index') }}" method="GET" class="flex items-center gap-4">
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, client number, or branch..." class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
            </div>
            <select name="pref_property" class="border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
                <option value="">Any Property Type</option>
                <option value="Flat" {{ request('pref_property') == 'Flat' ? 'selected' : '' }}>Flat</option>
                <option value="House" {{ request('pref_property') == 'House' ? 'selected' : '' }}>House</option>
                <option value="Studio" {{ request('pref_property') == 'Studio' ? 'selected' : '' }}>Studio</option>
            </select>
            <button type="submit" class="px-6 py-2 font-semibold text-white transition-colors rounded-lg bg-[#C9956A] hover:bg-[#b07d55]">
                Search
            </button>
            @if(request()->has('search') || request()->has('pref_property'))
                <a href="{{ route('clients.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800">Clear</a>
            @endif
        </form>
    </div>

    <table class="shadow-sm client-table">
        <thead>
            <tr>
                <th>Client No.</th>
                <th>Full Name</th>
                <th>Preference</th>
                <th>Max Budget</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr class="hover:bg-gray-50">
                <td class="font-bold text-[#C9956A]">{{ $client->renter_no }}</td>
                <td class="font-semibold text-gray-800">{{ $client->first_name }} {{ $client->last_name }}</td>
                <td class="text-gray-600">{{ $client->pref_property ?? 'No Preference' }}</td>
                <td class="font-bold text-teal-600">
                    {{ $client->max_rent ? '₱' . number_format($client->max_rent, 2) : 'Unspecified' }}
                </td>
                <td>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('clients.show', $client->renter_no) }}" class="font-bold text-teal-600 hover:text-teal-800">VIEW</a>
                        
                        @hasanyrole('Super Admin|Manager|Supervisor')
                            <a href="{{ route('clients.edit', $client->renter_no) }}" class="font-bold text-[#C9956A] hover:text-[#b07d55]">EDIT</a>
                            <form action="{{ route('clients.destroy', $client->renter_no) }}" method="POST" onsubmit="return confirm('Delete this client permanently?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-bold text-red-600 hover:text-red-800">DELETE</button>
                            </form>
                        @endhasanyrole
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">{{ $clients->links() ?? '' }}</div>
</x-app-layout>