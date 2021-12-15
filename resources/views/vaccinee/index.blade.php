<x-app-layout>
    <x-heading class="pt-5 pb-10">Vaccinees</x-heading>
    @if (session('success'))
    <script>
        $.toast({
                heading: 'Create Success',
                text: "{{ session('success') }}",
                icon: 'success',
                position: 'top-right'
            })
    </script>
    @endif
    <div class="bg-white p-5 rouded-md shadow text-dark">
        <!-- Filters-->
        <form action="{{route('vaccinees.index')}}" method="GET" autocomplete="off">
            <div class="flex mb-10">
                {{-- <div class="mr-5">
                    <x-label for="schedule" :value="__('Schedule')" />
                    <x-select class="block mt-1 w-full h-42px" id="schedule" name="type">
                        <option value="all" selected>All</option>
                        <option value="with-schedule" {{request()->input('type') == 'with-schedule' ? 'selected' :
                            ''}}>With Schedule</option>
                        <option value="without-schedule" {{request()->input('type') == 'without-schedule' ? 'selected' :
                            ''}}>Without Schedule</option>
                    </x-select>
                </div> --}}

                <div class="mr-5">
                    <x-label for="last_name" :value="__('Last name')" />
                    <x-input id="last_name" class="block mt-1" type=" text" name="last_name" placeholder="Valeza"
                        value="{{request()->input('last_name')}}" />
                </div>

                <div class="mr-5">
                    <x-label for="first_name" :value="__('First name')" />
                    <x-input id="first_name" class="block mt-1" type=" text" name="first_name" placeholder="Ryan"
                        value="{{request()->input('first_name')}}" />
                </div>

                <div class="mr-5">
                    <x-label for="middle_name" :value="__('Middle name')" />
                    <x-input id="middle_name" class="block mt-1" type=" text" name="middle_name" placeholder="Morales"
                        value="{{request()->input('middle_name')}}" />
                </div>

                <x-button class="self-end mb-0.5">
                    {{ __('Search') }}
                </x-button>
            </div>
        </form>

        <table class="w-full text-left">
            <tr class="bg-blue-100">
                {{-- <th class="font-semibold p-3 border">Registered At</th> --}}
                <th class="font-semibold p-3 border">Name</th>
                <th class="font-semibold p-3 border" style="width:300px;">Municipality</th>
                <th class="font-semibold p-3 border" >Age</th>
                {{-- <th class="font-semibold p-3 border" style="width:260px;">Vaccination Date</th> --}}
                {{-- <th class="font-semibold p-3 border" style="width:250px;">Remarks</th> --}}
                <th class="font-semibold p-3 border">Action</th>
            </tr>

            @foreach ($vaccinees as $vaccinee)
            <tr class="hover:bg-gray-100">
                {{-- <td class="border p-3">{{$vaccinee->date_registered}}</td> --}}
                <td class="border p-3 relative">
                    @if ($vaccinee->in_attendance)
                    <div class="h-full w-1 bg-green-300 absolute left-0 top-0"></div>
                    @endif

                    <a href="{{route('vaccinees.show', $vaccinee)}}" class="hover:underline text-primary uppercase">{{$vaccinee->full_name}}</a>
                </td>
                <td class="border p-3">{{$vaccinee->municipality}}</td>
                <td class="border p-3">{{$vaccinee->age}}</td>
                {{-- <td class="border p-3">
                    @if (isset($vaccinee->vaccination_date))
                    <span class="px-2 py-1 rounded bg-green-500 text-white">
                        {{$vaccinee->vaccination_date_string}}
                    </span>
                    @else
                    <span class="px-2 py-1 rounded bg-red-500 text-white">None</span>
                    @endif
                </td> --}}
                {{-- <td class="border p-3 leading-5">{{$vaccinee->remarks}}</td> --}}
                <td class="border p-3">
                    <!-- Modal Button -->
                    {{-- <a href="#modal-{{$vaccinee->id}}" rel="modal:open">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <!-- //Modal Button -->
                    <!-- modal -->
                    <div id="modal-{{$vaccinee->id}}" class="modal">
                        <h4 class="text-2xl mb-2 border-l-4 border-blue-800 pl-2">
                            Update Schedule
                        </h4>
                        <p>Name: {{$vaccinee->full_name}}</p>
                        <p>Age: {{$vaccinee->age}}</p>
                        <p>Schedule:
                            @if (isset($vaccinee->vaccination_date))
                            <span class="px-2 py-1 rounded bg-green-500 text-white text-sm">
                                {{$vaccinee->vaccination_date_string}}
                            </span>
                            @else
                            <span class="px-2 py-1 rounded bg-red-500 text-white text-sm">None</span>
                            @endif
                        </p>

                        <form method="POST" action="{{ route('vaccinees.update', $vaccinee)}}">
                            @csrf
                            @method('PUT')
                            <x-label for="_vaccination_date" class="mt-5" :value="__('Set Vaccination Date')" />
                            <x-input
                                class="_vaccination_date block mt-1 w-full flatpickr flatpickr-input {{$errors->has('vaccination_date') ? 'border border-red-500' : ''}}"
                                type="date" value="{{$vaccinee->vaccination_date}}" name="vaccination_date"
                                readonly="readonly" required />
                            <footer class="mt-10">

                                <button class="mr-5 bg-blue-500 px-3 py-1 rounded text-white">Save</button>
                                <a href="#" rel="modal:close"><button class="bg-gray-500 px-3 py-1 rounded text-white">
                                        Cancel
                                    </button></a>
                            </footer>
                        </form>
                    </div> --}}
                    <!-- //modal -->
                </td>
            </tr>
            @endforeach
        </table>
        <div class="mt-5">
            {{ $vaccinees->appends($_GET)->links() }}
        </div>



        <script>
            /**
             * Code for flatpickr - birthdate 
             */
              $("._vaccination_date").each(function(){
                $(this).flatpickr({
                        altInput: true,
                        altFormat: "F j, Y",
                        dateFormat: "Y-m-d",
                        minDate: "today",
                });
              })
        </script>
    </div>
    {{--
    <x-label for="schedule" :value="__('schedule*')" />
    <x-input id="schedule"
        class="block mt-1 w-full flatpickr flatpickr-input {{$errors->has('schedule') ? 'border border-red-500' : ''}}"
        type="text" :value="old('schedule')" name="schedule" readonly="readonly" required /> --}}

</x-app-layout>