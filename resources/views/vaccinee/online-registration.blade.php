<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bakuna - Catanduanes</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600&family=Raleway:ital,wght@0,100;0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <!-- SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script> --}}
    <!-- PH Location JS Modified-->
    <script src="{{ asset('js/jquery.ph-locations-v1.0.0.js') }}"></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .flatpickr-monthDropdown-months {
            font-weight: 400 !important;
        }

        .flatpickr-current-month input.cur-year {
            font-weight: 400 !important;
        }
    </style>
</head>

<body>
    <nav class="bg-blue-800 h-14 w-full flex items-center px-14">
        <span class="text-white text-2xl">eCVRS - Catanduanes</span>
    </nav>
    <main class="px-14 py-5 text-gray-700">
        <h1 class="mb-10 text-5xl font-semibold uppercase" style="word-spacing: 5px; font-family: Montserrat;">Covid-19
            Vaccine Registration System</h1>

        @if ($errors->any())
        <div class="text-red-500 text-xs">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

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
        <form method="POST" action="{{ route('registration.store') }}" autocomplete="off">
            @csrf
            <div class="flex">
                <div class="flex-1">
                    <!-- Last name -->
                    <div>
                        <x-label for="last_name" :value="__('Last name*')" />
                        <x-input id="last_name"
                            class="uppercase block mt-1 w-full {{$errors->has('last_name') ? 'border border-red-500' : ''}}"
                            type="text" name="last_name" :value="old('last_name')" required autofocus />
                        @error('last_name')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- First name -->
                    <div class="mt-5">
                        <x-label for="first_name" :value="__('First name*')" />

                        <x-input id="first_name"
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

                        <x-input id="middle_name"
                            class="uppercase block mt-1 w-full {{$errors->has('middle_name') ? 'border border-red-500' : ''}}"
                            type=" text" name="middle_name" :value="old('middle_name')" />
                        @error('middle_name')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Suffix -->
                    <div class="mt-5">
                        <x-label for="suffix" :value="__('Suffix*')" />

                        <x-select class="block mt-1 w-full {{$errors->has('suffix') ? 'border border-red-500' : ''}}"
                            id="
                            suffix" name="suffix" required>
                            <option value="" selected disabled>Choose here</option>
                            <option value="">Not Applicable</option>
                            @foreach ($suffixes as $suffix)
                            <option value="{{$suffix}}" {{old('suffix')==$suffix ? 'selected' : '' }}>{{$suffix}}
                            </option>
                            @endforeach
                        </x-select>
                        @error('suffix')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date of Birth-->
                    <div class="mt-5">
                        <x-label for="birthdate" :value="__('Birthdate*')" />
                        <x-input id="birthdate"
                            class="uppercase block mt-1 w-full flatpickr flatpickr-input {{$errors->has('birthdate') ? 'border border-red-500' : ''}}"
                            type="text" :value="old('birthdate')" name="birthdate" readonly="readonly" required />
                        @error('birthdate')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sex -->
                    <div class="mt-5">
                        <x-label for="sex" :value="__('Sex*')" />

                        <x-select
                            class="uppercase block mt-1 w-full {{$errors->has('sex') ? 'border border-red-500' : ''}}"
                            id=" sex" name="sex" required>
                            <option value="" selected disabled>Choose here</option>
                            @foreach ($sexes as $sex => $sex_val)
                            <option class="uppercase" value="{{$sex_val}}" {{old('sex')==$sex_val ? 'selected' : '' }}>
                                {{$sex}}</option>
                            @endforeach
                        </x-select>
                        @error('sex')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- If ph location is not available-->
                    <div class="mt-5">
                        <x-label for="municipality" :value="__('Municipality*')" />
                        <x-select
                            class="block mt-1 w-full {{$errors->has('municipality') ? 'border border-red-500' : ''}}"
                            id=" municipality" name="municipality" required>
                            <option value="" selected disabled>Choose here</option>
                            @foreach ($municipalities as $municipality => $municipality_val)
                            <option value="{{$municipality_val}}" {{old('municipality')==$municipality_val ? 'selected'
                                : '' }}>
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
                        <x-select class="block mt-1 w-full {{$errors->has('barangay') ? 'border border-red-500' : ''}}"
                            id="
                            barangay" name="barangay" required>
                        </x-select>
                        @error('barangay')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <!-- Occupation -->
                    <div class="mt-5">
                        <x-label for="occupation" :value="__('Occupation')" />

                        <x-input id="occupation"
                            class="uppercase block mt-1 w-full {{$errors->has('occupation') ? 'border border-red-500' : ''}}"
                            name="
                            occupation" :value="old('occupation')" />
                        @error('occupation')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mobile Number -->
                    <div class="mt-5">
                        <x-label for="mobile_number" :value="__('Mobile Number - 09xxxxxxxxx*')" />

                        <x-input id="mobile_number"
                            oninput=" this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            maxlength="11" placeholder="09112233444"
                            class="block mt-1 w-full {{$errors->has('mobile_number') ? 'border border-red-500' : ''}}"
                            name="
                            mobile_number" :value="old('mobile_number')" required />
                        @error('mobile_number')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Mobile Number -->
                    <div class="mt-5">
                        <x-label for="mobile_number_confirmation" :value="__('Confirm Mobile Number - 09xxxxxxxxx*')" />

                        <x-input id="mobile_number_confirmation"
                            oninput=" this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            maxlength="11" placeholder="09112233444" class="block mt-1 w-full"
                            name="mobile_number_confirmation" required />
                    </div>

                    <div class="flex items-center justify-end mt-5">
                        <x-button class="ml-4" type="button" onclick="submitForm(this);">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </div>
                <div class="flex-1"></div>
            </div>
        </form>

    </main>
    <!--just to fix the vue error-->
    <div id="app"></div>
    <!--//just to fix the vue error-->


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
</body>

</html>