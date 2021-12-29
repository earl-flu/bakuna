<x-app-layout>
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

    @if (session('success-store'))
    <script>
        $.toast({
                heading: 'Create Success',
                text: "{{ session('success-store') }}",
                icon: 'success',
                position: 'top-right'
            })
    </script>
    @endif


    @if ($errors->any())
    <div class="text-red-500 text-xs">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="bg-white p-5 rounded-md mb-5 shadow flex space-x-4 border">
        <div class="h-28 w-28 bg-gray-400">

        </div>
        <div class="flex-1 flex flex-col text-gray-600 py-1">
            <div class="flex-1">
                <p class="text-xs">00001523</p>
                <!-- modal button-->
                <a href="#personal-detail-modal">
                    <p class="uppercase text-primary hover:text-primary-dark inline-block">{{$vaccinee->full_name}}</p>
                </a>

                <!-- Update Personal Data - Modal Component -->
                @include('vaccinee.partials.update-personaldata-modal')
                <!-- //Update Personal Data - Modal Component -->

                <p class="text-xs font-medium capitalize">{{$vaccinee->barangay}}, {{$vaccinee->municipality_str}},
                    Catanduanes</p>
            </div>
            <div class="flex flex-1 text-xs font-medium items-start pt-2">
                <div class="flex-1">
                    <table>
                        <tr>
                            <td class="capitalize">Birthdate</td>
                            <td class="px-1 px-4">:</td>
                            <td class="text-primary">{{$vaccinee->birthdate_mdy}}</td>
                        </tr>
                        <tr>
                            <td class="capitalize pt-0.5">Age</td>
                            <td class="px-1 pt-0.5 px-4">:</td>
                            <td class="text-primary pt-0.5 display-age"></td>

                        </tr>
                    </table>
                </div>
                <div class="flex-1">
                    <table>
                        <tr>
                            <td class="capitalize pt-0.5">Gender</td>
                            <td class="px-1 pt-0.5 px-4">:</td>
                            <td class="text-primary pt-0.5">{{$vaccinee->sex === 'F' ? 'Female':
                                'Male'}}</td>
                        </tr>
                        <tr>
                            <td class="capitalize pt-0.5">Contact</td>
                            <td class="px-1 pt-0.5 px-4">:</td>
                            <td class="text-primary pt-0.5">{{$vaccinee->mobile_number}}</td>
                        </tr>
                    </table>
                </div>
                <div class="flex-1">
                    <table>
                        <tr>
                            <td class="capitalize">PWD</td>
                            <td class="px-1 px-4">:</td>
                            <td class="text-primary">
                                @if ($vaccinee->pwd)
                                <span class="py-0.5 px-1 rounded bg-red-500 text-gray-100">YES</span>
                                @else
                                No
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td class="capitalize pt-0.5">Indigenous Mem</td>
                            <td class="px-1 pt-0.5 px-4">:</td>
                            <td class="text-primary pt-0.5">
                                @if ($vaccinee->indigenous_member)
                                <span class="py-0.5 px-1 rounded bg-red-500 text-gray-100">YES</span>
                                @else
                                No
                                @endif
                            </td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <input id="birthdate-datepicker" type="text" name=""> --}}
    <div class="bg-white p-5 rounded-md mb-5 shadow text-gray-600 border">
        <p class="uppercase font-semibold">VACCINATION RECORD</p>
        <table class="w-full text-left text-sm mt-2">
            <tr class="font-medium">
                <td class="bg-gray-700 text-gray-100 p-2">Date</td>
                <td class="bg-gray-700 text-gray-100 p-2">Cat</td>
                <td class="bg-gray-700 text-gray-100 p-2">Vaccine</td>
                <td class="bg-gray-700 text-gray-100 p-2">1st D</td>
                <td class="bg-gray-700 text-gray-100 p-2">2nd D</td>
                <td class="bg-gray-700 text-gray-100 p-2">Booster</td>
                <td class="bg-gray-700 text-gray-100 p-2">Lot No</td>
                <td class="bg-gray-700 text-gray-100 p-2">Deferred</td>
                <td class="bg-gray-700 text-gray-100 p-2">Action</td>
            </tr>
            @foreach ($vaccinee->bakunas as $bakuna)
            <tr class="hover:bg-gray-100">
                <td class="p-2 border">{{$bakuna->vaccination_date_str}}</td>
                <td class="p-2 border">{{$bakuna->category}}</td>
                <td class="p-2 border">{{$bakuna->manufacturer_name}}</td>
                <td class="p-2 border">
                    @if ($bakuna->vaccine_shot == 1)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="green">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    @else
                    <div class="border border-gray-500 rounded-full h-3 w-3 border-2"></div>
                    @endif
                </td>
                <td class="p-2 border">
                    @if ($bakuna->vaccine_shot == 2)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="green">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    @else
                    <div class="border border-gray-500 rounded-full h-3 w-3 border-2"></div>
                    @endif
                </td>
                <td class="p-2 border">
                    @if ($bakuna->vaccine_shot == 3)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="green">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    @else
                    <div class="border border-gray-500 rounded-full h-3 w-3 border-2"></div>
                    @endif
                </td>
                <td class="p-2 border">
                    {{$bakuna->lot_number}}
                </td>
                <td class="p-2 border">
                    @if ($bakuna->is_deferred)
                    <span class="py-0.5 px-1 rounded bg-red-500 text-gray-100">YES</span>
                    @else
                    No
                    @endif
                </td>
                <td class="p-2 border">
                    <div class="inline-block">
                        <a href="#vaxupdatemodal-{{$bakuna->id}}" rel="modal:open">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hover:text-black" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                    <!-- Update Vaccination Record - Modal Component-->
                    @include('vaccinee.partials.update-vaccine-modal')
                    <!-- //Update Vaccination Record - Modal Component-->
                </td>
            </tr>
            @endforeach
        </table>
        <div class="flex">
            <!-- modal button for add record-->
            <a href="#add-record-modal"
                class="mt-3 transition duration-300 ease-in-out text-xs p-2 rounded bg-gray-600 hover:bg-gray-700 cursor-pointer text-gray-100">
                Add Record
            </a>
            <!-- //modal button for add record -->

            <!-- Add Vaccination Record - Modal Component -->
            @include('vaccinee.partials.add-vax-modal')
            <!-- //Add Vaccination Record - Modal Component -->
        </div>
    </div>

    <script>
        function addVaxData(){
            return {
                isComorbidity: false, 
                alp_category: '', 
                isPedia: false,
                alp_dose: '',
                setIsPedia(e){
                    const category = e.target.value
                    if( category == "ROPP" || category == "PA3"){
                        this.isPedia = true
                    } else {
                        this.isPedia = false
                    }
                }
            }
        }

        function updateVaxData(){
            return {
                isComorbidity: false, 
                isPedia: false,
                isDeferred: false,
                isAdverseEvent: false,
                alp_category: '',
                alp_dose: '',
                setIsPedia(e){
                    console.log('UpdateVaxData')
                    const category = e.target.value
                    if( category == "ROPP" || category == "PA3"){
                        this.isPedia = true
                    } else {
                        this.isPedia = false
                    }
                }
            }
        }

        $().ready(function(){
            $("#update-form").validate({
                rules: {
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    mobile_number: {
                        required: true,
                        maxlength:11,
                        minlength:11,
                        phoneStartsWith09: true,
                    },
                    birthdate: {
                        required: true, 
                        dpDate: true 
                    }
                },
                submitHandler: function(form){
                    $('form button[type=submit]').attr('disabled', 'disabled');
                    form.submit();
                }
            });

            $("#add-record-form").validate({
                rules: {
                    category: {
                        required: true,
                    },
                    vaccinator_name:{
                        required: true,
                    },
                    manufacturer_name: {
                        required: true,
                    },
                    batch_number: {
                        required: true,
                    },
                    lot_number: {
                        required: true,
                    },
                    vaccine_shot: {
                        required: true,
                    },
                    contact: {
                        required: true,
                        maxlength:11,
                        minlength:11,
                        phoneStartsWith09: true,
                    },
                    vaccination_date: {
                        required: true, 
                        dpDate: true 
                    }
                },
                submitHandler: function(form){
                    $('form button[type=submit]').attr('disabled', 'disabled');
                    form.submit();
                }
            });

            $("#update-vax-form").validate({
                rules: {
                    category: {
                        required: true,
                    },
                    vaccinator_name:{
                        required: true,
                    },
                    manufacturer_name: {
                        required: true,
                    },
                    batch_number: {
                        required: true,
                    },
                    lot_number: {
                        required: true,
                    },
                    vaccine_shot: {
                        required: true,
                    },
                    contact: {
                        required: true,
                        maxlength:11,
                        minlength:11,
                        phoneStartsWith09: true,
                    },
                    vaccination_date: {
                        required: true, 
                        dpDate: true 
                    }
                },
                submitHandler: function(form){
                    $('form button[type=submit]').attr('disabled', 'disabled');
                    form.submit();
                }
            });

            //add method for jquery validator
            jQuery.validator.addMethod("phoneStartsWith09", function(phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, ""); 
                return this.optional(element) || phone_number.match(/^09\d{9}$/);
            }, "Phone number should start with 09");
        });

        /**
        * MODAL FOR UPDATE PERSONAL DATA
        * jquery modal unclosable window
        */
        $('a[href="#personal-detail-modal"]').click(function(event) {
            event.preventDefault();
            $(this).modal({
                escapeClose: true,
                clickClose: false,
                // fadeDuration: 50
            });
        });

        /**
        * MODAL FOR ADD RECORD
        * jquery modal unclosable window
        */
        $('a[href="#add-record-modal"]').click(function(event) {
            event.preventDefault();
            $(this).modal({
                escapeClose: true,
                clickClose: false,
                // fadeDuration: 50
            });
        });


        $( function() {
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
                $('.display-age').each(function(){
                    $(this).html(age);
                });
            });

            $( "#vaccination_date_datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                maxDate: '0',
                // defaultDate: '01/01/2001',
                beforeShow: function() {
                    setTimeout(function(){
                        console.log(this)
                        $('.ui-datepicker').css('z-index', 99999999999999);
                        $(this).val("01/05/2012")
                    }, 0);
                },
            })
            $( "#vaccination_date_datepicker" ).datepicker('setDate', 'today');

            /**
             * UPDATE VACCINATION DATEPICKER 
             **/
            $('.update-vax-datepicker').each( function() {
                $(this).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    autoclose: true,
                    maxDate: '0',
                    beforeShow: function() {
                        setTimeout(function(){
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    },
                })
            })
        

        } );

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
        
        //set default age in modal update form
        function defaultAgeStr(){
            $('.display-age').each(function(){
                    $(this).html(getAge("{{$vaccinee->birthdate_mdy}}"));
                });
            // $('#display-age').html(getAge("{{$vaccinee->birthdate_mdy}}"));
        }
        defaultAgeStr();

     
    </script>
</x-app-layout>