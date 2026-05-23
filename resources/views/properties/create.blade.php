<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Add Property
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="flex items-center justify-between mb-6">
            <div class="text-sm text-gray-600">Fill in all required fields marked with *</div>
            <div class="flex gap-3">
                <a href="{{ route('properties.index') }}" class="px-4 py-2 font-semibold text-red-700 bg-white border border-red-300 rounded-full hover:bg-red-50">Cancel</a>
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded-full bg-teal-600 hover:bg-teal-700">Add Property</button>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg">
                <strong class="block mb-1">Submission Failed:</strong>
                <ul class="pl-5 list-disc text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-6">
            {{-- LEFT: Property Details --}}
            <div class="flex flex-col gap-6">
                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <h3 class="mb-4 text-lg font-bold border-b pb-2 text-gray-800">Property Details</h3>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Property Number</label>
                        <input type="text" placeholder="Auto-generated" readonly class="w-full border-gray-300 rounded-lg bg-gray-100 text-gray-500">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Street *</label>
                        <input type="text" name="street" value="{{ old('street') }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Area</label>
                        <input type="text" name="area" value="{{ old('area') }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">City *</label>
                        <input type="text" name="city" value="{{ old('city') }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Postcode *</label>
                        <input type="text" name="postcode" value="{{ old('postcode') }}" class="w-full border-gray-300 rounded-lg bg-gray-50 focus:border-teal-500 focus:ring-teal-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block mb-1 text-sm font-semibold text-gray-600">Property Type *</label>
                            <select name="type_of_property" class="w-full border-gray-300 rounded-lg bg-gray-50">
                                <option value="">Select type</option>
                                <option value="Flat" {{ old('type_of_property')=='Flat'?'selected':'' }}>Flat</option>
                                <option value="House" {{ old('type_of_property')=='House'?'selected':'' }}>House</option>
                                <option value="Studio" {{ old('type_of_property')=='Studio'?'selected':'' }}>Studio</option>
                                <option value="Bungalow" {{ old('type_of_property')=='Bungalow'?'selected':'' }}>Bungalow</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-semibold text-gray-600">No. of Rooms *</label>
                            <input type="number" name="number_of_rooms" value="{{ old('number_of_rooms') }}" min="1" class="w-full border-gray-300 rounded-lg bg-gray-50">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-semibold text-[#C9956A]">Monthly Rent (₱) *</label>
                        <input type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent') }}" class="w-full border-gray-300 rounded-lg bg-gray-50">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-lg bg-gray-50">
                            <option value="Available" {{ old('status','Available')=='Available'?'selected':'' }}>Available</option>
                            <option value="Rented" {{ old('status')=='Rented'?'selected':'' }}>Rented</option>
                            <option value="Reserved" {{ old('status')=='Reserved'?'selected':'' }}>Reserved</option>
                        </select>
                    </div>
                </div>

                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <h3 class="mb-4 text-lg font-bold border-b pb-2 text-gray-800">Property Image</h3>
                    <input type="file" id="property_image" name="property_image" accept="image/*" class="w-full mb-4 text-sm" onchange="previewImg(this,'propPreview')">
                    <div id="propPreview" class="flex items-center justify-center w-full h-48 bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden">
                        <span class="text-gray-400">Image Preview</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Owner + Branch --}}
            <div class="flex flex-col gap-6">
                {{-- Owner Panel --}}
                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <h3 class="mb-4 text-lg font-bold border-b pb-2 text-gray-800">Owner Assignment</h3>
                    
                    <div class="mb-6">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Select Existing Owner *</label>
                        <select name="owner_no" class="w-full border-gray-300 rounded-lg bg-gray-50" onchange="fillOwner(this)">
                            <option value="">— Select owner —</option>
                            @foreach($owners as $o)
                                <option value="{{ $o->owner_no }}" data-name="{{ $o->name }}" data-address="{{ $o->address }}" data-tel="{{ $o->telephone_no }}" data-image="{{ $o->image_path ? asset('storage/' . $o->image_path) : '' }}" {{ old('owner_no') == $o->owner_no ? 'selected' : '' }}>
                                    {{ $o->name }} ({{ $o->owner_no }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-center mb-6">
                        <div id="owner_photo_display" class="w-24 h-24 overflow-hidden bg-gray-100 border-4 border-white rounded-full shadow-md flex items-center justify-center">
                            <span class="text-gray-400">No Photo</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-500 uppercase">Full Name</label>
                            <input id="o_name" type="text" readonly class="w-full border-gray-200 rounded-lg bg-gray-100 text-gray-600 text-sm">
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-500 uppercase">Address</label>
                            <input id="o_address" type="text" readonly class="w-full border-gray-200 rounded-lg bg-gray-100 text-gray-600 text-sm">
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-500 uppercase">Telephone</label>
                            <input id="o_tel" type="text" readonly class="w-full border-gray-200 rounded-lg bg-gray-100 text-gray-600 text-sm">
                        </div>
                    </div>
                </div>

                {{-- Branch Panel --}}
                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <h3 class="mb-4 text-lg font-bold border-b pb-2 text-gray-800">Branch Assignment</h3>
                    
                    <div class="mb-6">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Select Branch *</label>
                        <select name="branch_no" class="w-full border-gray-300 rounded-lg bg-gray-50" onchange="fillBranch(this)">
                            <option value="">— Select branch —</option>
                            @foreach($branches as $b)
                                <option value="{{ $b->branch_no }}" data-street="{{ $b->street }}" data-area="{{ $b->area }}" data-city="{{ $b->city }}" data-postcode="{{ $b->postcode }}" data-fax="{{ $b->fax_no }}" {{ old('branch_no')==$b->branch_no ? 'selected' : '' }}>
                                    {{ $b->branch_no }} – {{ $b->city }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-500 uppercase">Branch No.</label>
                            <input id="b_no" type="text" readonly class="w-full border-gray-200 rounded-lg bg-gray-100 text-[#C9956A] font-bold text-sm">
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-semibold text-gray-500 uppercase">City</label>
                            <input id="b_city" type="text" readonly class="w-full border-gray-200 rounded-lg bg-gray-100 text-gray-600 text-sm">
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-1 text-xs font-semibold text-gray-500 uppercase">Street</label>
                            <input id="b_street" type="text" readonly class="w-full border-gray-200 rounded-lg bg-gray-100 text-gray-600 text-sm">
                        </div>
                    </div>

                    <div class="pt-4 border-t">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Assigned Staff *</label>
                        <select name="staff_no" class="w-full border-gray-300 rounded-lg bg-gray-50">
                            <option value="">— Select staff —</option>
                            @foreach($staff as $s)
                                <option value="{{ $s->staff_no }}" {{ old('staff_no')==$s->staff_no ? 'selected' : '' }}>
                                    {{ $s->first_name }} {{ $s->last_name }} ({{ $s->job_title }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImg(input, previewId) {
            const box = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => { box.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`; };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function fillOwner(sel) {
            const opt = sel.options[sel.selectedIndex];
            document.getElementById('o_name').value = opt.dataset.name || '';
            document.getElementById('o_address').value = opt.dataset.address || '';
            document.getElementById('o_tel').value = opt.dataset.tel || '';

            const displayBox = document.getElementById('owner_photo_display');
            if (opt.dataset.image) {
                displayBox.innerHTML = `<img src="${opt.dataset.image}" class="w-full h-full object-cover">`;
            } else {
                displayBox.innerHTML = `<span class="text-gray-400">No Photo</span>`;
            }
        }
        function fillBranch(sel) {
            const opt = sel.options[sel.selectedIndex];
            document.getElementById('b_no').value = opt.value || '';
            document.getElementById('b_street').value = opt.dataset.street || '';
            document.getElementById('b_city').value = opt.dataset.city || '';
        }
    </script>
</x-app-layout>