<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Staff Profile</h2>
    </x-slot>

    <div class="mb-6"><a href="{{ route('staff.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">← Back to Staff Directory</a></div>

    <div class="grid grid-cols-3 gap-6">
        {{-- Profile --}}
        <div class="flex flex-col items-center col-span-1 p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="flex items-center justify-center w-24 h-24 mb-4 text-3xl font-bold text-white rounded-full bg-[#5C5047] shadow-md">
                {{ strtoupper(substr($staff->first_name, 0, 1)) }}{{ strtoupper(substr($staff->last_name, 0, 1)) }}
            </div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $staff->first_name }} {{ $staff->last_name }}</h3>
            <div class="mt-1 text-sm font-bold text-[#C9956A] uppercase">{{ $staff->job_title }} | {{ $staff->staff_no }}</div>
            
            <div class="w-full mt-6 space-y-4 text-sm">
                <div><strong class="block text-xs text-gray-400 uppercase">Telephone</strong> <span class="font-semibold text-gray-700">{{ $staff->telephone_no }}</span></div>
                <div><strong class="block text-xs text-gray-400 uppercase">National ID</strong> <span class="text-gray-700">{{ $staff->nin }}</span></div>
                <div><strong class="block text-xs text-gray-400 uppercase">Address</strong> <span class="text-gray-700">{{ $staff->address }}</span></div>
            </div>
        </div>

        <div class="flex flex-col col-span-2 gap-6">
            {{-- Work Data --}}
            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Employment Profile</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="p-4 border border-gray-100 rounded-lg bg-gray-50">
                        <div class="tracking-wide text-gray-400 uppercase text-xs font-bold">Assigned Branch</div>
                        <div class="mt-1 text-xl font-bold text-gray-800">{{ $branch->branch_no }} - {{ $branch->city }}</div>
                    </div>
                    <div class="p-4 border rounded-lg bg-teal-50 border-teal-100">
                        <div class="tracking-wide text-teal-600 uppercase text-xs font-bold">Annual Salary</div>
                        <div class="mt-1 text-xl font-bold text-teal-800">€{{ number_format($staff->salary, 2) }}</div>
                    </div>
                </div>
            </div>

            {{-- Next of Kin --}}
            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Next-of-Kin (Emergency Contact)</h3>
                @if($kin)
                    <div class="grid grid-cols-2 gap-4">
                        <div><span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Name</span><span class="font-semibold text-gray-700">{{ $kin->full_name }}</span></div>
                        <div><span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Relationship</span><span class="font-semibold text-gray-700">{{ $kin->relationship }}</span></div>
                        <div><span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Telephone</span><span class="font-semibold text-[#C9956A]">{{ $kin->telephone_no }}</span></div>
                        <div class="col-span-2"><span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Address</span><span class="text-gray-700">{{ $kin->address }}</span></div>
                    </div>
                @else
                    <p class="italic text-gray-500">No emergency contact on file.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>