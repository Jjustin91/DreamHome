<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Press Contacts (Newspapers)</h2>
    </x-slot>

    <div class="flex justify-end mb-6">
        <a href="{{ route('newspapers.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase rounded-md bg-teal-600 hover:bg-teal-700">
            + Add Newspaper
        </a>
    </div>

    @if(session('success')) <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-lg">{{ session('success') }}</div> @endif

    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead class="text-white" style="background: #5C5047;">
                <tr>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Newspaper Name</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Contact Person</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Telephone</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Address</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newspapers as $paper)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold text-[#C9956A]">{{ $paper->newspaper_name }}</td>
                    <td class="p-4 text-gray-800 font-semibold">{{ $paper->contact_name }}</td>
                    <td class="p-4 text-gray-700">{{ $paper->telephone_no }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $paper->address }}</td>
                    <td class="p-4">
                        <form action="{{ route('newspapers.destroy', $paper->newspaper_name) }}" method="POST" onsubmit="return confirm('Remove this newspaper contact? This will also delete all advert records associated with it.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm font-bold text-red-600 hover:text-red-800">REMOVE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>