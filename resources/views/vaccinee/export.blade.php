<x-app-layout>
    <x-heading class="pt-5 pb-10">Export Vaccinees (.csv)</x-heading>
    <div class="bg-white p-5 rouded-md shadow text-dark">
        <form action="{{route('vaccinees.export-store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Vaccination Date-->
            <div class="mt-5">
                <x-label for="vaccination_date" :value="__('Vaccination Date*')" />
                <x-input id="vaccination_date"
                    class="uppercase block mt-1 w-full flatpickr flatpickr-input {{$errors->has('vaccination_date') ? 'border border-red-500' : ''}}"
                    type="text" :value="old('vaccination_date')" name="vaccination_date" readonly="readonly" required />
                @error('vaccination_date')
                <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <x-button class="mt-5">{{ __('Export') }}</x-button>
        </form>
    </div>

    <script>
        /**
         * Code for flatpickr - birthdate 
         */
         $("#vaccination_date").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>
</x-app-layout>