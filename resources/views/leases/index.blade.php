<x-app-layout>
    <div x-data="{ 
        isOpen: false, 
        isFormOpen: false,
        isOngoing: false,
        search: '',
        selected: { 
            id: '', property: '', renter: '', staff: '', rent: '', deposit: '', method: '', start: '', finish: '', status: '' 
        } 
    }" class="bg-[#EDE9E6] min-h-screen py-8 px-6">
        
        <div class="max-w-7xl mx-auto">
            
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                     class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold rounded shadow-sm flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 text-xl">&times;</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                    <p class="font-bold">Entry Failed:</p>
                    <ul class="list-disc ml-5 mt-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-[#5C4F4A]">Lease Agreements</h1>
                    <p class="text-[#C9996B] font-medium text-sm text-opacity-80">Manage rental contracts and payment terms</p>
                </div>
                <button @click="isFormOpen = true" class="bg-[#5F766D] hover:bg-[#4A5D55] text-white px-5 py-2.5 rounded-lg transition shadow-md flex items-center gap-2 font-semibold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Create New Lease
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-xl border-b-4 border-[#5F766D] shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Active Leases</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">
                        {{ str_pad($totalActiveLeases, 2, '0', STR_PAD_LEFT) }} 
                        <span class="text-sm font-normal text-gray-300 italic">Contracts</span>
                    </p>
                </div>
                <div class="bg-white p-6 rounded-xl border-b-4 border-[#C9996B] shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Monthly Revenue</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">
                        ₱{{ number_format($totalMonthlyRevenue, 0) }}
                        <span class="text-sm font-normal text-gray-300 italic">Total</span>
                    </p>
                </div>
                <div class="bg-white p-6 rounded-xl border-b-4 border-red-400 shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Pending Deposits</p>
                    <p class="text-3xl font-bold text-[#5C4F4A]">
                        {{ str_pad($pendingDeposits, 2, '0', STR_PAD_LEFT) }} 
                        <span class="text-sm font-normal text-gray-300 italic">Unpaid</span>
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-sm font-bold text-[#5C4F4A] uppercase tracking-widest">Lease Logs</h2>
                <div class="relative w-full max-w-md">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="h-4 w-4 text-[#C9996B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input x-model="search" type="text" placeholder="Search by renter or property..." 
                        class="block w-full pl-10 pr-3 py-2 border-transparent bg-white rounded-lg text-sm placeholder-gray-300 focus:ring-0 focus:border-[#C9996B] transition shadow-sm">
                </div>
            </div>

            <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($leases as $lease)
                    @php
                        $searchContent = strtolower($lease->lease_no . ' ' . ($lease->renter->first_name ?? '') . ' ' . ($lease->renter->last_name ?? '') . ' ' . ($lease->property->street ?? ''));
                    @endphp
                    <div x-show="search === '' || '{{ $searchContent }}'.includes(search.toLowerCase())"
                        x-transition
                        @click="isOpen = true; selected = {
                            id: '{{ $lease->lease_no }}',
                            property: '{{ $lease->property->street ?? 'Property ' . $lease->property_no }}',
                            renter: '{{ $lease->renter->first_name ?? '' }} {{ $lease->renter->last_name ?? '' }}',
                            staff: '{{ $lease->staff_no }}',
                            rent: '{{ number_format($lease->monthly_rent, 2) }}',
                            deposit: '{{ number_format($lease->deposit_amount, 2) }}',
                            method: '{{ $lease->payment_method }}',
                            /* Formatting added here to remove the zeroes */
                            start: '{{ \Carbon\Carbon::parse($lease->rent_start)->format('M d, Y') }}',
                            finish: '{{ $lease->rent_finish ? \Carbon\Carbon::parse($lease->rent_finish)->format('M d, Y') : 'Ongoing' }}',
                            status: '{{ $lease->deposit_paid ? 'DEPOSIT PAID' : 'DEPOSIT PENDING' }}'
                        }"
                        class="bg-white p-6 rounded-xl shadow-sm border border-transparent border-l-[6px] {{ $lease->deposit_paid ? 'border-l-[#5F766D]' : 'border-l-red-400' }} hover:border-[#C9996B] transition-all cursor-pointer group mb-4">
                        
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-[10px] font-bold font-mono text-[#5C4F4A] bg-[#EDE9E6] px-2 py-0.5 rounded">{{ $lease->lease_no }}</span>
                                    <span class="text-[10px] font-extrabold {{ $lease->deposit_paid ? 'text-[#5F766D]' : 'text-red-400' }} uppercase tracking-widest">
                                        {{ $lease->deposit_paid ? 'Active Lease' : 'Action Required' }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-[#5C4F4A]">{{ $lease->property->street ?? 'Property ' . $lease->property_no }}</h3>
                                <p class="text-sm text-gray-400">Renter: <span class="text-[#C9996B] font-semibold">{{ $lease->renter->first_name ?? '' }} {{ $lease->renter->last_name ?? '' }}</span></p>
                            </div>
                            
                            <div class="text-right text-nowrap pl-4">
                                <p class="text-[10px] font-bold text-gray-300 uppercase mb-4 tracking-widest">Monthly Rent</p>
                                <p class="text-xl font-black text-[#5C4F4A]">₱{{ number_format($lease->monthly_rent, 0) }}</p>
                                <span class="text-[#C9996B] text-[10px] font-bold group-hover:underline italic">View contract details →</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div x-show="isOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="isOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>
            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden z-10 relative border-t-8 border-[#5F766D]">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span x-text="selected.status" :class="selected.status === 'DEPOSIT PAID' ? 'text-[#5F766D]' : 'text-red-400'" class="text-[10px] font-extrabold uppercase tracking-widest"></span>
                            <h2 x-text="selected.property" class="text-2xl font-bold text-[#5C4F4A] mt-2"></h2>
                            <p class="text-sm text-[#C9996B] font-medium" x-text="'Renter: ' + selected.renter"></p>
                        </div>
                        <button @click="isOpen = false" class="text-gray-300 hover:text-red-400 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-[#F9F8F7] p-4 rounded-xl border-l-4 border-[#C9996B]">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Monthly Rent</p>
                            <p class="text-lg font-black text-[#5C4F4A]">₱<span x-text="selected.rent"></span></p>
                        </div>
                        <div class="bg-[#F9F8F7] p-4 rounded-xl border-l-4 border-[#5F766D]">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Security Deposit</p>
                            <p class="text-lg font-black text-[#5C4F4A]">₱<span x-text="selected.deposit"></span></p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm border-t border-gray-100 pt-6">
                        <div class="flex justify-between"><span class="text-gray-400">Assigned Staff:</span><span class="font-bold text-[#5C4F4A]" x-text="selected.staff"></span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Payment Method:</span><span class="font-bold text-[#5C4F4A]" x-text="selected.method"></span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Start Date:</span><span class="font-bold text-[#5C4F4A]" x-text="selected.start"></span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Finish Date:</span><span class="font-bold text-[#5C4F4A]" x-text="selected.finish"></span></div>
                    </div>

                    <button @click="isOpen = false" class="mt-10 w-full bg-[#5C4F4A] text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-black transition">Close Details</button>
                </div>
            </div>
        </div>

        <div x-show="isFormOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="isFormOpen = false" class="fixed inset-0 bg-[#5C4F4A]/60 backdrop-blur-sm"></div>
            <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden z-10 relative border-l-[12px] border-[#5F766D]">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-[#5C4F4A]">New Lease Agreement</h2>
                            <p class="text-xs text-[#C9996B] font-medium uppercase tracking-widest">Financial Contract Details</p>
                        </div>
                        <button @click="isFormOpen = false" class="text-gray-300 hover:text-red-400 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                    </div>

                    <form action="{{ route('leases.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Lease Number</label>
                                <input type="text" name="lease_no" value="{{ $nextLeaseID }}" readonly 
                                    class="w-full bg-gray-100 border-transparent rounded-lg text-sm text-gray-500 px-4 py-2.5 cursor-not-allowed font-mono font-bold">
                                <p class="text-[9px] text-[#C9996B] mt-1 italic">* Auto-generated</p>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Select Property</label>
                                <select name="property_no" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm px-4 py-2.5">
                                    <option value="">-- Choose Property --</option>
                                    @foreach($properties as $property)
                                        <option value="{{ $property->property_no }}">{{ $property->street }} ({{ $property->property_no }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Select Renter</label>
                                <select name="renter_no" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm px-4 py-2.5">
                                    <option value="">-- Choose Renter --</option>
                                    @foreach($renters as $renter)
                                        <option value="{{ $renter->renter_no }}">{{ $renter->first_name }} {{ $renter->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Assign Staff</label>
                                <select name="staff_no" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm px-4 py-2.5">
                                    <option value="">-- Choose Staff --</option>
                                    @foreach($staffMembers as $staff)
                                        <option value="{{ $staff->staff_no }}">{{ $staff->staff_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Monthly Rent (₱)</label>
                                <input type="number" name="monthly_rent" step="0.01" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Security Deposit (₱)</label>
                                <input type="number" name="deposit_amount" step="0.01" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Method</label>
                                <select name="payment_method" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm px-4 py-2.5">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 tracking-widest">Start Date</label>
                                <input type="date" name="rent_start" required class="w-full bg-[#F9F8F7] border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm px-4 py-2.5">
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Finish Date</label>
                                    <label class="flex items-center gap-1 cursor-pointer">
                                        <input type="checkbox" name="is_ongoing" x-model="isOngoing" class="rounded text-[#5F766D] w-3 h-3">
                                        <span class="text-[9px] font-bold text-[#C9996B] uppercase">Ongoing</span>
                                    </label>
                                </div>
                                <input type="date" name="rent_finish" :required="!isOngoing" :disabled="isOngoing" 
                                    :class="isOngoing ? 'opacity-30 cursor-not-allowed bg-gray-100' : 'bg-[#F9F8F7]'" 
                                    class="w-full border-transparent focus:border-[#C9996B] focus:ring-0 rounded-lg text-sm px-4 py-2.5 transition-all">
                            </div>
                        </div>

                        <div class="flex items-center gap-2 py-2">
                            <input type="checkbox" name="deposit_paid" id="deposit_paid" value="1" class="rounded border-gray-300 text-[#5F766D] focus:ring-[#5F766D]">
                            <label for="deposit_paid" class="text-xs font-bold text-[#5C4F4A] uppercase tracking-widest cursor-pointer">Security Deposit Paid</label>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button @click="isFormOpen = false" type="button" class="flex-grow bg-white border border-gray-200 text-[#5C4F4A] py-3 rounded-xl font-bold uppercase tracking-widest text-[10px] hover:bg-gray-50 transition">Cancel</button>
                            <button type="submit" class="flex-grow bg-[#5F766D] text-white py-3 rounded-xl font-bold uppercase tracking-widest text-[10px] hover:bg-black shadow-lg transition">Finalize Agreement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #C9996B; border-radius: 10px; }
</style>