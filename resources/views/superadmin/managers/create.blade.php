<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Assign New Manager') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
            
            <div class="flex items-center justify-between p-6 border-b bg-gray-50/50 border-dh-sand/20">
                <h3 class="text-lg font-bold text-dh-charcoal">Manager Details</h3>
                <a href="{{ route('managers.index') }}" class="px-4 py-2 text-sm font-semibold transition-colors border rounded-md text-dh-charcoal border-dh-sand hover:bg-dh-sand hover:text-white">
                    &larr; Back to Directory
                </a>
            </div>

            <div class="p-8">
                <form action="{{ route('managers.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        
                        <div>
                            <label for="staff_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Staff Number <span class="font-normal text-gray-500">(e.g. S102)</span></label>
                            <input type="text" id="staff_no" name="staff_no" value="{{ old('staff_no') }}" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                        </div>

                        <div>
                            <label for="branch_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Assign to Branch</label>
                            <select id="branch_no" name="branch_no" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                                <option value="">Select a Branch...</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->branch_no }}">{{ $branch->branch_no }} - {{ $branch->city }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="first_name" class="block text-sm font-bold tracking-wide text-dh-charcoal">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-bold tracking-wide text-dh-charcoal">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                        </div>

                        <div>
                            <label for="sex" class="block text-sm font-bold tracking-wide text-dh-charcoal">Sex</label>
                            <select id="sex" name="sex" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-bold tracking-wide text-dh-charcoal">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                        </div>

                        <div>
                            <label for="telephone_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Telephone</label>
                            <input type="text" id="telephone_no" name="telephone_no" value="{{ old('telephone_no') }}" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                        </div>

                        <div>
                            <label for="nin" class="block text-sm font-bold tracking-wide text-dh-charcoal">National Insurance No. (NIN)</label>
                            <input type="text" id="nin" name="nin" value="{{ old('nin') }}" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                        </div>

                        <div>
                            <label for="salary" class="block text-sm font-bold tracking-wide text-dh-charcoal">Starting Salary</label>
                            <input type="number" step="0.01" id="salary" name="salary" value="{{ old('salary') }}" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                        </div>

                    </div>

                    <div class="pt-6 mt-8 border-t border-gray-100"></div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="px-8 py-3 text-sm font-bold tracking-wider text-white transition-all duration-200 rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dh-forest">
                            CREATE MANAGER ACCOUNT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>