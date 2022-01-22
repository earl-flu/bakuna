<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Incident Management Team - Catanduanes</title>

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>
    <div style="font-family:Poppins;" class="text-xs absolute top-0 left-0 w-full bg-gray-700 text-gray-100 px-4 py-2">
        Incident Management Team - Catanduanes
    </div>
    <div class="p-4 bg-gray-100">
        <div class="mt-14">
            <!-- Logos-->
            <div class="flex justify-between md:flex-row items-center flex-col max-w-3xl mx-auto">
                <div class="flex items-center">
                    <div class="h-14 w-14 sm:h-20 sm:w-20 md:h-24 md:w-24 md:mr-3 mr-2">
                        <img src="{{asset('images/icons/republic-of-the-philippines.png')}}" class="object-cover">
                    </div>

                    <div>
                        <p class="text-xs sm:text-sm">REPUBLIC OF THE PHILIPPINES</p>
                        <p class="text-xs sm:text-xl border-t md:border-t-2 border-black">Provincial Local Government
                            of
                            Catanduanes</p>
                    </div>
                </div>

                <div class="flex md:mt-0 mt-4">
                    <div class="h-14 w-14 sm:h-20 sm:w-20 sm:mt-3 md:mt-0 md:h-24 md:w-24 mr-2 md:mr-3">
                        <img src="{{asset('images/icons/catanduanes-seal.png')}}" class="object-cover">
                    </div>

                    <div class="h-14 w-14 sm:h-20 sm:w-20 sm:mt-3 md:mt-0 md:h-24 md:w-24">
                        <img src="{{asset('images/logos/imt-logo.jpg')}}" class="object-cover">
                    </div>
                </div>
            </div>
            <!-- //Logos-->



            <div class="bg-white max-w-2xl mx-auto p-5 shadow-md mb-5 mt-5 md:mt-10 border border-gray-300">
                {{-- Header Certificate --}}
                <div class=" text-center">
                    <h1 class="text-2xl font-semibold">COVID-19 VACCINATION CERTIFICATE</h1>
                    <p class="text-sm sm:text-base">This serves as proof that the vaccinee whose name and details
                        appear
                        herein
                        below has been vaccinated against Covid-19.
                    </p>
                </div>
                {{-- //Header Certificate --}}
                <div class="mt-5">
                    <p class="font-semibold mb-1">VACCINEE DETAILS</p>
                    <div class="rounded p-4 border border-gray-200 shadow text-gray-600">
                        <table class="text-xs sm:text-sm">
                            <tr>
                                <td>Name</td>
                                <td class="px-5">:</td>
                                <td class="uppercase">{{$vaccinee->full_name}}</td>
                            </tr>
                            <tr>
                                <td>Birthdate</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->birthdate_str}}</td>
                            </tr>
                            <tr>
                                <td>Sex</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->sex === 'F' ? 'Female':
                                    'Male'}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td class="px-5">:</td>
                                <td class="capitalize">{{$vaccinee->barangay}}, {{$vaccinee->municipality_str}},
                                    Catanduanes</td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="mt-5">
                    <p class="font-semibold mb-1">VACCINATION DETAILS</p>
                    @if ($vaccinee->hasDose(1))
                    <div class="rounded p-4 border border-gray-200 shadow text-gray-600">
                        <table class="text-xs sm:text-sm">
                            <tr>
                                <td>Vaccine Shot</td>
                                <td class="px-5">:</td>
                                <td>First Dose</td>
                            </tr>
                            <tr>
                                <td>Vaccination Date</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(1,'vaccination_date_str_mdy')}}</td>
                            </tr>
                            <tr>
                                <td>Brand</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(1,'manufacturer_name_str')}}</td>
                            </tr>
                            <tr>
                                <td>Lot Number</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(1,'lot_number_id')}}</td>
                            </tr>
                        </table>
                    </div>
                    @endif
                    @if ($vaccinee->hasDose(2))
                    <div class="rounded p-4 border border-gray-200 shadow mt-2 text-gray-600">
                        <table class="text-xs sm:text-sm">
                            <tr>
                                <td>Vaccine Shot</td>
                                <td class="px-5">:</td>
                                <td>Second Dose</td>
                            </tr>
                            <tr>
                                <td>Vaccination Date</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(2,'vaccination_date_str_mdy')}}</td>
                            </tr>
                            <tr>
                                <td>Brand</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(2,'manufacturer_name_str')}}</td>
                            </tr>
                            <tr>
                                <td>Lot Number</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(2,'lot_number_id')}}</td>
                            </tr>
                        </table>
                    </div>
                    @endif
                    @if ($vaccinee->hasDose(3))
                    <div class="rounded p-4 border border-gray-200 shadow mt-2 text-gray-600">
                        <table class="text-xs sm:text-sm">
                            <tr>
                                <td>Vaccine Shot</td>
                                <td class="px-5">:</td>
                                <td>Booster Dose</td>
                            </tr>
                            <tr>
                                <td>Vaccination Date</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(3,'vaccination_date_str_mdy')}}</td>
                            </tr>
                            <tr>
                                <td>Brand</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(3,'manufacturer_name_str')}}</td>
                            </tr>
                            <tr>
                                <td>Lot Number</td>
                                <td class="px-5">:</td>
                                <td>{{$vaccinee->doseDetails(3,'lot_number_id')}}</td>
                            </tr>
                        </table>
                    </div>
                    @endif
                </div>

                <div class="mt-5 flex sm:items-center flex-col sm:flex-row">
                    <div class="flex-1 text-xs sm:text-sm">
                        <p>Scan the QR Code to validate authenticity.</p>
                        <p>The QR Code should be directed to <span
                                class="underline">https://bakuna.imtcatanduanes.com</span>
                        </p>
                    </div>
                    <div>
                        <!-- QRCODE-->
                        <div class="h-20 w-20 mt-2 md:mt-0">
                            {!! QrCode::size(78)
                            ->generate(route('vaccinees.verify', $vaccinee)); !!}
                            {{-- {!! QrCode::size(78)
                            ->generate($vaccinee->uuid); !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>