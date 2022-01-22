<x-app-layout>
    <x-heading class="pt-5 pb-10 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mr-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
        Lot Number Registration
    </x-heading>
    <div class=" flex items-center justify-center">
        <div class="shadow border w-96 bg-white p-5 rounded">
            <form id="vaccinator-store" method="POST" action="{{route('lot-numbers.store')}}" autocomplete="off">
                @csrf
                <div>
                    <x-label for="code" :value="__('Lot number*')" />
                    <x-input id="code" placeholder="CDJ20129"
                        class="block mt-1 w-full {{$errors->has('code') ? 'border border-red-500' : ''}}"
                        type="text" name="code" :value="old('code')" autofocus />
                    @error('code')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Must be SELECT-->
                <div class="mt-5">
                    <x-label for="manufacturer_name" :value="__('Manufacturer name*')" />
                    <x-input id="manufacturer_name" placeholder="Sinovac"
                        class="block mt-1 w-full {{$errors->has('manufacturer_name') ? 'border border-red-500' : ''}}"
                        type="text" name="manufacturer_name" :value="old('manufacturer_name')" autofocus />
                    @error('manufacturer_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-5 flex">
                    <x-label class="mr-2" for="is_active" :value="__('Active')" />
                    <input type="checkbox" class="w-4 h-4" name="is_active" checked id="is_active" {{ old('is_active')==1
                        ?'checked' : '' }} value="1">
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
                    code: {
                        required: true,
                        minlength: 2
                    },
                    manufacturer_name: {
                        required: true,
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