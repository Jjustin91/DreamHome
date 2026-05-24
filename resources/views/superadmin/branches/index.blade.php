<x-app-layout>
    
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-dh-charcoal">
            {{ __('Manage Branches') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            
            <div class="flex items-center justify-between p-6 border-b border-dh-sand/20">
                <h3 class="text-lg font-bold text-dh-charcoal">Branch Directory</h3>
                
                <a href="{{ route('branches.create') }}" class="px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal">
                    + Add New Branch
                </a>
        
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left whitespace-nowrap">
                        <thead class="tracking-wider text-white uppercase bg-dh-charcoal">
                            <tr>
                                <th scope="col" class="px-6 py-3 rounded-tl-lg">Branch No.</th>
                                <th scope="col" class="px-6 py-3">City</th>
                                <th scope="col" class="px-6 py-3">Street Address</th>
                                <th scope="col" class="px-6 py-3">Postcode</th>
                                <th scope="col" class="px-6 py-3">Telephone</th>
                                <th scope="col" class="px-6 py-3 text-center rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-dh-sand/30">
                            @foreach ($branches as $branch)
                                <tr class="transition-colors hover:bg-dh-light/50">
                                    <td class="px-6 py-4 font-bold text-dh-forest">{{ $branch->branch_no }}</td>
                                    <td class="px-6 py-4 font-semibold text-dh-charcoal">{{ $branch->city }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $branch->street }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $branch->postcode }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $branch->telephone_no }}</td>
                                    <td class="px-6 py-4 text-center">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('branches.edit', $branch->branch_no) }}" class="font-medium text-dh-sand hover:text-dh-forest">Edit</a>
                                        
                                        {{-- Delete Button Form --}}
                                        <form action="{{ route('branches.destroy', $branch->branch_no) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this branch?');" class="inline-block ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 transition-colors hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>