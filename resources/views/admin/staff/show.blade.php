@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Header Navigation --}}
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.staff.index') }}" class="p-2 rounded-full bg-white shadow-sm hover:bg-gray-50 transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h1 class="text-xl font-bold text-gray-800 tracking-tight">Staff Profile</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Main Profile Card --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Profile Banner/Photo Area --}}
                <div class="bg-[#F3F1ED] p-12 flex justify-center items-center">
                    <div class="w-48 h-48 rounded-2xl overflow-hidden shadow-2xl border-4 border-white rotate-1">
                        @if($staff->image_path)
                            <img src="{{ asset('storage/' . $staff->image_path) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-[#E5E1DA] flex items-center justify-center">
                                <span class="text-5xl font-black text-[#C9956A]">{{ substr($staff->first_name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Name and System ID --}}
                <div class="p-8 flex justify-between items-end">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $staff->first_name }} {{ $staff->last_name }}</h2>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mt-1">Official Staff Record</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">System ID</p>
                        <p class="text-2xl font-black text-[#C9956A] leading-none">{{ $staff->staff_no }}</p>
                    </div>
                </div>
            </div>

            {{-- New: Employment Timeline Section --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                 <div class="flex items-center gap-3 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 tracking-tight">Employment Status</h3>
                    <div class="h-px flex-1 bg-gray-50"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 bg-[#F3F1ED]/50 rounded-2xl border border-gray-50">
                        <label class="text-[9px] font-bold text-[#C9956A] uppercase tracking-widest block mb-1">Date Joined</label>
                        <p class="text-sm font-bold text-gray-700">
                            {{ \Carbon\Carbon::parse($staff->date_joined)->format('F d, Y') }}
                        </p>
                        <p class="text-[10px] text-gray-400 font-medium mt-1">
                            Tenure: {{ \Carbon\Carbon::parse($staff->date_joined)->diffForHumans(null, true) }}
                        </p>
                    </div>
                    <div class="p-4 bg-[#F3F1ED]/50 rounded-2xl border border-gray-50">
                        <label class="text-[9px] font-bold text-[#C9956A] uppercase tracking-widest block mb-1">Position Type</label>
                        <p class="text-sm font-bold text-gray-700">{{ $staff->job_title }}</p>
                        <p class="text-[10px] text-gray-400 font-medium mt-1">Reporting to: {{ $staff->supervisor_no ?? 'Direct Management' }}</p>
                    </div>
                </div>
            </div>

            {{-- Managed Properties Section --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900 tracking-tight">Managed Properties</h3>
                    <span class="px-3 py-1 bg-gray-50 text-[10px] font-bold text-gray-400 rounded-full border uppercase tracking-widest">
                        {{ count($properties ?? []) }} Total
                    </span>
                </div>

                @if(isset($properties) && count($properties) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($properties as $property)
                            <div class="p-4 rounded-2xl bg-[#F3F1ED]/50 border border-gray-50 flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $property->street }}</p>
                                    <p class="text-[10px] font-bold text-[#C9956A] uppercase">{{ $property->property_no }}</p>
                                </div>
                                <a href="{{ route('properties.show', $property->property_no) }}" class="p-2 text-gray-400 hover:text-[#C9956A]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-12 text-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">No properties assigned to this member</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Column: Sidebars --}}
        <div class="space-y-6">
            {{-- Contact Details Card --}}
            <div class="bg-[#5C5047] rounded-3xl p-8 text-white relative overflow-hidden shadow-xl">
                <svg class="absolute bottom-[-20px] right-[-20px] w-32 h-32 text-white/5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                
                <h3 class="text-lg font-bold mb-6">Contact Details</h3>
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest mb-1">Home Address</p>
                        <p class="text-sm font-semibold leading-relaxed">{{ $staff->address }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest mb-1">Telephone</p>
                        <p class="text-xl font-bold">{{ $staff->telephone_no }}</p>
                    </div>
                </div>
            </div>

            {{-- New: Next of Kin Sidebar Card --}}
            @if($nok)
                <div class="space-y-4">
                    <div>
                        {{-- REMOVED nok_ prefix to match your pgAdmin screenshot --}}
                        <p class="text-sm font-black text-gray-900">{{ $nok->full_name }}</p>
                        <p class="text-[10px] font-bold text-[#C9956A] uppercase tracking-widest">{{ $nok->relationship }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Emergency Contact</p>
                        {{-- REMOVED nok_ prefix --}}
                        <p class="text-sm font-bold text-gray-700">{{ $nok->telephone_no }}</p>
                    </div>
                </div>
            @else
                <div class="p-4 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">No Next of Kin</p>
                </div>
            @endif

            {{-- Account Management (RBAC Logic) --}}
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Account Management</h3>
                
                @if(auth()->user()->job_title === 'Admin')
                    <div class="space-y-3">
                        <a href="{{ route('admin.staff.edit', $staff->staff_no) }}" class="block w-full py-3 text-center rounded-xl bg-[#F3F1ED] text-[#5C5047] font-bold text-xs uppercase tracking-widest hover:bg-[#E5E1DA] transition">
                            Modify Staff Record
                        </a>
                        <form action="{{ route('admin.staff.destroy', $staff->staff_no) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="w-full py-3 text-center rounded-xl border border-red-50 text-red-400 font-bold text-[10px] uppercase tracking-widest hover:bg-red-50 transition">
                                Terminate Employment
                            </button>
                        </form>
                    </div>
                @else
                    <div class="p-4 bg-blue-50/50 rounded-2xl border border-blue-50 text-center">
                        <p class="text-[10px] font-bold text-blue-400 uppercase tracking-widest">Only Admins can modify staff records.</p>
                    </div>  
                @endif
            </div>
        </div>
    </div>
</div>
@endsection