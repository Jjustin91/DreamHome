@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Success Notification --}}

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Branch Offices</h1>
                <p class="text-sm text-gray-500 mt-1 font-medium">Manage all DreamHome physical office locations.</p>
            </div>
            <a href="{{ route('admin.branches.create') }}" class="px-6 py-3 bg-[#5C5047] text-white rounded-2xl font-bold text-xs uppercase tracking-widest shadow-lg hover:bg-[#4E443C] transition">
                + Add New Branch
            </a>
        </div>
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('admin.branches.index') }}" method="GET" class="flex items-center w-full max-w-md bg-white rounded-2xl shadow-sm border border-gray-100 p-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search branch city or ID..." 
                    class="w-full px-5 py-3 rounded-xl border-none bg-transparent text-sm focus:ring-0 placeholder-gray-300 font-medium">
                <button type="submit" class="px-6 py-3 bg-[#C9956A] text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#b07d56] transition shadow-md">
                    Search
                </button>
            </form>

            @if(request('search'))
                <a href="{{ route('admin.branches.index') }}" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-[#5C5047] flex items-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                    Clear Search
                </a>
            @endif
        </div>

        <table class="w-full text-left">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="p-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Branch ID</th>
                    <th class="p-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Location</th>
                    <th class="p-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Postcode</th>
                    <th class="p-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($branches as $branch)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-5">
                        <span class="px-3 py-1 bg-[#F3F1ED] text-[#C9956A] font-black rounded-lg text-sm">{{ $branch->branch_no }}</span>
                    </td>
                    <td class="p-5">
                        <div class="font-bold text-gray-900">{{ $branch->city }}</div>
                        <div class="text-[11px] text-gray-400 font-medium">{{ $branch->street }}</div>
                    </td>
                    <td class="p-5 font-mono text-xs text-gray-500">{{ $branch->postcode }}</td>
                    <td class="p-5 text-right">
                        <div class="flex justify-end items-center gap-6">
                            {{-- VIEW ACTION --}}
                            <a href="{{ route('admin.branches.show', $branch->branch_no) }}" 
                            class="text-[10px] font-bold text-blue-400 uppercase tracking-[0.2em] hover:text-blue-600 transition">
                                View
                            </a>

                            {{-- EDIT ACTION --}}
                            <a href="{{ route('admin.branches.edit', $branch->branch_no) }}" 
                            class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] hover:text-[#C9956A] transition">
                                Edit
                            </a>

                            {{-- DELETE ACTION --}}
                            <form action="{{ route('admin.branches.destroy', $branch->branch_no) }}" method="POST" 
                                onsubmit="return confirm('Are you sure you want to delete this branch?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-[10px] font-bold text-red-300 uppercase tracking-[0.2em] hover:text-red-500 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection