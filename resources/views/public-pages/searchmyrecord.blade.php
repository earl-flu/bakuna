{{-- <x-public-layout>
    <div class="flex flex-col flex-1 w-full mt-16 border border-black p-5 text-gray-600 h">
        This is search my record page
        <div class="shadow border-2 m-auto w-96 p-5 rounded-md">
            <form method="POST" action="{{}}" autocomplete="off">

                <div>
                    <x-label for="first_name" :value="__('First name*')" />
                    <x-input id="first_name" placeholder="Ryan"
                        class="block mt-1 w-full {{$errors->has('first_name') ? 'border border-red-500' : ''}}"
                        type="text" name="first_name" :value="old('first_name')" required autofocus />
                    @error('first_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="middle_name" :value="__('Middle name')" />
                    <x-input id="middle_name" placeholder="Almojuela"
                        class=" block mt-1 w-full {{$errors->has('middle_name') ? 'border border-red-500' : ''}}"
                        type="text" name="middle_name" :value="old('middle_name')" autofocus />
                    @error('middle_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="last_name" :value="__('Last name*')" />
                    <x-input id="last_name" placeholder="Valeza"
                        class=" block mt-1 w-full {{$errors->has('last_name') ? 'border border-red-500' : ''}}"
                        type="text" name="last_name" :value="old('last_name')" required autofocus />
                    @error('last_name')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="last_name" :value="__('Mobile number*')" />
                    <x-input id="mobile_number"
                        oninput=" this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        maxlength="11" placeholder="09*********"
                        class="text-sm block mt-1 w-full {{$errors->has('mobile_number') ? 'border border-red-500' : ''}}"
                        name="mobile_number" value="{{old('mobile_number')}}" required />
                    @error('mobile_number')
                    <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>



            </form>
        </div>
    </div>

</x-public-layout> --}}

<x-public-layout>
    <div
        class="py-16 w-full justify-center flex items-center bg-gray-400 h-full min-h-screen md:h-screen main-background"> <!-- search-my-record-bg-->
        {{-- w-4/5 h-5/6 --}}
        <div class="w-11/12 main-search-my-record border mt-10 border-red-500 bg-white rounded-3xl px-3 md:px-10 pb-10 pt-14 shadow relative flex">
            <!--Div for logos-->
            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 -translate-y-1/2 logo-shadow rounded-full">
                <img src="{{asset('images/icons/catanduanes-seal.png')}}" class="h-24 w-24"
                    alt="catanduanes official seal">
            </div>

            <div class="flex flex-col w-full">
                <p class="text-center mt-1 text-gray-500 font-semibold">
                    SEARCH MY VACCINATION RECORD
                </p>
                <div class="h-full flex flex-col md:flex-row">
                    <div class=" flex-1
                    flex text-gray-400 text-xl md:text-2xl p-6 justify-center items-center">
                        <div class="text-center">
                            "Example: <br>
                            Kung ang Pangalan ay <br>
                            <span class="text-gray-500">Juan dela Cruz,</span><br>
                            ilagay lamang ang First name na <br>
                            <span class="text-xl md:text-3xl
                            mt-2 block border-b-2 border-gray-400
                            text-gray-500">Juan</span>
                        </div>

                    </div>
                    <div class="flex-1 flex-col p-6 flex items-center justify-center">
                        @if ($errors->any())
                        <div class="bg-red-500 text-gray-100 p-2 mb-2 text-2xl font-semibold text-center w-full">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{route('search-record')}}" method="POST" autocomplete="off"
                            class="w-full">
                            @csrf
                            <label class="block text-center mb-6">
                                <span
                                    class="tracking-wide text-sm font-semibold border px-1.5 bg-dark-green text-gray-100 uppercase">ILAGAY
                                    ANG MOBILE NUMBER</span>
                                <input name="phone" value="{{ old('phone') }}"
                                    class="form-input font-semibold text-gray-500 mt-2 block w-full border border-gray-300 "
                                    placeholder="09***********">
                            </label>

                            <label class="block text-center mb-6">
                                <span
                                    class="tracking-wide text-sm font-semibold border px-1.5 bg-dark-green text-gray-100 uppercase">ILAGAY
                                    ANG FIRST
                                    NAME</span>
                                <input name="first_name" value="{{ old('first_name') }}"
                                    class="form-input font-semibold text-gray-500 mt-2 block w-full border border-gray-300"
                                    placeholder="Juan">
                            </label>

                            <button class="shadow-md rounded-md w-full p-5 search-record-btn
                                bg-dark-green text-2xl text-gray-100 font-semibold">
                                SEARCH
                            </button>
                            <p class="text-xs text-gray-400 mt-4 font-semibold">Back to
                                <a href="#" class="text-blue-400 hover:underline">IMT Home Page</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-public-layout>