<x-app-layout>
    <x-heading class="pt-5 pb-10 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mr-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
        Add Vaccination
    </x-heading>
    <div class="bg-white p-5 rounded-md mb-5 shadow">
        <div class="flex">
            <div class="flex flex-1 text-gray-600">
                <div class="mr-16">
                    <span class="text-xs">Last name</span>
                    <p class="text-3xl">{{$vaccinee->last_name}}</p>
                </div>
                <div class="mr-16">
                    <span class="text-xs">First name</span>
                    <p class="text-3xl">{{$vaccinee->first_name}}</p>
                </div>
                <div class="mr-16">
                    <span class="text-xs">Middle name</span>
                    <p class="text-3xl">{{$vaccinee->middle_name}}</p>
                </div>
                <div class="mr-16">
                    <span class="text-xs">Suffix</span>
                    <p class="text-3xl">{{$vaccinee->suffix}}</p>
                </div>
            </div>
            <div>
                <span class="text-xs">Age</span>
                <p class="text-3xl">{{$vaccinee->age}}</p>
            </div>
        </div>
    </div>
    <div class="bg-white p-5 rounded-md mb-5 shadow">
        <div class="flex text-gray-600 items-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
            </svg>
            <h2 class="text-xl">Vaccination Record</h2>
        </div>

        @if ($vaccinee->bakunas->isEmpty())
        <p class="text-italic text-red-500">NO RECORD FOUND</p>
        @else
        <table class="w-full text-left shadow">
            <tr class="bg-blue-100 text-sm text-gray-700">
                <th class="font-medium px-3 py-2 border">Shot</th>
                <th class="font-medium px-3 py-2 border">Brand Name</th>
                <th class="font-medium px-3 py-2 border" style="width:260px;">Date Vaccinated</th>
                <th class="font-medium px-3 py-2 border" style="width:250px;">Vaccinator Name</th>
                <th class="font-medium px-3 py-2 border">Lot Number</th>
                <th class="font-medium px-3 py-2 border">Action</th>
            </tr>
            @foreach ($vaccinee->bakunas as $bakuna)
            <tr class="hover:bg-gray-100 text-xs font-medium text-gray-600">
                <td class="border p-3">{{$bakuna->vaccine_shot_string}}</td>
                <td class="border p-3">{{$bakuna->manufacturer_name_string}}</td>
                <td class="border p-3">
                    <span
                        class="{{$bakuna->created_at_string === 'TODAY' ? 'bg-green-500 text-white p-1 rounded-md' : ''}}">
                        {{$bakuna->created_at_string}}
                    </span>
                </td>
                <td class="border p-3">{{$bakuna->vaccinator_name}}</td>
                <td class="border p-3">{{$bakuna->lot_number}}</td>
                <td class="border p-3">
                    <!-- Modal Button -->
                    <a href="#modal-{{$bakuna->id}}" rel="modal:open" class="inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-800" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>

                    <!-- //Modal Button -->
                    <!-- modal -->
                    <div id="modal-{{$bakuna->id}}" class="modal" style="max-width:600px; opacity:1; display:none;">
                        <h4 class="text-2xl mb-2 border-l-4 border-blue-800 pl-2">
                            Update Vaccination
                        </h4>
                        <form method="POST"
                            action="{{ route('vaccinees.bakunas.update', ['vaccinee' => $vaccinee, 'bakuna' => $bakuna])}}">
                            @csrf
                            @method('PUT')
                            <p class="font-medium text-green-500 mb-2">{{$bakuna->vaccine_shot_string}}</p>
                            <div class="flex">
                                <div class="flex-1">
                                    <!-- Vaccine Shot -->
                                    <div>
                                        <x-label for="vaccine_shot" :value="__('Vaccine Shot*')" />
                                        <x-select
                                            class="uppercase block mt-1 w-full {{$errors->has('vaccine_shot') ? 'border border-red-500' : ''}}"
                                            id=" vaccine_shot" name="vaccine_shot" required>
                                            <option value="" selected disabled>Choose here</option>
                                            @foreach ($vaccine_shots as $vaccine_shot => $vaccine_shot_val)
                                            <option value="{{$vaccine_shot_val}}" {{old('vaccine_shot') || $bakuna->
                                                vaccine_shot ==$vaccine_shot_val ? 'selected' : '' }}>
                                                {{$vaccine_shot}}
                                            </option>
                                            @endforeach
                                        </x-select>
                                        @error('vaccine_shot')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Vaccine Manufacturer Name -->
                                    <div class="mt-4">
                                        <x-label for="manufacturer_name" :value="__('Vaccine Manufacturer Name*')" />
                                        <x-select
                                            class="uppercase block mt-1 w-full {{$errors->has('manufacturer_name') ? 'border border-red-500' : ''}}"
                                            id=" manufacturer_name" name="manufacturer_name" required>
                                            <option value="" selected disabled>Choose here</option>
                                            @foreach ($manufacturer_names as $manufacturer_name =>
                                            $manufacturer_name_val)
                                            <option value="{{$manufacturer_name_val}}" {{old('manufacturer_name') ||
                                                $bakuna->manufacturer_name ==$manufacturer_name_val ? 'selected' : ''
                                                }}>
                                                {{$manufacturer_name}}
                                            </option>
                                            @endforeach
                                        </x-select>
                                        @error('manufacturer_name')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Vacinator Name -->
                                    <div class="mt-4">
                                        <x-label for="vaccinator_name" :value="__('Vaccinator Name*')" />
                                        <x-input id="vaccinator_name"
                                            class="uppercase block mt-1 w-full {{$errors->has('vaccinator_name') ? 'border border-red-500' : ''}}"
                                            type="text" name="vaccinator_name"
                                            value="{{old('vaccinator_name') ?: $bakuna->vaccinator_name}}" required
                                            autofocus />
                                        @error('vaccinator_name')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Vacinator Name -->
                                    <div class="mt-4">
                                        <x-label for="lot_number" :value="__('Lot Number*')" />
                                        <x-input id="lot_number"
                                            class="uppercase block mt-1 w-full {{$errors->has('lot_number') ? 'border border-red-500' : ''}}"
                                            type="text" name="lot_number"
                                            value="{{old('lot_number') ?: $bakuna->lot_number}}" required autofocus />
                                        @error('lot_number')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Adverse event BOOLEAN-->
                                    <div class="mt-4">
                                        <x-label for="adverse_event" :value="__('Adverse Event Condition*')" />

                                        <x-select
                                            class="uppercase block mt-1 w-full {{$errors->has('adverse_event') ? 'border border-red-500' : ''}}"
                                            id="adverse_event" name="adverse_event" required>
                                            <option value="" selected disabled>Choose here</option>
                                            @foreach ($adverse_events as $adverse_event => $adverse_event_val)
                                            <option value="{{$adverse_event_val}}" {{old('adverse_event') || $bakuna->
                                                adverse_event ==$adverse_event_val ? 'selected' : '' }}>
                                                {{$adverse_event}}
                                            </option>
                                            @endforeach
                                        </x-select>
                                        @error('adverse_event')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Adverse event condition -->
                                    <div class="mt-4">
                                        <x-label for="adverse_event_condition" :value="__('Adverse Event Condition')" />

                                        <x-select
                                            class="uppercase block mt-1 w-full {{$errors->has('adverse_event_condition') ? 'border border-red-500' : ''}}"
                                            id="adverse_event_condition" name="adverse_event_condition">
                                            {{-- <option value="" selected disabled>Choose here</option> --}}
                                            <option value="" selected>N/A</option>
                                            @foreach ($adverse_event_conditions as $adverse_event_condition)
                                            <option value="{{$adverse_event_condition}}"
                                                {{old('adverse_event_condition') || $bakuna->adverse_event_condition
                                                ==$adverse_event_condition ? 'selected'
                                                : '' }}>
                                                {{$adverse_event_condition}}
                                            </option>
                                            @endforeach
                                        </x-select>
                                        @error('adverse_event_condition')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <footer class="mt-10 flex">

                                <button class="flex-1 bg-blue-500 px-3 py-1 rounded text-white">Save</button>
                            </footer>
                        </form>
                    </div>
                    <!-- //modal -->
                </td>
            </tr>
            @endforeach
        </table>
        @endif

        </table>
    </div>
    @if ($errors->any())
    <div class="text-red-500 text-xs">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white shadow rounded-md overflow-hidden">
        <div class="flex text-gray-600 items-center p-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-xl">Add New Record</h2>
        </div>
        <form method="POST" action="{{ route('vaccinees.bakunas.store', $vaccinee) }}" autocomplete="off">
            @csrf
            <div class="flex">
                <div class="flex-1 px-5 pb-5">
                    <!-- Vaccine Shot -->
                    <div>
                        <x-label for="vaccine_shot" :value="__('Vaccine Shot*')" />
                        <x-select
                            class="uppercase block mt-1 w-full {{$errors->has('vaccine_shot') ? 'border border-red-500' : ''}}"
                            id=" vaccine_shot" name="vaccine_shot" required>
                            <option value="" selected disabled>Choose here</option>
                            @foreach ($vaccine_shots as $vaccine_shot => $vaccine_shot_val)
                            <option value="{{$vaccine_shot_val}}" {{old('vaccine_shot')==$vaccine_shot_val ? 'selected'
                                : '' }}>{{$vaccine_shot}}
                            </option>
                            @endforeach
                        </x-select>
                        @error('vaccine_shot')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Vaccine Manufacturer Name -->
                    <div class="mt-5">
                        <x-label for="manufacturer_name" :value="__('Vaccine Manufacturer Name*')" />
                        <x-select
                            class="uppercase block mt-1 w-full {{$errors->has('manufacturer_name') ? 'border border-red-500' : ''}}"
                            id=" manufacturer_name" name="manufacturer_name" required>
                            <option value="" selected disabled>Choose here</option>
                            @foreach ($manufacturer_names as $manufacturer_name => $manufacturer_name_val)
                            <option value="{{$manufacturer_name_val}}"
                                {{old('manufacturer_name')==$manufacturer_name_val ? 'selected' : '' }}>
                                {{$manufacturer_name}}
                            </option>
                            @endforeach
                        </x-select>
                        @error('manufacturer_name')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Vacinator Name -->
                    <div class="mt-5">
                        <x-label for="vaccinator_name" :value="__('Vaccinator Name*')" />
                        <x-input id="vaccinator_name"
                            class="uppercase block mt-1 w-full {{$errors->has('vaccinator_name') ? 'border border-red-500' : ''}}"
                            type="text" name="vaccinator_name" :value="old('vaccinator_name')" required autofocus />
                        @error('vaccinator_name')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Vacinator Name -->
                    <div class="mt-5">
                        <x-label for="lot_number" :value="__('Lot Number*')" />
                        <x-input id="lot_number"
                            class="uppercase block mt-1 w-full {{$errors->has('lot_number') ? 'border border-red-500' : ''}}"
                            type="text" name="lot_number" :value="old('lot_number')" required autofocus />
                        @error('lot_number')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Adverse event BOOLEAN-->
                    <div class="mt-5">
                        <x-label for="adverse_event" :value="__('Adverse Event Condition*')" />

                        <x-select
                            class="uppercase block mt-1 w-full {{$errors->has('adverse_event') ? 'border border-red-500' : ''}}"
                            id="adverse_event" name="adverse_event" required>
                            <option value="" selected disabled>Choose here</option>
                            @foreach ($adverse_events as $adverse_event => $adverse_event_val)
                            <option value="{{$adverse_event_val}}" {{old('adverse_event')==$adverse_event_val
                                ? 'selected' : '' }}>
                                {{$adverse_event}}
                            </option>
                            @endforeach
                        </x-select>
                        @error('adverse_event')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Adverse event condition -->
                    <div class="mt-5">
                        <x-label for="adverse_event_condition" :value="__('Adverse Event Condition')" />

                        <x-select
                            class="uppercase block mt-1 w-full {{$errors->has('adverse_event_condition') ? 'border border-red-500' : ''}}"
                            id="adverse_event_condition" name="adverse_event_condition">
                            {{-- <option value="" selected disabled>Choose here</option> --}}
                            <option value="" selected>N/A</option>
                            @foreach ($adverse_event_conditions as $adverse_event_condition)
                            <option value="{{$adverse_event_condition}}"
                                {{old('adverse_event_condition')==$adverse_event_condition ? 'selected' : '' }}>
                                {{$adverse_event_condition}}
                            </option>
                            @endforeach
                        </x-select>
                        @error('adverse_event_condition')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Add Vaccination-->
                    <div class="flex items-center justify-end mt-10">
                        <x-button class="w-full" type="button" onclick="submitForm(this);">
                            {{ __('Add Vaccination') }}
                        </x-button>
                    </div>
                </div>

            </div>
        </form>
    </div>
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
    <script>
        function submitForm(btn) {
                // disable the button
                btn.disabled = true;
                // submit the form    
                btn.form.submit();
            }
    </script>
</x-app-layout>