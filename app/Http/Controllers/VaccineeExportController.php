<?php

namespace App\Http\Controllers;

use App\Exports\VaccineesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class VaccineeExportController extends Controller
{
    public function show()
    {
        $auth_user = Auth::user();
        if (!$auth_user->is_super_admin) return abort(403, "Access denied");
        return view('vaccinee.export');
    }
    public function export(Request $request)
    {
        $auth_user = Auth::user();
        if (!$auth_user->is_super_admin) return abort(403, "Access denied");
        $date = $request->vaccination_date;
        // dd($date);
        //pass the vaccination_date as parameter to VaccineesExport
        return Excel::download(new VaccineesExport($date), "vaccinees_{$date}.csv");
    }
}
