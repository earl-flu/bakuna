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

    @if (session('success-delete'))
    <script>
        $.toast({
                heading: 'Deleted',
                text: "{{ session('success-delete') }}",
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
                <p class="text-xs">{{$vaccinee->id_str}}</p>
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

    <!-- PRINT SECTION-->
    <div x-data="{printPos: 'print-center'}">
        <div class="flex mb-2">
            <x-label class="mr-2" for="left" :value="__('Left')" />
            <input type="radio" class="w-4 h-4 mr-5" id="left" name="print-position" value="print-left"
                x-model="printPos">

            <x-label class="mr-2" for="center" :value="__('Center')" />
            <input type="radio" class="w-4 h-4" checked id="center" name="print-position" value="print-center"
                x-model="printPos">
        </div>

        <x-button class="print-1 text-xs">
            Print Vaccination Card
        </x-button>

        @if ($vaccinee->hasBooster())
        <x-button class="print-2 text-xs">
            Print Booster Card
        </x-button>
        @endif


        <!-- PRINTED VACCINATION CARD TEMPLATE-->
        <div id="card-1" class="invisible fixed top-0" x-bind:class="printPos">
            <!-- -->
            <div class="vaccination-card text-white bg-white text-gray-600 flex overflow-hidden">
                <div class="v-aside relative">
                    <div class="z-10 relative h-full flex flex-col">
                        <div class="v-header flex-1 flex relative">
                            <p class="v-title font-semibold tracking-widest transform -rotate-90 origin-top-left">
                                COVID-19
                            </p>
                            <p class="v-sub uppercase font-semibold transform -rotate-90 origin-top-left">
                                VACCINATION CARD
                            </p>
                        </div>
                        <div class="v-qr-container">
                            <div class="box bg-gray-500">
                                {!! QrCode::size(67)
                                ->generate($vaccinee->uuid); !!}
                                {{-- {!! QrCode::size(67)
                                ->generate(route('vaccinees.verify', $vaccinee)); !!} --}}

                            </div>
                        </div>
                    </div>
                    <img src="{{asset('images/bg/vax-bg.png')}}"
                        class="absolute left-0 top-0 object-cover w-full h-full">
                </div>
                <div class="relative flex-1 flex">

                    <div class="flex-1 flex flex-col"
                        style="border-top:1px dotted rgba(12, 105, 128,0.5); border-bottom:1px dotted rgba(12, 105, 128,0.5);">
                        <!-- Province Header -->
                        <div class="v-header-container flex  justify-end pr-2 items-center">
                            <div class="pr-2">
                                <p class="prov-of font-semibold text-right uppercase">PROVINCE OF</p>
                                <p class="catnes font-semibold uppercase">CATANDUANES</p>
                            </div>
                            <div class="prov-logo">
                                <img src="{{asset('images/icons/catanduanes-seal.png')}}"
                                    class="h-10- w-10 object-cover">
                            </div>
                        </div>

                        <!-- Person Details-->
                        <div class="person-container flex overflow-hidden">
                            <div class="picture-container">
                                <div class="image-box font-normal flex items-center justify-center">
                                    Picture
                                </div>
                            </div>
                            <div class="details-container flex items-center">
                                <div>
                                    <p class="uppercase v-name font-semibold leading-3">{{$vaccinee->full_name}}</p>
                                    <p class="f-9px mt-0.5">{{$vaccinee->birthdate_str}}</p>
                                    <p class="f-9px capitalize">{{$vaccinee->sex_str}}</p>
                                    <p class="f-9px capitalize">{{$vaccinee->barangay}},
                                        {{$vaccinee->municipality_str}},
                                        Catanduanes</p>

                                    {{-- <p class="f-9px">Date Registered</p> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Table Container-->
                        <div class="vax-table-container">
                            <table class="vax-table w-full">
                                <tr>
                                    <th></th>
                                    <th class="font-semibold">Date Given</th>
                                    <th class="font-semibold">Given By</th>
                                    <th class="font-semibold">Lot #</th>
                                    <th class="font-semibold">Brand</th>
                                </tr>
                                @if ($vaccinee->doseDetails(1, 'is_deferred'))
                                <tr>
                                    <td class="uppercase">1ST DOSE</td>
                                    <td class="uppercase"></td>
                                    <td class="uppercase"></td>
                                    <td></td>
                                    <td class="uppercase"></td>
                                </tr>
                                @else
                                <tr>
                                    <td class="uppercase">1ST DOSE</td>
                                    <td class="uppercase">{{$vaccinee->doseDetails(1, 'vaccination_date_str_mdy')}}</td>
                                    <td class="uppercase">{{$vaccinee->vaccinatorName(1)}}</td>
                                    <td>{{$vaccinee->doseDetails(1, 'lot_number_id')}}</td>
                                    <td class="uppercase">{{$vaccinee->doseDetails(1, 'manufacturername_str')}}</td>
                                </tr>
                                @endif

                                @if ($vaccinee->doseDetails(2, 'is_deferred'))
                                <tr>
                                    <td class="uppercase">2ND DOSE</td>
                                    <td class="uppercase"></td>
                                    <td class="uppercase"></td>
                                    <td></td>
                                    <td class="uppercase"></td>
                                </tr>
                                @else
                                <tr>
                                    <td class="uppercase">2ND DOSE</td>
                                    <td class="uppercase">{{$vaccinee->doseDetails(2, 'vaccination_date_str_mdy')}}</td>
                                    <td class="uppercase">
                                        {{$vaccinee->vaccinatorName(2)}}</td>
                                    <td>
                                        {{$vaccinee->doseDetails(2, 'lot_number_id')}}
                                    </td>
                                    <td class="uppercase">{{$vaccinee->doseDetails(2, 'manufacturername_str')}}</td>
                                </tr>
                                @endif

                            </table>
                        </div>

                        <!-- Social Media-->
                        <div class="flex w-full v-social-media justify-between">
                            <div class=" flex">
                                <svg class="v-gmail-svg" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 250.57 250.57" style="enable-background:new 0 0 250.57 250.57;"
                                    xml:space="preserve">
                                    <path fill="#0c6980" d="M23.032,220.285h204.506c12.7,0,23.032-10.333,23.032-23.034V53.318c0-12.701-10.332-23.033-23.032-23.033H23.032
                    C10.332,30.285,0,40.618,0,53.318v143.933C0,209.952,10.332,220.285,23.032,220.285z M15,53.318c0-4.436,3.601-8.033,8.032-8.033
                    h204.506c4.433,0,8.032,3.597,8.032,8.033v143.933c0,4.437-3.6,8.034-8.032,8.034H23.032c-4.432,0-8.032-3.597-8.032-8.034V53.318z
                    M44.738,194.677h-15V56.529l93.674,60.815c1.102,0.715,2.643,0.716,3.748-0.002l93.673-60.813v138.148h-15V84.151l-70.507,45.774
                    c-2.992,1.941-6.464,2.966-10.041,2.966s-7.049-1.025-10.039-2.965L44.738,84.151V194.677z" />
                                </svg>
                                info.catanduaneseoc@gmail.com
                            </div>
                            <div class=" flex">
                                <svg class="v-fb-svg" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 155.139 155.139" style="enable-background:new 0 0 155.139 155.139;"
                                    xml:space="preserve">
                                    <g>
                                        <path id="f_1_" style="fill:#0c6980;" d="M89.584,155.139V84.378h23.742l3.562-27.585H89.584V39.184
                    c0-7.984,2.208-13.425,13.67-13.425l14.595-0.006V1.08C115.325,0.752,106.661,0,96.577,0C75.52,0,61.104,12.853,61.104,36.452
                    v20.341H37.29v27.585h23.814v70.761H89.584z" />
                                    </g>
                                </svg>
                                imtcatanduanes
                            </div>
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="v-phone-svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M14.414 7l3.293-3.293a1 1 0 00-1.414-1.414L13 5.586V4a1 1 0 10-2 0v4.003a.996.996 0 00.617.921A.997.997 0 0012 9h4a1 1 0 100-2h-1.586z" />
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                0968-773-0422
                                {{-- <svg class="v-web-svg" id="Layer_1" enable-background="new 0 0 512.418 512.418"
                                    height="512" viewBox="0 0 512.418 512.418" width="512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#0c6980"
                                        d="m437.335 75.082c-100.1-100.102-262.136-100.118-362.252 0-100.103 100.102-100.118 262.136 0 362.253 100.1 100.102 262.136 100.117 362.252 0 100.103-100.102 100.117-262.136 0-362.253zm-10.706 325.739c-11.968-10.702-24.77-20.173-38.264-28.335 8.919-30.809 14.203-64.712 15.452-99.954h75.309c-3.405 47.503-21.657 92.064-52.497 128.289zm-393.338-128.289h75.309c1.249 35.242 6.533 69.145 15.452 99.954-13.494 8.162-26.296 17.633-38.264 28.335-30.84-36.225-49.091-80.786-52.497-128.289zm52.498-160.936c11.968 10.702 24.77 20.173 38.264 28.335-8.919 30.809-14.203 64.712-15.452 99.954h-75.31c3.406-47.502 21.657-92.063 52.498-128.289zm154.097 31.709c-26.622-1.904-52.291-8.461-76.088-19.278 13.84-35.639 39.354-78.384 76.088-88.977zm0 32.708v63.873h-98.625c1.13-29.812 5.354-58.439 12.379-84.632 27.043 11.822 56.127 18.882 86.246 20.759zm0 96.519v63.873c-30.119 1.877-59.203 8.937-86.246 20.759-7.025-26.193-11.249-54.82-12.379-84.632zm0 96.581v108.254c-36.732-10.593-62.246-53.333-76.088-88.976 23.797-10.817 49.466-17.374 76.088-19.278zm32.646 0c26.622 1.904 52.291 8.461 76.088 19.278-13.841 35.64-39.354 78.383-76.088 88.976zm0-32.708v-63.873h98.625c-1.13 29.812-5.354 58.439-12.379 84.632-27.043-11.822-56.127-18.882-86.246-20.759zm0-96.519v-63.873c30.119-1.877 59.203-8.937 86.246-20.759 7.025 26.193 11.249 54.82 12.379 84.632zm0-96.581v-108.254c36.734 10.593 62.248 53.338 76.088 88.977-23.797 10.816-49.466 17.373-76.088 19.277zm73.32-91.957c20.895 9.15 40.389 21.557 57.864 36.951-8.318 7.334-17.095 13.984-26.26 19.931-8.139-20.152-18.536-39.736-31.604-56.882zm-210.891 56.882c-9.165-5.947-17.941-12.597-26.26-19.931 17.475-15.394 36.969-27.801 57.864-36.951-13.068 17.148-23.465 36.732-31.604 56.882zm.001 295.958c8.138 20.151 18.537 39.736 31.604 56.882-20.895-9.15-40.389-21.557-57.864-36.951 8.318-7.334 17.095-13.984 26.26-19.931zm242.494 0c9.165 5.947 17.942 12.597 26.26 19.93-17.475 15.394-36.969 27.801-57.864 36.951 13.067-17.144 23.465-36.729 31.604-56.881zm26.362-164.302c-1.249-35.242-6.533-69.146-15.452-99.954 13.494-8.162 26.295-17.633 38.264-28.335 30.84 36.225 49.091 80.786 52.497 128.289z" />
                                </svg>
                                www.imt-catanduanes.ph --}}
                            </div>
                        </div>

                    </div>
                    <!-- img right border-->
                    <div class="img-border-container h-full">
                        <img src="{{asset('images/bg/vax-bg.png')}}" class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF PRINTED VACCINATION CARD TEMPLATE-->

        <!-- PRINTED BOOSTER CARD TEMPLATE-->
        {{-- section-to-print-booster --}}
        <div id="card-2" class="invisible fixed top-0" x-bind:class="printPos">
            <!-- -->
            <div class="vaccination-card text-white bg-white text-gray-600 flex overflow-hidden">
                <div class="v-aside relative">
                    <div class="z-10 relative h-full flex flex-col">
                        <div class="v-header flex-1 flex relative">
                            <p class="v-title font-semibold tracking-widest transform -rotate-90 origin-top-left">
                                COVID-19
                            </p>
                            <p class="v-sub uppercase font-semibold transform -rotate-90 origin-top-left">
                                VACCINATION CARD
                            </p>
                        </div>
                        <div class="v-qr-container">
                            <div class="box bg-gray-500">
                                {!! QrCode::size(67)
                                ->generate($vaccinee->uuid); !!}
                                {{-- {!! QrCode::size(67)
                                ->generate(route('vaccinees.verify', $vaccinee)); !!} --}}
                            </div>
                        </div>
                    </div>
                    <img src="{{asset('images/bg/vax-bg-test.png')}}"
                        class="absolute left-0 top-0 object-cover w-full h-full">
                </div>
                <div class="relative flex-1 flex">

                    <div class="flex-1 flex flex-col"
                        style="border-top:1px dotted rgba(12, 105, 128,0.5); border-bottom:1px dotted rgba(12, 105, 128,0.5);">
                        <!-- Province Header -->
                        <div class="v-header-container flex  justify-end pr-2 items-center mt-1">
                            <div class="pr-2">
                                <p class="prov-of font-semibold text-right uppercase">PROVINCE OF</p>
                                <p class="catnes font-semibold uppercase">CATANDUANES</p>
                            </div>
                            <div class="prov-logo">
                                <img src="{{asset('images/icons/catanduanes-seal.png')}}"
                                    class="h-10- w-10 object-cover">
                            </div>
                        </div>

                        <!-- Person Details-->
                        <div class="person-container flex overflow-hidden mt-2">
                            <div class="picture-container">
                                <div class="image-box font-normal flex items-center justify-center">
                                    Picture
                                </div>
                            </div>
                            <div class="details-container flex items-center">
                                <div>
                                    <p class="uppercase v-name font-semibold leading-3">{{$vaccinee->full_name}}</p>
                                    <p class="f-9px mt-0.5">{{$vaccinee->birthdate_str}}</p>
                                    <p class="f-9px capitalize">{{$vaccinee->sex_str}}</p>
                                    <p class="f-9px capitalize">{{$vaccinee->barangay}},
                                        {{$vaccinee->municipality_str}},
                                        Catanduanes</p>

                                    {{-- <p class="f-9px">Date Registered</p> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Table Container-->
                        <div class="vax-table-container mt-1 mb-1">
                            <table class="vax-table w-full">
                                <tr>
                                    <th></th>
                                    <th class="font-semibold">Date Given</th>
                                    <th class="font-semibold">Given By</th>
                                    <th class="font-semibold">Lot #</th>
                                    <th class="font-semibold">Brand</th>
                                </tr>
                                {{-- <tr>
                                    <td class="uppercase">1ST DOSE</td>
                                    <td class="uppercase">{{$vaccinee->doseDetails(1, 'vaccination_date_str_mdy')}}</td>
                                    <td class="uppercase">{{$vaccinee->vaccinatorName(1)}}</td>
                                    <td>{{$vaccinee->doseDetails(1, 'lot_number_id')}}</td>
                                    <td class="uppercase">{{$vaccinee->doseDetails(1, 'manufacturername_str')}}</td>
                                </tr> --}}
                                @if ($vaccinee->doseDetails(3, 'is_deferred'))
                                <tr>
                                    <td class="uppercase">Booster</td>
                                    <td class="uppercase"></td>
                                    <td class="uppercase"></td>
                                    <td></td>
                                    <td class="uppercase"></td>
                                </tr>
                                @else
                                <tr>
                                    <td class="uppercase">Booster</td>
                                    <td class="uppercase">{{$vaccinee->doseDetails(3, 'vaccination_date_str_mdy')}}</td>
                                    <td class="uppercase">{{$vaccinee->vaccinatorName(3)}}</td>
                                    <td>{{$vaccinee->doseDetails(3, 'lot_number_id')}}</td>
                                    <td class="uppercase">{{$vaccinee->doseDetails(3, 'manufacturername_str')}}</td>
                                </tr>
                                @endif

                            </table>
                        </div>

                        <!-- Social Media-->
                        <div class="flex w-full v-social-media justify-between mt-1">
                            <div class=" flex">
                                <svg class="v-gmail-svg" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 250.57 250.57" style="enable-background:new 0 0 250.57 250.57;"
                                    xml:space="preserve">
                                    <path fill="#0c6980" d="M23.032,220.285h204.506c12.7,0,23.032-10.333,23.032-23.034V53.318c0-12.701-10.332-23.033-23.032-23.033H23.032
                    C10.332,30.285,0,40.618,0,53.318v143.933C0,209.952,10.332,220.285,23.032,220.285z M15,53.318c0-4.436,3.601-8.033,8.032-8.033
                    h204.506c4.433,0,8.032,3.597,8.032,8.033v143.933c0,4.437-3.6,8.034-8.032,8.034H23.032c-4.432,0-8.032-3.597-8.032-8.034V53.318z
                    M44.738,194.677h-15V56.529l93.674,60.815c1.102,0.715,2.643,0.716,3.748-0.002l93.673-60.813v138.148h-15V84.151l-70.507,45.774
                    c-2.992,1.941-6.464,2.966-10.041,2.966s-7.049-1.025-10.039-2.965L44.738,84.151V194.677z" />
                                </svg>
                                info.catanduaneseoc@gmail.com
                            </div>
                            <div class=" flex">
                                <svg class="v-fb-svg" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 155.139 155.139" style="enable-background:new 0 0 155.139 155.139;"
                                    xml:space="preserve">
                                    <g>
                                        <path id="f_1_" style="fill:#0c6980;" d="M89.584,155.139V84.378h23.742l3.562-27.585H89.584V39.184
                    c0-7.984,2.208-13.425,13.67-13.425l14.595-0.006V1.08C115.325,0.752,106.661,0,96.577,0C75.52,0,61.104,12.853,61.104,36.452
                    v20.341H37.29v27.585h23.814v70.761H89.584z" />
                                    </g>
                                </svg>
                                imtcatanduanes
                            </div>

                            <div class=" flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="v-phone-svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M14.414 7l3.293-3.293a1 1 0 00-1.414-1.414L13 5.586V4a1 1 0 10-2 0v4.003a.996.996 0 00.617.921A.997.997 0 0012 9h4a1 1 0 100-2h-1.586z" />
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                0908-499-0867
                                {{-- <svg class="v-web-svg" id="Layer_1" enable-background="new 0 0 512.418 512.418"
                                    height="512" viewBox="0 0 512.418 512.418" width="512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#0c6980"
                                        d="m437.335 75.082c-100.1-100.102-262.136-100.118-362.252 0-100.103 100.102-100.118 262.136 0 362.253 100.1 100.102 262.136 100.117 362.252 0 100.103-100.102 100.117-262.136 0-362.253zm-10.706 325.739c-11.968-10.702-24.77-20.173-38.264-28.335 8.919-30.809 14.203-64.712 15.452-99.954h75.309c-3.405 47.503-21.657 92.064-52.497 128.289zm-393.338-128.289h75.309c1.249 35.242 6.533 69.145 15.452 99.954-13.494 8.162-26.296 17.633-38.264 28.335-30.84-36.225-49.091-80.786-52.497-128.289zm52.498-160.936c11.968 10.702 24.77 20.173 38.264 28.335-8.919 30.809-14.203 64.712-15.452 99.954h-75.31c3.406-47.502 21.657-92.063 52.498-128.289zm154.097 31.709c-26.622-1.904-52.291-8.461-76.088-19.278 13.84-35.639 39.354-78.384 76.088-88.977zm0 32.708v63.873h-98.625c1.13-29.812 5.354-58.439 12.379-84.632 27.043 11.822 56.127 18.882 86.246 20.759zm0 96.519v63.873c-30.119 1.877-59.203 8.937-86.246 20.759-7.025-26.193-11.249-54.82-12.379-84.632zm0 96.581v108.254c-36.732-10.593-62.246-53.333-76.088-88.976 23.797-10.817 49.466-17.374 76.088-19.278zm32.646 0c26.622 1.904 52.291 8.461 76.088 19.278-13.841 35.64-39.354 78.383-76.088 88.976zm0-32.708v-63.873h98.625c-1.13 29.812-5.354 58.439-12.379 84.632-27.043-11.822-56.127-18.882-86.246-20.759zm0-96.519v-63.873c30.119-1.877 59.203-8.937 86.246-20.759 7.025 26.193 11.249 54.82 12.379 84.632zm0-96.581v-108.254c36.734 10.593 62.248 53.338 76.088 88.977-23.797 10.816-49.466 17.373-76.088 19.277zm73.32-91.957c20.895 9.15 40.389 21.557 57.864 36.951-8.318 7.334-17.095 13.984-26.26 19.931-8.139-20.152-18.536-39.736-31.604-56.882zm-210.891 56.882c-9.165-5.947-17.941-12.597-26.26-19.931 17.475-15.394 36.969-27.801 57.864-36.951-13.068 17.148-23.465 36.732-31.604 56.882zm.001 295.958c8.138 20.151 18.537 39.736 31.604 56.882-20.895-9.15-40.389-21.557-57.864-36.951 8.318-7.334 17.095-13.984 26.26-19.931zm242.494 0c9.165 5.947 17.942 12.597 26.26 19.93-17.475 15.394-36.969 27.801-57.864 36.951 13.067-17.144 23.465-36.729 31.604-56.881zm26.362-164.302c-1.249-35.242-6.533-69.146-15.452-99.954 13.494-8.162 26.295-17.633 38.264-28.335 30.84 36.225 49.091 80.786 52.497 128.289z" />
                                </svg>
                                www.imt-catanduanes.ph --}}
                            </div>
                        </div>

                    </div>
                    <!-- img right border-->
                    <div class="img-border-container h-full">
                        <img src="{{asset('images/bg/vax-bg-test.png')}}" class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF PRINTED BOOSTER CARD TEMPLATE-->

    </div>
    <!-- //PRINT SECTION-->
    <div class="bg-white p-5 rounded-md mb-5 shadow text-gray-600 border mt-5">
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
                <td class="p-2 border">
                    @if ($bakuna->vaccination_date_str === 'TODAY')
                    <span class="text-white bg-green-600 py-1 px-2 rounded text-xs">
                        {{$bakuna->vaccination_date_str}}</span>

                    @else
                    {{$bakuna->vaccination_date_str}}
                    @endif
                </td>
                <td class="p-2 border">{{$bakuna->category}}</td>
                <td class="p-2 border">{{$bakuna->manufacturername_str}}</td>
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
                    {{$bakuna->lot_number_id}}
                </td>
                <td class="p-2 border">
                    @if ($bakuna->is_deferred)
                    <span class="py-0.5 px-1 rounded bg-red-500 text-gray-100">YES</span>
                    @else
                    No
                    @endif
                </td>
                <td class="p-2 border">
                    <div class="inline-block mr-2">
                        <a href="#vaxupdatemodal-{{$bakuna->id}}" class="vaxupdatemodal">
                            <!-- rel="modal:open"-->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hover:text-black" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                    @if (Auth::user()->is_super_admin)
                    <div class="inline-block">
                        <a href="#vaxdeletemodal-{{$bakuna->id}}" class="vaxdeletemodal">
                            <svg class="w-5 h-5  hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </a>
                    </div>
                    @endif
                    <!-- Delete Vaccination Modal-->
                    <div id="vaxdeletemodal-{{$bakuna->id}}" class="modal">

                        <div class="flex">
                            <svg class="w-44 h-44 -mt-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="flex flex-col">
                                <p class="text-2xl font-semibold text-gray-600">Delete Record?</p>
                                {{-- <p class="mt-0.5 leading-5">Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit.</p> --}}
                                <table class="mt-2 text-gray-600 font-medium text-sm">
                                    <tr>
                                        <td class="pt-1">Vaccine Shot</td>
                                        <td class="px-2 pt-1">:</td>
                                        <td class="pt-1">
                                            @if ($bakuna->vaccine_shot == 1)
                                            First Dose
                                            @endif
                                            @if ($bakuna->vaccine_shot == 2)
                                            Second Dose
                                            @endif
                                            @if ($bakuna->vaccine_shot == 3)
                                            Booster Dose
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-1">Manufacturer</td>
                                        <td class="px-2 pt-1">:</td>
                                        <td class="pt-1">{{$bakuna->manufacturername_str}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pt-1">Lot Number</td>
                                        <td class="px-2 pt-1">:</td>
                                        <td class="pt-1">{{$bakuna->lot_number_id}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pt-1">Vaccination Date</td>
                                        <td class="px-2 pt-1">:</td>
                                        <td class="pt-1">
                                            @if ($bakuna->vaccination_date_str === 'TODAY')
                                            <span class="text-white bg-green-600 py-1 px-2 rounded text-xs">
                                                {{$bakuna->vaccination_date_str}}</span>

                                            @else
                                            {{$bakuna->vaccination_date_str}}
                                            @endif
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        {{-- <p>
                            {{$bakuna->id}}
                        </p> --}}

                        <div class="flex mt-4">
                            <div class="flex flex-1">
                                <a href="#" rel="modal:close" class="flex-1 bg-gray-500 text-white 
                                p-3 text-center rounded hover:bg-gray-600">
                                    Cancel
                                </a>
                            </div>

                            <div class="w-3">
                                <!--spacer-->
                            </div>
                            <form class="flex-1 flex" method="POST"
                                action="{{route('vaccinees.bakunas.destroy', [$vaccinee, $bakuna])}}">
                                @csrf
                                @method('delete')
                                <button class="flex-1 bg-red-500 text-white 
                            p-3 text-center rounded hover:bg-red-600">Delete</button>
                            </form>
                        </div>

                    </div>
                    <!-- //Delete Vaccination Modal-->
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
        //Print Vaccination Card Button
        const print1 = document.querySelector('.print-1')
        // console.log("{{asset('css/vaccination-card/print-vax-card.css')}}");
        print1.addEventListener('click',function(){
            $("#card-2").removeClass('section-to-print');
            $("#card-1").addClass('section-to-print');
            window.print();
            // document.getElementById('printCss').href = "{{asset('css/vaccination-card/print-vax-card.css')}}";
            // setTimeout(() => {
            //     window.print();
            // }, 300); 
        })

        //Print Booster Card Button
        const print2 = document.querySelector('.print-2')
        if (print2) {
            print2.addEventListener('click',function(){
                $("#card-1").removeClass('section-to-print');
                $("#card-2").addClass('section-to-print');
                window.print();
            // document.getElementById('printCss').href = "{{asset('css/vaccination-card/print-booster-card.css')}}";
            // setTimeout(() => {
            //     window.print();
            // }, 300); 
        })
        }
       


        function addVaxData(){
            return {
                isComorbidity: false, 
                alp_category: '', 
                isPedia: false,
                alp_dose: '',
                // setIsPedia(e){
                //     const category = e.target.value
                //     if( category == "ROPP" || category == "PA3"){
                //         this.isPedia = true
                //     } else {
                //         this.isPedia = false
                //     }
                // }
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
                // setIsPedia(e){
                //     console.log('UpdateVaxData')
                //     const category = e.target.value
                //     if( category == "ROPP" || category == "PA3"){
                //         this.isPedia = true
                //     } else {
                //         this.isPedia = false
                //     }
                // }
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

            //Loop to every update-vax-form
            $(".update-vax-form").each(function(){
                $(this).validate({
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

        /**
         * MODAL FOR UPDATE VAX MODAL
         * loop to multiple modal
         * jquery modal unclosable window
         * */
        $('.vaxupdatemodal').each(function(){
            $(this).click(function(event) {
                event.preventDefault();
                $(this).modal({
                    escapeClose: true,
                    clickClose: false,
                    // fadeDuration: 50
                });
            });
        });

        $('.vaxdeletemodal').each(function(){
            $(this).click(function(event) {
                event.preventDefault();
                $(this).modal({
                    escapeClose: true,
                    clickClose: false,
                    // fadeDuration: 50
                });
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

        console.log("{{ asset('css/app.css') }}");
    </script>
</x-app-layout>