<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-[#5c4f4a]">Lease Agreements</h2>
            <button class="bg-[#c9996b] hover:bg-[#b88a5a] text-white px-4 py-2 rounded-lg transition shadow-md">
                + Create New Lease
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-[#ede9e6] text-[#5c4f4a] uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Lease No</th>
                        <th class="px-6 py-4">Property</th>
                        <th class="px-6 py-4">Monthly Rent</th>
                        <th class="px-6 py-4">Duration</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium">LS101</td>
                        <td class="px-6 py-4">PG21 - 18 Dale Road [cite: 69]</td>
                        <td class="px-6 py-4">£600 [cite: 69]</td>
                        <td class="px-6 py-4">6 Months [cite: 78]</td>
                        <td class="px-6 py-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Active</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>