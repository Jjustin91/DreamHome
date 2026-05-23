{{-- resources/views/clients/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Edit Client – ' . $client->first_name)

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-stone-100 flex items-center justify-between">
            <a href="{{ route('clients.index', $client->renter_no) }}"
               class="text-21 text-stone-500 hover:text-stone-800">
                ← Back to Details
            </a>
        </div>

        <form method="POST" action="{{ route('clients.update', $client->renter_no) }}" class="p-6 space-y-5">
            @csrf @method('PUT')

            {{-- Renter No is read-only on edit --}}
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Renter No</label>
                <input type="text" value="{{ $client->renter_no }}" disabled
                    class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm bg-stone-50 text-stone-400 cursor-not-allowed">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">First Name <span class="text-red-400">*</span></label>
                    <input type="text" name="first_name" value="{{ old('first_name', $client->first_name) }}" maxlength="50"
                        class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#c9996b]/40 focus:border-[#c9996b] @error('first_name') border-red-300 @enderror">
                    @error('first_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Last Name <span class="text-red-400">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name', $client->last_name) }}" maxlength="50"
                        class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#c9996b]/40 focus:border-[#c9996b] @error('last_name') border-red-300 @enderror">
                    @error('last_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Address <span class="text-red-400">*</span></label>
                <input type="text" name="address" value="{{ old('address', $client->address) }}" maxlength="250"
                    class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#c9996b]/40 focus:border-[#c9996b] @error('address') border-red-300 @enderror">
                @error('address')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Telephone No <span class="text-red-400">*</span></label>
                <input type="text" name="telephone_no" value="{{ old('telephone_no', $client->telephone_no) }}" maxlength="20"
                    class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#c9996b]/40 focus:border-[#c9996b] @error('telephone_no') border-red-300 @enderror">
                @error('telephone_no')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Property Preference</label>
                    <select name="pref_property"
                        class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#c9996b]/40 focus:border-[#c9996b]">
                        <option value="">-- None --</option>
                        @foreach(['Flat','House','Bungalow','Apartment','Villa'] as $type)
                        <option value="{{ $type }}" {{ old('pref_property', $client->pref_property) == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Maximum Rent</label>
                    <input type="number" name="max_rent" value="{{ old('max_rent', $client->max_rent) }}" step="0.01" min="0"
                        class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#c9996b]/40 focus:border-[#c9996b]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Date Registered</label>
                <input type="date" name="date" value="{{ old('date', $client->date?->format('Y-m-d')) }}"
                    class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#c9996b]/40 focus:border-[#c9996b]">
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Comments <span class="text-red-400">*</span></label>
                <input type="text" name="comments" value="{{ old('comments', $client->comments) }}" maxlength="250"
                    class="w-full px-3 py-2 rounded-lg border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#c9996b]/40 focus:border-[#c9996b] @error('comments') border-red-300 @enderror">
                @error('comments')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('clients.show', $client->renter_no) }}"
                class="w-48 py-2 text-center border border-stone-200 text-stone-600 hover:bg-stone-50 text-sm font-medium rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="w-48 py-2 bg-[#5c4f4a] hover:bg-[#c9996b] text-white text-sm font-medium rounded-lg transition-colors">
                    Update Client
                </button>
            </div>
        </form>
    </div>
</div>
@endsection