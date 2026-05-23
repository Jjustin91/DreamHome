<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Owners Information
        </h2>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <form action="{{ route('owners.index') }}" method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search owner name..." class="w-72 border-gray-300 rounded-lg">
            <button type="submit" class="px-4 py-2 text-white rounded-lg bg-[#C9956A] font-semibold">Search</button>
        </form>

        @hasanyrole('Super Admin|Manager|Supervisor')
            <a href="{{ route('owners.create') }}" class="px-5 py-2 font-semibold text-white uppercase rounded-lg bg-teal-500 hover:bg-teal-600">
               + ADD OWNER
            </a>
        @endhasanyrole
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-4">
        @foreach($owners as $owner)
        <div class="p-6 text-center bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 overflow-hidden rounded-full bg-[#EEEAE4] border-2 border-[#C9956A]">
                @if(isset($owner->image_path) && $owner->image_path)
                    <img src="{{ asset('storage/' . $owner->image_path) }}" class="object-cover w-full h-full">
                @else
                    <span class="text-2xl font-bold text-gray-400">{{ substr($owner->name, 0, 1) }}</span>
                @endif
            </div>

            <div class="text-xs font-bold text-[#C9956A] uppercase">{{ $owner->owner_no }}</div>
            <h3 class="mt-1 mb-2 text-lg font-bold text-gray-800">{{ $owner->name }}</h3>
            <p class="text-sm text-gray-500 mb-4">{{ $owner->telephone_no }}</p>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('owners.show', $owner->owner_no) }}" class="text-xs font-bold text-[#4F7C72]">VIEW</a>
                
                @hasanyrole('Super Admin|Manager|Supervisor')
                    <a href="{{ route('owners.edit', $owner->owner_no) }}" class="text-xs font-bold text-[#C9956A]">EDIT</a>
                @endhasanyrole

                @hasanyrole('Super Admin|Manager|Supervisor')
                    <form action="{{ route('owners.destroy', $owner->owner_no) }}" method="POST" onsubmit="return confirm('Remove this owner?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs font-bold text-red-600">DELETE</button>
                    </form>
                @endhasanyrole
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">{{ $owners->appends(request()->query())->links() }}</div>
</x-app-layout>