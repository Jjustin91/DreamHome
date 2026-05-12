@extends('layouts.app')

@section('title', 'Staff Management')
@section('breadcrumb', 'Administration / Staff Management')

@section('content')
<div class="space-y-6">
    {{-- Main Page Header --}}
    <div class="flex items-center justify-between gap-4 p-4 border border-gray-100 bg-white shadow-sm rounded-xl">
        <div class="flex items-center gap-4">
            <div class="p-3.5 bg-[#EEEAE4] rounded-lg">
                <svg class="w-6 h-6 text-[#5C5047]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.95-4.57 6.75 6.75 0 011.704 5.12z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-950">Staff Members</h1>
                <p class="text-base text-gray-600 mt-1">Manage all employees, supervisors, and managers of the DreamHome system.</p>
            </div>
        </div>
        
        <a href="{{ route('admin.staff.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#5C5047] text-[#EEEAE4] rounded-xl font-semibold hover:bg-[#4E443C] transition shadow-sm">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
            </svg>
            Add New Staff
        </a>
    </div>

    @if(session('success'))
        <div id="success-notification" class="mb-6 flex items-center justify-between p-4 bg-green-50 border-l-4 border-green-500 rounded-xl">
                <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-bold text-green-800 uppercase tracking-wider">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-center gap-3">
            <div class="w-2 h-2 bg-red-400 rounded-full"></div>
            <p class="text-xs font-bold text-red-600 uppercase tracking-widest">{{ session('error') }}</p>
        </div>
    @endif

    {{-- Search Bar Section --}}
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.staff.index') }}" method="GET" class="flex items-center gap-3 w-full max-w-md">
            <input type="text" name="search" placeholder="Search staff name..." value="{{ request('search') }}" 
                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#C9956A] focus:border-transparent outline-none transition text-sm">
            <button type="submit" class="px-6 py-2.5 bg-[#C9956A] text-white rounded-lg font-bold hover:bg-[#b07d56] transition shadow-sm text-sm">
                Search
            </button>
        </form>
    </div>

    

    {{-- Data Table Card --}}
    <div class="bg-white p-2 rounded-xl shadow-sm border border-gray-100">
        <table class="w-full text-left border-collapse table-fixed">
            <thead class="border-b border-gray-100">
                <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.1em]">
                    <th class="p-5 w-1/4">Name</th>
                    <th class="p-5 w-1/4">Contact Information</th>
                    <th class="p-5 w-1/6">Position</th>
                    <th class="p-5 w-1/6">Branch Assignment</th>
                    <th class="p-5 w-1/6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($staffs as $staff)
                <tr class="hover:bg-gray-50/50 transition">
                    {{-- NAME COLUMN --}}
                    <td class="p-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-[#F3F1ED] flex items-center justify-center border border-gray-100 shadow-sm">
                                @if($staff->image_path)
                                    {{-- This path works only AFTER running the storage:link command --}}
                                    <img src="{{ asset('storage/' . $staff->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    {{-- Fallback to Initial if no photo --}}
                                    <span class="text-sm font-bold text-[#C9956A]">{{ substr($staff->first_name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-gray-900">{{ $staff->first_name }} {{ $staff->last_name }}</div>
                                <div class="text-[10px] font-bold text-[#C9956A] uppercase">{{ $staff->staff_no }}</div>
                            </div>
                        </div>
                    </td>

                    {{-- CONTACT INFO --}}
                    <td class="p-5">
                        {{-- Since there is no email in your screenshot, use telephone_no --}}
                        <p class="font-semibold text-gray-800 text-sm truncate">{{ $staff->telephone_no ?? 'No Phone' }}</p>
                        <p class="text-[10px] text-gray-400 uppercase font-medium tracking-tight">Primary Contact</p>
                    </td>

                    {{-- POSITION --}}
                    <td class="p-5">
                        @php
                            $title = strtolower($staff->job_title ?? '');
                            $badge = 'bg-gray-100 text-gray-600';
                            if(str_contains($title, 'admin')) $badge = 'bg-red-100 text-red-700';
                            elseif(str_contains($title, 'manager')) $badge = 'bg-blue-100 text-blue-700';
                        @endphp
                        <span class="px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $badge }}">
                            {{ $staff->job_title ?? 'Staff' }}
                        </span>
                    </td>

                    {{-- BRANCH --}}
                    <td class="p-5">
                        <p class="font-bold text-gray-800 text-sm leading-tight">{{ $staff->branch_city ?? 'Active' }} Branch</p>
                        <p class="text-[10px] text-gray-400 uppercase font-medium mt-0.5">{{ $staff->branch_no }}</p>
                    </td>

                    {{-- ACTIONS --}}
                    <td class="p-5">
                        <div class="flex items-center gap-3">
                            {{-- View Button --}}
                            <a href="{{ route('admin.staff.show', $staff->staff_no) }}" class="text-xs font-bold text-blue-500 hover:underline uppercase tracking-widest">
                                View
                            </a>

                            {{-- Edit Button --}}
                            <a href="{{ route('admin.staff.edit', $staff->staff_no) }}" class="text-xs font-bold text-gray-900 hover:underline uppercase tracking-widest">
                                Edit
                            </a>

                            {{-- Delete Button --}}
                            <form action="{{ route('admin.staff.destroy', $staff->staff_no) }}" method="POST" onsubmit="return confirm('Delete this staff member?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-red-500 hover:underline uppercase tracking-widest">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-500">No staff members found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection