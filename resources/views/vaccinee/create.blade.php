<x-app-layout>
    <x-heading class="pb-5 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3" fill="none" viewBox="0 0 24 24"
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
        {{-- STILL NOT WORKING PROPERLY --}}
        @if (isset($vaccinees))
        <h1 class="text-red-500">Have Vaccinees Duplicate</h1>
        @else
        <form method="POST" action="{{ route('vaccinees.store') }}" autocomplete="off">
            @csrf
            <div class="flex">
                <div class="p-5" style="width:700px;">

                    <div class="personal-details border">
                        <div class="bg-blue-500 text-white px-5 py-3">
                            PERSONAL DETAILS
                        </div>
                        <div class="personal-details-body px-5 pb-5 grid grid-cols-1 gap-4">
                            <table>
                                <tr>
                                    <td class="pt-3" style="width:130px;">
                                        <x-label for="last_name" :value="__('Last name*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-input id="last_name" placeholder="Valeza"
                                            class=" block mt-1 w-full {{$errors->has('last_name') ? 'border border-red-500' : ''}}"
                                            type="text" name="last_name" :value="old('last_name')" required autofocus />
                                        @error('last_name')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="first_name" :value="__('First name*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-input id="first_name" placeholder="Ryan"
                                            class=" block mt-1 w-full {{$errors->has('first_name') ? 'border border-red-500' : ''}}"
                                            type="text" name="first_name" :value="old('first_name')" required
                                            autofocus />
                                        @error('first_name')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="middle_name" :value="__('Middle name')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-input id="middle_name" placeholder="Bonifacio"
                                            class=" block mt-1 w-full {{$errors->has('middle_name') ? 'border border-red-500' : ''}}"
                                            type="text" name="middle_name" :value="old('middle_name')" required
                                            autofocus />
                                        @error('middle_name')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-3">
                                        <x-label for="suffix" :value="__('Suffix*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-select
                                            class=" block mt-1 w-full {{$errors->has('suffix') ? 'border border-red-500' : ''}}"
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
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="sex" :value="__('Sex*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-select
                                            class=" block mt-1 w-full {{$errors->has('sex') ? 'border border-red-500' : ''}}"
                                            id=" sex" name="sex" required>
                                            <option value="" selected disabled>Choose here</option>
                                            @foreach ($sexes as $sex => $sex_val)
                                            <option value="{{$sex_val}}" {{old('sex')==$sex_val ? 'selected' : '' }}>
                                                {{$sex}}
                                            </option>
                                            @endforeach
                                        </x-select>
                                        @error('sex')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label class="text-gray-300" for="birthdate" :value="__('Birthdate*')" />
                                        <span class="block text-xs text-gray-400 font-medium pb-0.5">mm/dd/yyyy</span>
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <div class="flex">
                                            <div class="flex-1">
                                                <x-input id="birthdate-datepicker" placeholder="mm/dd/yyyy"
                                                    class=" block mt-1 w-full {{$errors->has('birthdate') ? 'border border-red-500' : ''}}"
                                                    maxlength="10" type="text" value="{{old('birthdate')}}"
                                                    name="birthdate" required />
                                                @error('birthdate')
                                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="flex-1 flex items-center pl-5">
                                                <span class="display-age text-sm text-gray-600">
                                                    <!-- Age will be displayed here-->
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">

                                    </td>
                                    <td class="pt-3 px-4"></td>

                                    <td class="pt-3">
                                        <div class="flex" style="padding-top:5px;">
                                            <div class="flex flex-col mr-10">
                                                <div class="flex items-center">
                                                    <x-label class="mr-2" for="pwd" :value="__('PWD')" />
                                                    <input type="checkbox" class="w-4 h-4" name="pwd" id="pwd"
                                                        {{old('pwd') ?'checked' : '' }} value="1">
                                                </div>
                                                <div>
                                                    @error('pwd')
                                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="flex flex-col flex-1">
                                                <div class="flex items-center">
                                                    <x-label class="mr-2" for="indigenous_member"
                                                        :value="__('Indigenous Member')" />
                                                    <input type="checkbox" class="w-4 h-4" name="indigenous_member"
                                                        id="indigenous_member" {{ old('indigenous_member') ? 'checked'
                                                        : '' }} value="1">
                                                </div>
                                                <div>
                                                    @error('indigenous_member')
                                                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="mobile_number" :value="__('Mobile Number')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-input id="mobile_number"
                                            oninput=" this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            maxlength="11" placeholder="09112233444"
                                            class="text-sm block mt-1 w-full {{$errors->has('mobile_number') ? 'border border-red-500' : ''}}"
                                            name="mobile_number" value="{{old('mobile_number')}}" required />
                                        @error('mobile_number')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            <!-- Last name -->
                            {{-- <div class="mt-5">
                                <x-label for="last_name" :value="__('Last name*')" />
                                <x-input id="last_name" placeholder="Valeza"
                                    class="uppercase block mt-1 w-full {{$errors->has('last_name') ? 'border border-red-500' : ''}}"
                                    type="text" name="last_name" :value="old('last_name')" required autofocus />
                                @error('last_name')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- First name -->
                            {{-- <div class="">
                                <x-label for="first_name" :value="__('First name*')" />

                                <x-input id="first_name" placeholder="Noel"
                                    class="uppercase block mt-1 w-full {{$errors->has('first_name') ? 'border border-red-500' : ''}}"
                                    name="
                                first_name" :value="old('first_name')" required />
                                @error('first_name')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <!-- Middle name -->
                            {{-- <div class="">
                                <x-label for="middle_name" :value="__('Middle name')" />

                                <x-input id="middle_name" placeholder="Bonifacio"
                                    class="uppercase block mt-1 w-full {{$errors->has('middle_name') ? 'border border-red-500' : ''}}"
                                    type=" text" name="middle_name" :value="old('middle_name')" />
                                @error('middle_name')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <!-- Suffix -->
                            {{-- <div class="">
                                <x-label for="suffix" :value="__('Suffix*')" />

                                <x-select
                                    class="uppercase block mt-1 w-full {{$errors->has('suffix') ? 'border border-red-500' : ''}}"
                                    id="
                                suffix" name="suffix" required>
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
                            </div> --}}
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
                                    class="municipality-select2 uppercase block mt-1 w-full {{$errors->has('municipality') ? 'border border-red-500' : ''}}"
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

                    <!-- Register-->
                    <div class="flex items-center justify-end mt-5">
                        <x-button class="w-full" type="button" onclick="submitForm(this);">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            /**
             * Code for flatpickr - birthdate 
             */
            // $("#birthdate").flatpickr({
            //     altInput: true,
            //     altFormat: "F j, Y",
            //     dateFormat: "Y-m-d",
            // });
    
            
            $( function() {
                $('.municipality-select2').select2();
                
                $( "#birthdate-datepicker" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    autoclose: true,
                    maxDate: '0',
                    beforeShow: function() {
                        setTimeout(function(){
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    },
                }).on('change', function(){
                    const age = getAge(this.value)
                    // $('.display-age').each(function(){
                    //     $(this).html(age);
                    // });
                    $('.display-age').html(age);
                });
                }
            );
    
            function getAge(dateVal) {
                var
                    birthday = new Date(dateVal),
                    today = new Date(),
                    ageInMilliseconds = new Date(today - birthday),
                    years = ageInMilliseconds / (24 * 60 * 60 * 1000 * 365.25 ),
                    months = 12 * (years % 1),
                    days = 30 * (months % 1);
    
                //round
                years = Math.floor(years);
                months = Math.floor(months);
                days = Math.floor(days);
    
                //if not less than 1 and not isNaN then create a text, else blank
                const days_txt = (days > 1 && !Number.isNaN(days)) ? `${days}d(s)`: '';
                const months_txt = (months > 1 && !Number.isNaN(months)) ? `${months}mth(s)`: '';
                const years_txt = (years > 1 && !Number.isNaN(years)) ? `${years}yr(s)`: '';
    
                return `${years_txt} ${months_txt} ${days_txt}`;
            }
    
            function submitForm(btn) {
                // disable the button
                btn.disabled = true;
                // submit the form    
                btn.form.submit();
            }
           
            const bdate = document.querySelector('#birthdate-datepicker').value;
            console.log(bdate);
            function defaultAgeStr(date){
                $('.display-age').html(getAge(date));
            }
            if (bdate){
                console.log('testtt');
                console.log(bdate);
                console.log(getAge(bdate))
                defaultAgeStr(bdate);
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
        @endif

    </div>
    </div>


</x-app-layout>