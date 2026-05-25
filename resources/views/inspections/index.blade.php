<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Property Inspections Log') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
            
            {{-- Top Action Bar with Omni-Search --}}
            <div class="flex items-center justify-between p-6 border-b bg-gray-50/50 border-dh-sand/20">
                <form action="{{ route('inspections.index') }}" method="GET" class="flex w-full max-w-md shadow-sm">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by property, staff, or date..." class="flex-grow border-gray-300 rounded-l-lg bg-white focus:border-dh-forest focus:ring-dh-forest">
                    <button type="submit" class="px-6 py-2 font-bold text-white transition rounded-r-lg bg-dh-charcoal hover:bg-gray-800">Search</button>
                    @if(request('search'))
                        <a href="{{ route('inspections.index') }}" class="flex items-center ml-3 text-sm font-bold text-gray-500 transition hover:text-gray-800">Clear</a>
                    @endif
                </form>

                <a href="{{ route('inspections.create') }}" class="px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal">
                    + Log New Inspection
                </a>
            </div>
            
            {{-- Inspections Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left whitespace-nowrap">
                    <thead class="tracking-wider text-white uppercase bg-dh-charcoal">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">Property</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Inspector (Staff)</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Inspection Date</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Findings & Comments</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dh-sand/30">
                        @foreach ($inspections as $inspection)
                            <tr class="transition-colors hover:bg-dh-light/50">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-dh-forest">{{ $inspection->property_no }}</div>
                                    <div class="text-xs text-gray-500">{{ $inspection->street ?? 'Location available in details' }}</div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{-- Uses null-coalescing to handle however your Controller joins the names --}}
                                    {{ $inspection->staff_first ?? $inspection->first_name ?? 'Staff ID:' }} {{ $inspection->staff_last ?? $inspection->last_name ?? $inspection->staff_no }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ \Carbon\Carbon::parse($inspection->inspection_date)->format('M d, Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600 truncate max-w-[300px]" title="{{ $inspection->comments }}">
                                    @if($inspection->comments)
                                        {{ $inspection->comments }}
                                    @else
                                        <span class="text-xs italic text-gray-400">No findings reported.</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('inspections.show', $inspection->property_no . '___' . $inspection->inspection_date) }}" class="font-medium text-dh-sand hover:text-dh-forest">
                                        View Report
                                    </a>

                                    @if(auth()->user()->hasRole('Super Admin'))
                                        <span class="mx-2 text-gray-300">|</span>
                                        <form action="{{ route('inspections.destroy', $inspection->property_no . '___' . $inspection->inspection_date) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this inspection?');">
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
            @if(method_exists($inspections, 'hasPages') && $inspections->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 sm:px-6">
                    {{ $inspections->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>