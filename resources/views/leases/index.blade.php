<x-app-layout>
    <div class="bg-[#EDE9E6] min-h-screen py-8 px-6">
        <div class="max-w-5xl mx-auto">
            
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-[#5C4F4A]">Lease Agreements</h1>
                    <p class="text-[#C9996B] font-medium text-sm">Manage rental contracts and payment terms</p>
                </div>
                <button class="bg-[#C9996B] hover:bg-[#B88A5A] text-white px-5 py-2.5 rounded-lg transition shadow-md flex items-center gap-2 font-semibold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Lease
                </button>
            </div>

            <div class="space-y-4">
                
                <div class="bg-white rounded-xl shadow-sm border border-transparent hover:border-[#C9996B] transition-all cursor-pointer group overflow-hidden">
                    <div class="flex flex-col md:flex-row items-stretch">
                        
                        <div class="w-2 bg-[#5F766D]"></div>

                        <div class="p-6 flex-grow grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                            
                            <div class="col-span-1">
                                <span class="text-[10px] font-mono font-bold text-gray-400">LS101</span>
                                <h3 class="text-lg font-bold text-[#5C4F4A] leading-tight">PG21 - 18 Dale Road</h3>
                                <p class="text-xs text-[#C9996B] font-medium">Tenant #RN72</p>
                            </div>

                            <div class="text-left border-l border-gray-50 pl-6">
                                <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest">Lease Period</p>
                                <p class="text-[11px] font-bold text-[#5C4F4A] mt-1">MAY 2026 - NOV 2026</p>
                                <p class="text-[9px] text-gray-400 italic">6 Months Duration</p>
                            </div>

                            <div class="text-left border-l border-gray-50 pl-6">
                                <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest">Assigned Staff</p>
                                <p class="text-[11px] font-bold text-[#5C4F4A] mt-1">S-102 (Branch A)</p>
                            </div>

                            <div class="text-right border-l border-gray-50 pl-6">
                                <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest mb-1">Monthly Rent</p>
                                <p class="text-2xl font-bold text-[#C9996B]">₱45,000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-transparent opacity-60 grayscale-[0.5]">
                    <div class="flex flex-col md:flex-row items-stretch">
                        <div class="w-2 bg-gray-300"></div>
                        <div class="p-6 flex-grow grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                            <div class="col-span-1">
                                <span class="text-[10px] font-mono font-bold text-gray-300">LS098</span>
                                <h3 class="text-lg font-bold text-gray-400 leading-tight">CR76 - 5th Ave Tower</h3>
                                <p class="text-xs text-gray-300 font-medium">Tenant #RN15</p>
                            </div>
                            <div class="text-left border-l border-gray-50 pl-6">
                                <p class="text-[9px] font-bold text-gray-200 uppercase tracking-widest">Lease Period</p>
                                <p class="text-[11px] font-bold text-gray-300 mt-1 uppercase">Term Ended Jan 2026</p>
                            </div>
                            <div class="text-left border-l border-gray-50 pl-6 italic text-[11px] text-gray-300">
                                Archived Record
                            </div>
                            <div class="text-right border-l border-gray-50 pl-6">
                                <p class="text-[9px] font-bold text-gray-200 uppercase tracking-widest mb-1">Monthly Rent</p>
                                <p class="text-2xl font-bold text-gray-300">₱32,500</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>