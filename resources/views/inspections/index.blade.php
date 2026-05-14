<x-app-layout>
    <div x-data="{ 
        isOpen: false, 
        isFormOpen: false,
        selected: { 
            id: '', property: '', staff: '', date: '', status: '', comments: '' 
        } 
    }" class="bg-[#EDE9E6] min-h-screen py-8 px-6">
        
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-[#5C4F4A]">Property Inspections</h1>
                    <p class="text-[#C9996B] font-medium text-sm text-opacity-80">Monitor property conditions and staff reports</p>
                </div>
                <button @click="isFormOpen = true" class="bg-[#C9996B] hover:bg-[#B88A5A] text-white px-5 py-2.5 rounded-lg transition shadow-md flex items-center gap-2 font-semibold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Record New Inspection
                </button>
            </div>

            <div class="space-y-4">
                <div @click="isOpen = true; selected = { id: 'P-402', property: 'Villa Rosa - Unit 4B', staff: 'S-102', date: 'May 12, 2026', status: 'CLEAR', comments: 'Found minor water damage in the laundry area. Recommended immediate pipe check.' }" 
                    class="bg-white p-6 rounded-xl shadow-sm border border-transparent hover:border-[#C9996B] transition-all cursor-pointer group">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-[10px] font-bold font-mono tracking-widest text-[#5C4F4A] bg-[#EDE9E6] px-2 py-0.5 rounded uppercase">P-402</span>
                                <span class="text-[10px] font-extrabold text-[#5F766D] uppercase tracking-widest">Clear</span>
                            </div>
                            <h3 class="text-xl font-bold text-[#5C4F4A]">Villa Rosa - Unit 4B</h3>
                            <p class="text-sm text-gray-400">Inspected by: <span class="text-[#C9996B] font-semibold">S-102</span></p>
                        </div>
                        <div class="text-right text-nowrap pl-4">
                            <p class="text-[10px] font-bold text-gray-300 uppercase mb-4 tracking-widest">May 12, 2026</p>
                            <span class="text-[#C9996B] text-[10px] font-bold group-hover:underline italic">Click to view notes →</span>
                        </div>
                    </div>
                </div>

                <div @click="isOpen = true; selected = { id: 'P-105', property: 'Pinecrest Heights - R10', staff: 'S-109', date: 'May 08, 2026', status: 'REPAIR NEEDED', comments: 'Kitchen cabinets showing signs of termites. Immediate treatment required.' }" 
                    class="bg-white p-6 rounded-xl shadow-sm border border-transparent hover:border-[#C9996B] transition-all cursor-pointer group">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-[10px] font-bold font-mono tracking-widest text-gray-400 bg-gray-100 px-2 py-0.5 rounded">P-105</span>
                                <span class="text-[10px] font-extrabold text-red-400 uppercase tracking-widest">Repair Needed</span>
                            </div>
                            <h3 class="text-xl font-bold text-[#5C4F4A]">Pinecrest Heights - R10</h3>
                            <p class="text-sm text-gray-400">Inspected by: <span class="text-[#C9996B] font-semibold">S-109</span></p>
                        </div>
                        <div class="text-right text-nowrap pl-4">
                            <p class="text-[10px] font-bold text-gray-300 uppercase mb-4 tracking-widest">May 08, 2026</p>
                            <span class="text-[#C9996B] text-[10px] font-bold group-hover:underline italic">Click to view notes →</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="isOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="isOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>
            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden z-10 relative border-t-8 border-[#C9996B]">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span x-text="selected.id" class="text-[10px] font-mono font-bold text-gray-400 bg-gray-100 px-2 py-1 rounded"></span>
                            <h2 x-text="selected.property" class="text-2xl font-bold text-[#5C4F4A] mt-2"></h2>
                        </div>
                        <button @click="isOpen = false" class="text-gray-400 hover:text-red-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-lg"><p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date</p><p x-text="selected.date" class="text-sm font-bold text-[#5C4F4A]"></p></div>
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-lg"><p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Inspector</p><p x-text="selected.staff" class="text-sm font-bold text-[#C9996B]"></p></div>
                    </div>
                    <div class="space-y-2">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Full Comments & Notes</p>
                        <div class="bg-white border-l-4 border-[#C9996B] p-4 italic text-[#5C4F4A] leading-relaxed">"<span x-text="selected.comments"></span>"</div>
                    </div>
                    <button @click="isOpen = false" class="mt-10 w-full bg-[#5C4F4A] text-white py-3 rounded-xl font-bold uppercase tracking-widest hover:bg-black transition shadow-lg text-xs">Close Report</button>
                </div>
            </div>
        </div>

        <div x-show="isFormOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center p-4">
            
            <div @click="isFormOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>

            <div class="bg-white w-full max-w-xl rounded-2xl shadow-2xl overflow-hidden z-10 relative border-l-[12px] border-[#C9996B]">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-[#5C4F4A]">Record Property Inspection</h2>
                            <p class="text-xs text-[#C9996B] font-medium uppercase tracking-widest">Condition & Compliance Report</p>
                        </div>
                        <button @click="isFormOpen = false" class="text-gray-300 hover:text-red-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form action="#" method="POST" @submit.prevent="isFormOpen = false" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Target Property</label>
                                <select class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5 transition">
                                    <option value="">Search Property ID...</option>
                                    <option>Villa Rosa - Unit 4B (PG21)</option>
                                    <option>Pinecrest Heights - R10 (CR76)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Assigned Staff</label>
                                <div class="relative">
                                    <input type="text" placeholder="Staff Name or ID..." class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5 transition">
                                    <span class="absolute right-3 top-2.5 text-gray-300"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Inspection Date</label>
                                <input type="date" class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Overall Condition</label>
                                <select class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5 transition">
                                    <option>Clear / Good</option>
                                    <option>Minor Issues Found</option>
                                    <option>Immediate Repair Needed</option>
                                    <option>Critical / Unsafe</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Inspector's Findings & Comments</label>
                            <textarea rows="4" placeholder="Detail any damages, maintenance requirements, or structural concerns..." class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] placeholder-gray-300 px-4 py-2.5 transition"></textarea>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button @click="isFormOpen = false" type="button" class="flex-grow bg-white border border-gray-200 text-[#5C4F4A] py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-gray-50 transition">
                                Cancel
                            </button>
                            <button type="submit" class="flex-grow bg-[#C9996B] text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-[#B88A5A] shadow-lg transition">
                                Finalize Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    [x-cloak] { display: none !important; }
</style>