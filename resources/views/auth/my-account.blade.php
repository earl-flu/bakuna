<x-app-layout>
    <h1 class="my-6 text-4xl font-semibold text-gray-700 dark:text-gray-200">
        My Account
    </h1>
    <h2 class="text-xl mb-2 font-semibold text-gray-700 text-opacity-95">
        <span class="text-yellow-500 mr-1 font-thin">#</span>
        Details
    </h2>
    <div class="mb-7 p-5 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800">
        <p class="mb-2"><span class="text-sm">Name:</span><br>{{Auth::user()->full_name}}</p>
        {{-- <p class="mb-2"><span class="text-sm">Email:</span><br>{{Auth::user()->email}}</p> --}}
        @if (Auth::user()->is_super_admin)
        <p class="mb-2"><span class="text-sm">Status:</span><br>Super Admin</p>
        @else
        <p class="mb-2"><span class="text-sm">Status:</span><br>Admin</p>
        @endif

    </div>
    <h2 class="text-xl mb-2 font-semibold text-gray-700 text-opacity-95">
        <span class="text-yellow-500 mr-1 font-thin">#</span>
        Change Password
    </h2>
    <div class="p-5 bg-white rounded-lg shadow-md border dark:border-transparent dark:bg-gray-800">
        @if(session()->has('error'))
        <span class="text-red-500 mb-2 block">
            <strong>{{ session()->get('error') }}</strong>
        </span>
        @endif
        @if(session()->has('success'))
        <span class="text-green-500 mb-2 block">
            <strong>{{ session()->get('success') }}</strong>
        </span>
        @endif
        <form method="POST" action="{{ route('change.password') }}">
            @csrf
            <div class=" grid grid-cols-6 gap-6">
                <div class="col-span-6 md:col-span-2">
                    <label for="current_password" class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Current Password</span>
                        <input type="password" class="border border-gray-200 rounded block w-full 
                        mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                        focus:border-purple-400 focus:outline-none 
                        focus:shadow-outline-purple dark:text-gray-300 
                        dark:focus:shadow-outline-gray form-input
                        @error('current_password') border border-red-500 @enderror" name="current_password" />
                        @error('current_password')
                        <span class="text-xs text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                </div>
                <div class="col-span-6 md:col-span-2">
                    <label for="password" class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">New Password</span>
                        <input type="password" class="border border-gray-200 rounded block w-full 
                        mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                        focus:border-purple-400 focus:outline-none 
                        focus:shadow-outline-purple dark:text-gray-300 
                        dark:focus:shadow-outline-gray form-input
                        @error('password') border border-red-500 @enderror" name="password" />
                        @error('password')
                        <span class="text-xs text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                </div>
                <div class="col-span-6 md:col-span-2">
                    <label for="password" class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password Confirmation</span>
                        <input type="password" class="border border-gray-200 rounded block w-full 
                        mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                        focus:border-purple-400 focus:outline-none 
                        focus:shadow-outline-purple dark:text-gray-300 
                        dark:focus:shadow-outline-gray form-input
                        @error('password_confirmation') border border-red-500 @enderror"
                            name="password_confirmation" />
                        @error('password_confirmation')
                        <span class="text-xs text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                </div>
            </div>
            <button class=" w-full md:w-auto mt-8 text-sm focus:outline-none border border-transparent py-2 px-3
            rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">
                Change Password
            </button>
        </form>
    </div>

</x-app-layout>