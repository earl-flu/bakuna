<x-app-layout>
    <x-heading class="pt-5 pb-10">Import Vaccinees (Excel to DB)</x-heading>

    <div class="bg-white p-5 rouded-md shadow text-dark">

        @if (session('status'))
        <div class="bg-green-400 p-2">
            {{session('status')}}
        </div>
        @endif

        <form action="{{route('vaccinees.import-store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input class="w-full block" type="file" name="file"></x-input>
            <x-button class="mt-5" type="button" onclick="submitForm(this);">{{ __('Import') }}</x-button>
        </form>

    </div>

    <script>
        function submitForm(btn) {
            // disable the button
            btn.disabled = true;
            // submit the form    
            btn.form.submit();
        }
    </script>
</x-app-layout>