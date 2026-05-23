<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Client Profile
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('clients.update', $client->renter_no) }}">
        @csrf @method('PUT')

        <div class="flex items-center justify-between mb-6">
            <div class="text-sm text-gray-600">Editing Client: <strong class="text-[#C9956A]">{{ $client->renter_no }}</strong></div>
            <div class="flex gap-3">
                <a href="{{ route('clients.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full hover:bg-red-50">Cancel</a>
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-[#C9956A] hover:bg-[#b07d55]">Update Client</button>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg">
                <ul class="pl-5 list-disc text-sm">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-6">
            {{-- Left: Personal Info --}}
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Personal Information</h3>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-1 text-sm font-semibold text-gray-600">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $client->first_name) }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Last Name *</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $client->last_name) }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Telephone Number *</label>
                    <input type="text" name="telephone_no" value="{{ old('telephone_no', $client->telephone_no) }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Current Address *</label>
                    <textarea name="address" rows="3" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500">{{ old('address', $client->address) }}</textarea>
                </div>
            </div>

            {{-- Right: Requirements & Assignments --}}
            <div class="flex flex-col gap-6">
                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Rental Requirements</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block mb-1 text-sm font-semibold text-gray-600">Preferred Property</label>
                            <select name="pref_property" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500">
                                <option value="">Any</option>
                                <option value="Flat" {{ old('pref_property', $client->pref_property) == 'Flat' ? 'selected' : '' }}>Flat</option>
                                <option value="House" {{ old('pref_property', $client->pref_property) == 'House' ? 'selected' : '' }}>House</option>
                                <option value="Studio" {{ old('pref_property', $client->pref_property) == 'Studio' ? 'selected' : '' }}>Studio</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-semibold text-[#C9956A]">Max Rent Budget (₱)</label>
                            <input type="number" step="0.01" name="max_rent" value="{{ old('max_rent', $client->max_rent) }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Comments / Notes</label>
                        <textarea name="comments" rows="2" class="w-full border-gray-300 rounded-lg bg-gray-50">{{ old('comments', $client->comments) }}</textarea>
                    </div>
                </div>

                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm opacity-80">
                    <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Internal Assignment (Read-Only)</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 text-sm font-semibold text-gray-600">Registering Branch</label>
                            <input type="text" value="{{ $client->branch_no }}" readonly class="w-full border-gray-200 rounded-lg bg-gray-100 text-gray-500">
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-semibold text-gray-600">Assigned Staff</label>
                            <input type="text" value="{{ $client->staff_no }}" readonly class="w-full border-gray-200 rounded-lg bg-gray-100 text-gray-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>