<x-app-layout>
    
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Add New Branch') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
            
            <div class="flex items-center justify-between p-6 border-b bg-gray-50/50 border-dh-sand/20">
                <h3 class="text-lg font-bold text-dh-charcoal">Branch Details</h3>
                <a href="{{ route('branches.index') }}" class="px-4 py-2 text-sm font-semibold transition-colors border rounded-md text-dh-charcoal border-dh-sand hover:bg-dh-sand hover:text-white">
                    &larr; Back to Directory
                </a>
            </div>

            <div class="p-8">
                <form action="{{ route('branches.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        
                        <div>
                            <label for="branch_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Branch Number <span class="font-normal text-gray-500">(e.g. B011)</span></label>
                            <input type="text" id="branch_no" name="branch_no" value="{{ old('branch_no') }}" required autofocus
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('branch_no') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="telephone_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Telephone Number</label>
                            <input type="text" id="telephone_no" name="telephone_no" value="{{ old('telephone_no') }}" required 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('telephone_no') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="street" class="block text-sm font-bold tracking-wide text-dh-charcoal">Street Address</label>
                            <input type="text" id="street" name="street" value="{{ old('street') }}" required 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('street') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="area" class="block text-sm font-bold tracking-wide text-dh-charcoal">Area <span class="font-normal text-gray-500">(Optional)</span></label>
                            <input type="text" id="area" name="area" value="{{ old('area') }}" 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('area') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-bold tracking-wide text-dh-charcoal">City</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" required 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('city') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="postcode" class="block text-sm font-bold tracking-wide text-dh-charcoal">Postcode</label>
                            <input type="text" id="postcode" name="postcode" value="{{ old('postcode') }}" required 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('postcode') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="fax_no" class="block text-sm font-bold tracking-wide text-dh-charcoal">Fax Number <span class="font-normal text-gray-500">(Optional)</span></label>
                            <input type="text" id="fax_no" name="fax_no" value="{{ old('fax_no') }}" 
                                class="block w-full mt-2 bg-white border-gray-300 rounded-lg shadow-sm text-dh-charcoal focus:border-dh-forest focus:ring focus:ring-dh-forest/30">
                            @error('fax_no') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div class="pt-6 mt-8 border-t border-gray-100"></div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="px-8 py-3 text-sm font-bold tracking-wider text-white transition-all duration-200 rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dh-forest">
                            SAVE BRANCH
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>