{{-- resources/views/clients/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Add Client')

@section('content')

{{-- Step Indicator (display only - navigation locked behind validation) --}}
<div style="display: flex; align-items: center; gap: 0; margin-bottom: 24px; background: #fff; border-radius: 12px; padding: 6px; width: fit-content; box-shadow: 0 1px 4px rgba(0,0,0,0.08); border: 1px solid #e7e0d8;">
    <span id="step-btn-1"
          style="padding: 8px 20px; border-radius: 8px; font-size: 13px; font-weight: 500; background: #4a3f35; color: #fff; user-select:none;">
        1. Client Details
    </span>
    <span id="step-btn-2"
          style="padding: 8px 20px; border-radius: 8px; font-size: 13px; font-weight: 500; background: transparent; color: #9e8e80; user-select:none;">
        2. Branch Assignment
    </span>
    <span id="step-btn-3"
          style="padding: 8px 20px; border-radius: 8px; font-size: 13px; font-weight: 500; background: transparent; color: #9e8e80; user-select:none;">
        3. Staff Assignment
    </span>
</div>

<form method="POST" action="{{ route('clients.store') }}" id="create-form" enctype="multipart/form-data" novalidate>
@csrf

{{-- ══════════════════════════════
     STEP 1: CLIENT DETAILS
══════════════════════════════ --}}
<div id="step-1">
<div style="max-width: 1500px; border-radius: 16px; padding: 28px;">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
        <h2 style="font-size: 24px; font-weight: 600; color: #3d2f27; margin: 0;">Client Details</h2>
        <a href="{{ route('clients.index') }}"
           style="font-size: 12px; font-weight: 500; color: #7a6a60; text-decoration: none;"
           onmouseover="this.style.color='#3d2f27'" onmouseout="this.style.color='#7a6a60'">← Back to Clients</a>
    </div>

    <div style="display: flex; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.13);">

        {{-- LEFT --}}
        <div style="width: 500px; flex-shrink: 0; background: #ffffff; padding: 20px; display: flex; flex-direction: column; gap: 14px;">

            {{-- Clickable image upload --}}
            <div onclick="document.getElementById('photo-input').click()"
                 title="Click to upload photo"
                 style="width: 100%; height: 160px; background: #e5e0da; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; overflow: hidden; position: relative;">
                <img id="photo-preview"
                     style="display: none; width: 100%; height: 100%; object-fit: cover; position: absolute; top:0; left:0; border-radius: 10px;">
                <div id="photo-placeholder" style="display: flex; flex-direction: column; align-items: center; gap: 6px; color: #9e8e80; pointer-events: none;">
                    <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                    </svg>
                    <span style="font-size: 11px; font-weight: 500; text-align: center;">Click to upload photo (optional)</span>
                </div>
                <input type="file" id="photo-input" name="photo" accept="image/*"
                       style="display: none;" onchange="previewPhoto(this)">
            </div>

            {{-- Fields --}}
            <div style="display: flex; flex-direction: column; gap: 10px; font-size: 12px;">

                <div>
                    <label style="color: #7a6a60; display: block; margin-bottom: 3px;">Renter No <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="renter_no" value="{{ old('renter_no') }}" placeholder="e.g. R101"
                           style="width: 100%; padding: 6px 10px; border: 1px solid #d1c8c0; border-radius: 6px; font-size: 12px; color: #2d1f1a; background: #faf8f6; box-sizing: border-box; outline: none;"
                           onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#d1c8c0'">
                    @error('renter_no')<span style="color:#dc2626;font-size:11px;">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label style="color: #7a6a60; display: block; margin-bottom: 3px;">First Name <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First name"
                           style="width: 100%; padding: 6px 10px; border: 1px solid #d1c8c0; border-radius: 6px; font-size: 12px; color: #2d1f1a; background: #faf8f6; box-sizing: border-box; outline: none;"
                           onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#d1c8c0'">
                    @error('first_name')<span style="color:#dc2626;font-size:11px;">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label style="color: #7a6a60; display: block; margin-bottom: 3px;">Last Name <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last name"
                           style="width: 100%; padding: 6px 10px; border: 1px solid #d1c8c0; border-radius: 6px; font-size: 12px; color: #2d1f1a; background: #faf8f6; box-sizing: border-box; outline: none;"
                           onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#d1c8c0'">
                    @error('last_name')<span style="color:#dc2626;font-size:11px;">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label style="color: #7a6a60; display: block; margin-bottom: 3px;">Address <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Street, City"
                           style="width: 100%; padding: 6px 10px; border: 1px solid #d1c8c0; border-radius: 6px; font-size: 12px; color: #2d1f1a; background: #faf8f6; box-sizing: border-box; outline: none;"
                           onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#d1c8c0'">
                    @error('address')<span style="color:#dc2626;font-size:11px;">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label style="color: #7a6a60; display: block; margin-bottom: 3px;">Telephone No <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="telephone_no" value="{{ old('telephone_no') }}" placeholder="e.g. 0131-501-0001"
                           style="width: 100%; padding: 6px 10px; border: 1px solid #d1c8c0; border-radius: 6px; font-size: 12px; color: #2d1f1a; background: #faf8f6; box-sizing: border-box; outline: none;"
                           onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#d1c8c0'">
                    @error('telephone_no')<span style="color:#dc2626;font-size:11px;">{{ $message }}</span>@enderror
                </div>

            </div>
        </div>

        {{-- RIGHT --}}
        <div style="flex: 1; background: #4a3f35; padding: 24px; display: flex; flex-direction: column; gap: 14px; color: #e8ddd5;">

            <div style="font-size: 12px; display: flex; flex-direction: column; gap: 6px;">
                <div style="display: flex; gap: 8px; align-items: center;">
                    <span style="color: #b0a090; width: 100px; flex-shrink: 0;">Branch:</span>
                    <span style="color: #6a5a50; font-style: italic; font-size: 11px;">Set in next step</span>
                </div>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <span style="color: #b0a090; width: 100px; flex-shrink: 0;">Staff Assigned:</span>
                    <span style="color: #6a5a50; font-style: italic; font-size: 11px;">Set in next step</span>
                </div>
            </div>

            <div style="border-top: 1px solid #6a5a50;"></div>

            <div>
                <p style="font-size: 14px; font-weight: 600; color: #e8ddd5; margin: 0 0 12px 0;">Preference</p>
                <div style="display: flex; flex-direction: column; gap: 12px; font-size: 12px;">

                    <div>
                        <label style="color: #b0a090; display: block; margin-bottom: 4px;">Property Type <span style="color:#fca5a5;">*</span></label>
                        <select name="pref_property"
                                style="width: 100%; background: #5c4f45; border: 1px solid #7a6a5a; color: #ffffff; border-radius: 8px; padding: 7px 12px; font-size: 12px; cursor: pointer; outline: none; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#7a6a5a'">
                            <option value="">-- Select --</option>
                            <option value="Flat"     {{ old('pref_property') == 'Flat'     ? 'selected' : '' }}>Flat</option>
                            <option value="House"    {{ old('pref_property') == 'House'    ? 'selected' : '' }}>House</option>
                            <option value="Studio"   {{ old('pref_property') == 'Studio'   ? 'selected' : '' }}>Studio</option>
                            <option value="Bungalow" {{ old('pref_property') == 'Bungalow' ? 'selected' : '' }}>Bungalow</option>
                        </select>
                        @error('pref_property')<span style="color:#fca5a5;font-size:11px;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label style="color: #b0a090; display: block; margin-bottom: 4px;">Maximum Rent (£) <span style="color:#fca5a5;">*</span></label>
                        <input type="number" name="max_rent" value="{{ old('max_rent') }}" placeholder="e.g. 1200" step="0.01" min="0"
                               style="width: 100%; background: #5c4f45; border: 1px solid #7a6a5a; color: #ffffff; border-radius: 8px; padding: 7px 12px; font-size: 12px; outline: none; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#7a6a5a'">
                        @error('max_rent')<span style="color:#fca5a5;font-size:11px;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label style="color: #b0a090; display: block; margin-bottom: 4px;">Date Registered <span style="color:#fca5a5;">*</span></label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                               style="width: 100%; background: #5c4f45; border: 1px solid #7a6a5a; color: #ffffff; border-radius: 8px; padding: 7px 12px; font-size: 12px; outline: none; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#7a6a5a'">
                        @error('date')<span style="color:#fca5a5;font-size:11px;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label style="color: #b0a090; display: block; margin-bottom: 4px;">Comments</label>
                        <textarea name="comments" rows="3" placeholder="Any notes or preferences…"
                                  style="width: 100%; background: #f5f0eb; border: none; border-radius: 8px; padding: 8px 12px; font-size: 12px; color: #4a3f35; resize: none; outline: none; box-sizing: border-box; line-height: 1.5;">{{ old('comments') }}</textarea>
                        @error('comments')<span style="color:#fca5a5;font-size:11px;">{{ $message }}</span>@enderror
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: flex-end; margin-top: 18px;">
        <button type="button" onclick="validateStep1ThenGo()"
                style="background-color: #c9996b; color: #fff; font-size: 13px; font-weight: 600; padding: 10px 28px; border-radius: 8px; border: none; cursor: pointer;"
                onmouseover="this.style.backgroundColor='#4a3f35'"
                onmouseout="this.style.backgroundColor='#c9996b'">
            Next: Branch Assignment →
        </button>
    </div>

</div>
</div>

{{-- ══════════════════════════════
     STEP 2: BRANCH ASSIGNMENT
══════════════════════════════ --}}
<div id="step-2" style="display:none;">
<div style="max-width: 1500px; border-radius: 16px; padding: 28px;">

    <div style="margin-bottom: 20px;">
        <h2 style="font-size: 24px; font-weight: 600; color: #3d2f27; margin: 0;">Branch Assignment</h2>
    </div>

    <div style="display: flex; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.13);">

        {{-- LEFT --}}
        <div style="width: 500px; flex-shrink: 0; background: #ffffff; padding: 20px; display: flex; flex-direction: column; gap: 14px;">
            <div id="photo-preview-2"
                 style="width: 100%; height: 160px; background: #e5e0da; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <img id="photo-preview-img-2" style="display:none; width:100%; height:100%; object-fit:cover;">
                <span style="color:#9e8e80;font-size:12px;" id="photo-placeholder-2">IMAGE</span>
            </div>
            <div style="font-size: 12px; display: flex; flex-direction: column; gap: 6px; color: #4a3f35;">
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">Renter No:</span><span id="preview-renter" style="font-weight:600;">—</span></div>
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">First Name:</span><span id="preview-first" style="font-weight:600;">—</span></div>
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">Last Name:</span><span id="preview-last" style="font-weight:600;">—</span></div>
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">Address:</span><span id="preview-address" style="font-weight:600;line-height:1.4;">—</span></div>
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">Tele Num:</span><span id="preview-tele" style="font-weight:600;">—</span></div>
            </div>
        </div>

        {{-- RIGHT --}}
        <div style="flex: 1; background: #4a3f35; padding: 24px; display: flex; flex-direction: column; gap: 14px; color: #e8ddd5;">
            <div>
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #b0a090; display: block; margin-bottom: 8px;">Select Branch <span style="color:#fca5a5;">*</span></label>
                <select name="branch_no"
                        onchange="fetchStaffByBranch(this.value)"
                        style="background: #5c4f45; border: 1px solid #7a6a5a; color: #ffffff; border-radius: 8px; padding: 8px 14px; font-size: 13px; cursor: pointer; outline: none; width: 100%; box-sizing: border-box;"
                        onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#7a6a5a'">
                    <option value="">-- Select Branch --</option>
                    @foreach($branch as $b)
                    <option value="{{ $b->branch_no }}" {{ old('branch_no') == $b->branch_no ? 'selected' : '' }}>
                        {{ $b->branch_no }} – {{ $b->city }}
                    </option>
                    @endforeach
                </select>
                @error('branch_no')<span style="color:#fca5a5;font-size:11px;">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 18px;">
        <button type="button" onclick="goToStep(1)"
                style="background: none; border: none; color: #7a6a60; font-size: 13px; font-weight: 500; cursor: pointer;"
                onmouseover="this.style.color='#3d2f27'" onmouseout="this.style.color='#7a6a60'">
            ← Back to Details
        </button>
        <button type="button" onclick="validateStep2ThenGo()"
                style="background-color: #c9996b; color: #fff; font-size: 13px; font-weight: 600; padding: 10px 28px; border-radius: 8px; border: none; cursor: pointer;"
                onmouseover="this.style.backgroundColor='#4a3f35'"
                onmouseout="this.style.backgroundColor='#c9996b'">
            Next: Staff Assignment →
        </button>
    </div>

</div>
</div>

{{-- ══════════════════════════════
     STEP 3: STAFF ASSIGNMENT
══════════════════════════════ --}}
<div id="step-3" style="display:none;">
<div style="max-width: 1500px; border-radius: 16px; padding: 28px;">

    <div style="margin-bottom: 20px;">
        <h2 style="font-size: 24px; font-weight: 600; color: #3d2f27; margin: 0;">Staff Assignment</h2>
    </div>

    <div style="display: flex; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.13);">

        {{-- LEFT --}}
        <div style="width: 500px; flex-shrink: 0; background: #ffffff; padding: 20px; display: flex; flex-direction: column; gap: 14px;">
            <div style="width: 100%; height: 160px; background: #e5e0da; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <img id="photo-preview-img-3" style="display:none; width:100%; height:100%; object-fit:cover;">
                <span style="color:#9e8e80;font-size:12px;" id="photo-placeholder-3">IMAGE</span>
            </div>
            <div style="font-size: 12px; display: flex; flex-direction: column; gap: 6px; color: #4a3f35;">
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">Renter No:</span><span id="preview-renter-3" style="font-weight:600;">—</span></div>
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">First Name:</span><span id="preview-first-3" style="font-weight:600;">—</span></div>
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">Last Name:</span><span id="preview-last-3" style="font-weight:600;">—</span></div>
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">Address:</span><span id="preview-address-3" style="font-weight:600;line-height:1.4;">—</span></div>
                <div style="display:flex;gap:6px;"><span style="color:#7a6a60;width:72px;flex-shrink:0;">Tele Num:</span><span id="preview-tele-3" style="font-weight:600;">—</span></div>
            </div>
        </div>

        {{-- RIGHT --}}
        <div style="flex: 1; background: #4a3f35; padding: 24px; display: flex; flex-direction: column; gap: 14px; color: #e8ddd5;">

            <div style="font-size: 12px;">
                <span style="color: #b0a090;">Branch:</span>
                <span id="preview-branch-3" style="color: #fff; font-weight: 600; margin-left: 8px;">—</span>
            </div>

            <div>
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #b0a090; display: block; margin-bottom: 8px;">Select Staff <span style="color:#fca5a5;">*</span></label>
                <select name="staff_no" id="staff-select"
                        style="background: #5c4f45; border: 1px solid #7a6a5a; color: #ffffff; border-radius: 8px; padding: 8px 14px; font-size: 13px; cursor: pointer; outline: none; width: 100%; box-sizing: border-box;"
                        onchange="updateStaffPreview(this)"
                        onfocus="this.style.borderColor='#c9996b'" onblur="this.style.borderColor='#7a6a5a'">
                    <option value="">-- Select Staff --</option>
                    @foreach($staffList as $staff)
                    <option value="{{ $staff->staff_no }}"
                            data-name="{{ $staff->first_name }} {{ $staff->last_name }}"
                            data-gender="{{ $staff->sex == 'M' ? 'Male' : 'Female' }}"
                            data-role="{{ $staff->job_title }}"
                            data-clients="{{ $staff->renters_count ?? 0 }}"
                            {{ old('staff_no') == $staff->staff_no ? 'selected' : '' }}>
                        {{ $staff->staff_no }}
                    </option>
                    @endforeach
                </select>
                @error('staff_no')<span style="color:#fca5a5;font-size:11px;">{{ $message }}</span>@enderror
            </div>

            <div style="border-top: 1px solid #6a5a50; padding-top: 14px;">
                <p style="font-size: 13px; font-weight: 600; color: #e8ddd5; margin: 0 0 12px 0;">Staff Details:</p>
                <div style="display: flex; gap: 14px; align-items: flex-start;">
                    <div style="width: 150px; height: 150px; background: #5c4f45; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #9e8e80; font-size: 11px; flex-shrink: 0;">IMAGE</div>
                    <div style="font-size: 12px; display: flex; flex-direction: column; gap: 7px; flex: 1;">
                        <div>
                            <p style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.08em; color: #b0a090; margin: 0 0 2px 0;">Staff ID</p>
                            <p style="font-weight: 600; color: #fff; margin: 0;" id="si-id">—</p>
                        </div>
                        <div>
                            <p style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.08em; color: #b0a090; margin: 0 0 2px 0;">Staff Name</p>
                            <p style="font-weight: 600; color: #fff; margin: 0;" id="si-name">—</p>
                        </div>
                        <div>
                            <p style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.08em; color: #b0a090; margin: 0 0 2px 0;">Gender</p>
                            <p style="font-weight: 600; color: #fff; margin: 0;" id="si-gender">—</p>
                        </div>
                        <div>
                            <p style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.08em; color: #b0a090; margin: 0 0 2px 0;">Staff Role</p>
                            <p style="font-weight: 600; color: #fff; margin: 0;" id="si-role">—</p>
                        </div>
                        <p style="color: #b0a090; font-size: 11px; margin: 2px 0 0 0;">
                            Currently handling <span style="color:#fff;font-weight:700;" id="si-clients">—</span> clients.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 18px;">
        <button type="button" onclick="goToStep(2)"
                style="background: none; border: none; color: #7a6a60; font-size: 13px; font-weight: 500; cursor: pointer;"
                onmouseover="this.style.color='#3d2f27'" onmouseout="this.style.color='#7a6a60'">
            ← Back to Branch
        </button>
        <button type="button" onclick="validateStep3ThenSubmit()"
                style="background-color: #c9996b; color: #fff; font-size: 13px; font-weight: 600; padding: 10px 28px; border-radius: 8px; border: none; cursor: pointer;"
                onmouseover="this.style.backgroundColor='#4a3f35'"
                onmouseout="this.style.backgroundColor='#c9996b'">
            Save Client
        </button>
    </div>

</div>
</div>

</form>

<script>
    const steps = [1, 2, 3];

    // ── Step navigation ──────────────────────────────────────
    function goToStep(n) {
        steps.forEach(s => {
            document.getElementById('step-' + s).style.display = s === n ? 'block' : 'none';
            const btn = document.getElementById('step-btn-' + s);
            btn.style.background = s === n ? '#4a3f35' : 'transparent';
            btn.style.color      = s === n ? '#fff' : '#9e8e80';
        });
        if (n >= 2) syncPreview();
        if (n === 3) syncBranchPreview();
    }

    // ── Step 1 validation before proceeding ─────────────────
    function validateStep1ThenGo() {
        const fields = [
            { name: 'renter_no',    label: 'Renter No' },
            { name: 'first_name',   label: 'First Name' },
            { name: 'last_name',    label: 'Last Name' },
            { name: 'address',      label: 'Address' },
            { name: 'telephone_no', label: 'Telephone No' },
            { name: 'pref_property',label: 'Property Type' },
            { name: 'max_rent',     label: 'Maximum Rent' },
            { name: 'date',         label: 'Date Registered' },
        ];

        let missing = [];
        fields.forEach(f => {
            const el = document.querySelector('[name="' + f.name + '"]');
            if (!el || !el.value.trim()) missing.push(f.label);
        });

        if (missing.length > 0) {
            showAlert('Please fill in the following required fields:\n• ' + missing.join('\n• '));
            return;
        }
        goToStep(2);
    }

    // ── Step 2 validation before proceeding ─────────────────
    function validateStep2ThenGo() {
        const branch = document.querySelector('[name="branch_no"]');
        if (!branch || !branch.value) {
            showAlert('Please select a Branch before continuing.');
            return;
        }
        goToStep(3);
    }

    function fetchStaffByBranch(branchNo) {
    const el = document.getElementById('preview-branch-3');
    if (el) el.textContent = branchNo || '—';

    const staffSelect = document.getElementById('staff-select');
    staffSelect.innerHTML = '<option value="">-- Select Staff --</option>';

    ['si-id','si-name','si-gender','si-role','si-clients'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = '—';
    });

    if (!branchNo) return;

    fetch(`/staff-by-branch?branch_no=${branchNo}`)
        .then(res => res.json())
        .then(staffList => {
            if (staffList.length === 0) {
                staffSelect.innerHTML = '<option value="">No salespersons in this branch</option>';
                return;
            }
            staffList.forEach(staff => {
                const opt = document.createElement('option');
                opt.value           = staff.staff_no;
                opt.dataset.name    = staff.first_name + ' ' + staff.last_name;
                opt.dataset.gender  = staff.sex === 'M' ? 'Male' : 'Female';
                opt.dataset.role    = staff.job_title;
                opt.dataset.clients = staff.renters_count ?? 0;
                opt.textContent     = staff.staff_no;
                staffSelect.appendChild(opt);
            });
        })
        .catch(() => {
            staffSelect.innerHTML = '<option value="">Error loading staff</option>';
        });
    }

    // ── Step 3 validation before submitting ─────────────────
    function validateStep3ThenSubmit() {
        const staff = document.querySelector('[name="staff_no"]');
        if (!staff || !staff.value) {
            showAlert('Please select a Staff member before saving.');
            return;
        }
        document.getElementById('create-form').submit();
    }

    // ── Simple inline alert banner ───────────────────────────
    function showAlert(msg) {
        let banner = document.getElementById('validation-banner');
        if (!banner) {
            banner = document.createElement('div');
            banner.id = 'validation-banner';
            banner.style.cssText = 'position:fixed;top:20px;left:50%;transform:translateX(-50%);background:#fff1f2;border:1.5px solid #fca5a5;color:#dc2626;padding:14px 24px;border-radius:10px;font-size:13px;z-index:9999;white-space:pre-line;box-shadow:0 4px 16px rgba(0,0,0,0.12);max-width:360px;line-height:1.6;';
            document.body.appendChild(banner);
        }
        banner.textContent = msg;
        banner.style.display = 'block';
        clearTimeout(banner._timer);
        banner._timer = setTimeout(() => banner.style.display = 'none', 4000);
    }

    // ── Sync preview panels ──────────────────────────────────
    function syncPreview() {
        const fields = {
            renter:  'renter_no',
            first:   'first_name',
            last:    'last_name',
            address: 'address',
            tele:    'telephone_no'
        };
        Object.entries(fields).forEach(([key, name]) => {
            const val = document.querySelector('[name="' + name + '"]')?.value || '—';
            ['preview-' + key, 'preview-' + key + '-3'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = val;
            });
        });

        // Sync uploaded photo to steps 2 & 3
        const src = document.getElementById('photo-preview')?.src;
        if (src && src !== window.location.href) {
            ['photo-preview-img-2','photo-preview-img-3'].forEach(id => {
                const img = document.getElementById(id);
                if (img) { img.src = src; img.style.display = 'block'; }
            });
            ['photo-placeholder-2','photo-placeholder-3'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
        }
    }

    function syncBranchPreview() {
        const sel = document.querySelector('[name="branch_no"]');
        const el  = document.getElementById('preview-branch-3');
        if (el && sel) el.textContent = sel.value || '—';
    }

    function previewPhoto(input) {
        if (!input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            const preview     = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }

    function updateStaffPreview(select) {
        const opt = select.options[select.selectedIndex];
        document.getElementById('si-id').textContent      = opt.value || '—';
        document.getElementById('si-name').textContent    = opt.dataset.name    || '—';
        document.getElementById('si-gender').textContent  = opt.dataset.gender  || '—';
        document.getElementById('si-role').textContent    = opt.dataset.role    || '—';
        document.getElementById('si-clients').textContent = opt.dataset.clients || '—';
    }

    // ── Auto-jump to the step that has backend errors ────────
    document.addEventListener('DOMContentLoaded', function () {
        @if($errors->hasAny(['staff_no']))
            goToStep(3);
        @elseif($errors->hasAny(['branch_no']))
            goToStep(2);
        @elseif($errors->any())
            goToStep(1);
        @else
            goToStep(1);
        @endif

        // Restore staff preview if old value exists
        const staffSel = document.getElementById('staff-select');
        if (staffSel && staffSel.value) updateStaffPreview(staffSel);
    });
</script>

@endsection