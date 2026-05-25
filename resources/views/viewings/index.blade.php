<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Property Viewings Directory') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
            
            {{-- Top Action Bar with Omni-Search --}}
            <div class="flex items-center justify-between p-6 border-b bg-gray-50/50 border-dh-sand/20">
                <form action="{{ route('viewings.index') }}" method="GET" class="flex w-full max-w-md shadow-sm">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, property, or date..." class="flex-grow border-gray-300 rounded-l-lg bg-white focus:border-dh-forest focus:ring-dh-forest">
                    <button type="submit" class="px-6 py-2 font-bold text-white transition rounded-r-lg bg-dh-charcoal hover:bg-gray-800">Search</button>
                    @if(request('search'))
                        <a href="{{ route('viewings.index') }}" class="flex items-center ml-3 text-sm font-bold text-gray-500 transition hover:text-gray-800">Clear</a>
                    @endif
                </form>

                <a href="{{ route('viewings.create') }}" class="px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal">
                    + Schedule Viewing
                </a>
            </div>
            
            {{-- Viewings Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left whitespace-nowrap">
                    <thead class="tracking-wider text-white uppercase bg-dh-charcoal">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">Viewing No</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Property</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Prospective Renter</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Staff Assigned</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Date</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Feedback / Status</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dh-sand/30">
                        @foreach ($viewings as $viewing)
                            <tr class="transition-colors hover:bg-dh-light/50">
                                <td class="px-6 py-4 font-bold text-dh-forest">{{ $viewing->viewing_no }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-dh-charcoal">{{ $viewing->street }}</div>
                                    <div class="text-xs text-gray-500">{{ $viewing->city }} ({{ $viewing->property_no }})</div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $viewing->renter_first }} {{ $viewing->renter_last }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $viewing->staff_first }} {{ $viewing->staff_last }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ \Carbon\Carbon::parse($viewing->viewing_date)->format('M d, Y') }}
                                    </span>
                                </td>
                                
                                {{-- FIXED COLUMN 6: Actual Feedback Text --}}
                                <td class="px-6 py-4 text-gray-600 truncate max-w-[200px]" title="{{ $viewing->feedback }}">
                                    @if($viewing->feedback)
                                        {{ $viewing->feedback }}
                                    @else
                                        <span class="text-xs italic text-gray-400">Pending Feedback</span>
                                    @endif
                                </td>
                                
                                {{-- FIXED COLUMN 7: Combined Action Buttons --}}
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('viewings.show', $viewing->viewing_no) }}" class="font-medium text-dh-sand hover:text-dh-forest">View Details</a>
                                    
                                    @if(!$viewing->feedback)
                                        <span class="mx-2 text-gray-300">|</span>
                                        <a href="{{ route('viewings.edit', $viewing->viewing_no) }}" class="font-medium text-blue-600 hover:text-blue-800">Log Feedback</a>
                                    @endif

                                    @if(auth()->user()->hasRole('Super Admin'))
                                        <span class="mx-2 text-gray-300">|</span>
                                        <form action="{{ route('viewings.destroy', $viewing->viewing_no) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this viewing?');">
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

            {{-- Pagination Links --}}
            @if($viewings->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 sm:px-6">
                    {{ $viewings->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>