<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Owner Profile
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('owners.update', $owner->owner_no) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="flex items-center justify-between mb-6">
            <div class="text-sm text-gray-600">Editing Record: <strong style="color:#C9956A">{{ $owner->owner_no }}</strong></div>
            <div class="flex gap-3">
                <a href="{{ route('owners.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full hover:bg-red-50">Cancel</a>
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-[#C9956A] hover:bg-[#b07d55]">Update Profile</button>
            </div>
        </div>

        <div class="max-w-2xl mx-auto p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="mb-6 flex flex-col items-center">
                <div class="w-32 h-32 mb-4 overflow-hidden rounded-full bg-[#EEEAE4] border-4 border-white shadow-md">
                    @if($owner->image_path)
                        <img src="{{ asset('storage/' . $owner->image_path) }}" class="object-cover w-full h-full">
                    @endif
                </div>
                <input type="file" name="image_path" class="text-sm text-gray-500">
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Owner ID</label>
                    <input type="text" value="{{ $owner->owner_no }}" readonly class="w-full border-gray-300 rounded-lg bg-gray-100 text-gray-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', $owner->name) }}" class="w-full border-gray-300 rounded-lg bg-gray-50">
                    @error('name')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Telephone *</label>
                    <input type="text" name="telephone_no" value="{{ old('telephone_no', $owner->telephone_no) }}" class="w-full border-gray-300 rounded-lg bg-gray-50">
                    @error('telephone_no')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-600">Address *</label>
                    <textarea name="address" rows="3" class="w-full border-gray-300 rounded-lg bg-gray-50">{{ old('address', $owner->address) }}</textarea>
                    @error('address')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                </div>
            </div>

        </div>
    </form>
</x-app-layout>