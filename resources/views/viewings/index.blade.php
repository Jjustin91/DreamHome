<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold text-[#5c4f4a] mb-6">Property Viewings</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-semibold mb-4">Record New Viewing</h3>
                <div class="space-y-4">
                    <input type="text" placeholder="Renter Number (e.g., CR74)" class="w-full border-gray-200 rounded-lg shadow-sm" [cite: 73]>
                    <input type="text" placeholder="Property Number" class="w-full border-gray-200 rounded-lg shadow-sm" [cite: 54]>
                    <textarea placeholder="Renter Comments..." class="w-full border-gray-200 rounded-lg shadow-sm h-24" [cite: 111]></textarea>
                    <button class="w-full bg-[#5c766d] text-white py-2 rounded-lg hover:bg-[#4a5f57] transition">Save Record</button>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-semibold mb-4">Recent Feedback</h3>
                <div class="space-y-4 text-sm text-gray-600">
                    <div class="border-l-4 border-[#c9996b] pl-4 py-2">
                        <p class="font-bold text-gray-800">Mike Ritchie (CR74) [cite: 73]</p>
                        <p>"Getting married in August, needs more space." [cite: 73]</p>
                        <span class="text-xs text-gray-400">March 24, 1995</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>