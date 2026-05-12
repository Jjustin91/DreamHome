@extends('layouts.app')

@section('content')
{{-- Header Arranged like Manage Properties --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <h2 style="font-size: 24px; font-weight: 600; color: #1a202c; margin: 0;">Owners Information</h2>
    
    @if(session('success'))
        <div id="success-alert" class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center justify-between shadow-sm animate-fade-in">
            <div class="flex items-center gap-3">
                {{-- Modern Checkmark Icon --}}
                <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center shadow-lg shadow-green-200">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-green-800 uppercase tracking-[0.2em] mb-0.5">System Update</p>
                    <p class="text-xs font-bold text-green-600 tracking-tight">{{ session('success') }}</p>
                </div>
            </div>
            
            {{-- Close Button --}}
            <button onclick="document.getElementById('success-alert').remove()" class="text-green-400 hover:text-green-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    @if(in_array(auth()->user()->job_title, ['Admin', 'Manager']))
        <a href="{{ route('owners.create') }}" 
           style="background: #14b8a6; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 14px; text-transform: uppercase;">
           + ADD OWNER
        </a>
    @endif
</div>

{{-- Search Bar (Optional but helpful) --}}
<div style="margin-bottom: 30px;">
    <form action="{{ route('owners.index') }}" method="GET" style="display: flex; gap: 10px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search owner name..." 
               style="padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; width: 300px; outline: none;">
        <button type="submit" style="background: #C9956A; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">Search</button>
    </form>
</div>

{{-- The ID Card Grid --}}
<div class="owner-grid">
    @foreach($owners as $owner)
    <div class="owner-card">
        <div class="card-inner">
            <div class="photo-section">
                @if(isset($owner->image_path) && $owner->image_path)
                    <img src="{{ asset('storage/' . $owner->image_path) }}" alt="Owner Photo">
                @else
                    <div class="photo-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                            <circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0113 0"/>
                        </svg>
                    </div>
                @endif
            </div>

            <div class="info-section">
                <span class="owner-id">{{ $owner->owner_no }}</span>
                <h3 class="owner-name">{{ $owner->name }}</h3>
                <p class="owner-contact">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                    {{ $owner->telephone_no }}
                </p>
            </div>

            <div class="action-section">
                <a href="{{ route('owners.show', $owner->owner_no) }}" class="btn-view">View</a>
                @if(in_array(auth()->user()->job_title, ['Admin', 'Manager', 'Supervisor']))
                    <a href="{{ route('owners.edit', $owner->owner_no) }}" class="btn-edit">Edit</a>
                @endif
                @if(in_array(auth()->user()->job_title, ['Admin', 'Manager']))
                    <form action="{{ route('owners.destroy', $owner->owner_no) }}" method="POST" style="display:inline;" onsubmit="return confirm('Remove this owner?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-12">
    {{ $owners->appends(request()->query())->links() }}
</div>

<style>
    .owner-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
    }
    .owner-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.2s ease;
    }
    .owner-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .card-inner { padding: 20px; text-align: center; }
    
    .photo-section {
        width: 80px; height: 80px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #EEEAE4;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden; border: 2px solid #C9956A;
    }
    .photo-section img { width: 100%; height: 100%; object-fit: cover; }
    .photo-placeholder { color: #5C5047; opacity: 0.5; width: 40px; }

    .owner-id { font-size: 11px; color: #C9956A; font-weight: 700; text-transform: uppercase; }
    .owner-name { font-size: 18px; font-weight: 600; color: #2d3748; margin: 5px 0; }
    .owner-contact { font-size: 13px; color: #718096; display: flex; align-items: center; justify-content: center; gap: 6px; }

    .action-section {
        margin-top: 20px; padding-top: 15px;
        border-top: 1px solid #f7fafc;
        display: flex; justify-content: space-around;
        align-items: center;
    }
    
    .btn-view { color: #4F7C72; text-decoration: none; font-size: 12px; font-weight: 700; line-height: 1; }
    .btn-edit { color: #C9956A; text-decoration: none; font-size: 12px; font-weight: 700; line-height: 1; }
    .btn-delete { color: #A03030; background: none; border: none; font-size: 12px; font-weight: 700; cursor: pointer; line-height: 1; }
</style>
<script>
    setTimeout(function() {
        let alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000); // 5 seconds
</script>

@endsection