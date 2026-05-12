@extends('layouts.app')
@section('title', '– Edit Property')
@section('breadcrumb', 'Edit Property')

@section('extra-styles')
{{-- Reuse same styles as create --}}
<style>
    :root{--cream:#EEEAE4;--tan:#C9956A;--tan-d:#b07d55;--brown:#5C5047;--teal:#4F7C72;--red:#A03030;--white:#FFFFFF;--text:#2C2520;--text-m:#6e6057;--border:rgba(92,80,71,0.18)}
    .page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px}
    .page-title{font-size:32px;font-weight:600;letter-spacing:-.5px;line-height:1.15}
    .page-title small{display:block;font-size:13px;font-weight:400;color:var(--text-m);margin-top:4px}
    .btn-primary{background:var(--teal);color:#fff;border:none;padding:10px 20px;border-radius:24px;font-size:13.5px;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:8px;text-decoration:none;transition:background .15s}
    .btn-primary:hover{background:#3d6158}
    .btn-cancel{background:#fff;color:var(--red);border:1.5px solid rgba(160,48,48,.3);padding:10px 20px;border-radius:24px;font-size:13.5px;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:8px;text-decoration:none;transition:all .15s}
    .btn-cancel:hover{background:rgba(160,48,48,.06)}
    .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
    .form-panel{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:24px}
    .form-panel-title{font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--text-m);margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid var(--border)}
    .form-row{margin-bottom:16px}
    .form-label{display:block;font-size:12px;font-weight:500;color:var(--text-m);margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px}
    .form-label.required::after{content:' *';color:var(--red)}
    .form-control{width:100%;padding:9px 13px;border:1px solid var(--border);border-radius:8px;font-size:13.5px;background:var(--cream);outline:none;transition:border-color .15s;font-family:inherit}
    .form-control:focus{border-color:var(--tan);background:#fff}
    .form-control[readonly]{opacity:.6;cursor:not-allowed}
    .form-control.is-invalid{border-color:var(--red)}
    .invalid-feedback{font-size:11.5px;color:var(--red);margin-top:4px}
    .preview-box{width:100%;aspect-ratio:4/3;border:2px dashed var(--border);border-radius:10px;display:flex;align-items:center;justify-content:center;background:var(--cream);overflow:hidden;margin-top:8px}
    .preview-box img{width:100%;height:100%;object-fit:cover;border-radius:8px}
    .preview-placeholder{text-align:center;color:var(--text-m);font-size:12px}
    .preview-placeholder svg{width:32px;height:32px;margin-bottom:8px;opacity:.4}
    .file-btn{display:inline-flex;align-items:center;gap:7px;padding:7px 14px;border:1px solid var(--border);border-radius:7px;font-size:12.5px;cursor:pointer;background:#fff;transition:all .15s}
    .file-btn:hover{border-color:var(--tan);color:var(--tan)}
    .select-control{width:100%;padding:9px 13px;border:1px solid var(--border);border-radius:8px;font-size:13.5px;background:var(--cream);outline:none;font-family:inherit}
    .select-control:focus{border-color:var(--tan);background:#fff}
    .readonly-note{font-size:11px;color:var(--text-m);font-style:italic;margin-top:3px}
</style>
@endsection

@section('content')
<form method="POST" action="{{ route('properties.update', $property->property_no) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<div class="page-header">
    <div class="page-title">
        Edit Property
        <small>Property No: <strong style="color:var(--tan)">{{ $property->property_no }}</strong></small>
    </div>
    <div style="display:flex;gap:10px">
        <a href="{{ route('properties.index') }}" class="btn-cancel">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            Cancel
        </a>
        <button type="submit" class="btn-primary">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            Save Changes
        </button>
    </div>
</div>

<div class="form-grid">
    <div style="display:flex;flex-direction:column;gap:20px">
        <div class="form-panel">
            <div class="form-panel-title">Property Details</div>

            <div class="form-row">
                <label class="form-label" style="color:var(--tan)">Property Number</label>
                <input class="form-control" type="text" value="{{ $property->property_no }} (Cannot be changed.)" readonly>
                <div class="readonly-note">This field is read-only.</div>
            </div>
            <div class="form-row">
                <label class="form-label required">Street</label>
                <input class="form-control {{ $errors->has('street') ? 'is-invalid' : '' }}" type="text" name="street" value="{{ old('street', $property->street) }}">
                @error('street')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-row">
                <label class="form-label">Area</label>
                <input class="form-control" type="text" name="area" value="{{ old('area', $property->area) }}">
            </div>
            <div class="form-row">
                <label class="form-label required">City</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" value="{{ old('city', $property->city) }}">
                @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-row">
                <label class="form-label">Postcode</label>
                <input class="form-control" type="text" value="Automatic" readonly>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <div class="form-row">
                    <label class="form-label">Property Type</label>
                    <input class="form-control {{ $errors->has('type_of_property') ? 'is-invalid' : '' }}" type="text" name="type_of_property" value="{{ old('type_of_property', $property->type_of_property) }}">
                </div>
                <div class="form-row">
                    <label class="form-label">No. of Rooms</label>
                    <input class="form-control" type="number" name="number_of_rooms" value="{{ old('number_of_rooms', $property->number_of_rooms) }}" min="1">
                </div>
            </div>
            <div class="form-row">
                <label class="form-label required" style="color:var(--tan)">Monthly Rent (₱)</label>
                <input class="form-control {{ $errors->has('monthly_rent') ? 'is-invalid' : '' }}" type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent', $property->monthly_rent) }}">
                @error('monthly_rent')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-row">
                <label class="form-label">Status</label>
                <select class="select-control" name="status">
                    @foreach(['Available','Rented','Reserved'] as $st)
                        <option value="{{ $st }}" {{ $property->status==$st?'selected':'' }}>{{ $st }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-panel">
            <div class="form-panel-title">Property Image</div>
            <label class="file-btn" for="property_image">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                Choose file
            </label>
            <input type="file" id="property_image" name="property_image" accept="image/*" style="display:none" onchange="previewImg(this,'propPreview')">
            <div class="preview-box" id="propPreview">
                @if($property->image_path)
                    <img src="{{ asset('storage/'.$property->image_path) }}" alt="Property image">
                @else
                    <div class="preview-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <div>No image uploaded</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px">
        <div class="form-panel">
            <div class="form-panel-title" style="font-size:18px;font-weight:600;text-transform:none;letter-spacing:0;color:var(--text)">Owner</div>
            <div class="form-row" style="display: flex; flex-direction: column; align-items: center; margin-bottom: 32px;">
                {{-- The Circular Avatar --}}
                <div id="editPreview" style="width: 130px; height: 130px; border-radius: 50%; background: #EEEAE4; border: 4px solid white; box-shadow: 0 4px 12px rgba(0,0,0,0.08); overflow: hidden; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; position: relative; cursor: pointer;" onclick="document.getElementById('owner_image').click()">
                    @if($property->owner_photo)
                        <img src="{{ asset('storage/' . $property->owner_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="text-align: center; color: var(--tan); opacity: 0.5;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                    @endif
                </div>

                {{-- Subtle 'Change' trigger --}}
                <label for="owner_image" style="font-size: 12px; font-weight: 600; color: var(--tan); text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; hover: opacity: 0.8;">
                    Change Photo
                </label>
                <input type="file" id="owner_image" name="image_path" accept="image/*" style="display:none" onchange="previewImg(this, 'editPreview')">
            </div>
            <div class="form-row">
                <label class="form-label">Full Name</label>
                <input class="form-control" type="text" value="{{ $property->owner_name ?? '' }}" readonly>
            </div>
            <div class="form-row">
                <label class="form-label">Address</label>
                <input class="form-control" type="text" value="{{ $property->owner_address ?? '' }}" readonly>
            </div>
            <div class="form-row">
                <label class="form-label">Telephone</label>
                <input class="form-control" type="text" value="{{ $property->owner_telephone ?? '' }}" readonly>
            </div>
        </div>

        <div class="form-panel">
            <div class="form-panel-title" style="font-size:18px;font-weight:600;text-transform:none;letter-spacing:0;color:var(--text)">Branch</div>
            <div class="form-row">
                <label class="form-label" style="color:var(--tan)">Branch No.</label>
                <input class="form-control" type="text" value="{{ $property->branch_no }} (Cannot be changed.)" readonly>
                <div class="readonly-note">Branch assignment is read-only.</div>
            </div>
            <div class="form-row">
                <label class="form-label">Street</label>
                <input class="form-control" type="text" value="{{ $property->branch_street ?? '' }}" readonly>
            </div>
            <div class="form-row">
                <label class="form-label">Area</label>
                <input class="form-control" type="text" value="{{ $property->branch_area ?? '' }}" readonly>
            </div>
            <div class="form-row">
                <label class="form-label">City</label>
                <input class="form-control" type="text" value="{{ $property->branch_city ?? '' }}" readonly>
            </div>
            <div class="form-row">
                <label class="form-label">Postcode</label>
                <input class="form-control" type="text" value="{{ $property->branch_postcode ?? '' }}" readonly>
            </div>
            <div class="form-row">
                <label class="form-label">Fax Number</label>
                <input class="form-control" type="text" value="{{ $property->branch_fax ?? '' }}" readonly>
            </div>
        </div>
    </div>
</div>
</form>
<script>
    function previewImg(input, previewId) {
        const box = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                // This replaces the icon or old image with the new one instantly
                box.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection