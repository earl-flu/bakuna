<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provincial Vaccination Team</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: Poppins;
        }
    </style>
</head>

<body class="antialiased">
    <div class="relative flex flex-col min-h-screen bg-gray-500 dark:bg-gray-900 sm:items-center sm:pt-0">
        {{-- Insert backgroudn at the div above --}}
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="flex items-center flex-1 h-full w-full border border-red-500">

            <h2 class="border border-black text-8xl ml-12 leading-tight font-medium">Provincial 
                <br>Vaccination 
                <br>Team
                <br><span class="text-3xl block mt-5 ml-3 font-normal">Catanduanes</span> 
            </h2>

        </div>

        <div class="w-full fixed bottom-0 right-0 px-6 py-2 sm:block bg-gray-800 text-gray-200 text-xs">
            This web application is maintained by Incident Management Team - Catanduanes
        </div>
    </div>
    {{-- <div class="bg-gray-200 h-screen w-full">

    </div> --}}

</body>

</html>