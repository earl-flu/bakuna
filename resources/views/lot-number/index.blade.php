<x-app-layout>
    <x-heading class="pt-5 pb-10 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mr-3" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        All Lot Numbers
    </x-heading>
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

    @if ($errors->any())
    <div class="text-red-500 text-xs">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="bg-white p-5 rouded-md shadow text-dark">
        <!-- Filters-->
        <form action="{{route('lot-numbers.index')}}" method="GET" autocomplete="off">
            <div class="flex">
                <div class="mr-5 flex-1">
                    <x-label for="status" :value="__('Status')" />
                    <x-select class="block mt-1 w-full h-42px block" id="status" name="status">
                        <option value="all" selected>All</option>
                        <option value="active" {{request()->input('status') == 'active' ? 'selected' :
                            ''}}>Active</option>
                        <option value="inactive" {{request()->input('status') == 'inactive' ? 'selected' :
                            ''}}>Inactive</option>
                    </x-select>
                </div>

                <div class="mr-5 flex-1">
                    <x-label for="code" :value="__('Lot Number')" />
                    <x-input id="code" class="block mt-1 w-full" type=" text" name="code" placeholder="CDJ20551"
                        value="{{request()->input('code')}}" />
                </div>

                <!-- Should be a SELECT-->
                <div class="mr-5 flex-1">
                    <x-label for="manufacturer_name" :value="__('Manufacturer Name')" />
                    <x-input id="manufacturer_name" class="block mt-1 w-full" type=" text" name="manufacturer_name"
                        placeholder="Sinovac" value="{{request()->input('manufacturer_name')}}" />
                </div>


            </div>
            <div class="mb-10">
                <x-button class="self-end mb-0.5 w-full mt-3">
                    {{ __('Search') }}
                </x-button>
            </div>


        </form>
        <table class="w-full text-left">
            <tr class="bg-blue-100">
                <th class="font-semibold p-3 border">Code</th>
                <th class="font-semibold p-3 border">Manufacturer Name</th>
                <th class="font-semibold p-3 border">Status</th>
                <th class="font-semibold p-3 border">Edit</th>
            </tr>

            @foreach ($lot_numbers as $lot_number)
            <tr class="hover:bg-gray-100">
                <td class="border p-3 text-primary">
                    {{$lot_number->code}}
                </td>
                <td class="border p-3"> {{$lot_number->manufacturer_name}}</td>
                <td class="border p-3">
                    @if ($lot_number->is_active)
                    <span class="bg-green-500 text-white text-xs px-1 py-0.5 rounded">Active</span>
                    @else
                    <span class="bg-red-500 text-white text-xs px-1 py-0.5 rounded">Inactive</span>
                    @endif
                </td>
                <td class="border p-3">
                    <!-- Modal Button -->
                    <a href="#modal-{{$lot_number->code}}" rel="modal:open">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <!-- //Modal Button -->
                    <!-- modal -->
                    <div id="modal-{{$lot_number->code}}" class="modal">
                        <h4 class="text-2xl mb-2 border-l-4 border-blue-800 pl-2">
                            Update Schedule
                        </h4>
                        <form action="{{route('lot-numbers.update', $lot_number)}}" method="POST" autocomplete="off">
                            @method('PUT')
                            @csrf

                            <table class="w-full">
                                <tr>
                                    <td class="pt-3" style="width:110px;">
                                        <x-label for="code-{{$lot_number->code}}" :value="__('Lot Number*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-input id="code-{{$lot_number->code}}" placeholder="CDJ20551"
                                            class="text-sm block mt-1 w-full {{$errors->has('code') ? 'border border-red-500' : ''}}"
                                            type="text" name="code" value="{{old('code') ?: $lot_number->code}}"
                                            autofocus />
                                        @error('code')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="manufacturer_name-{{$lot_number->code}}" :value="__('Manufacturer Name*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-input id="manufacturer_name-{{$lot_number->code}}" placeholder="Sinovac"
                                            class="text-sm uppercase block mt-1 w-full {{$errors->has('manufacturer_name') ? 'border border-red-500' : ''}}"
                                            type="text" name="manufacturer_name"
                                            value="{{old('manufacturer_name') ?: $lot_number->manufacturer_name}}"
                                            autofocus />
                                        @error('manufacturer_name')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="is_active-{{$lot_number->code}}" :value="__('Active*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <input type="checkbox" class="w-4 h-4" name="is_active"
                                            id="is_active-{{$lot_number->code}}" {{$lot_number->is_active
                                        ?'checked' : old('is_active') ? 'checked' : '' }}
                                        value="1">
                                        @error('is_active')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            </table>

                            <x-button class="w-full mt-5">Update</x-button>
                        </form>
                    </div>
                    <!-- //modal -->
                </td>
            </tr>
            @endforeach
        </table>
        <div class="mt-5">
            {{ $lot_numbers->appends($_GET)->links() }}
        </div>
    </div>
</x-app-layout>