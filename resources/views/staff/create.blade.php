<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Hire New Staff</h2>
    </x-slot>

    <form method="POST" action="{{ route('staff.store') }}" class="max-w-5xl mx-auto">
        @csrf
        <div class="flex items-center justify-between mb-6">
            <div class="text-sm text-gray-600">Register employee and next-of-kin details.</div>
            <div class="flex gap-3">
                <a href="{{ route('staff.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full">Cancel</a>
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-teal-600">Save Record</button>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-lg">
                <ul class="pl-5 list-disc text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-6">
            {{-- Left: Employee Data --}}
            <div class="flex flex-col gap-6">
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                    <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Personal Details</h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">First Name *</label><input type="text" name="first_name" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Last Name *</label><input type="text" name="last_name" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block mb-1 text-sm font-bold text-gray-700">Sex *</label>
                            <select name="sex" class="w-full rounded-lg bg-gray-50 border-gray-300"><option value="M">Male</option><option value="F">Female</option></select>
                        </div>
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Date of Birth *</label><input type="date" name="dob" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Telephone *</label><input type="text" name="telephone_no" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">National ID (NIN) *</label><input type="text" name="nin" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                    </div>
                    <div><label class="block mb-1 text-sm font-bold text-gray-700">Address *</label><textarea name="address" rows="2" class="w-full rounded-lg bg-gray-50 border-gray-300"></textarea></div>
                </div>

                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                    <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Emergency Contact (Next-of-Kin)</h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Full Name *</label><input type="text" name="kin_name" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Relationship *</label><input type="text" name="kin_relationship" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                    </div>
                    <div class="mb-4"><label class="block mb-1 text-sm font-bold text-gray-700">Telephone *</label><input type="text" name="kin_telephone" class="w-full rounded-lg bg-gray-50 border-gray-300"></div>
                    <div><label class="block mb-1 text-sm font-bold text-gray-700">Address *</label><textarea name="kin_address" rows="2" class="w-full rounded-lg bg-gray-50 border-gray-300"></textarea></div>
                </div>
            </div>

            {{-- Right: Job Data --}}
            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl h-fit">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Employment Details</h3>
                
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-bold text-gray-700">Branch Assignment *</label>
                    <select name="branch_no" class="w-full rounded-lg bg-gray-50 border-gray-300">
                        @foreach($branches as $b) <option value="{{ $b->branch_no }}">{{ $b->branch_no }} - {{ $b->city }}</option> @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-bold text-gray-700">Job Title *</label>
                    <select name="job_title" class="w-full rounded-lg bg-gray-50 border-gray-300">
                        <option value="Salesperson">Salesperson / Staff</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Secretary">Secretary</option>

                        {{-- ONLY Super Admins can see this option! --}}
                        @role('Super Admin')
                            <option value="Manager">Manager</option>
                        @endrole
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-bold text-[#C9956A]">Annual Salary (€) *</label>
                    <input type="number" name="salary" class="w-full rounded-lg bg-gray-50 border-gray-300">
                </div>

                <div class="pt-4 border-t">
                    <label class="block mb-1 text-sm font-bold text-gray-700">Assign to Supervisor (Optional)</label>
                    <select name="supervisor_no" class="w-full rounded-lg bg-gray-50 border-gray-300">
                        <option value="">-- None --</option>
                        @foreach($supervisors as $s) <option value="{{ $s->staff_no }}">{{ $s->first_name }} {{ $s->last_name }} ({{ $s->job_title }})</option> @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>