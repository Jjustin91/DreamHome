<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Property Details
        </h2>
    </x-slot>

    <style>
        :root{--cream:#EEEAE4;--tan:#C9956A;--brown:#5C5047;--teal:#4F7C72;}
        .details-grid{display:grid;grid-template-columns:1.3fr 1fr;gap:20px}
        .panel{background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden}
        .panel-img{width:100%;aspect-ratio:16/9;background:var(--cream);display:flex;align-items:center;justify-content:center;overflow:hidden}
        .detail-row{display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid rgba(0,0,0,0.05);font-size:13.5px}
        .side-panel{background:var(--brown);border-radius:14px;padding:22px; color:white;}
        
        /* Floating Edit Button Styles */
        .btn-edit-float{position:fixed;bottom:32px;right:32px;background:var(--teal);color:#fff;padding:12px 22px;border-radius:30px;font-size:14px;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:8px;box-shadow:0 4px 20px rgba(79,124,114,.35); transition: 0.2s;}
        .btn-edit-float:hover{background:#3d6158}
    </style>

    <div class="mb-6">
        <a href="{{ route('properties.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900">
            ← Back to List
        </a>
    </div>

    <div class="details-grid">
        <div class="panel">
            <div class="panel-img">
                @if($property->image_path)
                    <img src="{{ asset('storage/' . $property->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="color:#6e6057; text-align:center;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" class="w-12 h-12 mx-auto mb-2 opacity-30"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        NO IMAGE
                    </div>
                @endif
            </div>
            <div class="p-6">
                <div class="mb-4 text-2xl font-bold">Property: <span style="color:var(--tan)">{{ $property->property_no }}</span></div>
                <div class="detail-row"><span class="font-medium text-gray-500">Monthly Rent</span><span class="font-bold text-teal-600">₱{{ number_format($property->monthly_rent, 2) }}</span></div>
                <div class="detail-row"><span class="font-medium text-gray-500">Status</span><span class="font-bold" style="color: {{ $property->status == 'Available' ? 'var(--teal)' : 'var(--tan)' }}">{{ $property->status }}</span></div>
                <div class="detail-row"><span class="font-medium text-gray-500">Type</span><span>{{ $property->type_of_property }}</span></div>
                <div class="detail-row"><span class="font-medium text-gray-500">Rooms</span><span>{{ $property->number_of_rooms }}</span></div>
                <div class="detail-row"><span class="font-medium text-gray-500">Street</span><span>{{ $property->street }}</span></div>
                <div class="detail-row"><span class="font-medium text-gray-500">Area</span><span>{{ $property->area ?? '—' }}</span></div>
                <div class="detail-row"><span class="font-medium text-gray-500">City</span><span>{{ $property->city }}</span></div>
                <div class="detail-row"><span class="font-medium text-gray-500">Postcode</span><span>{{ $property->postcode }}</span></div>
            </div>
        </div>

        <div class="flex flex-col gap-4">
            <div class="side-panel">
                <div class="mb-4 text-lg font-bold">Owner Details</div>
                <div class="flex items-center gap-4 mb-4">
                    <div style="width:50px; height:50px; border-radius:50%; background:var(--tan); overflow:hidden;">
                        @if($property->owner_photo)
                            <img src="{{ asset('storage/' . $property->owner_photo) }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-lg font-bold text-white">
                                {{ strtoupper(substr($property->owner_name ?? 'O', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="font-bold">{{ $property->owner_name ?? '—' }}</div>
                        <div class="text-sm opacity-70">{{ $property->owner_no }}</div>
                    </div>
                </div>
                <div class="mb-2 text-sm"><span class="opacity-70">Tel:</span> {{ $property->owner_telephone ?? '—' }}</div>
                <div class="mb-2 text-sm"><span class="opacity-70">Address:</span> {{ $property->owner_address ?? '—' }}</div>
            </div>

            <div class="side-panel">
                <div class="mb-4 text-lg font-bold">Branch Details</div>
                <div class="mb-2 text-sm"><span class="opacity-70">Branch No:</span> <span style="color:var(--tan)" class="font-bold">{{ $property->branch_no }}</span></div>
                <div class="mb-2 text-sm"><span class="opacity-70">Street:</span> {{ $property->branch_street ?? '—' }}</div>
                <div class="mb-2 text-sm"><span class="opacity-70">City:</span> {{ $property->branch_city ?? '—' }}</div>
                <div class="mb-2 text-sm"><span class="opacity-70">Postcode:</span> {{ $property->branch_postcode ?? '—' }}</div>
            </div>
        </div>
    </div>

    {{-- Restored Next / Previous Navigation Footer --}}
    <div class="flex gap-4 pb-8 mt-8">
        @if($prevNo)
            <a href="{{ route('properties.show', $prevNo) }}" class="px-6 py-2 text-sm font-bold text-white transition-opacity rounded-full" style="background: var(--brown); hover:opacity:0.9;">
                ← Previous
            </a>
        @endif
        
        @if($nextNo)
            <a href="{{ route('properties.show', $nextNo) }}" class="px-6 py-2 text-sm font-bold text-white transition-opacity rounded-full" style="background: var(--brown); hover:opacity:0.9;">
                Next →
            </a>
        @endif
    </div>

    {{-- Restored Floating Edit Button --}}
    @hasanyrole('Super Admin|Manager|Supervisor')
        <a href="{{ route('properties.edit', $property->property_no) }}" class="btn-edit-float">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit Property
        </a>
    @endhasanyrole
</x-app-layout>