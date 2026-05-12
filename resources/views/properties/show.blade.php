@extends('layouts.app')
@section('title', '– Property Details')
@section('breadcrumb', 'Property Details')

@section('extra-styles')
<style>
    :root{--cream:#EEEAE4;--tan:#C9956A;--brown:#5C5047;--teal:#4F7C72;--red:#A03030;--white:#FFFFFF;--text:#2C2520;--text-m:#6e6057;--border:rgba(92,80,71,0.18)}
    .page-title{font-size:32px;font-weight:600;letter-spacing:-.5px;margin-bottom:28px;line-height:1.15}
    .details-grid{display:grid;grid-template-columns:1.3fr 1fr;gap:20px}
    .panel{background:var(--white);border:1px solid var(--border);border-radius:14px;overflow:hidden}
    .panel-img{width:100%;aspect-ratio:16/9;background:var(--cream);display:flex;align-items:center;justify-content:center;overflow:hidden}
    .panel-img img{width:100%;height:100%;object-fit:cover}
    .img-placeholder{text-align:center;color:var(--text-m)}
    .img-placeholder svg{width:48px;height:48px;opacity:.3;display:block;margin:0 auto 8px}
    .panel-body{padding:22px}
    .prop-no-badge{font-size:22px;font-weight:700;color:var(--text);margin-bottom:4px}
    .prop-no-badge span{color:var(--tan)}
    .detail-row{display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid rgba(92,80,71,0.08);font-size:13.5px}
    .detail-row:last-child{border-bottom:none}
    .detail-label{color:var(--text-m);font-weight:500}
    .detail-value{font-weight:500;text-align:right}
    .value-rent{color:var(--teal);font-weight:600;font-size:15px}
    .value-available{color:var(--teal)}
    .value-rented{color:var(--tan)}
    .value-reserved{color:#6b52a1}
    .side-panels{display:flex;flex-direction:column;gap:16px}
    .side-panel{background:var(--brown);border-radius:14px;padding:22px}
    .side-panel-title{font-size:20px;font-weight:600;color:#fff;margin-bottom:16px}
    .side-detail-row{display:flex;flex-direction:column;margin-bottom:10px}
    .side-label{font-size:11px;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.6px;margin-bottom:2px}
    .side-value{font-size:13.5px;color:rgba(255,255,255,.85)}
    .side-value.accent{color:var(--tan);font-weight:600}
    .owner-header{display:flex;align-items:center;gap:14px;margin-bottom:16px}
    .owner-avatar{width:52px;height:52px;border-radius:50%;background:var(--tan);display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:600;color:#fff;flex-shrink:0}
    .owner-tel{color:var(--teal,#4F7C72);font-weight:500}
    .nav-footer {
    display: flex;
    flex-direction: row; /* This ensures they are side-by-side */
    gap: 12px;           /* This adds the space between them */
    margin-top: 24px;    /* Space below the white property card */
    padding-bottom: 20px;
    }

    .btn-nav {
        background: var(--brown);
        color: #fff;
        padding: 10px 24px;
        border-radius: 24px;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap; /* Prevents text from wrapping */
        transition: all 0.2s ease;
    }
    .btn-nav:hover{background:var(--brown-l,#6e6057)}
    .btn-edit-float{position:fixed;bottom:32px;right:32px;background:var(--teal);color:#fff;padding:12px 22px;border-radius:30px;font-size:14px;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:8px;box-shadow:0 4px 20px rgba(79,124,114,.35)}
    .btn-edit-float:hover{background:#3d6158}
</style>
@endsection

@section('content')
<div class="flex items-center gap-4 mb-7">
    {{-- Back Button --}}
    <a href="{{ route('properties.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition shadow-sm" title="Back to List">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
    </a>

    {{-- Title --}}
    <h1 class="text-3xl font-bold tracking-tight text-gray-800">Property Details</h1>
</div>

<div class="details-grid">
    {{-- Left: property card --}}
    <div class="panel">
        <div class="panel-img">
            @if($property->image_path)
                <img src="{{ asset('storage/' . $property->image_path) }}" 
                alt="Property" 
                style="width: 100%; height: 100%; object-fit: cover;">
                
            @else
                <div class="img-placeholder">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    IMAGE
                </div>
            @endif
        </div>
        <div class="panel-body">
            <div class="prop-no-badge">Property Number: <span>{{ $property->property_no }}</span></div>
            <div style="font-size:13px;color:var(--text-m);margin-bottom:18px">
                {{ $property->street }}, {{ $property->area ? $property->area.', ' : '' }}{{ $property->city }}
            </div>

            <div class="detail-row">
                <span class="detail-label">Type</span>
                <span class="detail-value">{{ $property->type_of_property }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Number of Rooms</span>
                <span class="detail-value">{{ $property->number_of_rooms }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Monthly Rent</span>
                <span class="detail-value value-rent">₱{{ number_format($property->monthly_rent, 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value value-{{ strtolower($property->status) }}">{{ $property->status }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Street</span>
                <span class="detail-value">{{ $property->street }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Area</span>
                <span class="detail-value">{{ $property->area ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">City</span>
                <span class="detail-value">{{ $property->city }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Postcode</span>
                <span class="detail-value">{{ $property->postcode }}</span>
            </div>
        </div>
    </div>

    {{-- Right: owner + branch --}}
    <div class="side-panels">
        <div class="side-panel">
            <div class="side-panel-title">Owner</div>
            <div class="owner-header">
                <div class="owner-avatar" style="overflow: hidden; background: var(--tan);">
                    @if($property->owner_photo) {{-- Make sure you used 'owner_photo' as the alias in your Controller --}}
                        <img src="{{ asset('storage/' . $property->owner_photo) }}" 
                            style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        {{ strtoupper(substr($property->owner_name ?? 'O', 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div style="color:#fff;font-weight:500;font-size:14px">{{ $property->owner_name ?? '—' }}</div>
                    <div style="font-size:12px;color:rgba(255,255,255,.45)">{{ $property->owner_no }}</div>
                </div>
            </div>
            <div class="side-detail-row">
                <span class="side-label">Address</span>
                <span class="side-value">{{ $property->owner_address ?? '—' }}</span>
            </div>
            <div class="side-detail-row">
                <span class="side-label">Telephone</span>
                <span class="side-value owner-tel">{{ $property->owner_telephone ?? '—' }}</span>
            </div>
        </div>

        <div class="side-panel">
            <div class="side-panel-title">Branch</div>
            <div class="side-detail-row">
                <span class="side-label">Branch No.</span>
                <span class="side-value accent">{{ $property->branch_no }}</span>
            </div>
            <div class="side-detail-row">
                <span class="side-label">Street</span>
                <span class="side-value">{{ $property->branch_street ?? '—' }}</span>
            </div>
            <div class="side-detail-row">
                <span class="side-label">Area</span>
                <span class="side-value">{{ $property->branch_area ?? '—' }}</span>
            </div>
            <div class="side-detail-row">
                <span class="side-label">City</span>
                <span class="side-value">{{ $property->branch_city ?? '—' }}</span>
            </div>
            <div class="side-detail-row">
                <span class="side-label">Postcode</span>
                <span class="side-value">{{ $property->branch_postcode ?? '—' }}</span>
            </div>
            <div class="side-detail-row">
                <span class="side-label">Fax Number</span>
                <span class="side-value">{{ $property->branch_fax ?? '—' }}</span>
            </div>
        </div>
    </div>
</div>

<div class="nav-footer">
    @if($prevNo)
        <a href="{{ route('properties.show', $prevNo) }}" class="btn-nav">
            ← Previous
        </a>
    @endif
    
    @if($nextNo)
        <a href="{{ route('properties.show', $nextNo) }}" class="btn-nav">
            Next →
        </a>
    @endif
</div>


@if(in_array(auth()->user()->job_title, ['Manager', 'Supervisor']))
    <a href="{{ route('properties.edit', $property->property_no) }}" class="btn-edit-float">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
        </svg>
        Edit Property
    </a>
@endif

<a href="{{ route('properties.edit', $property->property_no) }}" class="btn-edit-float">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    Edit Property
</a>
@endsection