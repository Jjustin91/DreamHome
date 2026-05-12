@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.staff.update', $staff->staff_no) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-8">
        @csrf
        @method('PUT')
        @if ($errors->any())
            <div class="p-4 mb-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- PHOTO SECTION --}}
        <div class="flex flex-col items-center space-y-4">
            <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-gray-50 bg-[#F3F1ED] flex items-center justify-center">
                @if($staff->image_path)
                    <img id="preview-image" src="{{ asset('storage/' . $staff->image_path) }}" class="w-full h-full object-cover">
                @else
                    <svg id="placeholder" class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    <img id="preview-image" class="hidden w-full h-full object-cover">
                @endif
            </div>
            <label class="cursor-pointer px-4 py-2 border rounded-xl text-sm font-bold bg-white shadow-sm">
                Change Photo
                <input type="file" name="image" class="hidden" onchange="previewFile(this)">
            </label>
        </div>

        {{-- STAFF PRIMARY INFO --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Staff ID</label>
                <input type="text" value="{{ $staff->staff_no }}" disabled class="w-full px-4 py-3 rounded-xl bg-gray-50 border-none font-medium text-gray-400">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Job Title *</label>
                <select name="job_title" id="job_title" onchange="toggleJobFields()" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none focus:ring-2 focus:ring-[#C9956A] outline-none font-medium">
                    <option value="Manager" {{ $staff->job_title == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Secretary" {{ $staff->job_title == 'Secretary' ? 'selected' : '' }}>Secretary</option>
                    <option value="Supervisor" {{ $staff->job_title == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                    <option value="Salesperson" {{ $staff->job_title == 'Salesperson' ? 'selected' : '' }}>Salesperson</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">First Name *</label>
                <input type="text" name="first_name" value="{{ $staff->first_name }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Last Name *</label>
                <input type="text" name="last_name" value="{{ $staff->last_name }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Sex *</label>
                <select name="sex" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
                    <option value="M" {{ $staff->sex == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ $staff->sex == 'F' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Date of Birth *</label>
                <input type="date" name="date_of_birth" value="{{ $staff->date_of_birth }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">NIN *</label>
                <input type="text" name="nin" value="{{ $staff->nin }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Supervisor ID</label>
                <input type="text" name="supervisor_no" value="{{ $staff->supervisor_no }}" class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Salary *</label>
                <input type="number" step="0.01" name="salary" value="{{ $staff->salary }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Branch *</label>
                <select name="branch_no" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->branch_no }}" {{ $staff->branch_no == $branch->branch_no ? 'selected' : '' }}>
                            {{ $branch->branch_no }} - {{ $branch->street }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-full">
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Home Address *</label>
                <input type="text" name="address" value="{{ $staff->address }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Telephone *</label>
                <input type="text" name="telephone_no" value="{{ $staff->telephone_no }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none font-medium">
            </div>
        </div>

        {{-- DYNAMIC FIELDS --}}
        <div id="manager-fields" class="{{ $staff->job_title == 'Manager' ? 'grid' : 'hidden' }} grid-cols-2 gap-6 pt-6 border-t border-gray-100">
            <div>
                <label class="block text-[11px] font-bold text-[#C9956A] uppercase mb-2">Car Allowance</label>
                <input type="number" step="0.01" name="car_allowance" value="{{ $staff->car_allowance }}" class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-[#C9956A] uppercase mb-2">Bonus Payment</label>
                <input type="number" step="0.01" name="bonus_payment" value="{{ $staff->bonus_payment }}" class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none">
            </div>
        </div>

        <div id="secretary-fields" class="{{ $staff->job_title == 'Secretary' ? 'block' : 'hidden' }} pt-6 border-t border-gray-100">
            <label class="block text-[11px] font-bold text-[#C9956A] uppercase mb-2">Typing Speed (WPM)</label>
            <input type="number" name="typing_speed" value="{{ $staff->typing_speed }}" class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none">
        </div>

        {{-- NEXT OF KIN SECTION --}}
        <div class="pt-8 border-t border-gray-100">
            <h3 class="text-sm font-bold text-gray-950 uppercase tracking-widest mb-4">Next of Kin Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-full">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Full Name *</label>
                    <input type="text" name="nok_full_name" value="{{ $nok->full_name ?? '' }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none">
                </div>
                <div class="col-span-full">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Home Address *</label>
                    <input type="text" name="nok_address" value="{{ $nok->address ?? '' }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Relationship *</label>
                    <input type="text" name="nok_relationship" value="{{ $nok->relationship ?? '' }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Telephone *</label>
                    <input type="text" name="nok_telephone_no" value="{{ $nok->telephone_no ?? '' }}" required class="w-full px-4 py-3 rounded-xl bg-[#F3F1ED] border-none">
                </div>
            </div>
        </div>

        <div class="pt-8 flex justify-end gap-4 border-t">
            <a href="{{ route('admin.staff.index') }}" class="px-6 py-3 font-bold text-gray-400">Cancel</a>
            <button type="submit" class="px-10 py-3 bg-[#5C5047] text-white rounded-2xl font-bold hover:bg-[#4E443C] transition shadow-lg">
                Update Staff Member
            </button>
        </div>
    </form>
</div>

<script>
    function previewFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('preview-image').classList.remove('hidden');
                if(document.getElementById('placeholder')) document.getElementById('placeholder').classList.add('hidden');
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
            managerDiv.classList.add('grid');
        } else if (jobTitle === 'Secretary') {
            secretaryDiv.classList.remove('hidden');
        }
    }
</script>
@endsection