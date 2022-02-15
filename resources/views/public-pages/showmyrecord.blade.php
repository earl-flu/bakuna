<x-public-layout>
    <div
        class="py-16 w-full justify-center flex items-center bg-gray-400 h-full min-h-screen md:h-screen main-background">

        <div class="w-11/12 main-show-my-record-w bg-white rounded-3xl px-3 md:px-10 pb-10 pt-14 shadow relative flex">
            <!--Div for logos-->
            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 -translate-y-1/2 logo-shadow rounded-full">
                <img src="{{asset('images/icons/catanduanes-seal.png')}}" class="h-24 w-24"
                    alt="catanduanes official seal">
            </div>

            <h2 class="absolute left-1/2 top-16 transform -translate-x-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm w-full text-center">My Vaccination Record
            </h2>

            <div class="flex flex-col w-full">
               
                <div class="h-full text-gray-700 flex flex-col ">
                    <div class="flex w-full flex-1 flex-col mt-7 md:flex-row">
                        <div class="text-sm flex-1 text-center md:text-left">
                            <p class="text-xl md:text-2xl font-bold text-gray-800 mt-2 uppercase">{{$vaccinee->full_name}}</p>
                            <p>
                                Address: Purok 3, 887 Constantino Virac, Catanduanes
                            </p>
                            <p>
                                Date of Birth: June 13, 1984
                            </p>
                            <p>
                                Date Registered: August 18,2021
                            </p>
                        </div>
                        <div class="md:w-64 md:pl-10 text-base md:text-xl text-center md:text-left">
                            <p class="mt-3">Category: <span class="font-bold">A3</span></p>
                            <p class="text-base">ID Number: <span class="font-bold">V-07210614</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Print Script -->
    <script>
        const printBtn = document.querySelector('.print-btn')

        printBtn.addEventListener('click',function(){
            window.print();
        })
    </script>
</x-public-layout>