<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#5c4f4a] leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-sm border border-[#5c4f4a]/10 p-6 border-t-4 border-t-[#c9996b] transition-all hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-[#5c766d] mb-1">Total Properties</p>
                            <p class="text-3xl font-bold text-[#5c4f4a]">42</p>
                        </div>
                        <div class="w-12 h-12 bg-[#c9996b] rounded-full flex items-center justify-center text-white shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-[#5c4f4a]/10 p-6 border-t-4 border-t-[#5c766d] transition-all hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-[#5c766d] mb-1">Active Leases</p>
                            <p class="text-3xl font-bold text-[#5c4f4a]">38</p>
                        </div>
                        <div class="w-12 h-12 bg-[#5c766d] rounded-full flex items-center justify-center text-white shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-[#5c4f4a]/10 p-6 border-t-4 border-t-[#5c4f4a] transition-all hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-[#5c766d] mb-1">Pending Inspections</p>
                            <p class="text-3xl font-bold text-[#5c4f4a]">7</p>
                        </div>
                        <div class="w-12 h-12 bg-[#5c4f4a] rounded-full flex items-center justify-center text-white shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-[#5c4f4a]/10 overflow-hidden">
                <div class="bg-[#ede9e6] border-b border-[#5c4f4a]/10 px-6 py-4 flex justify-between items-center">
                    <h3 class="font-semibold text-[#5c4f4a]">Recent System Activity</h3>
                    <button class="text-sm text-[#c9996b] hover:text-[#5c4f4a] font-medium transition-colors">View All</button>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-2 h-2 mt-2 rounded-full bg-[#c9996b]"></div>
                            <div>
                                <p class="text-sm font-medium text-[#5c4f4a]">New lease agreement signed</p>
                                <p class="text-xs text-[#5c766d]">Property PG21 in Hyndland, Glasgow • 2 hours ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-2 h-2 mt-2 rounded-full bg-[#5c766d]"></div>
                            <div>
                                <p class="text-sm font-medium text-[#5c4f4a]">Property inspection completed</p>
                                <p class="text-xs text-[#5c766d]">Property PL94 by Susan Brand • 5 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>