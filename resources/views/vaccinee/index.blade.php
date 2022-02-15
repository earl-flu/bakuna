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
                <th class="font-semibold p-3 border">1st D</th>
                <th class="font-semibold p-3 border">2nd D</th>
                <th class="font-semibold p-3 border">Booster</th>
                <th class="font-semibold p-3 border">Age</th>
                {{-- <th class="font-semibold p-3 border" style="width:260px;">Vaccination Date</th> --}}
                {{-- <th class="font-semibold p-3 border" style="width:250px;">Remarks</th> --}}

                {{-- <th class="font-semibold p-3 border">Action</th> --}}
            </tr>

            @forelse ($vaccinees as $vaccinee)
            <tr class="hover:bg-gray-100">
                {{-- <td class="border p-3">{{$vaccinee->date_registered}}</td> --}}
                <td class="border p-3 relative">
                    @if ($vaccinee->hasVaxToday())
                    <div class="h-full w-1 bg-green-300 absolute left-0 top-0"></div>
                    @endif

                    <a href="{{route('vaccinees.show', $vaccinee)}}"
                        class="hover:underline text-primary uppercase">{{$vaccinee->full_name}}</a>
                </td>
                <td class="border p-3">{{$vaccinee->municipality_str}}</td>
                {{-- USE MODEL
                FIND IF THERE IS A FIRST DOSE, SECOND DOSE, OR BOOSTER
                --}}
                <td class="border p-3">
                    @if ($vaccinee->hasDose(1))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="green">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    @else
                    <div class="border border-gray-500 rounded-full h-3 w-3 border-2"></div>
                    @endif
                </td>
                <td class="border p-3">
                    @if ($vaccinee->hasDose(2))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="green">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    @else
                    <div class="border border-gray-500 rounded-full h-3 w-3 border-2"></div>
                    @endif
                </td>
                <td class="border p-3">
                    @if ($vaccinee->hasDose(3))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="green">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    @else
                    <div class="border border-gray-500 rounded-full h-3 w-3 border-2"></div>
                    @endif
                </td>

                <td class="border p-3">{{$vaccinee->age}}</td>

            </tr>
            @empty
            <tr>
                <td class="p-3">
                    <p>Record not found</p>
                    <a href="{{route('vaccinees.create')}}" 
                    class="bg-gray-600 text-white p-2 mt-5 rounded
                    hover:bg-gray-700 inline-block w-full text-center"
                    >Add New</a>
                </td>
            </tr>
  
            @endforelse
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