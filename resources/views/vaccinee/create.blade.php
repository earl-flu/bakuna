<x-app-layout>
    <x-heading class="pt-5 pb-10 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mr-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
        Vaccinee Registration
    </x-heading>
    @if (session('success'))
    <script>
        $.toast({
                heading: 'Update Success',
                text: "{{ session('success') }}",
                icon: 'success',
                position: 'top-right'
            })
    </script>
    @endif
    <div class="bg-white">
        <form method="POST" action="{{ route('vaccinees.store') }}" autocomplete="off">
            @csrf
            <div class="flex">
                <div class="flex-1 p-5">
                    <div class="personal-details border">
                        <div class="bg-blue-500 text-white px-5 py-3">
                            PERSONAL DETAILS
                        </div>
                        <div class="personal-details-body px-5 pb-5 grid grid-cols-4 gap-4">
                            <!-- Last name -->
                            <div class="mt-5">
                                <x-label for="last_name" :value="__('Last name*')" />
                                <x-input id="last_name" placeholder="Valeza"
                                    class="uppercase block mt-1 w-full {{$errors->has('last_name') ? 'border border-red-500' : ''}}"
                                    type="text" name="last_name" :value="old('last_name')" required autofocus />
                                @error('last_name')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- First name -->
                            <div class="mt-5">
                                <x-label for="first_name" :value="__('First name*')" />

                                <x-input id="first_name" x-model="message" placeholder="Noel"
                                    class="uppercase block mt-1 w-full {{$errors->has('first_name') ? 'border border-red-500' : ''}}"
                                    name="
                                first_name" :value="old('first_name')" required />
                                @error('first_name')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Middle name -->
                            <div class="mt-5">
                                <x-label for="middle_name" :value="__('Middle name')" />

                                <x-input id="middle_name" placeholder="Bonifacio"
                                    class="uppercase block mt-1 w-full {{$errors->has('middle_name') ? 'border border-red-500' : ''}}"
                                    type=" text" name="middle_name" :value="old('middle_name')" />
                                @error('middle_name')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Suffix -->
                            <div class="mt-5">
                                <x-label for="suffix" :value="__('Suffix*')" />

                                <x-select
                                    class="uppercase block mt-1 w-full {{$errors->has('suffix') ? 'border border-red-500' : ''}}"
                                    id="
                                suffix" name="suffix" required>
                                    {{-- <option value="" selected disabled>Choose here</option> --}}
                                    <option value="" selected>Not Applicable</option>
                                    @foreach ($suffixes as $suffix)
                                    <option value="{{$suffix}}" {{old('suffix')==$suffix ? 'selected' : '' }}>
                                        {{$suffix}}
                                    </option>
                                    @endforeach
                                </x-select>
                                @error('suffix')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- #################### --}}
                        <div class="personal-details-body px-5 pb-8 grid grid-cols-1 gap-4">

                            <!-- Date of Birth-->
                            <div>
                                <x-label class="text-gray-300" for="birthdate" :value="__('Birthdate*')" />
                                <x-input id="birthdate"
                                    class="uppercase block mt-1 w-full flatpickr flatpickr-input {{$errors->has('birthdate') ? 'border border-red-500' : ''}}"
                                    type="text" :value="old('birthdate')" name="birthdate" readonly="readonly"
                                    required />
                                @error('birthdate')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sex -->
                            <div class="mt-2">
                                <x-label for="sex" :value="__('Sex*')" />

                                <x-select
                                    class="uppercase block mt-1 w-full {{$errors->has('sex') ? 'border border-red-500' : ''}}"
                                    id=" sex" name="sex" required>
                                    <option value="" selected disabled>Choose here</option>
                                    @foreach ($sexes as $sex => $sex_val)
                                    <option value="{{$sex_val}}" {{old('sex')==$sex_val ? 'selected' : '' }}>{{$sex}}
                                    </option>
                                    @endforeach
                                </x-select>
                                @error('sex')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- PWD BOOLEAN OPTION -->
                            <div class="mt-2">
                                <x-label for="pwd" :value="__('Person with disability(PWD)*')" />

                                <x-select
                                    class="uppercase block mt-1 w-full {{$errors->has('pwd') ? 'border border-red-500' : ''}}"
                                    id=" pwd" name="pwd" required>
                                    <option value="" selected disabled>Choose here</option>
                                    @foreach ($pwds as $pwd => $pwd_val)
                                    <option value="{{$pwd_val}}" {{old('pwd')==$pwd_val ? 'selected' : '' }}>{{$pwd}}
                                    </option>
                                    @endforeach
                                </x-select>
                                @error('pwd')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Indegenous Member -->
                            <div class="mt-2">
                                <x-label for="indigenous_member" :value="__('Indigenous Member*')" />

                                <x-select
                                    class="uppercase block mt-1 w-full {{$errors->has('indigenous_member') ? 'border border-red-500' : ''}}"
                                    id=" indigenous_member" name="indigenous_member" required>
                                    <option value="" selected disabled>Choose here</option>
                                    @foreach ($indigenous_members as $indigenous_member => $indigenous_member_val)
                                    <option value="{{$indigenous_member_val}}"
                                        {{old('indigenous_member')==$indigenous_member_val ? 'selected' : '' }}>
                                        {{$indigenous_member}}</option>
                                    @endforeach
                                </x-select>
                                @error('indigenous_member')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Govt ID number -->
                            <div class="mt-2">
                                <x-label for="govt_id_number" :value="__('Government ID number')" />
                                <x-input id="govt_id_number"
                                    class="block mt-1 w-full {{$errors->has('govt_id_number') ? 'border border-red-500' : ''}}"
                                    type="text" name="govt_id_number" placeholder="123-45678-123"
                                    :value="old('govt_id_number')" autofocus />
                                @error('govt_id_number')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mobile Number -->
                            <div class="mt-2">
                                <x-label for="mobile_number" :value="__('Mobile Number - 09xxxxxxxxx*')" />

                                <x-input id="mobile_number"
                                    oninput=" this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                    maxlength="11" placeholder="09112233444"
                                    class="block mt-1 w-full {{$errors->has('mobile_number') ? 'border border-red-500' : ''}}"
                                    name="mobile_number" :value="old('mobile_number')" required />
                                @error('mobile_number')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Occupation -->
                            <div class="mt-2">
                                <x-label for="occupation" :value="__('Occupation')" />

                                <x-input id="occupation"
                                    class="uppercase block mt-1 w-full {{$errors->has('occupation') ? 'border border-red-500' : ''}}"
                                    name="occupation" :value="old('occupation')" />
                                @error('occupation')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="address-information border">
                        <div class="bg-blue-500 text-white px-5 py-3">
                            ADDRESS INFORMATION
                        </div>
                        <div class="address-information-body px-5 pb-8 grid grid-cols-2 gap-4">
                            <!-- If ph location is not available-->
                            <div class="mt-5">
                                <x-label for="municipality" :value="__('Municipality*')" />
                                <x-select
                                    class="uppercase block mt-1 w-full {{$errors->has('municipality') ? 'border border-red-500' : ''}}"
                                    id=" municipality" name="municipality" required>
                                    <option value="" selected disabled>Choose here</option>
                                    @foreach ($municipalities as $municipality => $municipality_val)
                                    <option value="{{$municipality_val}}" {{old('municipality')==$municipality_val
                                        ? 'selected' : '' }}>
                                        {{$municipality}}</option>
                                    @endforeach
                                </x-select>
                                @error('indigenous_member')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mt-5">
                                <x-label for="barangay" :value="__('Barangay*')" />

                                <x-input id="barangay"
                                    class="uppercase block mt-1 w-full {{$errors->has('barangay') ? 'border border-red-500' : ''}}"
                                    name="
                            barangay" :value="old('barangay')" required />
                                @error('barangay')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- //If ph location is not available-->

                            {{-- <div class="mt-5">
                                <x-label for="municipality" :value="__('Municipality*')" />
                                <x-select
                                    class="block mt-1 w-full {{$errors->has('municipality') ? 'border border-red-500' : ''}}"
                                    id="
                            city" name="municipality" required>
                                </x-select>
                                @error('municipality')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <x-label for="barangay" :value="__('Barangay*')" />
                                <x-select
                                    class="block mt-1 w-full {{$errors->has('barangay') ? 'border border-red-500' : ''}}"
                                    id="
                            barangay" name="barangay" required>
                                </x-select>
                                @error('barangay')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div> --}}
                        </div>
                    </div>

                    <div class="category-information border">
                        <div class="bg-blue-500 text-white px-5 py-3">
                            CATEGORY INFORMATION
                        </div>
                        <div class="category-information-body px-5 pb-8 grid grid-cols-2 gap-4">
                            <!-- category -->
                            <div class="mt-5">
                                <x-label for="category" :value="__('Priority Group*')" />

                                <x-select
                                    class="block mt-1 w-full {{$errors->has('category') ? 'border border-red-500' : ''}}"
                                    id="category" name="category" required>
                                    <option value="" selected disabled>Choose here</option>
                                    @foreach ($categories as $category => $category_val)
                                    <option value="{{$category_val}}" {{old('category')==$category_val ? 'selected' : ''
                                        }}>
                                        {{$category}}
                                    </option>
                                    @endforeach
                                </x-select>
                                @error('category')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Vaccine Shot-->
                            {{-- <div class="mt-5">
                                <x-label for="vaccine_shot" :value="__('Vaccine Shot*')" />

                                <x-select
                                    class="uppercase block mt-1 w-full {{$errors->has('vaccine_shot') ? 'border border-red-500' : ''}}"
                                    id=" vaccine_shot" name="vaccine_shot" required>
                                    <option value="" selected disabled>Choose here</option>
                                    @foreach ($vaccine_shots as $vaccine_shot => $vaccine_shot_val)
                                    <option value="{{$vaccine_shot_val}}" {{old('vaccine_shot')==$vaccine_shot_val
                                        ? 'selected' : '' }}>{{$vaccine_shot}}</option>
                                    @endforeach
                                </x-select>
                                @error('vaccine_shot')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div> --}}

                        </div>
                    </div>

                    <!-- Register-->
                    <div class="flex items-center justify-end mt-10">
                        <x-button class="w-full" type="button" onclick="submitForm(this);">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
        <div style="width:800px;" class="border border-red-600">
            <div class="flex">
                <div class="mr-10">
                    <p class="text-xs text-gray-500">Last name</p>
                    <p>Sarmiento</p>
                </div>
                <div class="mr-10">
                    <p class="text-xs text-gray-500">First name</p>
                    <p>Earl John</p>
                </div>
                <div class="mr-10">
                    <p class="text-xs text-gray-500">Middle name</p>
                    <p>Budy</p>
                </div>
                <div class="mr-10">
                    <p class="text-xs text-gray-500">Suffix</p>
                    <p>Jr</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        /**
         * Code for flatpickr - birthdate 
         */
        $("#birthdate").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        function submitForm(btn) {
            // disable the button
            btn.disabled = true;
            // submit the form    
            btn.form.submit();
        }

        /**
         * Code for ph locations
         */

        // var my_handlers = {
        //     fill_barangays: function(){

        //         var city_code = $(this).find(":selected").attr("id");
        //         $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
            
        //         setTimeout(() => {
        //             console.log('Number of barangays:', $('#barangay').find('option').length - 1);
        //         }, 1000);
        //     }
        // };

        // $(function(){
        //     $('#city').on('change', my_handlers.fill_barangays);

        //     $('#city').ph_locations({'location_type': 'cities'});
        //     $('#barangay').ph_locations({'location_type': 'barangays'});

        //     $('#city').ph_locations('fetch_list',[{'province_code': '0520'}]);
        // });

    


    </script>
</x-app-layout>