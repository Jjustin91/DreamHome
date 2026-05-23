<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Log Advertisement</h2></x-slot>

    <form method="POST" action="{{ route('adverts.store') }}" class="max-w-3xl mx-auto">
        @csrf
        <div class="flex justify-end gap-3 mb-6">
            <a href="{{ route('adverts.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full">Cancel</a>
            <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-[#C9956A]">Log Advert</button>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-lg">
                <ul class="pl-5 list-disc text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="p-6 space-y-6 bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-700">Property to Advertise *</label>
                    <select name="property_no" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-[#C9956A]">
                        <option value="">Select Property...</option>
                        @foreach($properties as $p)<option value="{{ $p->property_no }}">{{ $p->property_no }} - {{ $p->street }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-700">Newspaper *</label>
                    <select name="newspaper_name" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-[#C9956A]">
                        <option value="">Select Newspaper...</option>
                        @foreach($newspapers as $n)<option value="{{ $n->newspaper_name }}">{{ $n->newspaper_name }}</option>@endforeach
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-700">Date Advertised *</label>
                    <input type="date" name="date_advertised" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-[#C9956A]">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold text-teal-600">Total Cost (€) *</label>
                    <input type="number" step="0.01" name="cost" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500">
                </div>
            </div>
        </div>
    </form>
</x-app-layout>