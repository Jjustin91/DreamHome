<x-app-layout>
    <div class="py-12 px-6 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold text-[#5C4F4A]">Property Viewings</h1>
                <p class="text-[#C9996B] mt-1 text-sm">Manage client visits and property feedback</p>
            </div>
                <button class="bg-[#c9996b] hover:bg-[#b88a5a] text-white px-4 py-2 rounded-lg transition shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Record New Viewing
                </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-xl border-b-4 border-[#C9996B] shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Available</p>
                <p class="text-3xl font-bold text-[#5C4F4A]">12 <span class="text-sm font-normal text-gray-400 italic">Units</span></p>
            </div>
            <div class="bg-white p-6 rounded-xl border-b-4 border-[#C97D60] shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Reserved</p>
                <p class="text-3xl font-bold text-[#5C4F4A]">04 <span class="text-sm font-normal text-gray-400 italic">Units</span></p>
            </div>
            <div class="bg-white p-6 rounded-xl border-b-4 border-[#5C4F4A] shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Successfully Rented</p>
                <p class="text-3xl font-bold text-[#5C4F4A]">25 <span class="text-sm font-normal text-gray-400 italic">Units</span></p>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-lg font-bold text-[#5C4F4A] mb-4">Recent Viewings & Feedback</h2>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row hover:shadow-md transition-shadow">
                <div class="w-full md:w-48 h-32 bg-[#ede9e6] flex items-center justify-center text-gray-400">
                    <span class="text-xs italic">[Property Image]</span>
                </div>
                <div class="p-6 flex-grow flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-lg font-bold text-[#5C4F4A]">Villa Rosa - Unit 4B</h3>
                        <p class="text-sm text-gray-500">Client: <span class="font-semibold text-[#C9996B]">Maria Santos</span></p>
                        <p class="text-xs text-gray-400 mt-1">Visited on May 12, 2026 | 2:00 PM</p>
                    </div>
                    <div class="flex flex-col items-end gap-3 w-full md:w-auto">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 uppercase tracking-tighter">Highly Interested</span>
                        <p class="text-sm text-gray-600 italic text-right max-w-xs">"Loved the natural lighting, but the kitchen tiles felt a bit outdated."</p>
                        <button class="text-[#C97D60] text-xs font-bold hover:underline">Edit Feedback</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row opacity-80">
                <div class="w-full md:w-48 h-32 bg-[#ede9e6] flex items-center justify-center text-gray-400">
                    <span class="text-xs italic">[Property Image]</span>
                </div>
                <div class="p-6 flex-grow flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h3 class="text-lg font-bold text-[#5C4F4A]">Pinecrest Heights - Room 10</h3>
                        <p class="text-sm text-gray-500">Client: <span class="font-semibold text-[#C9996B]">Bruce Bilar</span></p>
                        <p class="text-xs text-gray-400 mt-1">Visited on May 10, 2026 | 10:00 AM</p>
                    </div>
                    <div class="flex flex-col items-end gap-3 w-full md:w-auto">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 uppercase tracking-tighter">Neutral</span>
                        <p class="text-sm text-gray-600 italic text-right max-w-xs">"Location is great for work, but the noise level from the street is a concern."</p>
                        <button class="text-[#C97D60] text-xs font-bold hover:underline">Edit Feedback</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>