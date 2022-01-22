<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters-->
            <form action="{{route('dashboard')}}" method="GET" autocomplete="off">
                <div class="flex mb-10">
                    {{-- <div class="mr-5">
                        <x-label for="schedule" :value="__('Schedule')" />
                        <x-select class="block mt-1 w-full h-42px" id="schedule" name="type">
                            <option value="all" selected>All</option>
                            <option value="with-schedule" {{request()->input('type') == 'with-schedule' ? 'selected' :
                                ''}}>With Schedule</option>
                            <option value="without-schedule" {{request()->input('type') == 'without-schedule' ?
                                'selected' :
                                ''}}>Without Schedule</option>
                        </x-select>
                    </div> --}}
                    <x-label for="schedule" :value="__('Vaccination Date')" />
                    <x-select class="block mt-1 w-full h-42px" id="schedule" name="vax_date">
                        <option value=""> SELECT HERE</option>
                        @foreach ($vaccination_dates as $v_date)
                        <option value="{{$v_date}}" {{request()->input('vax_date') == $v_date ? 'selected' :
                            ''}}>{{$v_date}}</option>
                        @endforeach

                    </x-select>

                    <x-button class="self-end mb-0.5">
                        {{ __('Search') }}
                    </x-button>
                </div>
            </form>
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    **WORK IN PROGRESS
                </div>
            </div> --}}
            <p class="text-xl mt-5 mb-5">Total Vaccinated: {{$total}}</p>
            {{-- <p class="text-xs mb-5 font-bold text-gray-500">December 20, 2021</p> --}}
        
            <div class="grid grid-cols-3 gap-3">
                <div class="border border-gray-300 bg-white p-5 rounded-md shadow-md">
                    <p class="text-xl mb-5">First Dose: {{$firstD}}</p>
                    @foreach ($firstD_data as $brand => $data_array)
                    <p class="font-semibold text-gray-600 mb-1">{{$brand}} ({{array_sum($firstD_data[$brand])}})</p>
                    <table class="mb-5 text-gray-600">
                        @php
                        ksort($data_array)
                        @endphp
                        @foreach ($data_array as $category => $total)
                        <tr>
                            <td class="">{{$category}}</td>
                            <td class=" px-4">:</td>
                            <td class="">{{$total}}</td>
                        </tr>
                        @endforeach
                    </table>
                    @endforeach
                </div>
                <div class="border border-gray-300 bg-white p-5 rounded-md shadow-md">
                    <p class="text-xl mb-5">Second Dose: {{$secondD}}</p>
                    @foreach ($secondD_data as $brand => $data_array)
                    <p class="font-semibold text-gray-600 mb-1">{{$brand}} ({{array_sum($secondD_data[$brand])}})</p>
                    <table class="mb-5 text-gray-600">
                        @php
                        ksort($data_array)
                        @endphp
                        @foreach ($data_array as $category => $total)
                        <tr>
                            <td class="">{{$category}}</td>
                            <td class=" px-4">:</td>
                            <td class="">{{$total}}</td>
                        </tr>
                        @endforeach
                    </table>
                    @endforeach
                </div>
                <div class="border border-gray-300 bg-white p-5 rounded-md shadow-md">
                    <p class="text-xl mb-5">Booster Dose: {{$booster}}</p>
                    @foreach ($boosterD_data as $brand => $data_array)
                    <p class="font-semibold text-gray-600 mb-1">{{$brand}} ({{array_sum($boosterD_data[$brand])}})</p>
                    @php
                    ksort($data_array)
                    @endphp
                    <table class="mb-5 text-gray-600">
                        @foreach ($data_array as $category => $total)
                        <tr>
                            <td class="">{{$category}}</td>
                            <td class=" px-4">:</td>
                            <td class="">{{$total}}</td>
                        </tr>
                        @endforeach
                    </table>
                    @endforeach
                </div>
            </div>

            <h2 class="text-xl mt-8 mb-3">Total Per Brand and Catagory:</h2>
            <table>
                <tr>
                    <td class="p-1">Sinovac</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$sinovac}}</td>
                </tr>
                <tr>
                    <td class="p-1">AstraZeneca</td>
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

                <tr class="pt-5">
                    <td class="p-1 pt-8">A1</td>
                    <td class="p-1 pt-8 px-2">:</td>
                    <td class="p-1 pt-8">{{$a1}}</td>
                </tr>
                <tr>
                    <td class="p-1">A1.8</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$a1_8}}</td>
                </tr>
                <tr>
                    <td class="p-1">A1.9</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$a1_9}}</td>
                </tr>
                <tr>
                    <td class="p-1">A2</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$a2}}</td>
                </tr>
                <tr>
                    <td class="p-1">A3</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$a3}}</td>
                </tr>
                <tr>
                    <td class="p-1">A4</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$a4}}</td>
                </tr>
                <tr>
                    <td class="p-1">A5</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$a5}}</td>
                </tr>
                <tr>
                    <td class="p-1">PA3</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$pa3}}</td>
                </tr>
                {{-- <tr>
                    <td class="p-1">ROP</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$rop}}</td>
                </tr> --}}
                <tr>
                    <td class="p-1">ROAP</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$roap}}</td>
                </tr>
                <tr>
                    <td class="p-1">ROPP</td>
                    <td class="p-1 px-2">:</td>
                    <td class="p-1">{{$ropp}}</td>
                </tr>
                <tr>
                    <td class="p-1 pt-5">Deferred</td>
                    <td class="p-1 pt-5 px-2">:</td>
                    <td class="p-1 pt-5 text-red-500">{{$deferred}}</td>
                </tr>
            </table>
        </div>
    </div>
</x-app-layout>