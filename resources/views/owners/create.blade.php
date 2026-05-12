@extends('layouts.app')
@section('title', '– Add Owner')

@section('content')
<form method="POST" action="{{ route('owners.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- The Fixed Professional Header --}}
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
        <div class="page-title" style="font-size: 28px; font-weight: 600; color: #1a202c;">
            Add New Owner
            <small style="display:block; font-size:13px; font-weight:400; color:#718096; margin-top:4px;">
                Fill in all required fields marked with *
            </small>
        </div>
        <div style="display:flex;gap:10px">
            <a href="{{ route('owners.index') }}" 
               style="background: white; color: #A03030; border: 1.5px solid rgba(160,48,48,.3); padding: 10px 20px; border-radius: 24px; font-size: 13.5px; font-weight: 600; text-decoration: none; cursor: pointer; display: flex; align-items: center; gap: 8px;">
               <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
               Cancel
            </a>
            <button type="submit" 
                style="background: #14b8a6; color: white; border: none; padding: 10px 20px; border-radius: 24px; font-size: 13.5px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                 Save Owner
            </button>
        </div>
    </div>

    {{-- The Redesigned Form Card (Matches Property/Owner Detail panels) --}}
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 14px; padding: 24px; max-width: 600px; margin: 0 auto;">
        
        <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #718096; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0;">
            Owner Details
        </div>

        <div style="margin-bottom: 16px; margin-top: 24px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
            <label style="display:block; font-size:12px; font-weight:500; color:#718096; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                Owner Photo
            </label>    
                <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 30px;">
    
                    {{-- The Circular Preview Box --}}
                    <div id="createPreview" style="width: 140px; height: 140px; border-radius: 50%; background: #EEEAE4; border: 3px dashed var(--tan); overflow: hidden; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; cursor: pointer; transition: 0.3s; position: relative;" onclick="document.getElementById('owner_image').click()">
                        {{-- Default Placeholder Icon --}}
                        <div id="placeholder_content" style="text-align: center; color: var(--tan); opacity: 0.6;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 4px;">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <div style="font-size: 10px; font-weight: 600; text-transform: uppercase;">Preview</div>
                        </div>
                    </div>

                    {{-- The Styled Upload Button --}}
                    <label class="file-btn" for="owner_image" style="background: #fff; border: 1.5px solid #d1d5db; color: #374151; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: 0.2s;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Choose file
                    </label>

                    {{-- Hidden File Input --}}
                    <input type="file" id="owner_image" name="image_path" accept="image/*" style="display:none" onchange="previewImg(this, 'createPreview')">
                </div>
            
        </div>

        {{-- Row: Name --}}
        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:12px; font-weight:500; color:#718096; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                Full Name <span style="color:#A03030;">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Maria Clara" 
                   style="width: 100%; padding: 9px 13px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; background: #EEEAE4; outline: none;">
            @error('name')<div style="color: #A03030; font-size: 12px; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>

        {{-- Row: Address --}}
        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:12px; font-weight:500; color:#718096; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                Address <span style="color:#A03030;">*</span>
            </label>
            <textarea name="address" rows="3" placeholder="Street, City, Postcode"
                      style="width: 100%; padding: 9px 13px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; background: #EEEAE4; outline: none; font-family: inherit;">{{ old('address') }}</textarea>
            @error('address')<div style="color: #A03030; font-size: 12px; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>

        {{-- Row: Telephone --}}
        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:12px; font-weight:500; color:#718096; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
                Telephone Number <span style="color:#A03030;">*</span>
            </label>
            <input type="text" name="telephone_no" value="{{ old('telephone_no') }}" placeholder="e.g. 0912-345-6789" 
                   style="width: 100%; padding: 9px 13px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; background: #EEEAE4; outline: none;">
            @error('telephone_no')<div style="color: #A03030; font-size: 12px; margin-top: 5px;">{{ $message }}</div>@enderror
        </div>


    </div>
</form>
<script>
    function previewImg(input, previewId) {
        const box = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                // Replaces the placeholder SVG with the actual image
                box.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">`;
                // Optional: Change border to solid once image is picked
                box.style.borderStyle = 'solid';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection