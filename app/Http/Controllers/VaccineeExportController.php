<?php

namespace App\Http\Controllers;

use App\Exports\VaccineesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VaccineeExportController extends Controller
{
    public function show()
    {
        return view('vaccinee.export');
    }
    public function export(Request $request){
        $date = $request->vaccination_date;
        //pass the vaccination_date as parameter to VaccineesExport
        return Excel::download(new VaccineesExport($date), "vaccinees_{$date}.csv");
    }
}
