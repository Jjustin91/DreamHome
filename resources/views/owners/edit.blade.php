@extends('layouts.app')
@section('title', '– Edit Owner')

@section('content')
@if ($errors->any())
    <div style="background: #fee2e2; border: 1.5px solid #ef4444; color: #991b1b; padding: 16px; border-radius: 12px; margin-bottom: 24px;">
        <p style="font-weight: 700; font-size: 14px; margin-bottom: 8px; text-transform: uppercase;">Update Blocked:</p>
        <ul style="font-size: 13px; font-weight: 500;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('owners.update', $owner->owner_no) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Header: Styled like Manage Properties, Color shifted to Tan --}}
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
        <div class="page-title" style="font-size: 28px; font-weight: 600; color: #1a202c;">
            Edit Owner Profile
            <small style="display:block; font-size:13px; font-weight:400; color:#718096; margin-top:4px;">
                Updating records for ID: <span style="color:#C9956A; font-weight:600;">{{ $owner->owner_no }}</span>
            </small>
        </div>
        <div style="display:flex;gap:10px">
            <a href="{{ route('owners.index') }}" 
               style="background: white; color: #A03030; border: 1.5px solid rgba(160,48,48,.3); padding: 10px 20px; border-radius: 24px; font-size: 13.5px; font-weight: 600; text-decoration: none; cursor: pointer; display: flex; align-items: center; gap: 8px;">
               <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
               Cancel
            </a>
            <button type="submit" 
                style="background: #C9956A; color: white; border: none; padding: 10px 20px; border-radius: 24px; font-size: 13.5px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 12a10 10 0 0115.5-8.1L21.5 8M22 12a10 10 0 01-15.5 8.1L2.5 16"/></svg>
                Update Profile
            </button>
        </div>
    </div>

    {{-- The Redesigned Form Card --}}
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 14px; padding: 24px; max-width: 600px; margin: 0 auto;">
        
        <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #718096; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0;">
            Information Details
        </div>
        <div style="background: white; border: 1px solid var(--border); border-radius: 14px; padding: 24px; margin-top: 24px;">
        <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--text-m); margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid var(--border);">
            Profile 
        </div>

        {{-- Action Row: Button on the left --}}
        <div style="margin-bottom: 15px;">
            <label class="file-btn" for="owner_image" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; background: #fff; transition: all 0.2s;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                Choose file
            </label>
            <input type="file" id="owner_image" name="image_path" accept="image/*" style="display:none" onchange="previewImg(this, 'editPreview')">
        </div>

        {{-- Preview Box: Centered Placeholder --}}
        <div id="editPreview" style="width: 100%; aspect-ratio: 4/3; border: 2px dashed #d1d5db; border-radius: 12px; background: #EEEAE4; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
            @if($owner->image_path)
                {{-- Shows existing image by default --}}
                <img src="{{ asset('storage/' . $owner->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                {{-- Centered Placeholder Icon and Text --}}
                <div style="text-align: center; color: #8c7e73;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" style="margin-bottom: 10px; opacity: 0.5;">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <div style="font-size: 14px; opacity: 0.8;">Image preview</div>
                </div>
            @endif
        </div>

        {{-- Row: System ID (Read-only like Property Number) --}}
        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:12px; font-weight:500; color:#718096; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                Owner ID
            </label>
            <input type="text" value="{{ $owner->owner_no }}" readonly
                   style="width: 100%; padding: 9px 13px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; background: #EEEAE4; outline: none; opacity:0.7; color:#C9956A; font-weight:600;">
        </div>

        {{-- Row: Name --}}
        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:12px; font-weight:500; color:#718096; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                Full Name <span style="color:#A03030;">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $owner->name) }}"
                   style="width: 100%; padding: 9px 13px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; background: #EEEAE4; outline: none;">
            @error('name')<div style="color: #A03030; font-size: 12px; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>

        {{-- Row: Address --}}
        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:12px; font-weight:500; color:#718096; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                Address <span style="color:#A03030;">*</span>
            </label>
            <textarea name="address" rows="3"
                      style="width: 100%; padding: 9px 13px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; background: #EEEAE4; outline: none; font-family: inherit;">{{ old('address', $owner->address) }}</textarea>
            @error('address')<div style="color: #A03030; font-size: 12px; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>

        {{-- Row: Telephone --}}
        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:12px; font-weight:500; color:#718096; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                Telephone Number <span style="color:#A03030;">*</span>
            </label>
            <input type="text" name="telephone_no" value="{{ old('telephone_no', $owner->telephone_no) }}"
                   style="width: 100%; padding: 9px 13px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; background: #EEEAE4; outline: none;">
            @error('telephone_no')<div style="color: #A03030; font-size: 12px; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>
        

</form>
    <script>
        function previewImg(input, previewId) {
            const box = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    box.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection