<x-public-layout>
    <div class="flex items-center flex-1 h-full w-full sm:p-5 main-background">
        <div class="flex-1 flex justify-center">
            <h2 class="text-5xl sm:text-7xl md:text-6xl lg:text-7xl leading-tight font-medium text-gray-200">
                <span class="span-1 inline-block">Provincial</span>
                <br><span class="span-2 inline-block">Vaccination</span>
                <br><span class="span-3 inline-block">Team</span>
                <br><span
                    class="span-4 text-lg sm:text-2xl text-gray-200 block mt-1 ml-1 font-normal">Catanduanes</span>
            </h2>
        </div>
        <div class="flex-1 justify-center hidden md:flex">
            <div class="h-14 w-14 md:h-80 md:w-80 lg:h-96 lg:w-96">
                <img src="{{asset('images/bg/vaccine.png')}}" class="vaccine-image object-cover">
            </div>
        </div>
    </div>

    <div class="w-full fixed bottom-0 right-0 px-6 py-2 sm:block bg-gray-200 text-gray-700 text-xs">
        This website is maintained by Incident Management Team - Catanduanes
    </div>
</x-public-layout>