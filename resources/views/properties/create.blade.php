@extends('layouts.app')
@section('title', '– Add Property')
@section('breadcrumb', 'Add Property')

@section('extra-styles')
    <style>
        :root {
            --cream:#EEEAE4; --tan:#C9956A; --tan-d:#b07d55;
            --brown:#5C5047; --teal:#4F7C72; --red:#A03030;
            --white:#FFFFFF; --text:#2C2520; --text-m:#6e6057;
            --border:rgba(92,80,71,0.18);
        }
        .page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px}
        .page-title{font-size:32px;font-weight:600;letter-spacing:-.5px;line-height:1.15}
        .page-title small{display:block;font-size:13px;font-weight:400;color:var(--text-m);margin-top:4px}
        .btn-primary{background:var(--teal);color:#fff;border:none;padding:10px 20px;border-radius:24px;font-size:13.5px;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:8px;text-decoration:none;transition:background .15s}
        .btn-primary:hover{background:var(--teal-d,#3d6158)}
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
        .side-panels{display:flex;flex-direction:column;gap:20px}
        .select-control{width:100%;padding:9px 13px;border:1px solid var(--border);border-radius:8px;font-size:13.5px;background:var(--cream);outline:none;font-family:inherit}
        .select-control:focus{border-color:var(--tan);background:#fff}
    </style>
    @endsection

    @section('content')
    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="page-header">
        <div class="page-title">
            Add Property
            <small>Fill in all required fields marked with *</small>
        </div>
        <div style="display:flex;gap:10px">
            <a href="{{ route('properties.index') }}" class="btn-cancel">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Cancel
            </a>
            <button type="submit" class="btn-primary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add Property
            </button>
        </div>
    </div>

    @if ($errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f87171;">
        <strong style="display:block; margin-bottom:5px;">Submission Failed:</strong>
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-grid">
        {{-- LEFT: Property Details --}}
        <div style="display:flex;flex-direction:column;gap:20px">
            <div class="form-panel">
                <div class="form-panel-title">Property Details</div>

                <div class="form-row">
                    <label class="form-label">Property Number</label>
                    <input class="form-control" type="text" placeholder="Auto-generated" readonly>
                </div>
                <div class="form-row">
                    <label class="form-label required">Street</label>
                    <input class="form-control {{ $errors->has('street') ? 'is-invalid' : '' }}" type="text" name="street" value="{{ old('street') }}" placeholder="e.g. 1 Rizal St.">
                    @error('street')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-row">
                    <label class="form-label">Area</label>
                    <input class="form-control" type="text" name="area" value="{{ old('area') }}" placeholder="e.g. Rems">
                </div>
                <div class="form-row">
                    <label class="form-label required">City</label>
                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" value="{{ old('city') }}" placeholder="e.g. Glasgow">
                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-row">
                    <label class="form-label required">Postcode</label>
                    <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="text" name="postcode" value="{{ old('postcode') }}" placeholder="e.g. G11 4PR">
                    @error('postcode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                    <div class="form-row">
                        <label class="form-label required">Property Type</label>
                        <select class="select-control {{ $errors->has('type_of_property') ? 'is-invalid' : '' }}" name="type_of_property">
                            <option value="">Select type</option>
                            <option value="Flat" {{ old('type_of_property')=='Flat'?'selected':'' }}>Flat</option>
                            <option value="House" {{ old('type_of_property')=='House'?'selected':'' }}>House</option>
                            <option value="Studio" {{ old('type_of_property')=='Studio'?'selected':'' }}>Studio</option>
                            <option value="Bungalow" {{ old('type_of_property')=='Bungalow'?'selected':'' }}>Bungalow</option>
                        </select>
                        @error('type_of_property')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-row">
                        <label class="form-label required">No. of Rooms</label>
                        <input class="form-control {{ $errors->has('number_of_rooms') ? 'is-invalid' : '' }}" type="number" name="number_of_rooms" value="{{ old('number_of_rooms') }}" min="1" placeholder="e.g. 3">
                        @error('number_of_rooms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-row">
                    <label class="form-label required" style="color:var(--tan)">Monthly Rent (₱)</label>
                    <input class="form-control {{ $errors->has('monthly_rent') ? 'is-invalid' : '' }}" type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent') }}" placeholder="e.g. 10000">
                    @error('monthly_rent')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-row">
                    <label class="form-label">Status</label>
                    <select class="select-control" name="status">
                        <option value="Available" {{ old('status','Available')=='Available'?'selected':'' }}>Available</option>
                        <option value="Rented" {{ old('status')=='Rented'?'selected':'' }}>Rented</option>
                        <option value="Reserved" {{ old('status')=='Reserved'?'selected':'' }}>Reserved</option>
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
                    <div class="preview-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <div>Image preview</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: Owner + Branch --}}
        <div class="side-panels">
            <div class="form-panel">
                <div class="form-panel-title" style="font-size:18px;font-weight:600;text-transform:none;letter-spacing:0;color:var(--text)">Owner</div>
                <div class="form-row">
                    <label class="form-label required">Select Existing Owner</label>
                    <select class="select-control" name="owner_no" onchange="fillOwner(this)">
                        <option value="">— Select owner —</option>
                        @foreach($owners as $o)
                            <option value="{{ $o->owner_no }}"
                                data-name="{{ $o->name }}"
                                data-address="{{ $o->address }}"
                                data-tel="{{ $o->telephone_no }}"
                                {{-- Pass the storage path here --}}
                                data-image="{{ $o->image_path ? asset('storage/' . $o->image_path) : '' }}"
                                {{ old('owner_no') == $o->owner_no ? 'selected' : '' }}>
                                {{ $o->name }} ({{ $o->owner_no }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Add the Profile Picture Display Box here --}}
                <div class="form-row" style="display: flex; justify-content: center; margin: 15px 0;">
                    <div id="owner_photo_display" style="width: 100px; height: 100px; border-radius: 50%; background: #EEEAE4; border: 2px solid var(--border); overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <svg id="owner_placeholder" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#8c7e73" stroke-width="1.5" style="opacity: 0.5;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>
                <div class="form-row">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" id="o_name" type="text" readonly placeholder="Auto-filled from selection">
                </div>
                <div class="form-row">
                    <label class="form-label">Address</label>
                    <input class="form-control" id="o_address" type="text" readonly placeholder="Auto-filled">
                </div>
                <div class="form-row">
                    <label class="form-label">Telephone</label>
                    <input class="form-control" id="o_tel" type="text" readonly placeholder="Auto-filled">
                </div>
                
            </div>

            <div class="form-panel">
                <div class="form-panel-title" style="font-size:18px;font-weight:600;text-transform:none;letter-spacing:0;color:var(--text)">Branch</div>
                <div class="form-row">
                    <label class="form-label required">Select Branch</label>
                    <select class="select-control {{ $errors->has('branch_no') ? 'is-invalid' : '' }}" name="branch_no" onchange="fillBranch(this)">
                        <option value="">— Select branch —</option>
                        @foreach($branches as $b)
                            <option value="{{ $b->branch_no }}"
                                data-street="{{ $b->street }}"
                                data-area="{{ $b->area }}"
                                data-city="{{ $b->city }}"
                                data-postcode="{{ $b->postcode }}"
                                data-fax="{{ $b->fax_no }}"
                                {{ old('branch_no')==$b->branch_no ? 'selected' : '' }}>
                                {{ $b->branch_no }} – {{ $b->city }}
                            </option>
                        @endforeach
                    </select>
                    @error('branch_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-row">
                    <label class="form-label" style="color:var(--tan)">Branch No.</label>
                    <input class="form-control" id="b_no" type="text" readonly placeholder="Auto-filled">
                </div>
                <div class="form-row">
                    <label class="form-label">Street</label>
                    <input class="form-control" id="b_street" type="text" readonly placeholder="Auto-filled">
                </div>
                <div class="form-row">
                    <label class="form-label">Area</label>
                    <input class="form-control" id="b_area" type="text" readonly placeholder="Auto-filled">
                </div>
                <div class="form-row">
                    <label class="form-label">City</label>
                    <input class="form-control" id="b_city" type="text" readonly placeholder="Auto-filled">
                </div>
                <div class="form-row">
                    <label class="form-label">Postcode</label>
                    <input class="form-control" id="b_postcode" type="text" readonly placeholder="Auto-filled">
                </div>
                <div class="form-row">
                    <label class="form-label">Fax Number</label>
                    <input class="form-control" id="b_fax" type="text" readonly placeholder="Auto-filled">
                </div>

                <div class="form-row" style="margin-top:4px">
                    <label class="form-label required">Assigned Staff</label>
                    <select class="select-control {{ $errors->has('staff_no') ? 'is-invalid' : '' }}" name="staff_no">
                        <option value="">— Select staff —</option>
                        @foreach($staff as $s)
                            <option value="{{ $s->staff_no }}" {{ old('staff_no')==$s->staff_no ? 'selected' : '' }}>
                                {{ $s->first_name }} {{ $s->last_name }} ({{ $s->job_title }})
                            </option>
                        @endforeach
                    </select>
                    @error('staff_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                box.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function fillOwner(sel) {
        const opt = sel.options[sel.selectedIndex];
        
        // Fill the text fields
        document.getElementById('o_name').value    = opt.dataset.name    || '';
        document.getElementById('o_address').value = opt.dataset.address || '';
        document.getElementById('o_tel').value     = opt.dataset.tel     || '';

        // Handle the Profile Picture logic
        const displayBox = document.getElementById('owner_photo_display');
        const imageUrl = opt.dataset.image;

        if (imageUrl) {
            // If the owner has a photo, show it
            displayBox.innerHTML = `<img src="${imageUrl}" style="width: 100%; height: 100%; object-fit: cover;">`;
        } else {
            // If no photo exists, show the original placeholder icon
            displayBox.innerHTML = `
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#8c7e73" stroke-width="1.5" style="opacity: 0.5;">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>`;
        }
    }
    function fillBranch(sel) {
        const opt = sel.options[sel.selectedIndex];
        document.getElementById('b_no').value      = opt.value            || '';
        document.getElementById('b_street').value  = opt.dataset.street   || '';
        document.getElementById('b_area').value    = opt.dataset.area     || '';
        document.getElementById('b_city').value    = opt.dataset.city     || '';
        document.getElementById('b_postcode').value= opt.dataset.postcode || '';
        document.getElementById('b_fax').value     = opt.dataset.fax      || '';
    }
</script>
@endsection