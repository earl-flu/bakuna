<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h1 class="text-xl">More than one vaccination data</h1>
    <ul class="list-decimal ml-5">
        @foreach ($tests as $test)
        <li>{{$test->full_name}}</li>
        @endforeach
    </ul>
    <h2 class="mt-5 text-xl">No Vaccination data</h2>
    <ul class="list-decimal ml-5">
        @foreach ($tests2 as $test)
        <li>{{$test->full_name}}</li>
        @endforeach
    </ul>

    <h2 class="text-2xl mt-5">Aztrazeneca</h2>
    <ul class="list-decimal ml-10">
        @foreach ($aztrapips as $aztrapip)
        <li>{{$aztrapip->vaccinee->full_name}} | Dose: {{$aztrapip->vaccine_shot}}</li>
        @endforeach

    </ul>

    <h2 class="text-2xl mt-5">Pfizer First Dose</h2>
    <ul class="list-decimal ml-10">
        @foreach ($gurangpfis as $pfi)
        <li>{{$pfi->vaccinee->full_name}} | Dose: {{$pfi->vaccine_shot}}</li>
        @endforeach

    </ul>

    <h2 class="text-2xl mt-5">Pedia Sputnik</h2>
    <ul class="list-decimal ml-10">
        @foreach ($sputpips as $sputpip)
        <li>{{$sputpip->vaccinee->full_name}} | Dose: {{$sputpip->vaccine_shot}} | Age: {{$sputpip->vaccinee->age}}</li>
        @endforeach

    </ul>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    **WORK IN PROGRESS
                </div>
            </div>
            <p class="text-xl mt-5">Total: {{$total}}</p>
            <p class="text-xs mb-5 font-bold text-gray-500">December 20, 2021</p>
            <table>
                <tr>
                    <td>First Dose</td>
                    <td class="px-2">:</td>
                    <td>{{$firstD}}</td>
                </tr>
                <tr>
                    <td>Second Dose</td>
                    <td class="px-2">:</td>
                    <td>{{$secondD}}</td>
                </tr>
                <tr>
                    <td>Booster</td>
                    <td class="px-2">:</td>
                    <td>{{$booster}}</td>
                </tr>
                <tr class="pt-5">
                    <td class="p-1 pt-8">Sinovac</td>
                    <td class="p-1 pt-8 px-2">:</td>
                    <td class="p-1 pt-8">{{$sinovac}}</td>
                </tr>
                <tr>
                    <td class="p-1">Aztrazeneca</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$az}}</td>
                </tr>
                <tr>
                    <td class="p-1">Pfizer</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$pfizer}}</td>
                </tr>
                <tr>
                    <td class="p-1">Moderna</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$moderna}}</td>
                </tr>
                <tr>
                    <td class="p-1">Sputnik</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$sputnik}}</td>
                </tr>
                <tr>
                    <td class="p-1">Novavax</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$novavax}}</td>
                </tr>
                <tr>
                    <td class="p-1">Johnson and Johnson</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$jj}}</td>
                </tr>
            </table>

            {{-- <h2 class="text-2xl mt-10">Vaccine Brand</h2> --}}
            {{-- <table class="mt-5">
                <tr>
                    <td>Sinovac</td>
                    <td class="px-2">:</td>
                    <td>{{$sinovac}}</td>
                </tr>
                <tr>
                    <td>Aztrazeneca</td>
                    <td class="px-2">:</td>
                    <td>{{$az}}</td>
                </tr>
                <tr>
                    <td>Pfizer</td>
                    <td class="px-2">:</td>
                    <td>{{$pfizer}}</td>
                </tr>
                <tr>
                    <td>Moderna</td>
                    <td class="px-2">:</td>
                    <td>{{$moderna}}</td>
                </tr>
                <tr>
                    <td>Sputnik</td>
                    <td class="px-2">:</td>
                    <td>{{$sputnik}}</td>
                </tr>
                <tr>
                    <td>Novavax</td>
                    <td class="px-2">:</td>
                    <td>{{$novavax}}</td>
                </tr>
                <tr>
                    <td>Johnson and Johnson</td>
                    <td class="px-2">:</td>
                    <td>{{$jj}}</td>
                </tr>

            </table> --}}
        </div>
    </div>
</x-app-layout>