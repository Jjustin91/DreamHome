<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Property Advertisements</h2>
    </x-slot>

    <div class="flex justify-end mb-6">
        <a href="{{ route('adverts.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase rounded-md bg-teal-600 hover:bg-teal-700">
            + Log Advert
        </a>
    </div>

    @if(session('success')) <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-lg">{{ session('success') }}</div> @endif

    {{-- Filter Bar to satisfy requirements (n) and (o) --}}
    <div class="p-5 mb-6 bg-white border border-gray-200 rounded-xl">
        <form action="{{ route('adverts.index') }}" method="GET" class="flex items-center gap-4">
            <select name="property_no" class="flex-grow border-gray-300 rounded-lg bg-gray-50 focus:ring-[#C9956A]">
                <option value="">All Properties</option>
                @foreach($properties as $p)
                    <option value="{{ $p->property_no }}" {{ request('property_no') == $p->property_no ? 'selected' : '' }}>{{ $p->property_no }} - {{ $p->street }}</option>
                @endforeach
            </select>
            
            <select name="newspaper_name" class="flex-grow border-gray-300 rounded-lg bg-gray-50 focus:ring-[#C9956A]">
                <option value="">All Newspapers</option>
                @foreach($newspapers as $n)
                    <option value="{{ $n->newspaper_name }}" {{ request('newspaper_name') == $n->newspaper_name ? 'selected' : '' }}>{{ $n->newspaper_name }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="px-6 py-2 font-semibold text-white rounded-lg bg-[#C9956A] hover:bg-[#b07d55]">Filter</button>
            @if(request('property_no') || request('newspaper_name'))
                <a href="{{ route('adverts.index') }}" class="text-sm text-gray-500 font-bold hover:text-gray-800">Clear</a>
            @endif
        </form>
    </div>

    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead class="text-white" style="background: #5C5047;">
                <tr>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Date</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Property</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Newspaper</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Cost</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adverts as $adv)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold text-gray-800">{{ \Carbon\Carbon::parse($adv->date_advertised)->format('M d, Y') }}</td>
                    <td class="p-4 text-gray-700">{{ $adv->property_no }} - {{ $adv->street }}</td>
                    <td class="p-4 text-[#C9956A] font-bold">{{ $adv->newspaper_name }}</td>
                    <td class="p-4 text-teal-700 font-bold">€{{ number_format($adv->cost, 2) }}</td>
                    <td class="p-4">
                        {{-- NOTE: We use the composite key encoded with three underscores --- --}}
                        <form action="{{ route('adverts.destroy', $adv->property_no . '___' . $adv->newspaper_name . '___' . $adv->date_advertised) }}" method="POST" onsubmit="return confirm('Delete this advert record?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm font-bold text-red-600 hover:text-red-800">DELETE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $adverts->links() }}</div>
</x-app-layout>