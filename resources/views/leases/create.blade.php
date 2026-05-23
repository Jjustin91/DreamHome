<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Draft Lease Agreement</h2>
    </x-slot>

    <form method="POST" action="{{ route('leases.store') }}" class="max-w-5xl mx-auto">
        @csrf
        <div class="flex items-center justify-between mb-6">
            <div class="text-sm text-gray-600">Draft a legally binding lease agreement (3 to 12 months).</div>
            <div class="flex gap-3">
                <a href="{{ route('leases.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full hover:bg-red-50">Cancel</a>
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-[#C9956A] hover:bg-[#b07d55]">Draft Agreement</button>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-lg">
                <ul class="pl-5 list-disc text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-6">
            <div class="flex flex-col gap-6">
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                    <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Parties & Property</h3>
                    
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-bold text-gray-700">Property *</label>
                        <select name="property_no" class="w-full rounded-lg bg-gray-50 border-gray-300">
                            @foreach($properties as $p) <option value="{{ $p->property_no }}">{{ $p->property_no }} - {{ $p->street }}, {{ $p->city }}</option> @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-bold text-gray-700">Client / Renter *</label>
                        <select name="renter_no" class="w-full rounded-lg bg-gray-50 border-gray-300">
                            @foreach($clients as $c) <option value="{{ $c->renter_no }}">{{ $c->renter_no }} - {{ $c->first_name }} {{ $c->last_name }}</option> @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-bold text-gray-700">Authorizing Staff *</label>
                        <select name="staff_no" class="w-full rounded-lg bg-gray-50 border-gray-300">
                            @foreach($staff as $s) <option value="{{ $s->staff_no }}">{{ $s->first_name }} {{ $s->last_name }} ({{ $s->job_title }})</option> @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl h-fit">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Terms & Finances</h3>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div><label class="block mb-1 text-sm font-bold text-gray-700">Rent Start Date *</label><input type="date" name="rent_start" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                    <div><label class="block mb-1 text-sm font-bold text-gray-700">Duration (3 - 12 Mos) *</label><input type="number" name="duration_months" min="3" max="12" value="12" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-1 text-sm font-bold text-[#C9956A]">Monthly Rent (₱) *</label>
                        <input type="number" step="0.01" name="monthly_rent" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-bold text-[#C9956A]">Deposit Required (₱) *</label>
                        <input type="number" step="0.01" name="deposit_amount" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-sm font-bold text-gray-700">Payment Method *</label>
                        <select name="payment_method" class="w-full rounded-lg bg-gray-50 border-gray-300">
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-bold text-gray-700">Deposit Paid? *</label>
                        <select name="deposit_paid" class="w-full rounded-lg bg-gray-50 border-gray-300">
                            <option value="1">Yes - Paid in Full</option>
                            <option value="0">No - Pending</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>