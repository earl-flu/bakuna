<x-app-layout>
    <x-heading class="pt-5 pb-10">Attendance</x-heading>
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
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- Card -->
        <div class="shadow flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class=" mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Attended Today
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200
          ">
                    {{$attended_today}}
                </p>
            </div>
        </div>
    </div>
    <div class="bg-white p-5 rouded-md shadow text-dark">
        <!-- Filters-->
        <form action="{{route('vaccinees.attendace-index')}}" method="GET" autocomplete="off">
            <div class="flex mb-10">
                <div class="mr-5">
                    <x-label for="last_name" :value="__('Last name')" />
                    <x-input id="last_name" class="block mt-1" type=" text" name="last_name"
                        value="{{request()->input('last_name')}}" />
                </div>

                <div class="mr-5">
                    <x-label for="first_name" :value="__('First name')" />
                    <x-input id="first_name" class="block mt-1" type=" text" name="first_name"
                        value="{{request()->input('first_name')}}" />
                </div>

                <x-button class="self-end mb-0.5">
                    {{ __('Search') }}
                </x-button>
            </div>
        </form>
        <table class="w-full text-left">
            <tr class="bg-blue-100">
                <th class="font-semibold p-3 border">Name</th>
                <th class="font-semibold p-3 border">Age</th>
                <th class="font-semibold p-3 border">Vaccination Date</th>
                <th class="font-semibold p-3 border">Action</th>
            </tr>

            @foreach ($vaccinees as $vaccinee)
            <tr class="hover:bg-gray-100">
                <td class="border p-3 relative">
                    @if ($vaccinee->in_attendance)
                    <div class="h-full w-1 bg-green-300 absolute left-0 top-0"></div>
                    @endif
                    {{$vaccinee->full_name}}
                </td>
                <td class="border p-3">{{$vaccinee->age}}</td>
                <td class="border p-3">
                    @if (isset($vaccinee->vaccination_date))
                    <span class="px-2 py-1 rounded text-white 
                    {{$vaccinee->vaccination_date_string == 'TODAY' ? 'bg-green-500' : 'bg-yellow-500'}}">
                        {{$vaccinee->vaccination_date_string}}
                    </span>
                    @else
                    <span class="px-2 py-1 rounded bg-red-500 text-white">None</span>
                    @endif
                </td>

                <td class="border p-3">
                    <!-- Modal Button -->
                    <a href="#modal-{{$vaccinee->id}}" rel="modal:open" class="block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <!-- //Modal Button -->
                    <!-- modal -->
                    <div id="modal-{{$vaccinee->id}}" class="modal">
                        <p class="text-3xl">{{$vaccinee->full_name}}</p>
                        <p>Age: {{$vaccinee->age}}</p>
                        <p>Schedule:
                            @if (isset($vaccinee->vaccination_date))
                            <span class="px-2 py-1 rounded text-white text-sm
                            {{$vaccinee->vaccination_date_string == 'TODAY' ? 'bg-green-500' : 'bg-yellow-500'}}">
                                {{$vaccinee->vaccination_date_string}}
                            </span>
                            @else
                            <span class="px-2 py-1 rounded bg-red-500 text-white text-sm">None</span>
                            @endif
                        </p>

                        <form method="POST" action="{{ route('vaccinees.attendance-update', $vaccinee)}}">
                            @csrf
                            @method('PUT')
                            <x-label for="remarks" class="mt-5" :value="__('Remarks')" />
                            <textarea name="remarks" id="" cols="30" rows="5"
                                class="w-full border border-gray-300">{{$vaccinee->remarks}}</textarea>

                            <x-label for="in_attendance" class="mt-2" :value="__('Is Present*')" />

                            <x-select
                                class="block mt-1 w-full {{$errors->has('in_attendance') ? 'border border-red-500' : ''}}"
                                id="in_attendance" name="in_attendance" required>
                                {{old('in_attendance')}}
                                <option value="" selected disabled>Choose here</option>

                                <option value="0" {{$vaccinee->in_attendance == 0 ? 'selected' : '' }}>
                                    Not Present
                                </option>
                                <option value="1" {{$vaccinee->in_attendance ==1 ? 'selected' : '' }}>
                                    PRESENT
                                </option>
                            </x-select>
                            @error('in_attendance')
                            <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                            @enderror
                            <footer class="mt-10">
                                <button class="mr-5 bg-blue-500 px-3 py-2 rounded text-white w-full"
                                    onclick="submitForm(this);">Save</button>
                            </footer>
                        </form>
                    </div>
                    <!-- //modal -->
                </td>
            </tr>
            @endforeach
        </table>
        <div class="mt-5">
            {{ $vaccinees->links() }}
        </div>
    </div>

    <script>
        })
        function submitForm(btn) {
            // disable the button
            btn.disabled = true;
            // submit the form    
            btn.form.submit();
        }
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
</x-app-layout>