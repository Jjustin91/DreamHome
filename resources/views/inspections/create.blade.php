<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Log Property Inspection</h2></x-slot>

    <form method="POST" action="{{ route('inspections.store') }}" class="max-w-3xl mx-auto">
        @csrf
        <div class="flex justify-end gap-3 mb-6">
            <a href="{{ route('inspections.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full">Cancel</a>
            <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-teal-600">Save Inspection</button>
        </div>

        <div class="p-6 space-y-6 bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-700">Property</label>
                    <select name="property_no" class="w-full border-gray-300 rounded-lg bg-gray-50"><option value="">Select Property...</option>@foreach($properties as $p)<option value="{{ $p->property_no }}">{{ $p->property_no }} - {{ $p->street }}</option>@endforeach</select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-700">Inspecting Staff</label>
                    <select name="staff_no" class="w-full border-gray-300 rounded-lg bg-gray-50"><option value="">Select Staff...</option>@foreach($staff as $s)<option value="{{ $s->staff_no }}">{{ $s->first_name }} {{ $s->last_name }}</option>@endforeach</select>
                </div>
            </div>
            
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Inspection Date</label>
                <input type="date" name="inspection_date" class="w-full border-gray-300 rounded-lg bg-gray-50 max-w-[50%]">
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-[#C9956A]">Condition Comments / Maintenance Required</label>
                <textarea name="comments" rows="3" class="w-full border-gray-300 rounded-lg bg-gray-50"></textarea>
            </div>
        </div>
    </form>
</x-app-layout>