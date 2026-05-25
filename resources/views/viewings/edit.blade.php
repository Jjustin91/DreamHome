<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-dh-charcoal">
            {{ __('Log Viewing Feedback') }}
        </h2>
    </x-slot>

    <div class="py-8 mx-auto max-w-4xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
            <div class="p-8 border-b border-gray-200">
                
                @if ($errors->any())
                    <div class="p-4 mb-6 text-red-700 bg-red-100 border border-red-400 rounded-lg">
                        <ul class="text-sm list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('viewings.update', $viewing->viewing_no) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Locked Context (Read-Only) --}}
                    <h3 class="mb-4 text-lg font-semibold text-dh-forest border-b pb-2">Appointment Details (Locked)</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-8 bg-gray-50 p-6 rounded-lg border border-gray-100">
                        
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase">Viewing Record</span>
                            <span class="block text-lg font-bold text-gray-900">{{ $viewing->viewing_no }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase">Scheduled Date</span>
                            <span class="block text-base font-medium text-gray-900">{{ \Carbon\Carbon::parse($viewing->viewing_date)->format('l, F j, Y') }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase">Property ID</span>
                            <span class="block text-base font-medium text-gray-900">{{ $viewing->property_no }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase">Renter ID</span>
                            <span class="block text-base font-medium text-gray-900">{{ $viewing->renter_no }}</span>
                        </div>

                    </div>

                    {{-- Updatable Feedback --}}
                    <h3 class="mb-4 text-lg font-semibold text-dh-forest border-b pb-2">Client Feedback</h3>
                    <div class="mb-8">
                        <label for="feedback" class="block text-sm font-medium text-gray-700">What were the renter's comments on the property?</label>
                        
                        <textarea name="feedback" id="feedback" rows="4" 
                            {{ $viewing->feedback ? 'readonly' : 'required' }} 
                            class="block w-full mt-2 border-gray-300 rounded-md shadow-sm {{ $viewing->feedback ? 'bg-gray-100 cursor-not-allowed text-gray-600' : 'focus:ring-dh-forest focus:border-dh-forest' }}"
                        >{{ $viewing->feedback }}</textarea>
                        
                        @if($viewing->feedback)
                            <p class="mt-2 text-xs font-bold text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                This feedback is permanently locked for auditing purposes.
                            </p>
                        @else
                            <p class="mt-1 text-xs text-gray-500">Maximum 255 characters.</p>
                        @endif
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center justify-between pt-4 mt-6 border-t border-gray-200">
                        <a href="{{ route('viewings.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:text-dh-forest focus:outline-none focus:ring-2 focus:ring-dh-forest focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Cancel Changes
                        </a>
                        
                        @if(!$viewing->feedback)
                            <button type="submit" class="px-6 py-3 font-bold text-white transition-colors rounded-lg shadow-md bg-dh-charcoal hover:bg-gray-800">
                                Save Feedback
                            </button>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>