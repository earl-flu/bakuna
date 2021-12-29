<div id="vaxupdatemodal-{{$bakuna->id}}" class="modal" style="max-width:600px;">
    <p class="font-semibold uppercase text-gray-600">Update Vaccination Record</p>
    <form x-data="updateVaxData()" x-init="alp_category = '{{$bakuna->category}}'; isComorbidity = '{{$bakuna->is_comorbidity}}';isDeferred = '{{$bakuna->is_deferred}}'; isAdverseEvent = '{{$bakuna->is_adverse_event}}'" method="POST"
        action="{{ route('vaccinees.bakunas.update', [$vaccinee,$bakuna]) }}" autocomplete="off" id="update-vax-form">
        @csrf
        @method('PUT')
        <table class="w-full">
            <tr>
                <td class="pt-3" style="width:130px;">
                    <x-label for="philhealth_num-{{$bakuna->id}}" :value="__('Philhealth Num')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="philhealth_num-{{$bakuna->id}}" placeholder="001-002-003"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('philhealth_num') ? 'border border-red-500' : ''}}"
                        type="text" name="philhealth_num" value="{{old('philhealth_num') ?: $bakuna->philhealth_num}}"
                        autofocus />
                    @error('philhealth_num')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="category-{{$bakuna->id}}" :value="__('Category*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select x-model="alp_category" x-on:change="setIsPedia"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('category') ? 'border border-red-500' : ''}}"
                        id="category-{{$bakuna->id}}" name="category" required>
                        <option value="" selected disabled>Choose here</option>
                        @foreach ($categories as $category => $category_val)

                        <option value="{{$category_val}}" {{ $bakuna->category ==
                            $category_val ? 'selected'
                            : '' }}>
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
                        <x-label for="guardian_pedia-{{$bakuna->id}}" :value="__('Guardian for Pedia')" />
                    </td>
                    <td class="pt-3 px-4">:</td>
                    <td class="pt-3">
                        <x-input id="guardian_pedia-{{$bakuna->id}}" placeholder="lastname, firstname"
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
                    <x-label for="comorbidity-{{$bakuna->id}}" :value="__('Comorbidity')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <div class="flex items-center" style="min-height:42px;">
                        <div class="flex flex-col mr-5">
                            <div class="flex">
                                <input x-model="isComorbidity" type="checkbox" class="w-4 h-4" name="is_comorbidity"
                                    id="comorbidity-{{$bakuna->id}}" {{ old('is_comorbidity') || $bakuna->is_comorbidity
                                ? 'checked' : '' }} value="1">
                            </div>
                            <div>
                                @error('is_comorbidity')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex-1">
                            <template x-if="isComorbidity">
                                <x-input id="comorbidity-{{$bakuna->id}}" x-bind:required="isComorbidity"
                                    class="text-sm uppercase block mt-1 w-full {{$errors->has('comorbidity') ? 'border border-red-500' : ''}}"
                                    type=" text" name="comorbidity"
                                    value="{{old('comorbidity') ?: $bakuna->comorbidity}}" />
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
                    <x-label for="vaccination_date_datepicker-{{$bakuna->id}}"
                        :value="__('Vaccination Date* (mm/dd/yyyy)')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="vaccination_date_datepicker-{{$bakuna->id}}" placeholder="mm/dd/yyyy"
                        class="update-vax-datepicker uppercase block mt-1 w-full {{$errors->has('vaccination_date') ? 'border border-red-500' : ''}}"
                        maxlength="10" type="text" value="{{old('vaccination_date') ?: $bakuna->vaccination_date_mdy}}"
                        name="vaccination_date" required />
                    @error('vaccination_date')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td class="pt-3" style="width:130px;">
                    <x-label for="vaccinator_name-{{$bakuna->id}}" :value="__('Vaccinator Name')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('vaccinator_name') ? 'border border-red-500' : ''}}"
                        id="vaccinator_name-{{$bakuna->id}}" name="vaccinator_name" required>
                        <option value="" selected disabled>Choose here</option>
                        @foreach ($vaccinators as $vaccinator)
                        <option value="{{$vaccinator->id}}" {{old('vaccinator')==$vaccinator->id ||
                            $bakuna->vaccinator_name==$vaccinator->id ?
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
                    <x-label for="vaccine_shot-{{$bakuna->id}}" :value="__('Vaccine Shot')" />
                </td>
                <td class="pt-3 px-4">:</td>

                <td class="pt-3" x-data="{alp_dose: ''}" x-init="() => alp_dose = '{{$bakuna->vaccine_shot}}'">
                    <div class="flex" style="min-height:42px; padding-top:2px;">
                        <div class="flex items-center mr-7">
                            <x-label class="mr-2" for="1st-{{$bakuna->id}}" :value="__('1st Dose')"
                                x-bind:class="alp_dose == '1' ? 'text-blue-600' : ''" />
                            <input type="radio" class="w-4 h-4" id="1st-{{$bakuna->id}}" name="vaccine_shot" value="1"
                                x-model="alp_dose">
                        </div>
                        <div class="flex items-center mr-7">
                            <x-label class="mr-2" for="2nd-{{$bakuna->id}}" :value="__('2nd Dose')"
                                x-bind:class="alp_dose == '2' ? 'text-blue-600' : ''" />
                            <input type="radio" class="w-4 h-4" id="2nd-{{$bakuna->id}}" name="vaccine_shot" value="2"
                                x-model="alp_dose">
                        </div>
                        <div class="flex items-center">
                            <x-label class="mr-2" for="booster-{{$bakuna->id}}" :value="__('Booster')"
                                x-bind:class="alp_dose == '3' ? 'text-blue-600' : ''" />
                            <input type="radio" class="w-4 h-4" id="booster-{{$bakuna->id}}" name="vaccine_shot"
                                value="3" x-model="alp_dose">
                        </div>
                    </div>
                    <div class="error" id="vaccine_shot-error"></div>
                    @error('vaccinator_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="manufacturer_name-{{$bakuna->id}}" :value="__('Manufacturer Name*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-select
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('manufacturer_name') ? 'border border-red-500' : ''}}"
                        id="manufacturer_name-{{$bakuna->id}}" name="manufacturer_name" required>
                        <option value="" selected disabled>Choose here</option>
                        @foreach ($manufacturer_names as $manufacturer_name =>
                        $manufacturer_name_val)
                        <option value="{{$manufacturer_name_val}}" {{old('manufacturer_name')==$manufacturer_name_val ||
                            $bakuna->manufacturer_name ==$manufacturer_name_val ? 'selected' : '' }}>
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
                    <x-label for="batch_number-{{$bakuna->id}}" :value="__('Batch Num*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="batch_number-{{$bakuna->id}}"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('batch_number') ? 'border border-red-500' : ''}}"
                        type="text" name="batch_number" value="{{old('batch_number') ?: $bakuna->batch_number}}"
                        autofocus />
                    @error('batch_number')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3" style="width:130px;">
                    <x-label for="lot_number-{{$bakuna->id}}" :value="__('Lot Num*')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <x-input id="lot_number-{{$bakuna->id}}"
                        class="text-sm uppercase block mt-1 w-full {{$errors->has('lot_number') ? 'border border-red-500' : ''}}"
                        type="text" name="lot_number" value="{{old('lot_number') ?: $bakuna->lot_number}}" autofocus />
                    @error('lot_number')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="is_deferred-{{$bakuna->id}}" :value="__('Deferred')" class="text-white"
                        x-bind:class="isDeferred ? 'text-red-500' : ''" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <div class="flex items-center" style="min-height:42px;">
                        <div class="flex flex-col mr-5">
                            <div class="flex">
                                <input x-model="isDeferred" type="checkbox" class="w-4 h-4" name="is_deferred"
                                    id="is_deferred-{{$bakuna->id}}" {{ old('is_deferred') || $bakuna->is_deferred
                                ? 'checked' : '' }} value="1">
                            </div>
                            <div>
                                @error('is_deferred')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex-1">
                            <template x-if="isDeferred">
                                <x-select
                                    class="text-sm uppercase block mt-1 w-full {{$errors->has('deferral_reason') ? 'border border-red-500' : ''}}"
                                    id="deferral_reason-{{$bakuna->id}}" name="deferral_reason" required>
                                    <option value="" selected disabled>Choose here</option>
                                    @foreach ($deferral_reasons as $reason)
                                    <option value="{{$reason}}" {{old('deferral_reason')==$reason || 
                                    $bakuna->deferral_reason == $reason ?
                                        'selected' : '' }}>
                                        {{$reason}}</option>
                                    @endforeach
                                </x-select>
                                @error('deferral_reason')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </template>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="pt-3">
                    <x-label for="adverse_event-{{$bakuna->id}}" :value="__('Adverse Event')"
                        x-bind:class="isAdverseEvent ? 'text-red-600' : ''" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <div class="flex items-center" style="min-height:42px;">
                        <div class="flex flex-col mr-5">
                            <div class="flex">
                                <input x-model="isAdverseEvent" type="checkbox" class="w-4 h-4" name="is_adverse_event"
                                    id="adverse_event-{{$bakuna->id}}" {{ old('is_adverse_event') ||
                                    $bakuna->is_adverse_event
                                ? 'checked' : '' }} value="1">
                            </div>
                            <div>
                                @error('is_adverse_event')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex-1">
                            <template x-if="isAdverseEvent">
                                <x-select
                                    class="text-sm uppercase block mt-1 w-full {{$errors->has('adverse_event_condition') ? 'border border-red-500' : ''}}"
                                    id="adverse_event_condition-{{$bakuna->id}}" name="adverse_event_condition"
                                    required>
                                    <option value="" selected disabled>Choose here</option>
                                    @foreach ($adverse_event_conditions as $condition)
                                    <option value="{{$condition}}" {{old('adverse_event_condition')==$condition ||
                                        $bakuna->
                                        adverse_event_condition==$condition ?
                                        'selected' : '' }}>
                                        {{$condition}}</option>
                                    @endforeach
                                </x-select>
                                @error('adverse_event_condition')
                                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </template>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="pt-3">
                    <x-label for="remarks-{{$bakuna->id}}" :value="__('Remarks')" />
                </td>
                <td class="pt-3 px-4">:</td>
                <td class="pt-3">
                    <textarea name="remarks" id="remarks-{{$bakuna->id}}" cols="5" rows="3"
                        class="w-full border border-gray-400 focus:outline-none rounded">{{$bakuna->remarks}}</textarea>
                    @error('remarks')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <button
            class="transition duration-300 ease-in-out hover:bg-gray-700 w-full text-gray-100 bg-gray-600 mt-5 p-2 text-sm rounded">
            Update Vaccination Record
        </button>
    </form>
</div>