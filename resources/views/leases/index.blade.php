<x-app-layout>
    <div x-data="{ 
        isOpen: false, 
        selected: { 
            id: '', 
            property: '', 
            tenant: '', 
            staff: '', 
            rent: '', 
            deposit: '', 
            method: '', 
            period: '',
            isPaid: false 
        } 
    }" class="bg-[#EDE9E6] min-h-screen py-8 px-6">
        
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
                
                <div @click="
                    isOpen = true; 
                    selected = { 
                        id: 'LS101', 
                        property: 'PG21 - 18 Dale Road', 
                        tenant: 'Renter #RN72', 
                        staff: 'S-102 (Branch A)', 
                        rent: '₱45,000', 
                        deposit: '₱90,000', 
                        method: 'Bank Transfer', 
                        period: 'MAY 2026 - NOV 2026',
                        isPaid: true 
                    }" 
                    class="bg-white rounded-xl shadow-sm border border-transparent hover:border-[#C9996B] transition-all cursor-pointer group overflow-hidden">
                    <div class="flex flex-col md:flex-row items-stretch">
                        <div class="w-2 bg-[#5F766D]"></div>
                        <div class="p-6 flex-grow grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                            <div class="col-span-1">
                                <span class="text-[10px] font-mono font-bold text-gray-400">LS101</span>
                                <h3 class="text-lg font-bold text-[#5C4F4A] leading-tight text-nowrap">PG21 - 18 Dale Road</h3>
                                <p class="text-xs text-[#C9996B] font-medium">Tenant #RN72</p>
                            </div>
                            <div class="text-left border-l border-gray-50 pl-6">
                                <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest">Lease Period</p>
                                <p class="text-[11px] font-bold text-[#5C4F4A] mt-1 uppercase">May 2026 - Nov 2026</p>
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

                <div class="bg-white rounded-xl shadow-sm border border-transparent opacity-60 grayscale-[0.5] overflow-hidden">
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
                            <div class="text-left border-l border-gray-50 pl-6 italic text-[11px] text-gray-300">Archived Record</div>
                            <div class="text-right border-l border-gray-50 pl-6">
                                <p class="text-[9px] font-bold text-gray-200 uppercase tracking-widest mb-1">Monthly Rent</p>
                                <p class="text-2xl font-bold text-gray-300">₱32,500</p>
                            </div>
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

            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden z-10 relative border-t-8 border-[#5F766D]">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <span x-text="selected.id" class="text-[10px] font-mono font-bold text-gray-400 bg-gray-100 px-2 py-1 rounded"></span>
                            <h2 x-text="selected.property" class="text-2xl font-bold text-[#5C4F4A] mt-2"></h2>
                            <p x-text="selected.tenant" class="text-sm font-semibold text-[#C9996B]"></p>
                        </div>
                        <button @click="isOpen = false" class="text-gray-300 hover:text-red-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-xl border border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Monthly Rent</p>
                            <p x-text="selected.rent" class="text-xl font-bold text-[#C9996B]"></p>
                            <p class="text-[9px] text-gray-400 italic">Via <span x-text="selected.method"></span></p>
                        </div>
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-xl border border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Security Deposit</p>
                            <p x-text="selected.deposit" class="text-xl font-bold text-[#5C4F4A]"></p>
                            <span :class="selected.isPaid ? 'text-green-600' : 'text-red-400'" class="text-[9px] font-bold uppercase tracking-tighter">
                                <span x-text="selected.isPaid ? '● Deposit Paid' : '○ Pending Deposit'"></span>
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Lease Duration</p>
                            <p x-text="selected.period" class="text-sm font-bold text-[#5C4F4A] mt-1"></p>
                        </div>
                        <div class="pt-4 border-t border-gray-50 flex justify-between items-center">
                            <div>
                                <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Managing Staff</p>
                                <p x-text="selected.staff" class="text-[11px] font-bold text-[#5C4F4A]"></p>
                            </div>
                            <button class="bg-[#EDE9E6] text-[#5C4F4A] text-[10px] px-3 py-1.5 rounded-lg font-bold hover:bg-[#C9996B] hover:text-white transition uppercase">
                                Print PDF
                            </button>
                        </div>
                    </div>

                    <button @click="isOpen = false" class="mt-10 w-full bg-[#5C4F4A] text-white py-3 rounded-xl font-bold uppercase tracking-widest hover:bg-black transition shadow-lg">
                        Close Details
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    [x-cloak] { display: none !important; }
</style>