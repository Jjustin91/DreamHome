<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('System Managers') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
            
            <div class="flex items-center justify-between p-6 border-b bg-gray-50/50 border-dh-sand/20">
                <h3 class="text-lg font-bold text-dh-charcoal">Active Branch Managers</h3>
                <a href="{{ route('managers.create') }}" class="px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal">
                    + Assign New Manager
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left whitespace-nowrap">
                    <thead class="tracking-wider text-white uppercase bg-dh-charcoal">
                        <tr>
                            <th scope="col" class="px-6 py-3">Staff No.</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Branch</th>
                            <th scope="col" class="px-6 py-3">Telephone</th>
                            <th scope="col" class="px-6 py-3">Salary</th>
                            <th scope="col" class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dh-sand/30">
                        @foreach ($managers as $manager)
                            <tr class="transition-colors hover:bg-dh-light/50">
                                <td class="px-6 py-4 font-bold text-dh-forest">{{ $manager->staff_no }}</td>
                                <td class="px-6 py-4 font-semibold text-dh-charcoal">
                                    {{ $manager->first_name }} {{ $manager->last_name }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 font-medium">
                                    {{ $manager->branch_no }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $manager->telephone_no }}</td>
                                <td class="px-6 py-4 text-gray-600">£{{ number_format($manager->salary, 2) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="#" class="font-medium text-dh-sand hover:text-dh-forest">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>