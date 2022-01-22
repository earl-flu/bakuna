<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf
            <!-- Last Name -->
            <div>
                <x-label for="last_name" :value="__('Last Name')" />

                <x-input id="last_name" placeholder="Valeza" class="block mt-1 w-full" type="text" name="last_name"
                    :value="old('last_name')" required autofocus />
            </div>
            <!-- First Name -->
            <div class="mt-4">
                <x-label for="first_name" :value="__('First Name')" />

                <x-input id="first_name" placeholder="Ryan" class="block mt-1 w-full" type="text" name="first_name"
                    :value="old('first_name')" required autofocus />
            </div>
            <!-- Middle Name -->
            <div class="mt-4">
                <x-label for="middle_name" :value="__('Middle Name')" />

                <x-input id="middle_name" placeholder="Almojuela" class="block mt-1 w-full" type="text"
                    name="middle_name" :value="old('middle_name')" autofocus />
            </div>



            <!-- Username -->
            <div class="mt-4">
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" name="username" :value="old('username')" required />
            </div>


            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <!-- Super Admin-->
            <div class="flex mt-4 text-sm">
                <label class="flex items-center dark:text-gray-400">
                    <input type="checkbox" name="is_super_admin" value="1" {{old('is_super_admin') ? 'checked' : '' }}
                        class="text-purple-600 form-checkbox border border-gray-300 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                    <span class="ml-2">
                        Super Admin
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>