<div id="personal-detail-modal" class="modal" style="max-width:600px;">
    <h4 class="font-medium mb-3">UPDATE PERSONAL DATA</h4>
    <form method="POST" action="{{ route('vaccinees.update', $vaccinee) }}" autocomplete="off" id="update-form">
        @method('PUT')
        @csrf
        <table class="w-full">
            <tr>
                <td class="pt-3" style="width:110px;">
                    <x-label for="last_name" :value="__('Last name*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="last_name" placeholder="Valeza"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('last_name') ? 'border border-red-500' : ''}}"
                        type="text" name="last_name" value="{{old('last_name') ?: $vaccinee->last_name}}" autofocus />
                    @error('last_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="first_name" :value="__('First name*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="first_name" placeholder="Noel"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('first_name') ? 'border border-red-500' : ''}}"
                        name="first_name" value="{{old('first_name') ?: $vaccinee->first_name}}" />
                    @error('first_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="middle_name" :value="__('Middle name')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="middle_name" placeholder="Bonifacio"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('middle_name') ? 'border border-red-500' : ''}}"
                        type=" text" name="middle_name" value="{{old('middle_name') ?: $vaccinee->middle_name}}" />
                    @error('middle_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="suffix" :value="__('Suffix*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('suffix') ? 'border border-red-500' : ''}}"
                        id="suffix" name="suffix">
                        <option value="" selected>Not Applicable</option>
                        @foreach ($suffixes as $suffix)
                        <option value="{{$suffix}}" {{old('suffix') || $vaccinee->suffix ==$suffix ?
                            'selected' : '' }}>
                            {{$suffix}}
                        </option>
                        @endforeach
                    </x-select>
                    @error('suffix')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td class="pt-3">
                    <x-label for="birthdate" :value="__('Birthdate* (mm/dd/yyyy)')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3 flex">
                    {{-- <input id="birthdate-datepicker" type="text" name=""> --}}
                    <div class="flex-1">
                        <x-input id="birthdate-datepicker" placeholder="mm/dd/yyyy"
                            class="uppercase block mt-1 w-full {{$errors->has('birthdate') ? 'border border-red-500' : ''}}"
                            maxlength="10" type="text" value="{{old('birthdate') ?: $vaccinee->birthdate_mdy}}"
                            name="birthdate" required />
                        @error('birthdate')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center pl-3" style="width:155px;">
                        <span class="display-age text-xs font-medium text-gray-600">
                            <!-- Age will be displayed here-->
                        </span>
                    </div>
                </td>

            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="sex" :value="__('Sex*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('sex') ? 'border border-red-500' : ''}}"
                        id=" sex" name="sex" required>
                        <option value="" selected disabled>Choose here</option>
                        @foreach ($sexes as $sex => $sex_val)
                        <option value="{{$sex_val}}" {{old('sex') || $vaccinee->sex ==$sex_val ?
                            'selected'
                            : '' }}>{{$sex}}
                        </option>
                        @endforeach
                    </x-select>
                    @error('sex')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">

                </td>
                <td class="pt-3 px-4"></td>

                <td class="pt-3">
                    <div class="flex" style="padding-top:5px;">
                        <div class="flex flex-col mr-10">
                            <div class="flex items-center">
                                <x-label class="mr-2" for="pwd1" :value="__('PWD')" />
                                <input type="checkbox" class="w-4 h-4" name="pwd" id="pwd1" {{$vaccinee->pwd ?'checked'
                                : '' }}
                                value="1">
                            </div>
                            <div>
                                @error('pwd')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col flex-1">
                            <div class="flex items-center">
                                <x-label class="mr-2" for="indigenous_member1" :value="__('Indigenous Member')" />
                                <input type="checkbox" class="w-4 h-4" name="indigenous_member" id="indigenous_member1"
                                    {{ $vaccinee->indigenous_member ? 'checked'
                                :
                                ''
                                }}
                                value="1">
                            </div>
                            <div>
                                @error('indigenous_member')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="pt-3">
                    <x-label for="mobile_number" :value="__('Mobile Number')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="mobile_number"
                        oninput=" this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        maxlength="11" placeholder="09112233444"
                        class="text-sm block mt-1 w-full {{$errors->has('mobile_number') ? 'border border-red-500' : ''}}"
                        name="mobile_number" value="{{old('mobile_number') ?: $vaccinee->mobile_number}}" />
                    @error('mobile_number')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="municipality" :value="__('Municipality*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('municipality') ? 'border border-red-500' : ''}}"
                        id=" municipality" name="municipality" required>
                        <option value="" selected disabled>Choose here</option>
                        @foreach ($municipalities as $municipality => $municipality_val)
                        <option value="{{$municipality_val}}" {{old('municipality') || $vaccinee->
                            municipality == $municipality_val
                            ? 'selected' : '' }}>
                            {{$municipality}}</option>
                        @endforeach
                    </x-select>
                    @error('municipality')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="barangay" :value="__('Barangay*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="barangay"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('barangay') ? 'border border-red-500' : ''}}"
                        name="barangay" value="{{old('barangay') ?: $vaccinee->barangay}}" required />
                    @error('barangay')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <button type="submit"
            class="transition duration-300 ease-in-out hover:bg-gray-700 w-full text-gray-100 bg-gray-600 mt-5 p-2 text-sm rounded">
            Update
        </button>
    </form>
</div>