<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Property Viewings</h2>
    </x-slot>

    <div class="flex justify-end mb-6">
        <a href="{{ route('viewings.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase rounded-md bg-teal-600 hover:bg-teal-700">
            + Schedule Viewing
        </a>
    </div>

    @if(session('success')) <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-lg">{{ session('success') }}</div> @endif

    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead class="text-white" style="background: #5C5047;">
                <tr>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Date</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Property</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Client</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Staff Assigned</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewings as $view)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold text-gray-800">{{ \Carbon\Carbon::parse($view->viewing_date)->format('M d, Y') }}</td>
                    <td class="p-4 text-gray-700">{{ $view->property_no }} - {{ $view->street }}</td>
                    <td class="p-4 text-gray-700">{{ $view->renter_first }} {{ $view->renter_last }}</td>
                    <td class="p-4 text-gray-700">{{ $view->staff_first }} {{ $view->staff_last }}</td>
                    <td class="p-4">
                        <div class="flex items-center gap-3 text-sm font-bold">
                            <a href="{{ route('viewings.edit', $view->viewing_no) }}" class="text-[#C9956A] hover:text-[#b07d55]">LOG FEEDBACK</a>
                            <form action="{{ route('viewings.destroy', $view->viewing_no) }}" method="POST" onsubmit="return confirm('Cancel this viewing?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">CANCEL</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>