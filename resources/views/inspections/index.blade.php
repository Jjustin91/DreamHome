<x-app-layout>
    <div class="py-12 px-6 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold text-[#5C4F4A]">Property Inspections</h1>
                <p class="text-[#C9996B] mt-1 text-sm">Monitor property conditions and staff reports</p>
            </div>
                <button class="bg-[#c9996b] hover:bg-[#b88a5a] text-white px-4 py-2 rounded-lg transition shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Record New Inspection
                </button>
        </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-[#C9996B]">
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-1">Inspections This Month</p>
                    <p class="text-2xl font-bold text-[#5C4F4A]">08</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-[#5F766D]">
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-1">Clear Condition</p>
                    <p class="text-2xl font-bold text-[#5C4F4A]">06</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-red-400">
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-1">Repairs Flagged</p>
                    <p class="text-2xl font-bold text-[#5C4F4A]">02</p>
                </div>
            </div>

            <h2 class="text-lg font-bold text-[#5C4F4A] mb-6 uppercase tracking-wider">Recent Reports</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:border-[#C9996B] transition-all cursor-pointer group">
                    <div class="bg-[#5C4F4A] p-4 flex justify-between items-center">
                        <span class="text-[#EDE9E6] text-xs font-bold font-mono tracking-widest">P-402</span>
                        <span class="bg-[#5F766D] text-white text-[10px] px-2 py-0.5 rounded font-bold uppercase">Clear</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-[#5C4F4A] mb-1">Villa Rosa - Unit 4B</h3>
                        <p class="text-sm text-gray-400 mb-4">Inspected by: <span class="text-[#C9996B] font-semibold">S-102</span></p>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                            <span class="text-[10px] text-gray-400 font-bold uppercase">May 12, 2026</span>
                            <span class="text-[#C9996B] text-xs font-bold group-hover:underline italic">Click to view notes</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:border-[#C9996B] transition-all cursor-pointer group">
                    <div class="bg-[#5C4F4A] p-4 flex justify-between items-center">
                        <span class="text-[#EDE9E6] text-xs font-bold font-mono tracking-widest">P-105</span>
                        <span class="bg-red-100 text-red-600 text-[10px] px-2 py-0.5 rounded font-bold uppercase">Repair Needed</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-[#5C4F4A] mb-1">Pinecrest Heights - R10</h3>
                        <p class="text-sm text-gray-400 mb-4">Inspected by: <span class="text-[#C9996B] font-semibold">S-109</span></p>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                            <span class="text-[10px] text-gray-400 font-bold uppercase">May 08, 2026</span>
                            <span class="text-[#C9996B] text-xs font-bold group-hover:underline italic">Click to view notes</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:border-[#C9996B] transition-all cursor-pointer group opacity-90">
                    <div class="bg-[#5C4F4A] p-4 flex justify-between items-center">
                        <span class="text-[#EDE9E6] text-xs font-bold font-mono tracking-widest">P-221</span>
                        <span class="bg-[#5F766D] text-white text-[10px] px-2 py-0.5 rounded font-bold uppercase">Clear</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-[#5C4F4A] mb-1">Oakwood Estates - H1</h3>
                        <p class="text-sm text-gray-400 mb-4">Inspected by: <span class="text-[#C9996B] font-semibold">S-102</span></p>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                            <span class="text-[10px] text-gray-400 font-bold uppercase">May 05, 2026</span>
                            <span class="text-[#C9996B] text-xs font-bold group-hover:underline italic">Click to view notes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>