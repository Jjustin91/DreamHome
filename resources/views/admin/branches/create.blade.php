@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    {{-- Back Button --}}
    <a href="{{ route('admin.branches.index') }}" class="inline-flex items-center gap-2 mb-6 text-gray-400 hover:text-gray-600 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span class="text-[10px] font-bold uppercase tracking-widest">Back to List</span>
    </a>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Card Header --}}
        <div class="p-8 bg-white border-b border-gray-50 text-center">
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Register New Branch</h2>
            <p class="text-[10px] font-bold text-[#C9956A] uppercase tracking-[0.2em] mt-1">Expanding the DreamHome Network</p>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.branches.store') }}" method="POST" class="p-10 space-y-8">
            @csrf

            <div class="grid grid-cols-2 gap-8">
                {{-- Branch ID --}}
                <div class="col-span-full md:col-span-1">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">
                        Branch ID
                    </label>
                    <div class="w-full px-6 py-4 bg-gray-50 border border-dashed border-gray-200 rounded-2xl font-black text-gray-400">
                        System Generated
                    </div>
                    <p class="text-[9px] text-gray-400 mt-2 italic">The next available ID will be assigned automatically.</p>
                </div>

                {{-- City --}}
                <div class="col-span-full md:col-span-1">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">City</label>
                    <input type="text" name="city" placeholder="City name" required 
                        class="w-full px-6 py-4 bg-[#F3F1ED] border-none rounded-2xl font-bold text-gray-700">
                </div>

                {{-- Street Address --}}
                <div class="col-span-full">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Street Address</label>
                    <input type="text" name="street" placeholder="123 Example St." required 
                        class="w-full px-6 py-4 bg-[#F3F1ED] border-none rounded-2xl font-bold text-gray-700">
                </div>

                {{-- Postcode --}}
                <div class="col-span-full md:col-span-1">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Postcode</label>
                    <input type="text" name="postcode" placeholder="G-- ---" required 
                        class="w-full px-6 py-4 bg-[#F3F1ED] border-none rounded-2xl font-mono text-gray-700 uppercase">
                </div>
            </div>
            <div class="col-span-full md:col-span-1">
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Telephone Number *</label>
                <input type="text" name="telephone_no" placeholder="0141-xxx-xxxx" required 
                    class="w-full px-6 py-4 bg-[#F3F1ED] border-none rounded-2xl font-bold text-gray-700">
            </div>

            {{-- Footer / Actions --}}
            <div class="pt-10 flex justify-center border-t border-gray-50">
                <button type="submit" class="px-12 py-5 bg-[#5C5047] text-white rounded-2xl font-bold text-xs uppercase tracking-[0.2em] shadow-2xl hover:bg-[#4E443C] transition-all transform hover:-translate-y-1">
                    Confirm Registration
                </button>
            </div>
        </form>
    </div>
</div>
@endsection