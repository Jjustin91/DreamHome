<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Property Inspections</h2>
    </x-slot>

    <div class="flex justify-end mb-6">
        <a href="{{ route('inspections.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase rounded-md bg-teal-600 hover:bg-teal-700">
            + Log Inspection
        </a>
    </div>

    @if(session('success')) <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-lg">{{ session('success') }}</div> @endif

    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead class="text-white" style="background: #5C5047;">
                <tr>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Date</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Property</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Inspector</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Comments</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inspections as $insp)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold text-gray-800">{{ \Carbon\Carbon::parse($insp->inspection_date)->format('M d, Y') }}</td>
                    <td class="p-4 text-gray-700">{{ $insp->property_no }} - {{ $insp->street }}</td>
                    <td class="p-4 text-gray-700">{{ $insp->first_name }} {{ $insp->last_name }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $insp->comments ?? 'No issues reported.' }}</td>
                    <td class="p-4">
                        {{-- NOTE: We use the composite key encoded with three underscores --- --}}
                        <form action="{{ route('inspections.destroy', $insp->property_no . '___' . $insp->inspection_date) }}" method="POST" onsubmit="return confirm('Delete this inspection record?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm font-bold text-red-600 hover:text-red-800">DELETE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>