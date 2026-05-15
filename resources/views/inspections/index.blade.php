<x-app-layout>
    <div x-data="{ 
        isOpen: false, 
        isFormOpen: false,
        search: '',
        selected: { 
            id: '', property: '', staff: '', date: '', status: '', comments: '' 
        } 
    }" class="bg-[#EDE9E6] min-h-screen py-8 px-6">
        
        <div class="max-w-7xl mx-auto">
            
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                     class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold rounded shadow-sm flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 text-xl">&times;</button>
                </div>
            @endif

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-[#5C4F4A]">Property Inspections</h1>
                    <p class="text-[#C9996B] font-medium text-sm text-opacity-80">Monitor property conditions and staff reports</p>
                </div>
                <button @click="isFormOpen = true" class="bg-[#5F766D] hover:bg-[#4A5D55] text-white px-5 py-2.5 rounded-lg transition shadow-md flex items-center gap-2 font-semibold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Record New Inspection
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-xl border-b-4 border-[#C9996B] shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Total Inspections</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">
                        {{ str_pad($totalInspections, 2, '0', STR_PAD_LEFT) }} 
                        <span class="text-sm font-normal text-gray-300 italic">Logs</span>
                    </p>
                </div>
                <div class="bg-white p-6 rounded-xl border-b-4 border-red-400 shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Inspections This Month</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">
                        {{ str_pad($inspectionsThisMonth, 2, '0', STR_PAD_LEFT) }} 
                        <span class="text-sm font-normal text-gray-300 italic">Reports</span>
                    </p>
                </div>
                <div class="bg-white p-6 rounded-xl border-b-4 border-[#5C4F4A] shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Recent Property Inspected</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">
                        {{ $recentInspection ? $recentInspection->property_no : 'N/A' }}
                        <span class="text-sm font-normal text-gray-300 italic">ID</span>
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-sm font-bold text-[#5C4F4A] uppercase tracking-widest">Recent Inspection Reports</h2>
                <div class="relative w-full max-w-md">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="h-4 w-4 text-[#C9996B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input x-model="search" type="text" placeholder="Search by address, city, or property ID..." 
                        class="block w-full pl-10 pr-3 py-2 border-transparent bg-white rounded-lg text-sm placeholder-gray-300 focus:ring-0 focus:border-[#C9996B] transition shadow-sm">
                </div>
            </div>

            <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($inspections as $inspection)
                    @php
                        $needsRepair = str_contains(strtolower($inspection->comments), 'repair') || 
                                       str_contains(strtolower($inspection->comments), 'damage') ||
                                       str_contains(strtolower($inspection->comments), 'urgent');
                        
                        $searchContent = strtolower($inspection->property_no . ' ' . ($inspection->property->street ?? '') . ' ' . ($inspection->property->city ?? ''));
                    @endphp

                    <div x-show="search === '' || '{{ $searchContent }}'.includes(search.toLowerCase())"
                        x-transition
                        @click="isOpen = true; selected = { 
                            id: '{{ $inspection->property_no }}', 
                            property: '{{ $inspection->property->street ?? 'Property ' . $inspection->property_no }}', 
                            staff: '{{ $inspection->staff_no }}', 
                            date: '{{ \Carbon\Carbon::parse($inspection->inspection_date)->format('M d, Y') }}', 
                            status: '{{ $needsRepair ? 'REPAIR NEEDED' : 'CLEAR' }}', 
                            comments: '{{ addslashes($inspection->comments) }}' 
                        }" 
                        class="bg-white p-6 rounded-xl shadow-sm border border-transparent border-l-[6px] {{ $needsRepair ? 'border-l-red-400' : 'border-l-[#5F766D]' }} hover:border-[#C9996B] transition-all cursor-pointer group mb-4">
                        
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-[10px] font-bold font-mono tracking-widest text-[#5C4F4A] bg-[#EDE9E6] px-2 py-0.5 rounded uppercase">{{ $inspection->property_no }}</span>
                                    <span class="text-[10px] font-extrabold {{ $needsRepair ? 'text-red-400' : 'text-[#5F766D]' }} uppercase tracking-widest">
                                        {{ $needsRepair ? 'Repair Needed' : 'Clear' }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-[#5C4F4A]">
                                    {{ $inspection->property ? $inspection->property->street . ', ' . $inspection->property->city : 'Unit ' . $inspection->property_no }}
                                </h3>
                                <p class="text-sm text-gray-400 italic">Inspected by staff: <span class="text-[#C9996B] font-semibold">{{ $inspection->staff_no }}</span></p>
                            </div>
                            <div class="text-right text-nowrap pl-4">
                                <p class="text-[10px] font-bold text-gray-300 uppercase mb-4 tracking-widest">{{ $inspection->inspection_date }}</p>
                                <span class="text-[#C9996B] text-[10px] font-bold group-hover:underline italic">Click to view report →</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div x-show="isOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="isOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>
            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden z-10 relative border-t-8 border-[#5C4F4A]">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span x-text="selected.status" 
                                  :class="selected.status === 'REPAIR NEEDED' ? 'bg-red-50 text-red-400' : 'bg-[#5F766D]/10 text-[#5F766D]'" 
                                  class="text-[10px] font-extrabold px-2 py-1 rounded uppercase tracking-widest"></span>
                            
                            <h2 x-text="selected.property" class="text-2xl font-black text-[#5C4F4A] mt-4"></h2>
                            <p class="flex items-center gap-2 text-xs font-mono font-bold text-gray-400 mt-1 uppercase italic">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                <span x-text="'Record ID: ' + selected.id"></span>
                            </p>
                        </div>
                        <button @click="isOpen = false" class="text-gray-300 hover:text-red-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-[#F9F8F7] p-4 rounded-xl border-l-4 border-[#C9996B]">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Inspection Date</p>
                            <div class="flex items-center gap-2 text-sm font-black text-[#5C4F4A]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#C9996B]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span x-text="selected.date"></span>
                            </div>
                        </div>
                        <div class="bg-[#F9F8F7] p-4 rounded-xl border-l-4 border-[#5F766D]">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Inspector</p>
                            <div class="flex items-center gap-2 text-sm font-black text-[#5C4F4A]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#5F766D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                <span x-text="'Staff ' + selected.staff"></span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Findings & Comments</p>
                        <div class="bg-[#F9F8F7] border-l-4 border-[#C9996B] p-5 italic text-[#5C4F4A] leading-relaxed rounded-r-lg shadow-inner text-sm min-h-[100px]">
                            "<span x-text="selected.comments"></span>"
                        </div>
                    </div>

                    <button @click="isOpen = false" class="mt-10 w-full bg-[#5C4F4A] text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-black transition shadow-lg">Close Report</button>
                </div>
            </div>
        </div>

        <div x-show="isFormOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="isFormOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>
            <div class="bg-white w-full max-w-xl rounded-2xl shadow-2xl overflow-hidden z-10 relative border-l-[12px] border-[#C9996B]">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-[#5C4F4A]">Record Property Inspection</h2>
                            <p class="text-xs text-[#C9996B] font-medium uppercase tracking-widest">Condition & Compliance Report</p>
                        </div>
                        <button @click="isFormOpen = false" class="text-gray-300 hover:text-red-400 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>

                    <form action="{{ route('inspections.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Target Property</label>
                                <select name="property_no" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5 transition">
                                    <option value="">Select Property...</option>
                                    @foreach($properties as $property)
                                        <option value="{{ $property->property_no }}" {{ old('property_no') == $property->property_no ? 'selected' : '' }}>
                                            {{ $property->street ?? $property->property_no }} ({{ $property->property_no }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Assigned Staff</label>
                                <select name="staff_no" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5 transition">
                                    <option value="">Select Staff...</option>
                                    @foreach($staffMembers as $staff)
                                        <option value="{{ $staff->staff_no }}" {{ old('staff_no') == $staff->staff_no ? 'selected' : '' }}>
                                            {{ $staff->staff_no }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Inspection Date</label>
                            <input type="date" name="inspection_date" value="{{ old('inspection_date') }}" required 
                                class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5 @error('inspection_date') border-red-500 @enderror">
                            @error('inspection_date')
                                <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Inspector's Findings & Comments</label>
                            <textarea name="comments" rows="4" placeholder="Detail any damages or maintenance requirements..." class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] placeholder-gray-300 px-4 py-2.5 transition">{{ old('comments') }}</textarea>
                        </div>
                        <div class="flex gap-3 pt-4">
                            <button @click="isFormOpen = false" type="button" class="flex-grow bg-white border border-gray-200 text-[#5C4F4A] py-3 rounded-xl font-bold uppercase tracking-widest text-[10px] hover:bg-gray-50 transition">Cancel</button>
                            <button type="submit" class="flex-grow bg-[#C9996B] text-white py-3 rounded-xl font-bold uppercase tracking-widest text-[10px] hover:bg-[#5F766D] shadow-lg transition">Finalize Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #C9996B; border-radius: 10px; }
</style>