@extends('layouts.app')
@section('title', '– Owner Profile')

@section('content')
{{-- Header with Back Navigation --}}
<div class="page-header" style="display: flex; align-items: center; gap: 15px; margin-bottom: 28px;">
    <a href="{{ route('owners.index') }}" 
       style="background: white; color: #1a202c; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-decoration: none;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    </a>
    <h2 style="font-size: 26px; font-weight: 600; color: #1a202c; margin: 0;">Owner Profile</h2>
</div>

<div style="display: grid; grid-template-columns: 1fr 400px; gap: 24px; align-items: start;">
    
    {{-- LEFT: Large Image / ID Panel --}}
    <div style="background: #EEEAE4; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; min-height: 500px; display: flex; flex-direction: column;">
        <div style="flex-grow: 1; display: flex; align-items: center; justify-content: center; padding: 40px;">
            @if(isset($owner->image_path) && $owner->image_path)
                <img src="{{ asset('storage/' . $owner->image_path) }}" 
                     style="max-width: 100%; max-height: 400px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); object-fit: cover;">
            @else
                <div style="text-align: center; color: #718096; opacity: 0.4;">
                    <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0113 0"/></svg>
                    <p style="font-size: 18px; margin-top: 15px; font-weight: 500;">NO PROFILE IMAGE</p>
                </div>
            @endif
        </div>
        
        <div style="background: white; padding: 24px; border-top: 1px solid #e2e8f0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div>
                    <h3 style="font-size: 24px; font-weight: 700; color: #2d3748; margin: 0;">{{ $owner->name }}</h3>
                    <p style="color: #718096; margin: 5px 0 0 0; font-size: 14px;">Official System Record</p>
                </div>
                <div style="text-align: right;">
                    <span style="font-size: 12px; color: #718096; text-transform: uppercase; letter-spacing: 1px;">System ID</span>
                    <div style="font-size: 20px; font-weight: 700; color: #C9956A;">{{ $owner->owner_no }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT: Detail Cards --}}
    <div style="display: flex; flex-direction: column; gap: 20px;">
        
        {{-- Contact Card --}}
        <div style="background: #5C5047; border-radius: 16px; padding: 24px; color: white; position: relative; overflow: hidden;">
            <div style="font-size: 18px; font-weight: 600; margin-bottom: 20px;">Contact Details</div>
            
            <div style="margin-bottom: 15px;">
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.7; display: block; margin-bottom: 4px;">Address</label>
                <div style="font-size: 15px; font-weight: 400; line-height: 1.5;">{{ $owner->address }}</div>
            </div>

            <div>
                <label style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.7; display: block; margin-bottom: 4px;">Telephone</label>
                <div style="font-size: 18px; font-weight: 500; color: #EEEAE4;">{{ $owner->telephone_no }}</div>
            </div>

            {{-- Decorative Icon background --}}
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="0.5" style="position: absolute; right: -10px; bottom: -10px; opacity: 0.1;">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
            </svg>
        </div>

        {{-- Actions Card --}}
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px;">
            <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; color: #718096; margin-bottom: 15px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">Account Management</div>
            
            <div style="display: flex; flex-direction: column; gap: 12px;">
                @if(in_array(auth()->user()->job_title, ['Admin', 'Manager']))
                    <a href="{{ route('owners.edit', $owner->owner_no) }}" 
                       style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #4F7C72; color: white; padding: 12px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Owner Info
                    </a>

                    <form action="{{ route('owners.destroy', $owner->owner_no) }}" method="POST" onsubmit="return confirm('Strict: Are you sure you want to delete this owner permanently?')">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; background: #fff; color: #A03030; border: 1.5px solid #A03030; padding: 12px; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 14px; transition: 0.2s;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></button>
                    </form>
                @else
                    <div style="background: #f8fafc; padding: 12px; border-radius: 8px; font-size: 12px; color: #718096; text-align: center;">
                        Only Admins and Managers can modify owner records.
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
<div style="margin-top: 30px;">
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #f1f5f9; background: #fafafa; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 18px; font-weight: 600; color: #2d3748; margin: 0;">Owned Properties</h3>
            <span style="background: #EEEAE4; color: #C9956A; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                {{ $properties->count() }} Total
            </span>
        </div>

        <div style="padding: 0;">
            @if($properties->isEmpty())
                <div style="padding: 40px; text-align: center; color: #a0aec0;">
                    <p>This owner currently has no properties listed.</p>
                </div>
            @else
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead style="background: #f8fafc; text-align: left;">
                        <tr>
                            <th style="padding: 15px 20px; color: #64748b; font-weight: 600;">Property No.</th>
                            <th style="padding: 15px 20px; color: #64748b; font-weight: 600;">Street</th>
                            <th style="padding: 15px 20px; color: #64748b; font-weight: 600;">City</th>
                            <th style="padding: 15px 20px; color: #64748b; font-weight: 600;">Status</th>
                            <th style="padding: 15px 20px; color: #64748b; font-weight: 600; text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $prop)
                        <tr style="border-top: 1px solid #f1f5f9;">
                            <td style="padding: 15px 20px; font-weight: 600; color: #C9956A;">{{ $prop->property_no }}</td>
                            <td style="padding: 15px 20px; color: #475569;">{{ $prop->street }}</td>
                            <td style="padding: 15px 20px; color: #475569;">{{ $prop->city }}</td>
                            <td style="padding: 15px 20px;">
                                <span style="padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; 
                                    {{ $prop->status == 'Available' ? 'background: #dcfce7; color: #166534;' : 'background: #fee2e2; color: #991b1b;' }}">
                                    {{ strtoupper($prop->status) }}
                                </span>
                            </td>
                            <td style="padding: 15px 20px; text-align: right;">
                                <a href="{{ route('properties.show', $prop->property_no) }}" 
                                   style="color: #4F7C72; text-decoration: none; font-weight: 700; font-size: 12px;">VIEW DETAILS</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection