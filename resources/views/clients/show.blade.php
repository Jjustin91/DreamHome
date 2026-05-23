{{-- resources/views/clients/show.blade.php --}}
@extends('layouts.app')
@section('title', 'Client – ' . $client->first_name . ' ' . $client->last_name)

@section('content')

<div style="max-width: 1500px; border-radius: 16px; padding: 28px;">

    {{-- Title + Edit + Back --}}
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
        <h2 style="font-size: 24px; font-weight: 600; color: #3d2f27; margin: 0;">Client Details</h2>
        <div style="display: flex; align-items: center; gap: 10px;">
            <a href="{{ route('clients.index') }}"
               style="font-size: 12px; font-weight: 500; color: #7a6a60; text-decoration: none;"
               onmouseover="this.style.color='#3d2f27'"
               onmouseout="this.style.color='#7a6a60'">← Back to Clients</a>
            <a href="{{ route('clients.edit', $client->renter_no) }}"
               style="background-color: #4a7c6b; color: #fff; font-size: 12px; font-weight: 500; padding: 6px 18px; border-radius: 999px; text-decoration: none;"
               onmouseover="this.style.backgroundColor='#3a6358'"
               onmouseout="this.style.backgroundColor='#4a7c6b'">Edit</a>
        </div>
    </div>

    {{-- Card body: white left + dark right --}}
    <div style="display: flex; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.13);">

        {{-- LEFT: white panel --}}
        <div style="width: 500px; flex-shrink: 0; background: #ffffff; padding: 20px; display: flex; flex-direction: column; gap: 16px;">

            {{-- Image placeholder --}}
            <div style="width: 100%; height: 250px; background: #e5e0da; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #9e8e80; font-size: 12px; font-weight: 500; letter-spacing: 0.05em;">
                IMAGE
            </div>

            {{-- Client info --}}
            <div style="font-size: 13px; display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; gap: 8px;">
                    <span style="color: #7a6a60; width: 76px; flex-shrink: 0;">Renter ID:</span>
                    <span style="font-weight: 600; color: #2d1f1a; text-decoration: underline; text-underline-offset: 2px;">{{ $client->renter_no }}</span>
                </div>
                <div style="display: flex; gap: 8px;">
                    <span style="color: #7a6a60; width: 76px; flex-shrink: 0;">First Name:</span>
                    <span style="font-weight: 600; color: #2d1f1a; text-decoration: underline; text-underline-offset: 2px;">{{ $client->first_name }}</span>
                </div>
                <div style="display: flex; gap: 8px;">
                    <span style="color: #7a6a60; width: 76px; flex-shrink: 0;">Last Name:</span>
                    <span style="font-weight: 600; color: #2d1f1a; text-decoration: underline; text-underline-offset: 2px;">{{ $client->last_name }}</span>
                </div>
                <div style="display: flex; gap: 8px;">
                    <span style="color: #7a6a60; width: 76px; flex-shrink: 0;">Address:</span>
                    <span style="font-weight: 600; color: #2d1f1a; text-decoration: underline; text-underline-offset: 2px; line-height: 1.5;">{{ $client->address }}</span>
                </div>
                <div style="display: flex; gap: 8px;">
                    <span style="color: #7a6a60; width: 76px; flex-shrink: 0;">Tele Num:</span>
                    <span style="font-weight: 600; color: #2d1f1a; text-decoration: underline; text-underline-offset: 2px;">{{ $client->telephone_no }}</span>
                </div>
            </div>
        </div>

        {{-- RIGHT: dark panel --}}
        <div style="flex: 1; background: #4a3f35; padding: 24px; display: flex; flex-direction: column; gap: 14px; color: #e8ddd5;">

            {{-- Branch & Staff --}}
            <div style="font-size: 13px; display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; gap: 8px;">
                    <span style="color: #b0a090; width: 100px; flex-shrink: 0;">Branch:</span>
                    <span style="font-weight: 600; color: #fff; text-decoration: underline; text-underline-offset: 2px;">{{ $client->branch_no ?? '—' }}</span>
                </div>
                <div style="display: flex; gap: 8px;">
                    <span style="color: #b0a090; width: 100px; flex-shrink: 0;">Staff Assigned:</span>
                    <span style="font-weight: 600; color: #fff; text-decoration: underline; text-underline-offset: 2px;">{{ $client->staff_no ?? '—' }}</span>
                </div>
            </div>

            <div style="border-top: 1px solid #6a5a50;"></div>

            {{-- Preference --}}
            <div>
                <p style="font-size: 14px; font-weight: 600; color: #e8ddd5; margin: 0 0 12px 0;">Preference</p>
                <div style="font-size: 13px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; gap: 8px;">
                        <span style="color: #b0a090; width: 100px; flex-shrink: 0;">Property Type:</span>
                        <span style="font-weight: 600; color: #fff; text-decoration: underline; text-underline-offset: 2px;">{{ $client->pref_property ?? '—' }}</span>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="color: #b0a090; width: 100px; flex-shrink: 0;">Maximum Rent:</span>
                        <span style="font-weight: 600; color: #fff; text-decoration: underline; text-underline-offset: 2px;">
                            {{ $client->max_rent ? '$' . number_format($client->max_rent, 2) : '—' }}
                        </span>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="color: #b0a090; width: 100px; flex-shrink: 0;">Date Registered:</span>
                        <span style="font-weight: 600; color: #fff; text-decoration: underline; text-underline-offset: 2px;">
                            {{ $client->date ? \Carbon\Carbon::parse($client->date)->format('Y-m-d') : '—' }}
                        </span>
                    </div>
                    <div>
                        <span style="color: #b0a090; display: block; margin-bottom: 6px;">Comments:</span>
                        <div style="background: #f5f0eb; border-radius: 8px; padding: 10px 14px; color: #4a3f35; font-size: 13px; min-height: 64px; line-height: 1.6;">
                            {{ $client->comments ?? '' }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection