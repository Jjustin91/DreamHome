<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Manage Properties
        </h2>
    </x-slot>

    <style>
        :root { --cream:#EEEAE4; --tan:#C9956A; --brown:#5C5047; --teal:#4F7C72; }
        .prop-table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; border: 1px solid rgba(0,0,0,0.1); }
        .prop-table th { background: var(--brown); color: white; padding: 12px; text-align: left; font-size: 13px; text-transform: uppercase; }
        .prop-table td { padding: 15px 12px; border-bottom: 1px solid #eee; font-size: 14px; }
    </style>

    {{-- Top Action Bar --}}
    <div class="flex justify-end mb-6">
        @hasanyrole('Super Admin|Manager|Supervisor')
            <a href="{{ route('properties.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-teal-600 hover:bg-teal-700">
                + Add Property
            </a>
        @endhasanyrole
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-5 mb-6 bg-white border border-gray-200 rounded-xl">
        <form action="{{ route('properties.index') }}" method="GET" class="flex items-center gap-4">
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by street, city, or owner..." class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
            </div>
            <select name="status" class="border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
                <option value="">All Status</option>
                <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Rented" {{ request('status') == 'Rented' ? 'selected' : '' }}>Rented</option>
            </select>
            <button type="submit" class="px-6 py-2 font-semibold text-white transition-colors rounded-lg bg-[#C9956A] hover:bg-[#b07d55]">
                Search
            </button>
            @if(request()->has('search') || request()->has('status'))
                <a href="{{ route('properties.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800">Clear Filters</a>
            @endif
        </form>
    </div>

    <table class="prop-table shadow-sm">
        <thead>
            <tr>
                <th>Property Street</th>
                <th>City</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
            <tr class="hover:bg-gray-50">
                <td class="font-semibold text-gray-800">{{ $property->street }}</td>
                <td class="text-gray-600">{{ $property->city }}</td>
                <td>
                    <span class="px-2 py-1 rounded-full text-xs font-bold {{ $property->status == 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ strtoupper($property->status) }}
                    </span>
                </td>
                <td>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('properties.show', $property->property_no) }}" class="font-bold text-teal-600 hover:text-teal-800">VIEW</a>
                        
                        @hasanyrole('Super Admin|Manager|Supervisor')
                            <a href="{{ route('properties.edit', $property->property_no) }}" class="font-bold text-[#C9956A] hover:text-[#b07d55]">EDIT</a>
                        
                            <form action="{{ route('properties.destroy', $property->property_no) }}" method="POST" onsubmit="return confirm('Delete this property permanently?')">
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

    <div class="mt-6">{{ $properties->links() }}</div>
</x-app-layout>