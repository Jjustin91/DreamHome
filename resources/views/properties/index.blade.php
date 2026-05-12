@extends('layouts.app')

@section('title', 'Property List')
@section('breadcrumb', 'Property Management')

@section('extra-styles')
<style>
    :root {
        --cream:#EEEAE4; --tan:#C9956A; --brown:#5C5047; --teal:#4F7C72;
    }
    .prop-table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; border: 1px solid rgba(0,0,0,0.1); }
    .prop-table th { background: var(--brown); color: white; padding: 12px; text-align: left; font-size: 13px; text-transform: uppercase; }
    .prop-table td { padding: 15px 12px; border-bottom: 1px solid #eee; font-size: 14px; }
    .btn-view { color: var(--teal); font-weight: 600; text-decoration: none; margin-right: 10px; }
    .btn-edit { color: var(--tan); font-weight: 600; text-decoration: none; }
    .header-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
</style>
@endsection

@section('content')
<div class="header-actions">
    <h2 class="text-2xl font-bold text-gray-800">Manage Properties</h2>
    
    {{-- Only Managers and Supervisors can see the 'Add' button --}}
    @if(in_array(auth()->user()->job_title, ['Admin', 'Manager']))
        <a href="{{ route('properties.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 transition ease-in-out duration-150">
            + Add Property
        </a>
    @endif
</div>

@if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #b91c1c;">
        {{ session('success') }}
    </div>
@endif

<div style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 24px;">
    <form action="{{ route('properties.index') }}" method="GET" style="display: flex; gap: 15px; align-items: center;">
        
        {{-- Search Input --}}
        <div style="flex-grow: 1; position: relative;">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Search by street, city, or owner..." 
                   style="width: 100%; padding: 10px 15px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: #f8fafc;">
        </div>

        {{-- Status Filter --}}
        <select name="status" style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; background: white; color: #475569;">
            <option value="">All Status</option>
            <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
            <option value="Rented" {{ request('status') == 'Rented' ? 'selected' : '' }}>Rented</option>
        </select>

        {{-- Action Buttons --}}
        <button type="submit" style="background: #C9956A; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.2s;">
            Search
        </button>
        
        @if(request()->has('search') || request()->has('status'))
            <a href="{{ route('properties.index') }}" style="color: #64748b; font-size: 13px; text-decoration: none; font-weight: 500;">Clear Filters</a>
        @endif
    </form>
</div>

<table class="prop-table shadow-sm">
    <thead>
        <tr>
            <th>Property Street</th>
            <th>City</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($properties as $property)
        <tr>
            <td class="font-semibold">{{ $property->street }}</td>
            <td>{{ $property->city }}</td>
            <td>
                <span class="px-2 py-1 rounded-full text-xs {{ $property->status == 'Available' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                    {{ $property->status }}
                </span>
            </td>
            <td>
                <div class="flex items-center gap-3">
                    {{-- Everyone sees View --}}
                    <a href="{{ route('properties.show', $property->property_no) }}" class="text-teal-600">View</a>

                    {{-- Managers and Supervisors can see Edit --}}
                    @if(in_array(auth()->user()->job_title, ['Admin', 'Manager', 'Supervisor']))
                        <a href="{{ route('properties.edit', $property->property_no) }}" class="text-tan-600">Edit</a>
                    @endif

                    {{-- ONLY the Manager can see and use Delete --}}
                    @if(in_array(auth()->user()->job_title, ['Admin', 'Manager']))
                        <form action="{{ route('properties.destroy', $property->property_no) }}" method="POST" onsubmit="return confirm('Delete this property permanently?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 font-medium">Delete</button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-6">
    {{ $properties->links() }}
</div>
@endsection