<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            Edit Manager: {{ $manager->staff_no }}
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
                <form action="{{ route('managers.update', $manager->staff_no) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        
                        <div>
                            <label class="block text-sm font-bold tracking-wide text-dh-charcoal">Staff Number</label>
                            <input type="text" value="{{ $manager->staff_no }}" readonly 
                                class="block w-full mt-2 bg-gray-100 border-gray-300 rounded-lg shadow-sm text-gray-500 cursor-not-allowed">
                        </div>

                        <div>
                            <label for="branch_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Assign to Branch</label>
                            <select id="branch_no" name="branch_no" required class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->branch_no }}" {{ (old('branch_no', $manager->branch_no) == $branch->branch_no) ? 'selected' : '' }}>
                                        {{ $branch->branch_no }} - {{ $branch->city }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_no') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="first_name" class="block text-sm font-bold tracking-wide text-dh-charcoal">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $manager->first_name) }}" required 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('first_name') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-bold tracking-wide text-dh-charcoal">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $manager->last_name) }}" required 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('last_name') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-bold tracking-wide text-dh-charcoal">Home Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $manager->address) }}" required 
                            class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('address') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold tracking-wide text-dh-charcoal">Sex</label>
                            <select disabled class="block w-full mt-2 bg-gray-100 border-gray-300 rounded-lg shadow-sm text-gray-500 cursor-not-allowed">
                                <option value="M" {{ $manager->sex == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ $manager->sex == 'F' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold tracking-wide text-dh-charcoal">Date of Birth</label>
                            <input type="date" value="{{ $manager->date_of_birth }}" readonly 
                                class="block w-full mt-2 bg-gray-100 border-gray-300 rounded-lg shadow-sm text-gray-500 cursor-not-allowed">
                        </div>

                        <div>
                            <label for="telephone_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Telephone</label>
                            <input type="text" id="telephone_no" name="telephone_no" value="{{ old('telephone_no', $manager->telephone_no) }}" required 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('telephone_no') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold tracking-wide text-dh-charcoal">National Insurance No. (NIN)</label>
                            <input type="text" value="{{ $manager->nin }}" readonly 
                                class="block w-full mt-2 bg-gray-100 border-gray-300 rounded-lg shadow-sm text-gray-500 cursor-not-allowed">
                        </div>

                        <div>
                            <label for="salary" class="block text-sm font-bold tracking-wide text-dh-charcoal">Current Salary</label>
                            <input type="number" step="0.01" id="salary" name="salary" value="{{ old('salary', $manager->salary) }}" required 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('salary') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div class="pt-6 mt-8 border-t border-gray-100"></div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="px-8 py-3 text-sm font-bold tracking-wider text-white transition-all duration-200 rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dh-forest">
                            UPDATE MANAGER PROFILE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>