<x-app-layout>
    <div x-data="{ 
        isOpen: false, 
        selected: { 
            property: '', 
            client: '', 
            staff: '', 
            date: '', 
            time: '', 
            status: '', 
            feedback: '' 
        } 
    }" class="bg-[#EDE9E6] min-h-screen py-12 px-6">
        
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-[#5C4F4A]">Property Viewings</h1>
                    <p class="text-[#C9996B] mt-1 text-sm font-medium">Manage client visits and property feedback</p>
                </div>
                <button class="bg-[#C9996B] hover:bg-[#B88A5A] text-white px-5 py-2.5 rounded-lg transition shadow-md flex items-center gap-2 font-semibold text-sm">
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
                
                <div @click="
                    isOpen = true; 
                    selected = { 
                        property: 'Villa Rosa - Unit 4B', 
                        client: 'Maria Santos', 
                        staff: 'S-102', 
                        date: 'May 12, 2026', 
                        time: '2:00 PM', 
                        status: 'Highly Interested', 
                        feedback: 'Loved the natural lighting, but the kitchen tiles felt a bit outdated and might need replacement before move-in.' 
                    }" 
                    class="bg-white rounded-xl shadow-sm border border-transparent hover:border-[#C9996B] transition-all cursor-pointer group overflow-hidden flex flex-col md:flex-row">
                    
                    <div class="w-full md:w-48 h-32 bg-[#EDE9E6] flex items-center justify-center text-gray-400 group-hover:bg-[#E2DDD9] transition-colors">
                        <span class="text-[10px] uppercase font-bold tracking-tighter italic">Property Photo</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col md:flex-row justify-between items-start md:items-center">
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

                <div @click="
                    isOpen = true; 
                    selected = { 
                        property: 'Pinecrest Heights - Room 10', 
                        client: 'Bruce Bilar', 
                        staff: 'S-109', 
                        date: 'May 10, 2026', 
                        time: '10:00 AM', 
                        status: 'Neutral', 
                        feedback: 'Location is great for work, but the noise level from the street is a concern. Requesting a viewing for a higher floor unit.' 
                    }" 
                    class="bg-white rounded-xl shadow-sm border border-transparent hover:border-[#C9996B] transition-all cursor-pointer group overflow-hidden flex flex-col md:flex-row opacity-80">
                    
                    <div class="w-full md:w-48 h-32 bg-[#EDE9E6] flex items-center justify-center text-gray-400 group-hover:bg-[#E2DDD9] transition-colors">
                        <span class="text-[10px] uppercase font-bold tracking-tighter italic">Property Photo</span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h3 class="text-lg font-bold text-[#5C4F4A]">Pinecrest Heights - R10</h3>
                            <p class="text-sm text-gray-500">Client: <span class="font-semibold text-[#C9996B]">Bruce Bilar</span></p>
                            <p class="text-[10px] font-bold text-gray-300 mt-1 uppercase">Visited May 10, 2026 | 10:00 AM</p>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-gray-100 text-gray-600 uppercase tracking-widest">Neutral</span>
                            <span class="text-[#C9996B] text-[10px] font-bold group-hover:underline italic">Click to expand feedback →</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="isOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4">
            
            <div @click="isOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>

            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden z-10 relative border-t-8 border-[#C97D60]">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span x-text="selected.status" :class="{
                                'bg-green-100 text-green-700': selected.status === 'Highly Interested',
                                'bg-gray-100 text-gray-600': selected.status === 'Neutral'
                            }" class="text-[9px] font-bold px-2 py-1 rounded uppercase tracking-widest"></span>
                            <h2 x-text="selected.property" class="text-2xl font-bold text-[#5C4F4A] mt-3"></h2>
                            <p class="text-sm text-gray-400 italic">With Client: <span x-text="selected.client" class="text-[#C9996B] font-bold"></span></p>
                        </div>
                        <button @click="isOpen = false" class="text-gray-300 hover:text-red-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-xl">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Schedule</p>
                            <p x-text="selected.date" class="text-xs font-bold text-[#5C4F4A] mt-1"></p>
                            <p x-text="selected.time" class="text-[10px] text-[#C9996B] font-bold"></p>
                        </div>
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-xl">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Accompanied By</p>
                            <p x-text="selected.staff" class="text-xs font-bold text-[#5C4F4A] mt-1"></p>
                            <p class="text-[9px] text-gray-400 italic font-medium">Licensed Representative</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Detailed Client Feedback</p>
                        <div class="bg-[#F9F8F7] border-l-4 border-[#C97D60] p-5 rounded-r-lg">
                            <p class="text-[#5C4F4A] text-sm leading-relaxed italic" x-text="selected.feedback"></p>
                        </div>
                    </div>

                    <div class="mt-10 flex gap-3">
                        <button @click="isOpen = false" class="flex-grow bg-[#5C4F4A] text-white py-3 rounded-xl font-bold uppercase tracking-widest hover:bg-black transition text-xs">
                            Close
                        </button>
                        <button class="px-6 border border-gray-200 text-gray-400 rounded-xl hover:bg-gray-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    [x-cloak] { display: none !important; }
</style>