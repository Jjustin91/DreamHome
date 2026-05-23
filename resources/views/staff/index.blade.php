<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Manage Staff</h2>
    </x-slot>

    <div class="flex justify-end mb-6">
        <a href="{{ route('staff.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-teal-600 rounded-md hover:bg-teal-700">
            + Hire New Staff
        </a>
    </div>

    {{-- Success and Error Alerts --}}
    @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg">{{ session('error') }}</div>
    @endif

    <div class="p-5 mb-6 bg-white border border-gray-200 rounded-xl">
        <form action="{{ route('staff.index') }}" method="GET" class="flex items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or ID..." class="flex-grow border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500">
            
            <select name="branch_no" class="border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500">
                <option value="">All Branches</option>
                @foreach($branches as $b)
                    <option value="{{ $b->branch_no }}" {{ request('branch_no') == $b->branch_no ? 'selected' : '' }}>{{ $b->branch_no }} - {{ $b->city }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="px-6 py-2 font-semibold text-white rounded-lg bg-[#C9956A] hover:bg-[#b07d55]">Filter</button>
        </form>
    </div>

    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead class="text-white" style="background: #5C5047;">
                <tr>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Staff ID</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Full Name</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Branch</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Position</th>
                    <th class="p-4 text-sm font-semibold tracking-wide uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $s)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold text-[#C9956A]">{{ $s->staff_no }}</td>
                    <td class="p-4 font-semibold text-gray-800">{{ $s->first_name }} {{ $s->last_name }}</td>
                    <td class="p-4 text-gray-700">{{ $s->branch_no }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $s->job_title == 'Manager' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ strtoupper($s->job_title) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex items-center gap-3 text-sm font-bold">
                            {{-- EVERYONE CAN VIEW --}}
                            <a href="{{ route('staff.show', $s->staff_no) }}" class="text-teal-600 hover:text-teal-800">VIEW</a>
                            
                            {{-- LOGIC: If this is the currently logged-in Manager's own row, disable the buttons --}}
                            @if(auth()->user()->staff_no === $s->staff_no && auth()->user()->hasRole('Manager'))
                                <span class="text-gray-300 cursor-not-allowed" title="You cannot edit your own HR record">EDIT</span>
                                <span class="text-gray-300 cursor-not-allowed" title="You cannot terminate your own account">DELETE</span>
                            
                            {{-- Otherwise, show normal functional buttons --}}
                            @else
                                <a href="{{ route('staff.edit', $s->staff_no) }}" class="text-[#C9956A] hover:text-[#b07d55]">EDIT</a>
                                <form action="{{ route('staff.destroy', $s->staff_no) }}" method="POST" onsubmit="return confirm('Terminate this staff record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">DELETE</button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>