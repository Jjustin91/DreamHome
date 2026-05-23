<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Property
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('properties.update', $property->property_no) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="flex items-center justify-between mb-6">
            <div class="text-sm text-gray-600">Editing Property No: <strong style="color:#C9956A">{{ $property->property_no }}</strong></div>
            <div class="flex gap-3">
                <a href="{{ route('properties.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full hover:bg-red-50">Cancel</a>
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-teal-600 hover:bg-teal-700">Save Changes</button>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            {{-- Left Column: Form Inputs --}}
            <div class="p-6 bg-white border border-gray-200 rounded-xl">
                <h3 class="mb-4 text-lg font-bold border-b pb-2">Property Details</h3>
                
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Street</label>
                    <input type="text" name="street" value="{{ old('street', $property->street) }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
                </div>
                
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-600">City</label>
                    <input type="text" name="city" value="{{ old('city', $property->city) }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Property Type</label>
                        <input type="text" name="type_of_property" value="{{ old('type_of_property', $property->type_of_property) }}" class="w-full border-gray-300 rounded-lg bg-gray-50">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Rooms</label>
                        <input type="number" name="number_of_rooms" value="{{ old('number_of_rooms', $property->number_of_rooms) }}" class="w-full border-gray-300 rounded-lg bg-gray-50">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Monthly Rent (₱)</label>
                    <input type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent', $property->monthly_rent) }}" class="w-full border-gray-300 rounded-lg bg-gray-50">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg bg-gray-50">
                        @foreach(['Available','Rented','Reserved'] as $st)
                            <option value="{{ $st }}" {{ $property->status==$st?'selected':'' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Right Column: Image and Read Only Data --}}
            <div class="flex flex-col gap-6">
                <div class="p-6 bg-white border border-gray-200 rounded-xl">
                    <h3 class="mb-4 text-lg font-bold border-b pb-2">Property Image</h3>
                    <input type="file" name="property_image" class="w-full text-sm">
                    @if($property->image_path)
                        <img src="{{ asset('storage/'.$property->image_path) }}" class="mt-4 rounded-lg">
                    @endif
                </div>

                <div class="p-6 bg-white border border-gray-200 rounded-xl">
                    <h3 class="mb-4 text-lg font-bold border-b pb-2">Related Information</h3>
                    <div class="mb-2 text-sm"><strong class="text-gray-600">Owner ID:</strong> {{ $property->owner_no }}</div>
                    <div class="mb-2 text-sm"><strong class="text-gray-600">Owner Name:</strong> {{ $property->owner_name }}</div>
                    <div class="mb-2 text-sm"><strong class="text-gray-600">Branch ID:</strong> {{ $property->branch_no }}</div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>