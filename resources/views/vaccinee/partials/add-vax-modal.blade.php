<div id="add-record-modal" class="modal" style="max-width:600px;">
    <h4 class="font-semibold text-gray-600 uppercase">Add Vaccination Record</h4>
    <p class="text-xs text-gray-500">{{$cbcr_id}}</p>
    <form x-data="addVaxData()" method="POST" action="{{ route('vaccinees.bakunas.store', $vaccinee) }}"
        autocomplete="off" id="add-record-form">
        @csrf

        <table class="w-full">
            <tr>
                <td class="pt-3" style="width:130px;">
                    <x-label for="philhealth_num" :value="__('Philhealth Num')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="philhealth_num" placeholder="001-002-003"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('philhealth_num') ? 'border border-red-500' : ''}}"
                        type="text" name="philhealth_num" value="{{old('philhealth_num')}}" autofocus />
                    @error('philhealth_num')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            {{-- <tr>
                <td class="pt-3">
                    <x-label for="contact" :value="__('Contact Num*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="contact"
                        oninput=" this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        maxlength="11" placeholder="09112233444"
                        class="text-sm block mt-1 w-full {{$errors->has('contact') ? 'border border-red-500' : ''}}"
                        name="contact" value="{{old('contact')}}" />
                    @error('contact')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr> --}}
            {{-- <tr>
                <td class="pt-3">
                    <x-label for="bakuna_center_cbcr_id" :value="__('Center ID')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="bakuna_center_cbcr_id"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('bakuna_center_cbcr_id') ? 'border border-red-500' : ''}}"
                        type=" text" name="bakuna_center_cbcr_id" value="{{$cbcr_id}}" disabled />
                    @error('bakuna_center_cbcr_id')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr> --}}
            <tr>
                <td class="pt-3">
                    <x-label for="category" :value="__('Category*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select x-model="alp_category" x-on:change="setIsPedia"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('category') ? 'border border-red-500' : ''}}"
                        id=" category" name="category" required>
                        <option value="" selected disabled>Choose here</option>
                        @foreach ($categories as $category => $category_val)
                        <option value="{{$category_val}}" {{old('category')==$category ? 'selected' : '' }}>
                            {{$category}}</option>
                        @endforeach
                    </x-select>
                    @error('category')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <template x-if="isPedia">
                <tr>
                    <td class="pt-3">
                        <x-label for="guardian_pedia" :value="__('Guardian for Pedia*')" />
                    </td>
                    <td class="pt-3 px-4">:</td>
                    <td class="pt-3">
                        <x-input id="guardian_pedia" placeholder="lastname, firstname"
                            class="text-sm uppercase block mt-1 w-full {{$errors->has('guardian_pedia') ? 'border border-red-500' : ''}}"
                            type=" text" name="guardian_pedia" value="{{old('guardian_pedia')}}" />
                        @error('guardian_pedia')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            </template>
            <tr>
                <td class="pt-3">
                    <x-label for="comorbidity" :value="__('Comorbidity')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <div class="flex items-center" style="min-height:42px;">
                        <div class="flex flex-col mr-5">
                            <div class="flex">
                                <input x-model="isComorbidity" type="checkbox" class="w-4 h-4" name="is_comorbidity"
                                    id="comorbidity" {{ old('is_comorbidity') ?'checked' : '' }} value="1">
                            </div>
                            <div>
                                @error('is_comorbidity')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex-1">
                            <template x-if="isComorbidity">
                                <x-input id="comorbidity" x-bind:required="isComorbidity"
                                    class="text-sm uppercase block mt-1 w-full {{$errors->has('comorbidity') ? 'border border-red-500' : ''}}"
                                    type=" text" name="comorbidity" value="{{old('comorbidity')}}" />
                                @error('comorbidity')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </template>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="pt-3">
                    <x-label for="vaccination_date_datepicker" :value="__('Vaccination Date* (mm/dd/yyyy)')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="vaccination_date_datepicker" placeholder="mm/dd/yyyy"
                        class="uppercase block mt-1 w-full {{$errors->has('vaccination_date') ? 'border border-red-500' : ''}}"
                        maxlength="10" type="text" value="{{old('vaccination_date')}}" name="vaccination_date"
                        required />
                    @error('vaccination_date')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td class="pt-3" style="width:130px;">
                    <x-label for="vaccinator_name" :value="__('Vaccinator Name')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('Vaccinator name') ? 'border border-red-500' : ''}}"
                        id="vaccinator_name" name="vaccinator_name" required>
                        <option value="" selected disabled>Choose here</option>
                        @foreach ($vaccinators as $vaccinator)
                        <option value="{{$vaccinator->id}}" {{old('vaccinator')==$vaccinator->id ?
                            'selected' : '' }}>
                            {{$vaccinator->full_name}}</option>
                        @endforeach
                    </x-select>
                    @error('vaccinator_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="vaccine_shot" :value="__('Vaccine Shot')" />
                </td>
                <td class="pt-3 px-4">:</td>

                <td class="pt-3">
                    <div class="flex" style="min-height:42px; padding-top:2px;">
                        <div class="flex items-center mr-7">
                            <x-label class="mr-2" for="1st" :value="__('1st Dose')"
                                x-bind:class="alp_dose == '1' ? 'text-blue-600' : ''" />
                            <input type="radio" class="w-4 h-4" id="1st" name="vaccine_shot" value="1"
                                x-model="alp_dose">
                        </div>
                        <div class="flex items-center mr-7">
                            <x-label class="mr-2" for="2nd" :value="__('2nd Dose')"
                                x-bind:class="alp_dose == '2' ? 'text-blue-600' : ''" />
                            <input type="radio" class="w-4 h-4" id="2nd" name="vaccine_shot" value="2"
                                x-model="alp_dose">
                        </div>
                        <div class="flex items-center">
                            <x-label class="mr-2" for="booster" :value="__('Booster')"
                                x-bind:class="alp_dose == '3' ? 'text-blue-600' : ''" />
                            <input type="radio" class="w-4 h-4" id="booster" name="vaccine_shot" value="3"
                                x-model="alp_dose">
                        </div>
                    </div>
                    <div class="error" id="vaccine_shot-error"></div>
                    {{-- id="vaccine_shot-error" --}}
                    @error('vaccinator_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="manufacturer_name" :value="__('Manufacturer Name*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('manufacturer_name') ? 'border border-red-500' : ''}}"
                        id=" manufacturer_name" name="manufacturer_name" required>
                        <option value="" selected disabled>Choose here</option>
                        @foreach ($manufacturer_names as $manufacturer_name => $manufacturer_name_val)
                        <option value="{{$manufacturer_name_val}}" {{old('manufacturer_name')==$manufacturer_name
                            ? 'selected' : '' }}>
                            {{$manufacturer_name}}</option>
                        @endforeach
                    </x-select>
                    @error('manufacturer_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3" style="width:130px;">
                    <x-label for="batch_number" :value="__('Batch Num*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('batch_number') ? 'border border-red-500' : ''}}"
                        id="batch_number" name="batch_number" required>
                        <option value="" selected disabled>Choose here</option>
                        <option value="12900">12900 - Pfizer</option>
                        <option value="21221G4F2">21221G4F2 - Sputnik</option>
                        <option value="A1065">A1065 - Aztrazeneca</option>
                    </x-select>
                    @error('batch_number')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3" style="width:130px;">
                    <x-label for="lot_number" :value="__('Lot Num*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('lot_number') ? 'border border-red-500' : ''}}"
                        id="lot_number" name="lot_number" required>
                        <option value="" selected disabled>Choose here</option>
                        <option value="12900">12900 - Pfizer</option>
                        <option value="21221G4F2">21221G4F2 - Sputnik</option>
                        <option value="A1065">A1065 - Aztrazeneca</option>
                    </x-select>
                    {{--
                    <x-input id="lot_number"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('lot_number') ? 'border border-red-500' : ''}}"
                        type="text" name="lot_number" value="{{old('lot_number')}}" autofocus /> --}}
                    @error('lot_number')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <button
            class="transition duration-300 ease-in-out hover:bg-gray-700 w-full text-gray-100 bg-gray-600 mt-5 p-2 text-sm rounded">
            Add Vaccination Record
        </button>
    </form>
</div>