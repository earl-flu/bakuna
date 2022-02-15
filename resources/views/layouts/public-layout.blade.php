<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provincial Vaccination Team</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/searchrecord/searchmyrecord.css')}}">
    <link rel="stylesheet" href="{{asset('css/searchrecord/showrecord.css')}}">
    <!-- jquery script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <style>
        body {
            font-family: Poppins;
        }

        /* md size in tailwind */
        @media (min-width: 768px) {
            #hamburger {
                display: none !important;
            }

            #close-icon {
                display: none !important;
            }

            #mobile-nav {
                display: none !important;
            }
        }

        .main-background{
            background-image: linear-gradient(to right bottom, #032252, #005186, #0083af, #00b7c8, #12ebd1);
            /* background-image: linear-gradient(to left bottom, #0b3371, #005e9d, #008bc3, #00bae1, #38e9f9); */
        }
    </style>
</head>

<body class="antialiased">
    <div class="relative flex flex-col min-h-screen dark:bg-gray-900 sm:items-center sm:pt-0">
        <!-- Mobile Nav-->
        <!-- hamburger-->
        <svg xmlns="http://www.w3.org/2000/svg" id="hamburger" class="block md:hidden h-8 w-8 fixed top-4 right-4"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <!-- close icon-->
        <svg id="close-icon" xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8 hidden fixed z-20 top-4 right-4 text-white" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <!-- Mobile Nav Container-->
        <div id="mobile-nav"
            class="flex justify-center items-center md:hidden fixed top-0 left-0 h-screen w-full bg-gray-700 z-10">


            <ul class="text-white text-2xl sm:text-3xl uppercase font-semibold">
                <li class="mb-6 sm:mb-8"><a href="{{ route('home') }}"
                        class="  {{request()->routeIs('home') ? 'text-blue-500' : 'text-white' }}">Home</a></li>
                <li class="mb-6 sm:mb-8"><a href="#">Contact Us</a></li>
                <li class="mb-6 sm:mb-8"><a href="#">Registration</a></li>
                <li class="mb-6 sm:mb-8 {{request()->routeIs('searchmyrecordpage') ? 'text-blue-500' : 'text-white' }}"><a href="{{route('searchmyrecordpage')}}">Search My Record</a></li>
                <li class="mb-6 sm:mb-8"><a href="#"></a></li>
                <li>
                    @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}">Log in</a>
                    @endauth
                </li>
            </ul>
        </div>
        <!--// Mobile Nav-->
        @if (Route::has('login'))
        <div class="text-gray-300 hidden fixed w-full top-0 right-0 px-6 py-4 md:block text-sm font-medium uppercase">
            <div class="flex">
                <div>
                    Provincial Vaccination Team
                </div>
                <div class="flex-1"></div>
                <div>
                    <a href="{{ route('home') }}" class="
                    {{request()->routeIs('home') ? 'text-gray-100 underline' : 'text-gray-300' }}
                    text-sm md:mr-3 lg:mr-6 hover:text-gray-100 ">Home</a>
                    <a href="#" class="
                    {{request()->routeIs('contact-us') ? 'text-gray-100 underline' : 'text-gray-300' }}
                    text-sm md:mr-3 lg:mr-6 hover:text-gray-100">Contact Us</a>
                    <a href="#" class="
                    {{request()->routeIs('registration') ? 'text-gray-100 underline' : 'text-gray-300' }}
                    text-sm md:mr-3 lg:mr-6 hover:text-gray-100">Registration</a>
                    <a href="{{ route('searchmyrecordpage') }}" class="
                    {{request()->routeIs('searchmyrecordpage') ? 'text-gray-100 underline' : 'text-gray-300' }}
                    text-sm md:mr-3 lg:mr-6 hover:text-gray-100">Search My
                        Record</a>
                    @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm hover:text-gray-100 text-gray-300">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="text-sm hover:text-gray-100 text-gray-300">Employee Log
                        in</a>

                    {{-- @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm hover:text-blue-500 dark:text-gray-500">Register</a>
                    @endif --}}
                    @endauth
                </div>
            </div>
        </div>
        @endif

        <!-- main content here-->
        {{$slot}}
        <!-- //main content here-->
    </div>
    {{-- <div class="bg-gray-200 h-screen w-full">

    </div> --}}

</body>

<script>
    var tl = gsap.timeline();

    tl.from('.span-1', {x:-800,duration:0.3, ease:"power4.out"});
    tl.from('.span-2', {x:-800,duration:0.3, ease:"power4.out"});
    tl.from('.span-3', {x:-800,duration:0.3, ease:"power4.out"});
    tl.from('.span-4', {x:-800,duration:0.3, ease:"power4.out"});
    tl.from('.vaccine-image', {opacity:0})

    function hideHamburger(){
        gsap.to('#hamburger', {opacity:0, display:'none'})
    }
    function showHamburger(){
        gsap.to('#hamburger', {opacity:1, display:'block'})
    }
    function hideCloseIcon(){
        gsap.to('#close-icon', {opacity:0, display:'none'})
    }
    function showCloseIcon(){
        gsap.to('#close-icon', {opacity:1, display:'block'})
    }

    function slideIn(){
        let tl_in = gsap.timeline() 
        tl_in.to('#mobile-nav', {display:'flex'})
        tl_in.to('#mobile-nav', {xPercent:0, ease:"power4"}, "<")
    }

    function slideOut(){
        gsap.to('#mobile-nav',{xPercent:100})
    }

    //mobile nav scripts
    const nav_in = gsap.timeline();
    $(function(){
        gsap.set('#mobile-nav', {xPercent: 100})

        $('#hamburger').on('click', function(){
            console.log('burger clicked')
            hideHamburger()
            showCloseIcon()
            slideIn()

            //slide in mobile nav
        });

        $('#close-icon').on('click', function(){
            console.log('close icon clicked')
            hideCloseIcon()
            showHamburger()
            slideOut()
            
            //slide out mobile nav
        })
    });

</script>

</html>