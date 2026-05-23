{{-- resources/views/clients/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Client Records')

@section('content')

{{-- ── CARD ── --}}

    {{-- ── Card Header ── --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
        <h2 class="text-base font-semibold text-gray-800">Manage Clients</h2>

        <a href="{{ route('clients.create') }}"
           class="inline-flex items-center gap-2 rounded-lg text-sm font-semibold text-white"
           style="background-color: #14b8a6; padding: 9px 24px;"
           onmouseover="this.style.backgroundColor='#0d9488'"
           onmouseout="this.style.backgroundColor='#14b8a6'">
            + ADD CLIENT
        </a>
    </div>

    {{-- ── Search Bar ── --}}
    <div style="padding: 12px 24px; background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
        <form method="GET" action="{{ route('clients.index') }}">
            <div style="display: flex; align-items: center; gap: 10px;">

                {{-- Search Input --}}
                <div style="position: relative; width: 280px;">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search clients…"
                        style="width: 100%; padding: 8px 40px 8px 14px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; background: #ffffff; color: #374151; box-sizing: border-box; outline: none;">
                    <button type="submit"
                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 0; display: flex; align-items: center; color: #9ca3af;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>

                {{-- Sort By Dropdown --}}
                <select name="sort_by"
                        onchange="this.form.submit()"
                        style="padding: 8px 32px 8px 14px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; background: #ffffff; color: #374151; outline: none; cursor: pointer; appearance: none; background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 10px center;">
                    <option value="">Sort by…</option>
                    <option value="renter_no"   {{ request('sort_by') === 'renter_no'   ? 'selected' : '' }}>Renter No</option>
                    <option value="first_name"  {{ request('sort_by') === 'first_name'  ? 'selected' : '' }}>Client Name</option>
                    <option value="branch_no"   {{ request('sort_by') === 'branch_no'   ? 'selected' : '' }}>Branch</option>
                    <option value="staff_no"    {{ request('sort_by') === 'staff_no'    ? 'selected' : '' }}>Staff</option>
                    <option value="pref_property" {{ request('sort_by') === 'pref_property' ? 'selected' : '' }}>Preference</option>
                    <option value="max_rent"    {{ request('sort_by') === 'max_rent'    ? 'selected' : '' }}>Max Rent</option>
                </select>

                {{-- Sort Direction Toggle --}}
                <select name="sort_dir"
                        onchange="this.form.submit()"
                        style="padding: 8px 32px 8px 14px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; background: #ffffff; color: #374151; outline: none; cursor: pointer; appearance: none; background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 10px center;">
                    <option value="asc"  {{ request('sort_dir', 'asc') === 'asc'  ? 'selected' : '' }}>↑ Asc</option>
                    <option value="desc" {{ request('sort_dir') === 'desc' ? 'selected' : '' }}>↓ Desc</option>
                </select>

            </div>
        </form>
    </div>

<div style="max-width: 1500px;" class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    {{-- ── Table ── --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm" style="border-collapse: collapse;">

            <thead>
                <tr style="background-color: #4a3f35; color: #ffffff;">
                    <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">Renter No</th>
                    <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">Client Name</th>
                    <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">Branch</th>
                    <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">Staff</th>
                    <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">Preference</th>
                    <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">Max Rent</th>
                    <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clients as $client)
                <tr style="border-bottom: 1px solid #f3f4f6;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">

                    <td style="padding: 14px 16px; text-align: center; font-family: monospace; font-size: 12px; color: #9ca3af; white-space: nowrap;">
                        {{ $client->renter_no }}
                    </td>

                    <td style="padding: 14px 16px; text-align: center; font-weight: 500; color: #1f2937; white-space: nowrap;">
                        {{ $client->first_name }} {{ $client->last_name }}
                    </td>

                    <td style="padding: 14px 16px; text-align: center; color: #4b5563; white-space: nowrap;">
                        {{ $client->branch_no ?? '—' }}
                    </td>

                    <td style="padding: 14px 16px; text-align: center; color: #6b7280; white-space: nowrap;">
                        {{ $client->staff_no ?? 'Unassigned' }}
                    </td>

                    <td style="padding: 14px 16px; text-align: center; white-space: nowrap;">
                        @php
                            $pref = $client->pref_property ?? 'Any';
                            $badgeStyle = match(strtolower($pref)) {
                                'flat'   => 'background-color:#dbeafe; color:#1e40af; border:1.5px solid #93c5fd;',
                                'bungalow'   => 'background-color:#dbeafe; color:#1e40af; border:1.5px solid #f993fd;',
                                'house'  => 'background-color:#dcfce7; color:#166534; border:1.5px solid #86efac;',
                                'studio' => 'background-color:#fef9c3; color:#854d0e; border:1.5px solid #fde047;',
                                default  => 'background-color:#f3f4f6; color:#4b5563; border:1.5px solid #d1d5db;',
                            };
                        @endphp
                        <span style="display: inline-block; padding: 4px 14px; border-radius: 9999px; font-size: 12px; font-weight: 600; {{ $badgeStyle }}">
                            {{ $pref }}
                        </span>
                    </td>

                    <td style="padding: 14px 16px; text-align: center; font-weight: 600; color: #c9996b; white-space: nowrap;">
                        {{ number_format($client->max_rent ?? 0, 2) }}
                    </td>

                    <td style="padding: 14px 16px; text-align: center; white-space: nowrap;">
                        <div style="display: inline-flex; align-items: center; gap: 12px;">
                            <a href="{{ route('clients.show', $client->renter_no) }}"
                               style="font-size: 13px; font-weight: 500; color: #14b8a6; text-decoration: none;"
                               onmouseover="this.style.color='#0d9488'"
                               onmouseout="this.style.color='#14b8a6'">View</a>

                            <a href="{{ route('clients.edit', $client->renter_no) }}"
                               style="font-size: 13px; font-weight: 500; color: #6b7280; text-decoration: none;"
                               onmouseover="this.style.color='#374151'"
                               onmouseout="this.style.color='#6b7280'">Edit</a>

                            <form method="POST"
                                  action="{{ route('clients.destroy', $client->renter_no) }}"
                                  style="display: inline;"
                                  onsubmit="return confirm('Remove record for {{ addslashes($client->first_name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="font-size: 13px; font-weight: 500; color: #f87171; background: none; border: none; cursor: pointer; padding: 0;"
                                        onmouseover="this.style.color='#dc2626'"
                                        onmouseout="this.style.color='#f87171'">Delete</button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 40px; text-align: center; color: #9ca3af; font-style: italic; font-size: 14px;">
                        No client records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── Footer ── --}}
    @if($clients->hasPages())
    <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-gray-50">
        <p class="text-xs text-gray-500">
            Showing {{ $clients->firstItem() }} to {{ $clients->lastItem() }}
            of {{ $clients->total() }} results
        </p>
        <div>
            {{ $clients->withQueryString()->links() }}
        </div>
    </div>
    @endif

</div>

@endsection