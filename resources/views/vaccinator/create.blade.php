<x-app-layout>
    <x-heading class="pt-5 pb-10 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mr-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
        Vaccinator Registration
    </x-heading>
    <div class=" flex items-center justify-center">
        <div class="shadow border w-96 bg-white p-5 rounded">
            <form id="vaccinator-store" method="POST" action="{{route('vaccinators.store')}}" autocomplete="off">
                @csrf
                <div>
                    <x-label for="last_name" :value="__('Last name*')" />
                    <x-input id="last_name" placeholder="Valeza"
                        class="uppercase block mt-1 w-full {{$errors->has('last_name') ? 'border border-red-500' : ''}}"
                        type="text" name="last_name" :value="old('last_name')" autofocus />
                    @error('last_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-5">
                    <x-label for="first_name" :value="__('First name*')" />
                    <x-input id="first_name" placeholder="Ryan"
                        class="uppercase block mt-1 w-full {{$errors->has('first_name') ? 'border border-red-500' : ''}}"
                        type="text" name="first_name" :value="old('first_name')" autofocus />
                    @error('first_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-5">
                    <x-label for="middle_name" :value="__('Middle name')" />
                    <x-input id="middle_name" placeholder="Bonifacio"
                        class="uppercase block mt-1 w-full {{$errors->has('middle_name') ? 'border border-red-500' : ''}}"
                        type="text" name="middle_name" :value="old('middle_name')" autofocus />
                    @error('middle_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-5">
                    <x-label for="suffix" :value="__('Suffix')" />
                    <x-input id="suffix"
                        class="uppercase block mt-1 w-full {{$errors->has('suffix') ? 'border border-red-500' : ''}}"
                        type="text" name="suffix" :value="old('suffix')" autofocus />
                    @error('suffix')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-5">
                    <x-label for="office" :value="__('Office')" />
                    <x-input id="office" placeholder="IMT"
                        class="uppercase block mt-1 w-full {{$errors->has('office') ? 'border border-red-500' : ''}}"
                        type="text" name="office" :value="old('office')" autofocus />
                    @error('office')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-5 flex">
                    <x-label class="mr-2" for="is_active" :value="__('Active')" />
                    <input type="checkbox" class="w-4 h-4" name="is_active" id="is_active" {{ old('is_active')==1
                        ?'checked' : '' }} value="1">
                </div>
                <div class="mt-5">
                    <x-label for="remarks" :value="__('Remarks')" />
                    <textarea name="remarks" id="remarks" cols="30" rows="5"
                        class="mt-1 w-full border border-gray-300"></textarea>
                </div>
              
                <x-button class="w-full mt-3">
                    Save
                </x-button>
            </form>
        </div>
    </div>

    <script>
        $().ready(function(){
            $("#vaccinator-store").validate({
                rules: {
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    office: {
                        required: true,
                        minlength: 2
                    },
                },
                submitHandler: function(form){
                    $('form button[type=submit]').attr('disabled', 'disabled');
                    form.submit();
                }
            });
        });

        function submitForm(btn) {
            // disable the button
            btn.disabled = true;
            // submit the form    
            btn.form.submit();
        }
    </script>
</x-app-layout>