<x-app-layout>
    <div x-data="{ 
        isOpen: false, 
        isFormOpen: false,
        selected: { 
            id: '', property: '', tenant: '', staff: '', rent: '', deposit: '', method: '', period: '', isPaid: false 
        } 
    }" class="bg-[#EDE9E6] min-h-screen py-8 px-6">
        
        <div class="max-w-5xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-[#5C4F4A]">Lease Agreements</h1>
                    <p class="text-[#C9996B] font-medium text-sm">Manage rental contracts and payment terms</p>
                </div>
                <button @click="isFormOpen = true" class="bg-[#C9996B] hover:bg-[#B88A5A] text-white px-5 py-2.5 rounded-lg transition shadow-md flex items-center gap-2 font-semibold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Lease
                </button>
            </div>

            <div class="space-y-4">
                <div @click="isOpen = true; selected = { id: 'LS101', property: 'PG21 - 18 Dale Road', tenant: 'Renter #RN72', staff: 'S-102 (Branch A)', rent: '₱45,000', deposit: '₱90,000', method: 'Bank Transfer', period: 'MAY 2026 - NOV 2026', isPaid: true }" 
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
                                <p class="text-[11px] font-bold text-[#5C4F4A] mt-1 uppercase text-nowrap">May 2026 - Nov 2026</p>
                            </div>
                            <div class="text-left border-l border-gray-50 pl-6 text-nowrap">
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
            </div>
        </div>

        <div x-show="isOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="isOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>
            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden z-10 relative border-t-8 border-[#5F766D]">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <span x-text="selected.id" class="text-[10px] font-mono font-bold text-gray-400 bg-gray-100 px-2 py-1 rounded"></span>
                            <h2 x-text="selected.property" class="text-2xl font-bold text-[#5C4F4A] mt-2"></h2>
                            <p x-text="selected.tenant" class="text-sm font-semibold text-[#C9996B]"></p>
                        </div>
                        <button @click="isOpen = false" class="text-gray-300 hover:text-red-400 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-xl border border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Monthly Rent</p>
                            <p x-text="selected.rent" class="text-xl font-bold text-[#C9996B]"></p>
                        </div>
                        <div class="bg-[#EDE9E6]/50 p-4 rounded-xl border border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Security Deposit</p>
                            <p x-text="selected.deposit" class="text-xl font-bold text-[#5C4F4A]"></p>
                        </div>
                    </div>
                    <button @click="isOpen = false" class="w-full bg-[#5C4F4A] text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs">Close Details</button>
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

            <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden z-10 relative border-l-[12px] border-[#5F766D]">
                <div class="p-10">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-[#5C4F4A]">New Lease Agreement</h2>
                            <p class="text-xs text-[#C9996B] font-medium uppercase tracking-widest">Contract Setup & Financial Terms</p>
                        </div>
                        <button @click="isFormOpen = false" class="text-gray-300 hover:text-red-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form action="#" method="POST" @submit.prevent="isFormOpen = false" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Select Renter (Tenant)</label>
                                <input type="text" placeholder="Search by name or RN-ID..." class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-3 transition">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Select Property</label>
                                <select class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-3 transition">
                                    <option value="">Choose available property...</option>
                                    <option>PG21 - 18 Dale Road</option>
                                    <option>CR76 - 5th Ave Tower</option>
                                </select>
                            </div>
                        </div>

                        <div class="p-6 bg-[#F9F8F7] rounded-xl grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Monthly Rent</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3 text-gray-400 text-sm">₱</span>
                                    <input type="number" placeholder="0.00" class="w-full bg-white border-gray-100 focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] pl-8 py-2.5 transition">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Security Deposit</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3 text-gray-400 text-sm">₱</span>
                                    <input type="number" placeholder="0.00" class="w-full bg-white border-gray-100 focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] pl-8 py-2.5 transition">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Payment Method</label>
                                <select class="w-full bg-white border-gray-100 focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-2.5 transition">
                                    <option>Bank Transfer</option>
                                    <option>Cash</option>
                                    <option>Check</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Start Date</label>
                                <input type="date" class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-3">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">End Date</label>
                                <input type="date" class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm text-[#5C4F4A] px-4 py-3">
                            </div>
                        </div>

                        <div class="flex gap-4 pt-6">
                            <button @click="isFormOpen = false" type="button" class="flex-1 bg-white border border-gray-200 text-[#5C4F4A] py-3.5 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-gray-50 transition">
                                Discard Draft
                            </button>
                            <button type="submit" class="flex-[2] bg-[#5F766D] text-white py-3.5 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-[#4A5D55] shadow-xl transition">
                                Finalize & Generate Lease
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