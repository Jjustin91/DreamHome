@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 bg-white border-b border-gray-50">
            <h2 class="text-2xl font-black text-gray-900">Branch Details</h2>
            <p class="text-xs font-bold text-[#C9956A] uppercase tracking-widest mt-1">Official Office Registration</p>
        </div>

        <form action="{{ isset($branch) ? route('admin.branches.update', $branch->branch_no) : route('admin.branches.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            @if(isset($branch)) @method('PUT') @endif

            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-full md:col-span-1">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Branch ID</label>
                    <input type="text" name="branch_no" value="{{ $branch->branch_no ?? old('branch_no') }}" {{ isset($branch) ? 'disabled' : '' }} class="w-full px-5 py-4 bg-[#F3F1ED] border-none rounded-2xl font-bold text-gray-700">
                </div>

                <div class="col-span-full md:col-span-1">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">City</label>
                    <input type="text" name="city" value="{{ $branch->city ?? old('city') }}" class="w-full px-5 py-4 bg-[#F3F1ED] border-none rounded-2xl font-bold text-gray-700">
                </div>

                <div class="col-span-full">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Street Address</label>
                    <input type="text" name="street" value="{{ $branch->street ?? old('street') }}" class="w-full px-5 py-4 bg-[#F3F1ED] border-none rounded-2xl font-bold text-gray-700">
                </div>

                <div class="col-span-full md:col-span-1">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Postcode</label>
                    <input type="text" name="postcode" value="{{ $branch->postcode ?? old('postcode') }}" class="w-full px-5 py-4 bg-[#F3F1ED] border-none rounded-2xl font-mono text-gray-700">
                </div>
            </div>

            <div class="pt-8 flex justify-end gap-4 border-t border-gray-50">
                <a href="{{ route('admin.branches.index') }}" class="px-6 py-4 font-bold text-gray-400 text-xs uppercase tracking-widest">Cancel</a>
                <button type="submit" class="px-10 py-4 bg-[#5C5047] text-white rounded-2xl font-bold text-xs uppercase tracking-widest shadow-xl hover:bg-[#4E443C] transition">
                    {{ isset($branch) ? 'Save Changes' : 'Register Branch' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection