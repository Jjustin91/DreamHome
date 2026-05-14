<x-app-layout>
    <div x-data="{ 
        isOpen: false, 
        isFormOpen: false,
        selected: { 
            property: '', client: '', staff: '', date: '', time: '', status: '', feedback: '' 
        } 
    }" class="bg-[#EDE9E6] min-h-screen py-12 px-6">
        
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-[#5C4F4A]">Property Viewings</h1>
                    <p class="text-[#C9996B] mt-1 text-sm font-medium">Manage client visits and property feedback</p>
                </div>
                <button @click="isFormOpen = true" class="bg-[#C9996B] hover:bg-[#B88A5A] text-white px-5 py-2.5 rounded-lg transition shadow-md flex items-center gap-2 font-semibold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Record New Viewing
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-xl border-b-4 border-[#C9996B] shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Total Available</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">12 <span class="text-sm font-normal text-gray-300 italic">Units</span></p>
                </div>
                <div class="bg-white p-6 rounded-xl border-b-4 border-[#C97D60] shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Reserved</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">04 <span class="text-sm font-normal text-gray-300 italic">Units</span></p>
                </div>
                <div class="bg-white p-6 rounded-xl border-b-4 border-[#5C4F4A] shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Successfully Rented</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">25 <span class="text-sm font-normal text-gray-300 italic">Units</span></p>
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-sm font-bold text-[#5C4F4A] mb-4 uppercase tracking-widest">Recent Viewings & Feedback</h2>
                
                <div @click="isOpen = true; selected = { property: 'Villa Rosa - Unit 4B', client: 'Maria Santos', staff: 'S-102', date: 'May 12, 2026', time: '2:00 PM', status: 'Highly Interested', feedback: 'Loved the natural lighting, but the kitchen tiles felt a bit outdated.' }" 
                    class="bg-white rounded-xl shadow-sm border border-transparent hover:border-[#C9996B] transition-all cursor-pointer group overflow-hidden flex flex-col md:flex-row">
                    <div class="w-full md:w-48 h-32 bg-[#EDE9E6] flex items-center justify-center text-gray-400 group-hover:bg-[#E2DDD9] transition-colors italic text-[10px]">Property Photo</div>
                    <div class="p-6 flex-grow flex flex-col md:flex-row justify-between items-start md:items-center text-nowrap">
                        <div>
                            <h3 class="text-lg font-bold text-[#5C4F4A]">Villa Rosa - Unit 4B</h3>
                            <p class="text-sm text-gray-500">Client: <span class="font-semibold text-[#C9996B]">Maria Santos</span></p>
                            <p class="text-[10px] font-bold text-gray-300 mt-1 uppercase">Visited May 12, 2026 | 2:00 PM</p>
                        </div>
                        <div class="flex flex-col items-end gap-2 mt-4 md:mt-0">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 uppercase tracking-widest">Highly Interested</span>
                            <span class="text-[#C9996B] text-[10px] font-bold group-hover:underline italic">Click to expand feedback →</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="isOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="isOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>
            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidd en z-10 relative border-t-8 border-[#C97D60]">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span x-text="selected.status" class="text-[9px] font-bold px-2 py-1 rounded uppercase tracking-widest bg-gray-100 text-gray-600"></span>
                            <h2 x-text="selected.property" class="text-2xl font-bold text-[#5C4F4A] mt-3"></h2>
                            <p class="text-sm text-gray-400 italic">With Client: <span x-text="selected.client" class="text-[#C9996B] font-bold"></span></p>
                        </div>
                        <button @click="isOpen = false" class="text-gray-300 hover:text-red-400 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-xl">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Schedule</p>
                            <p x-text="selected.date" class="text-xs font-bold text-[#5C4F4A] mt-1"></p>
                        </div>
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-xl">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Accompanied By</p>
                            <p x-text="selected.staff" class="text-xs font-bold text-[#5C4F4A] mt-1"></p>
                        </div>
                    </div>
                    <div class="bg-[#F9F8F7] border-l-4 border-[#C97D60] p-5 rounded-r-lg italic text-[#5C4F4A] text-sm" x-text="selected.feedback"></div>
                    <button @click="isOpen = false" class="mt-10 w-full bg-[#5C4F4A] text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs">Close</button>
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

            <div class="bg-white w-full max-w-xl rounded-2xl shadow-2xl overflow-hidden z-10 relative border-l-[12px] border-[#C97D60]">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-[#5C4F4A]">Record Viewing</h2>
                            <p class="text-xs text-[#C9996B] font-medium">Capture feedback and schedule details</p>
                        </div>
                        <button @click="isFormOpen = false" class="text-gray-300 hover:text-red-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form action="#" method="POST" @submit.prevent="isFormOpen = false" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Client Name</label>
                                <div class="relative">
                                    <input type="text" placeholder="Search client name..." class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] placeholder-gray-300 px-4 py-2.5 transition">
                                    <span class="absolute right-3 top-3 text-gray-300"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Property</label>
                                <select class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5 transition">
                                    <option value="">Select a property</option>
                                    <option>Villa Rosa - Unit 4B</option>
                                    <option>Pinecrest Heights - R10</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Date</label>
                                <input type="date" class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Time</label>
                                <input type="time" class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Assigned Staff</label>
                                <input type="text" placeholder="e.g. S-102" class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Client Feedback</label>
                            <textarea rows="4" placeholder="How was the viewing? Note any specific concerns or likes..." class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] placeholder-gray-300 px-4 py-2.5 transition"></textarea>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button @click="isFormOpen = false" type="button" class="flex-grow bg-white border border-gray-200 text-[#5C4F4A] py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-gray-50 transition">
                                Cancel
                            </button>
                            <button type="submit" class="flex-grow bg-[#C97D60] text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-[#B86A4F] shadow-lg transition">
                                Save Viewing Record
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