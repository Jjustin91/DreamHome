@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">Register New Staff</h1>
        <p class="text-[10px] font-bold text-[#C9956A] uppercase tracking-[0.2em] mt-1">DreamHome Human Resources</p>
    </div>

    <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10 space-y-8">
        @csrf

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center gap-3 animate-fade-in">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                <p class="text-xs font-bold text-green-600 uppercase tracking-widest">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Error Notification (Shows the DB Reason) --}}
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-center gap-3">
                <div class="w-2 h-2 bg-red-400 rounded-full"></div>
                <p class="text-xs font-bold text-red-600 uppercase tracking-widest">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Validation Errors (e.g., Image too big) --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-orange-50 border border-orange-100 rounded-2xl">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-[10px] font-bold text-orange-600 uppercase tracking-tighter">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- PHOTO SECTION --}}
        <div class="flex flex-col items-center space-y-4">
            <div class="relative w-36 h-36 rounded-full overflow-hidden border-4 border-gray-50 bg-[#F3F1ED] flex items-center justify-center shadow-inner">
                <img id="preview-image" class="hidden w-full h-full object-cover">
                <svg id="placeholder" class="w-14 h-14 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            </div>
            <label class="cursor-pointer px-5 py-2.5 border border-gray-100 rounded-xl text-xs font-bold bg-white text-gray-600 hover:bg-gray-50 transition shadow-sm">
                Upload Photo
                <input type="file" name="image" class="hidden" onchange="previewFile(this)">
            </label>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- STAFF INFO --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Job Title *</label>
                <select name="job_title" id="job_title" onchange="toggleJobFields()" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none focus:ring-2 focus:ring-[#C9956A] outline-none font-bold text-gray-700">
                    <option value="">Select Job Title</option>
                    <option value="Manager">Manager</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Salesperson">Salesperson</option>
                    <option value="Assistant">Assistant</option>
                </select>
            </div>

            {{-- BRANCH ASSIGNMENT (Critical Addition) --}}
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Assign to Branch *</label>
                <select name="branch_no" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none focus:ring-2 focus:ring-[#C9956A] outline-none font-bold text-gray-700">
                    <option value="" disabled {{ !$preSelectedBranch ? 'selected' : '' }}>Select Branch</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->branch_no }}" 
                            {{ (old('branch_no') == $branch->branch_no || ($preSelectedBranch ?? '') == $branch->branch_no) ? 'selected' : '' }}>
                            {{ $branch->branch_no }} - {{ $branch->city }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">First Name *</label>
                <input type="text" name="first_name" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Last Name *</label>
                <input type="text" name="last_name" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Sex *</label>
                <select name="sex" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Date of Birth *</label>
                <input type="date" name="date_of_birth" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
            </div>
            
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Date Joined *</label>
                <input type="date" name="date_joined" value="{{ old('date_joined', date('Y-m-d')) }}" required 
                    class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700 focus:ring-2 focus:ring-[#C9956A]">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">National Insurance No (NIN) *</label>
                <input type="text" name="nin" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Supervisor ID (Optional)</label>
                <input type="text" name="supervisor_no" placeholder="e.g. S001" class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Annual Salary *</label>
                <input type="number" name="salary" step="0.01" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Telephone *</label>
                <input type="text" name="telephone_no" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
            </div>

            <div class="col-span-full">
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Home Address *</label>
                <input type="text" name="address" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold text-gray-700">
            </div>
        </div>

        {{-- DYNAMIC MANAGER FIELDS --}}
        <div id="manager-fields" class="hidden grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-gray-50">
            <div>
                <label class="block text-[10px] font-bold text-[#C9956A] uppercase tracking-widest mb-3">Car Allowance</label>
                <input type="number" step="0.01" name="car_allowance" class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-[#C9956A] uppercase tracking-widest mb-3">Bonus Payment</label>
                <input type="number" step="0.01" name="bonus_payment" class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold">
            </div>
        </div>

        {{-- DYNAMIC SECRETARY FIELDS --}}
        <div id="secretary-fields" class="hidden pt-8 border-t border-gray-50">
            <label class="block text-[10px] font-bold text-[#C9956A] uppercase tracking-widest mb-3">Typing Speed (WPM)</label>
            <input type="number" name="typing_speed" placeholder="e.g. 60" class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold">
        </div>

        {{-- NEXT OF KIN SECTION --}}
        <div class="pt-10 border-t border-gray-100">
            <div class="flex items-center gap-3 mb-6">
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Next of Kin Information</h3>
                <div class="h-px flex-1 bg-gray-50"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="col-span-full">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Full Name *</label>
                    <input type="text" name="nok_full_name" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold">
                </div>
                <div class="col-span-full">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Home Address *</label>
                    <input type="text" name="nok_address" placeholder="Street, City, Postcode" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Relationship *</label>
                    <input type="text" name="nok_relationship" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Telephone *</label>
                    <input type="text" name="nok_telephone_no" required class="w-full px-5 py-4 rounded-2xl bg-[#F3F1ED] border-none font-bold">
                </div>
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="pt-10 flex justify-end gap-6 border-t border-gray-50">
            <a href="{{ route('admin.staff.index') }}" class="px-6 py-4 font-bold text-gray-400 text-xs uppercase tracking-widest">Discard</a>
            <button type="submit" class="px-12 py-4 bg-[#5C5047] text-white rounded-2xl font-bold text-xs uppercase tracking-[0.2em] shadow-2xl hover:bg-[#4E443C] transition transform hover:-translate-y-1">
                Finalize Registration
            </button>
        </div>
    </form>
</div>

<script>
    function previewFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('preview-image');
                img.src = e.target.result;
                img.classList.remove('hidden');
                document.getElementById('placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleJobFields() {
        const jobTitle = document.getElementById('job_title').value;
        const managerDiv = document.getElementById('manager-fields');
        const secretaryDiv = document.getElementById('secretary-fields');

        managerDiv.classList.add('hidden');
        secretaryDiv.classList.add('hidden');

        if (jobTitle === 'Manager') {
            managerDiv.classList.remove('hidden');
        } else if (jobTitle === 'Secretary') {
            secretaryDiv.classList.remove('hidden');
        }
    }
</script>
@endsection