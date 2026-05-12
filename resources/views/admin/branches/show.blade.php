@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.branches.index') }}" class="p-3 bg-white rounded-2xl shadow-sm border border-gray-100 text-gray-400 hover:text-[#C9956A] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-black text-gray-900 tracking-tight">Branch Overview</h1>
                <p class="text-[10px] font-bold text-[#C9956A] uppercase tracking-[0.2em]">DreamHome Network Division</p>
            </div>
        </div>

        {{-- QUICK ASSIGN DROPDOWN --}}
        <form action="{{ route('admin.branches.assign-staff', $branch->branch_no) }}" method="POST" class="flex items-center gap-2 bg-white p-2 rounded-2xl shadow-sm border border-gray-50">
            @csrf
            <select name="staff_no" required class="text-[10px] font-bold uppercase tracking-widest border-none bg-transparent px-4 py-1 focus:ring-0 outline-none min-w-[200px] text-gray-600">
                <option value="" disabled selected>Assign Staff to this Branch</option>
                @foreach($availableStaff as $as)
                    <option value="{{ $as->staff_no }}">
                        {{ $as->last_name }}, {{ $as->first_name }} ({{ $as->job_title }})
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-6 py-3 bg-[#5C5047] text-white rounded-xl font-bold text-[10px] uppercase tracking-widest shadow-lg hover:bg-[#4E443C] transition">
                Assign
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left: Branch Identity Card --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-6">
                    <span class="text-4xl font-black text-gray-50/50">{{ $branch->branch_no }}</span>
                </div>
                
                <div class="mb-8">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Location City</label>
                    <h2 class="text-3xl font-black text-gray-900">{{ $branch->city }}</h2>
                </div>

                <div class="space-y-6">
                    <div class="p-4 bg-[#F3F1ED] rounded-2xl border border-gray-50">
                        <label class="text-[9px] font-bold text-[#C9956A] uppercase tracking-widest block mb-1">Full Address</label>
                        <p class="text-sm font-bold text-gray-700 leading-snug">{{ $branch->street }}</p>
                        <p class="text-xs font-medium text-gray-400 mt-1">{{ $branch->postcode }}</p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.branches.edit', $branch->branch_no) }}" class="flex-1 py-3 bg-gray-900 text-white text-center rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-black transition">
                            Edit Branch
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Staff Roster --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest">Team Roster</h3>
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Personnel at this location</p>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 bg-white px-4 py-1.5 rounded-full border border-gray-100 shadow-sm">
                        {{ count($staffs) }} Members
                    </span>
                </div>

                <div class="divide-y divide-gray-50 max-h-[600px] overflow-y-auto">
                    @forelse($staffs as $staff)
                        <div class="p-6 flex items-center justify-between hover:bg-gray-50/30 transition group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-[#F3F1ED] flex items-center justify-center border border-gray-100 overflow-hidden shadow-inner group-hover:border-[#C9956A] transition-colors">
                                    @if($staff->image_path)
                                        <img src="{{ asset('storage/' . $staff->image_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-sm font-bold text-[#C9956A]">{{ substr($staff->first_name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900">{{ $staff->first_name }} {{ $staff->last_name }}</h4>
                                    <p class="text-[10px] font-bold text-[#C9956A] uppercase tracking-widest">{{ $staff->job_title }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-6">
                                <a href="{{ route('admin.staff.show', $staff->staff_no) }}" class="text-[10px] font-bold text-gray-400 hover:text-gray-900 uppercase tracking-[0.2em] transition">View Profile</a>
                                <a href="{{ route('admin.staff.edit', $staff->staff_no) }}" class="p-2.5 bg-[#F3F1ED] rounded-xl text-[#C9956A] hover:bg-[#C9956A] hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-20 text-center">
                            <p class="text-xs font-bold text-gray-300 uppercase tracking-[0.2em]">No staff currently assigned</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection