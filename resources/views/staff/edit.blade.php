<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Staff Record</h2>
    </x-slot>

    <form method="POST" action="{{ route('staff.update', $staff->staff_no) }}" class="max-w-5xl mx-auto">
        @csrf @method('PUT')
        
        <div class="flex items-center justify-between mb-6">
            <div class="text-sm text-gray-600">Editing profile for: <strong class="text-[#C9956A]">{{ $staff->staff_no }}</strong></div>
            <div class="flex gap-3">
                <a href="{{ route('staff.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full hover:bg-red-50">Cancel</a>
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-[#C9956A] hover:bg-[#b07d55]">Update Record</button>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg">
                <ul class="pl-5 list-disc text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-6">
            {{-- Left Column: Personal Data --}}
            <div class="flex flex-col gap-6">
                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                    <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Personal Details</h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">First Name *</label><input type="text" name="first_name" value="{{ old('first_name', $staff->first_name) }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]"></div>
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Last Name *</label><input type="text" name="last_name" value="{{ old('last_name', $staff->last_name) }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block mb-1 text-sm font-bold text-gray-700">Sex *</label>
                            <select name="sex" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">
                                <option value="M" {{ old('sex', $staff->sex) == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ old('sex', $staff->sex) == 'F' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Date of Birth *</label><input type="date" name="dob" value="{{ old('dob', $staff->date_of_birth) }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Telephone *</label><input type="text" name="telephone_no" value="{{ old('telephone_no', $staff->telephone_no) }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]"></div>
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">National ID (NIN) *</label><input type="text" name="nin" value="{{ old('nin', $staff->nin) }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]"></div>
                    </div>
                    <div><label class="block mb-1 text-sm font-bold text-gray-700">Address *</label><textarea name="address" rows="2" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">{{ old('address', $staff->address) }}</textarea></div>
                </div>

                <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                    <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Emergency Contact (Next-of-Kin)</h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Full Name *</label><input type="text" name="kin_name" value="{{ old('kin_name', $kin->full_name ?? '') }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]"></div>
                        <div><label class="block mb-1 text-sm font-bold text-gray-700">Relationship *</label><input type="text" name="kin_relationship" value="{{ old('kin_relationship', $kin->relationship ?? '') }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]"></div>
                    </div>
                    <div class="mb-4"><label class="block mb-1 text-sm font-bold text-gray-700">Telephone *</label><input type="text" name="kin_telephone" value="{{ old('kin_telephone', $kin->telephone_no ?? '') }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]"></div>
                    <div><label class="block mb-1 text-sm font-bold text-gray-700">Address *</label><textarea name="kin_address" rows="2" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">{{ old('kin_address', $kin->address ?? '') }}</textarea></div>
                </div>
            </div>

            {{-- Right Column: Work Data --}}
            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl h-fit">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Employment Details</h3>
                
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-bold text-gray-700">Branch Assignment *</label>
                    <select name="branch_no" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">
                        @foreach($branches as $b) 
                            <option value="{{ $b->branch_no }}" {{ old('branch_no', $staff->branch_no) == $b->branch_no ? 'selected' : '' }}>
                                {{ $b->branch_no }} - {{ $b->city }}
                            </option> 
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-bold text-gray-700">Job Title *</label>
                    <select name="job_title" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">
                        <option value="Salesperson" {{ old('job_title', $staff->job_title) == 'Salesperson' ? 'selected' : '' }}>Salesperson / Staff</option>
                        <option value="Supervisor" {{ old('job_title', $staff->job_title) == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                        <option value="Manager" {{ old('job_title', $staff->job_title) == 'Manager' ? 'selected' : '' }}>Manager</option>
                        <option value="Secretary" {{ old('job_title', $staff->job_title) == 'Secretary' ? 'selected' : '' }}>Secretary</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-bold text-[#C9956A]">Annual Salary (₱) *</label>
                    <input type="number" step="0.01" name="salary" value="{{ old('salary', $staff->salary) }}" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">
                </div>

                <div class="pt-4 border-t">
                    <label class="block mb-1 text-sm font-bold text-gray-700">Assigned Supervisor (Optional)</label>
                    <select name="supervisor_no" class="w-full rounded-lg bg-gray-50 border-gray-300 focus:ring-[#C9956A]">
                        <option value="">-- None --</option>
                        @foreach($supervisors as $s) 
                            <option value="{{ $s->staff_no }}" {{ old('supervisor_no', $staff->supervisor_no) == $s->staff_no ? 'selected' : '' }}>
                                {{ $s->first_name }} {{ $s->last_name }} ({{ $s->job_title }})
                            </option> 
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>