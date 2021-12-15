<?php

namespace App\Http\Controllers;

use App\Imports\VaccineesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VaccineeImportController extends Controller
{
    public function show(){
        return view('vaccinee.import');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new VaccineesImport, $file);
        return back()->with('status', 'Excelfile imported successfully!');
    }
}
