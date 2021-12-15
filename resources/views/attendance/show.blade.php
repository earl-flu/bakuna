<x-app-layout>
    <x-heading class="pt-5 pb-10">Vaccinee Details</x-heading>

    <div class="bg-white">
        <div>
            <div class="bg-blue-700 px-5 py-2">
                <h2 class="font-semibold text-white">Full name</h2>
            </div>
            <div class="grid-cols-4 grid gap-4 p-5">
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Last name</p>
                    <p class="font-semibold border-b border-gray-300 text-xl">Sarmiento</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">First name</p>
                    <p class="font-semibold border-b border-gray-300 text-xl">Earl John</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Middle name</p>
                    <p class="font-semibold border-b border-gray-300 text-xl">Budy</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Suffix</p>
                    <p class="font-semibold border-b border-gray-300 text-xl">Jr</p>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-blue-700 px-5 py-2">
                <h2 class="font-semibold text-white">Personal Details</h2>
            </div>
            <div class="grid-cols-1 grid gap-4 p-5">
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Birthdate</p>
                    <p class="font-semibold border-b border-gray-300">November 9, 1995</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Sex</p>
                    <p class="font-semibold border-b border-gray-300">Male</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Contact Number</p>
                    <p class="font-semibold border-b border-gray-300">09504908013</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Occupation</p>
                    <p class="font-semibold border-b border-gray-300">NA</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">PWD</p>
                    <p class="font-semibold border-b border-gray-300">No</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Indigenous Member</p>
                    <p class="font-semibold border-b border-gray-300">No</p>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-blue-700 px-5 py-2">
                <h2 class="font-semibold text-white">Address Information</h2>
            </div>
            <div class="grid-cols-2 grid gap-4 p-5">
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Municipality</p>
                    <p class="font-semibold border-b border-gray-300">Virac</p>
                </div>
                <div>
                    <p class="text-xs mb-1 font-medium text-gray-600">Barangay</p>
                    <p class="font-semibold border-b border-gray-300">Constantino</p>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-blue-700 px-5 py-2">
                <h2 class="font-semibold text-white">Vaccine Information</h2>
            </div>
            <div class="p-5">
                <table class="w-full text-left">
                    <tr class="bg-blue-100">
                        {{-- <th class="font-semibold p-3 border">Registered At</th> --}}
                        <th class="font-semibold p-3 border">Shot</th>
                        <th class="font-semibold p-3 border">Brand Name</th>
                        <th class="font-semibold p-3 border" style="width:260px;">Vaccination Date</th>
                        <th class="font-semibold p-3 border" style="width:250px;">Vaccinator Name</th>
                        <th class="font-semibold p-3 border">Lot Number</th>
                    </tr>

                    <tr class="hover:bg-gray-100">
                        <td class="border p-3">1st Dose</td>
                        <td class="border p-3">Sinovac</td>
                        <td class="border p-3">Nov. 29, 2021</td>
                        <td class="border p-3">Angel Albert Lamban MD</td>
                        <td class="border p-3">112233</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>