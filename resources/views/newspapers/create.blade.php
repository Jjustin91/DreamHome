<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold leading-tight text-gray-800">Add Press Contact</h2></x-slot>

    <form method="POST" action="{{ route('newspapers.store') }}" class="max-w-2xl mx-auto">
        @csrf
        <div class="flex justify-end gap-3 mb-6">
            <a href="{{ route('newspapers.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full">Cancel</a>
            <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-teal-600">Save Contact</button>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-lg">
                <ul class="pl-5 list-disc text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="p-6 space-y-6 bg-white border border-gray-200 shadow-sm rounded-xl">
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Newspaper Name *</label>
                <input type="text" name="newspaper_name" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500" placeholder="e.g. The Glasgow Herald">
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-700">Contact Person *</label>
                    <input type="text" name="contact_name" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold text-gray-700">Telephone *</label>
                    <input type="text" name="telephone_no" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500">
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-gray-700">Address *</label>
                <textarea name="address" rows="2" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500"></textarea>
            </div>
        </div>
    </form>
</x-app-layout>