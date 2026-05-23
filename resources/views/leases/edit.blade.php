<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Update Lease Agreement</h2>
    </x-slot>

    <form method="POST" action="{{ route('leases.update', $lease->lease_no) }}" class="max-w-3xl mx-auto">
        @csrf @method('PUT')
        
        <div class="flex items-center justify-between mb-6">
            <div class="text-sm text-gray-600">Updating Lease: <strong class="text-[#C9956A]">{{ $lease->lease_no }}</strong></div>
            <div class="flex gap-3">
                <a href="{{ route('leases.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full hover:bg-red-50">Cancel</a>
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-[#C9956A] hover:bg-[#b07d55]">Save Updates</button>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
            <h3 class="pb-2 mb-4 text-lg font-bold text-gray-800 border-b">Financial Status</h3>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Payment Method</label>
                    <select name="payment_method" class="w-full rounded-lg bg-gray-50 border-gray-300">
                        <option value="Bank Transfer" {{ $lease->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="Cash" {{ $lease->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Cheque" {{ $lease->payment_method == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Deposit Paid?</label>
                    <select name="deposit_paid" class="w-full rounded-lg bg-gray-50 border-gray-300">
                        <option value="1" {{ $lease->deposit_paid ? 'selected' : '' }}>Yes - Paid in Full</option>
                        <option value="0" {{ !$lease->deposit_paid ? 'selected' : '' }}>No - Pending</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>