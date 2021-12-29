<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaccineeBakunaRequest;
use App\Http\Requests\UpdateVaccineeBakunaRequest;
use App\Models\Bakuna;
use App\Models\Vaccinee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VaccineeBakunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Vaccinee $vaccinee, Bakuna $bakuna)
    {
        $vaccine_shots = Bakuna::SHOTS;
        $adverse_events = Bakuna::ADVERSE_EVENTS;
        $adverse_event_conditions = Bakuna::ADVERSE_EVENT_CONDITIONS;
        $manufacturer_names = Bakuna::VACCINE_MANUFACTURER_NAMES;
        return view('bakuna.create', compact('vaccinee', 'vaccine_shots', 'adverse_event_conditions', 'adverse_events', 'manufacturer_names'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVaccineeBakunaRequest $request, Vaccinee $vaccinee)
    {
        $validated = $request->validated();
        $validated['vaccinee_id'] = $vaccinee->id;
        $validated['vaccination_date'] = Carbon::parse($request->vaccination_date)->format('Y-m-d');
        $validated['is_comorbidity'] = $request->has('is_comorbidity');
        $validated['bakuna_center_cbcr_id'] = Bakuna::CBCR_ID;


        // $validated['adverse_event'] = '1';
        Bakuna::create($validated);
        $fn = strtoupper($vaccinee->first_name);
        $ln = strtoupper($vaccinee->last_name);
        return redirect()->back()->with('success', "{$fn}, {$ln} - Successfully saved vaccination record");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVaccineeBakunaRequest $request, Vaccinee $vaccinee, Bakuna $bakuna)
    {
        $validated = $request->validated();

        $validated['is_comorbidity'] = $request->has('is_comorbidity');
        $validated['is_deferred'] = $request->has('is_deferred');
        $validated['is_adverse_event'] = $request->has('is_adverse_event');
        $validated['vaccination_date'] = Carbon::parse($request->vaccination_date)->format('Y-m-d');

        // if false then clear the value of specific field
        if (!$validated['is_comorbidity']) $validated['comorbidity'] = '';
        if (!$validated['is_deferred']) $validated['deferral_reason'] = '';
        if (!$validated['is_adverse_event']) $validated['adverse_event_condition'] = ''; 

        $bakuna->update($validated);

        $fn = strtoupper($bakuna->vaccinee->first_name);
        $ln = strtoupper($bakuna->vaccinee->last_name);
        return redirect()->back()->with('success', "${ln}, ${fn} - Successfully updated vaccination record");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
