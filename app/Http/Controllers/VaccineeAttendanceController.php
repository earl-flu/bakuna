<?php

namespace App\Http\Controllers;

use App\Models\Vaccinee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VaccineeAttendanceController extends Controller
{

    public function index(Request $request)
    {
        // dd(Vaccinee::where('vaccination_date',);
        // dd(Carbon::parse('2021-11-24') == Carbon::today());
        // dd(Carbon::parse('2021-11-24')->isToday());
        $vaccinees = Vaccinee::orderBy('last_name', 'asc');

        if ($request->filled('first_name')) {
            $fname = $request->get('first_name');
            $vaccinees = $vaccinees->where('first_name', 'like', '%' . $fname . '%');
        }
        if ($request->filled('last_name')) {
            $lname = $request->get('last_name');
            $vaccinees = $vaccinees->where('last_name', 'like', '%' . $lname . '%');
        }
        $attended_today = Vaccinee::where('vaccination_date', Carbon::today())
            ->where('in_attendance', 1)
            ->get()->count();

        $vaccinees = $vaccinees->paginate(10);
        return view('attendance.index', compact('vaccinees', 'attended_today'));
    }

    public function update(Request $request, Vaccinee $vaccinee)
    {

        $validated = $request->validate([
            'remarks' => 'nullable',
            'in_attendance' => 'required|in:0,1'
        ]);

        if ($request->in_attendance) { //is true
            $validated['attended_at'] = now();
        }

        $vaccinee->update($validated);
        if ($vaccinee->in_attendance) return redirect()->back()->with('success', $vaccinee->full_name . ' is present');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccinee  $vaccinee
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccinee $vaccinee)
    {

        return view('attendance.show', compact('vaccinee'));
    }
}
