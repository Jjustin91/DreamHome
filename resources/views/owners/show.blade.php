<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Owner Profile
        </h2>
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('owners.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900">
            ← Back to Owners List
        </a>
    </div>

    <div class="grid grid-cols-3 gap-6">
        {{-- Profile Card --}}
        <div class="col-span-1 p-6 bg-white border border-gray-200 rounded-xl flex flex-col items-center">
            <div class="w-32 h-32 mb-4 overflow-hidden rounded-full bg-[#EEEAE4] border-4 border-white shadow-lg">
                @if($owner->image_path)
                    <img src="{{ asset('storage/' . $owner->image_path) }}" class="object-cover w-full h-full">
                @endif
            </div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $owner->name }}</h3>
            <div class="mt-1 text-sm font-bold text-[#C9956A]">ID: {{ $owner->owner_no }}</div>
            
            <div class="w-full mt-6 space-y-4 text-sm">
                <div><strong class="block text-gray-500">Telephone</strong> {{ $owner->telephone_no }}</div>
                <div><strong class="block text-gray-500">Address</strong> {{ $owner->address }}</div>
            </div>

            @hasanyrole('Super Admin|Manager|Supervisor')
                <div class="w-full mt-8 flex flex-col gap-3">
                    <a href="{{ route('owners.edit', $owner->owner_no) }}" class="w-full py-2 text-center text-white bg-[#4F7C72] rounded-lg font-semibold">Edit Owner Info</a>
                    <form action="{{ route('owners.destroy', $owner->owner_no) }}" method="POST" onsubmit="return confirm('Delete owner permanently?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full py-2 text-center text-red-600 border border-red-600 rounded-lg font-semibold">Delete Record</button>
                    </form>
                </div>
            @else
                <div class="w-full mt-8 p-3 bg-gray-50 rounded-lg text-center text-sm text-gray-500">
                    Only operations staff can modify owner records.
                </div>
            @endhasanyrole
        </div>

        {{-- Owned Properties Table --}}
        <div class="col-span-2 p-6 bg-white border border-gray-200 rounded-xl">
            <h3 class="mb-4 text-lg font-bold border-b pb-2">Owned Properties ({{ $properties->count() }})</h3>
            
            @if($properties->isEmpty())
                <p class="text-gray-500 text-center py-8">This owner has no properties listed.</p>
            @else
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-600 text-sm">
                        <tr>
                            <th class="p-3">Prop No.</th>
                            <th class="p-3">Street</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($properties as $prop)
                        <tr class="border-t">
                            <td class="p-3 font-semibold text-[#C9956A]">{{ $prop->property_no }}</td>
                            <td class="p-3">{{ $prop->street }}, {{ $prop->city }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs font-bold rounded-md {{ $prop->status == 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ strtoupper($prop->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('properties.show', $prop->property_no) }}" class="font-bold text-[#4F7C72]">VIEW</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>