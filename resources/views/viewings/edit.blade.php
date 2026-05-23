<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Log Viewing Feedback</h2></x-slot>

    <form method="POST" action="{{ route('viewings.update', $viewing->viewing_no) }}" class="max-w-2xl mx-auto">
        @csrf @method('PUT')
        <div class="flex justify-end gap-3 mb-6">
            <a href="{{ route('viewings.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full">Cancel</a>
            <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-[#C9956A]">Save Feedback</button>
        </div>

        <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
            <label class="block mb-2 text-sm font-bold text-[#C9956A]">Client Feedback / Notes</label>
            <textarea name="feedback" rows="4" class="w-full border-gray-300 rounded-lg bg-gray-50">{{ $viewing->feedback }}</textarea>
        </div>
    </form>
</x-app-layout>