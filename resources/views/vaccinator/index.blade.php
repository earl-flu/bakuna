<x-app-layout>
    <x-heading class="pt-5 pb-10 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        All Vaccinators
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
    <div class="bg-white p-5 rouded-md shadow text-dark">
        <!-- Filters-->
        <form action="{{route('vaccinators.index')}}" method="GET" autocomplete="off">
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
                    <x-label for="last_name" :value="__('Last name')" />
                    <x-input id="last_name" class="block mt-1" type=" text" name="last_name" placeholder="Valeza"
                        value="{{request()->input('last_name')}}" />
                </div>

                <div class="mr-5 flex-1">
                    <x-label for="first_name" :value="__('First name')" />
                    <x-input id="first_name" class="block mt-1" type=" text" name="first_name" placeholder="Ryan"
                        value="{{request()->input('first_name')}}" />
                </div>

                <div class="mr-5">
                    <x-label for="middle_name" :value="__('Middle name')" />
                    <x-input id="middle_name" class="block mt-1" type=" text" name="middle_name" placeholder="Morales"
                        value="{{request()->input('middle_name')}}" />
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
                <th class="font-semibold p-3 border">Name</th>
                <th class="font-semibold p-3 border">Office</th>
                <th class="font-semibold p-3 border">Status</th>
                <th class="font-semibold p-3 border" style="width:250px;">Remarks</th>
                <th class="font-semibold p-3 border">Edit</th>
            </tr>

            @foreach ($vaccinators as $vaccinator)
            <tr class="hover:bg-gray-100">
                <td class="border p-3 uppercase text-primary">
                    {{$vaccinator->full_name}}
                </td>
                <td class="border p-3"> {{$vaccinator->office}}</td>
                <td class="border p-3">
                    @if ($vaccinator->is_active)
                    <span class="bg-green-500 text-white text-xs px-1 py-0.5 rounded">Active</span>
                    @else
                    <span class="bg-red-500 text-white text-xs px-1 py-0.5 rounded">Inactive</span>
                    @endif
                </td>
                <td class="border p-3 text-sm"> {{$vaccinator->remarks}}</td>
                <td class="border p-3">
                    <!-- Modal Button -->
                    <a href="#modal-{{$vaccinator->id}}" rel="modal:open">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <!-- //Modal Button -->
                    <!-- modal -->
                    <div id="modal-{{$vaccinator->id}}" class="modal">
                        <h4 class="text-2xl mb-2 border-l-4 border-blue-800 pl-2">
                            Update Schedule
                        </h4>
                        <form action="{{route('vaccinators.update', $vaccinator)}}" method="POST">
                            @method('PUT')
                            @csrf

                            <table class="w-full">
                                <tr>
                                    <td class="pt-3" style="width:110px;">
                                        <x-label for="last_name" :value="__('Last name*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-input id="last_name"
                                            class="text-sm uppercase block mt-1 w-full {{$errors->has('last_name') ? 'border border-red-500' : ''}}"
                                            type="text" name="last_name"
                                            value="{{old('last_name') ?: $vaccinator->last_name}}" autofocus />
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
                                        <x-input id="first_name"
                                            class="text-sm uppercase block mt-1 w-full {{$errors->has('first_name') ? 'border border-red-500' : ''}}"
                                            type="text" name="first_name"
                                            value="{{old('first_name') ?: $vaccinator->first_name}}" autofocus />
                                        @error('first_name')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="middle_name" :value="__('Middle name*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <x-input id="middle_name"
                                            class="text-sm uppercase block mt-1 w-full {{$errors->has('middle_name') ? 'border border-red-500' : ''}}"
                                            type="text" name="middle_name"
                                            value="{{old('middle_name') ?: $vaccinator->middle_name}}" autofocus />
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
                                        <x-input id="suffix"
                                            class="text-sm uppercase block mt-1 w-full {{$errors->has('suffix') ? 'border border-red-500' : ''}}"
                                            type="text" name="suffix" value="{{old('suffix') ?: $vaccinator->suffix}}"
                                            autofocus />
                                        @error('suffix')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="remarks" :value="__('Remarks*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <textarea class="w-full border border-gray-400 p-2" name="remarks" id="remarks"
                                            rows="5">{{old('remarks') ?: $vaccinator->remarks}}</textarea>
                                        @error('remarks')
                                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <x-label for="is_active_{{$vaccinator->id}}" :value="__('Active*')" />
                                    </td>
                                    <td class="pt-3 px-4">:</td>
                                    <td class="pt-3">
                                        <input type="checkbox" class="w-4 h-4" name="is_active"
                                            id="is_active_{{$vaccinator->id}}" {{$vaccinator->is_active
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
            {{ $vaccinators->appends($_GET)->links() }}
        </div>
    </div>
</x-app-layout>