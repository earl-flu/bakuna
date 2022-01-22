<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaccineeRequest;
use App\Models\Bakuna;
use App\Models\LotNumber;
use App\Models\Vaccinator;
use App\Models\Vaccinee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nexmo\Laravel\Facade\Nexmo;


class VaccineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(Carbon::parse('2021-11-23')->isToday());
        $vaccinees = Vaccinee::orderBy('created_at', 'desc');

        // if ($request->filled('type')) {
        //     $type = $request->get('type');

        //     //all
        //     $type == "all" ? $vaccinees = $vaccinees : "";

        //     //with schedule
        //     $type == "with-schedule" ? $vaccinees = $vaccinees->where('vaccination_date', '!=', null) : "";

        //     //without schedule
        //     $type == "without-schedule" ? $vaccinees = $vaccinees->where('vaccination_date', null) : "";
        // }

        if ($request->filled('first_name')) {

            $fname = $request->get('first_name');
            $vaccinees = $vaccinees->where('first_name', 'like', '%' . $fname . '%');
        }
        if ($request->filled('last_name')) {
            $lname = $request->get('last_name');
            $vaccinees = $vaccinees->where('last_name', 'like', '%' . $lname . '%');
        }

        if ($request->filled('middle_name')) {
            $mname = $request->get('middle_name');
            $vaccinees = $vaccinees->where('middle_name', 'like', '%' . $mname . '%');
        }

        $vaccinees = $vaccinees->paginate(10);

        return view('vaccinee.index', compact('vaccinees'));
    }

    /**
     * Show the form for creating a new resource.
     * FOR ONLINE REGISTRATION  - NOT A PRIORITY
     * @return \Illuminate\Http\Response
     */
    public function onlineVaccineeCreate() // Think of a better name
    {
        $suffixes = Vaccinee::SUFFIXES;
        $sexes = Vaccinee::SEXES;
        $municipalities = Vaccinee::MUNICIPALITIES; // incase theres no internet for ph location
        return view('vaccinee.online-registration', compact('suffixes', 'sexes', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     * FOR ONLINE REGISTRATION  - NOT A PRIORITY
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function onlineVaccineeStore(Request $request) // Think of a better name
    {
        $validated = $request->validate([
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'middle_name' => 'nullable|max:50',
            'suffix' => "nullable|in: '',I,II,III,IV,JR,SR",
            'birthdate' => "required|date|before:today",
            'sex' => 'required|in:M,F',
            'municipality' => 'required',
            'barangay' => 'required',
            'mobile_number' => 'required|confirmed|min:11', //number validation
            'occupation' => 'nullable',
            'vaccination_date' => 'nullable|date'
        ]);
        // dd($validated);
        $validated['uuid'] = Str::uuid();
        $validated['region'] = 'REGION V (BICOL REGION)';
        $validated['province'] = '052000000Catanduanes';
        $validated['registration_type'] = 'online';
        Vaccinee::create($validated);

        return redirect()->route('registration')->with('success', $request->first_name . ' is successfully registered!');
    }

    public function create()
    {

        $suffixes = Vaccinee::SUFFIXES;
        $sexes = Vaccinee::SEXES;
        $categories = Bakuna::CATEGORIES;
        $pwds = Vaccinee::PWDS;
        $indigenous_members = Vaccinee::INDIGENOUS_MEMBERS;
        // $vaccine_shots = Vaccinee::VACCINE_SHOTS;
        $municipalities = Vaccinee::MUNICIPALITIES; // incase theres no internet for ph location
        return view('vaccinee.create', compact('suffixes', 'sexes', 'categories', 'pwds', 'indigenous_members', 'municipalities'));
    }

    public function store(StoreVaccineeRequest $request)
    {
        $validated = $request->validated();
        $validated['uuid'] = Str::uuid();
        $validated['birthdate'] = Carbon::parse($request->birthdate)->format('Y-m-d');
        $validated['pwd'] = $request->has('pwd');
        $validated['indigenous_member'] = $request->has('indigenous_member');
        $validated['region'] = 'REGION V (BICOL REGION)';
        $validated['province'] = '052000000Catanduanes';
        $validated['registration_type'] = 'walk-in';

        // for attendance and online registration - NOT A PRIORITY 
        // $validated['vaccination_date'] = now();
        // $validated['in_attendance'] = 1;
        // $validated['attended_at'] = now();

        $vaccinee = Vaccinee::create($validated);

        $fn = strtoupper($request->first_name);
        $ln = strtoupper($request->last_name);
        return redirect()->route('vaccinees.show', $vaccinee)->with('success-store', "{$fn}, {$ln} is successfully registered!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccinee  $vaccinee
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccinee $vaccinee)
    {
        // dd($vaccinee->lastDose());
        // dd($vaccinee->hasBooster());
        // dd($vaccinee->bakunas->first()->lot_number_id);

        // dd($vaccinee->doseDetails(2, 'vaccination_date_str_mdy'));
        // dd($vaccinee->bakunas->Where('vaccine_shot', 1)->first());
        $vaccine_shots = Bakuna::SHOTS;
        $adverse_event_conditions = Bakuna::ADVERSE_EVENT_CONDITIONS;
        $manufacturer_names = Bakuna::VACCINE_MANUFACTURER_NAMES;
        $suffixes = Vaccinee::SUFFIXES;
        $sexes = Vaccinee::SEXES;
        $categories = Bakuna::CATEGORIES;
        $municipalities = Vaccinee::MUNICIPALITIES; // incase theres no internet for ph location
        $active_vaccinators = Vaccinator::where('is_active', 1)->get()->sortBy('last_name');
        $active_lot_numbers = LotNumber::where('is_active',1)->get()->sortBy('code');
        $vaccinators = Vaccinator::all()->sortBy('last_name');
        $lot_numbers = LotNumber::all()->sortBy('code');
        $cbcr_id = Bakuna::CBCR_ID;
        $deferral_reasons = Bakuna::DEFERRAL_REASONS;
        // dd($vaccinee->municipality);
        return view('vaccinee.show', compact(
            'vaccinee',
            'deferral_reasons',
            'cbcr_id',
            'categories',
            'sexes',
            'vaccinators',
            'lot_numbers',
            'active_vaccinators',
            'active_lot_numbers',
            'municipalities',
            'suffixes',
            'vaccine_shots',
            'adverse_event_conditions',
            'manufacturer_names'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccinee  $vaccinee
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccinee $vaccinee)
    {
        $suffixes = Vaccinee::SUFFIXES;
        $sexes = Vaccinee::SEXES;
        $categories = Bakuna::CATEGORIES;
        $pwds = Vaccinee::PWDS;
        $indigenous_members = Vaccinee::INDIGENOUS_MEMBERS;
        // $vaccine_shots = Vaccinee::VACCINE_SHOTS;
        $municipalities = Vaccinee::MUNICIPALITIES; // incase theres no internet for ph location
        return view('vaccinee.edit', compact('vaccinee', 'suffixes', 'sexes', 'categories', 'pwds', 'indigenous_members', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaccinee  $vaccinee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaccinee $vaccinee)
    {
        // $test = Carbon::parse($request->birthdate)->format('Y-m-d');
        // dd($request->birthdate,$test);
        // dd($request->has('pwd'), $request->has('indigenous_member'));
        $validated = $request->validate([
            'govt_id_number' => 'nullable',
            'pwd' => 'boolean',
            'indigenous_member' => 'boolean',
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'middle_name' => 'nullable|max:50',
            'suffix' => "nullable|in: '',I,II,III,IV,JR,SR",
            'birthdate' => 'required|date',
            'sex' => 'required|in:M,F',
            'municipality' => 'required',
            'barangay' => 'required',
            'mobile_number' => 'required|max:11|min:11', //number validation
            'occupation' => 'nullable',
        ]);
        $validated['birthdate'] = Carbon::parse($request->birthdate)->format('Y-m-d');
        $validated['pwd'] = $request->has('pwd');
        $validated['indigenous_member'] = $request->has('indigenous_member');
        // $validated['birtdate']
        $vaccinee->update($validated);

        $fn = strtoupper($request->first_name);
        $ln = strtoupper($request->last_name);
        return redirect()->back()->with('success', "{$fn}, {$ln} is successfully updated!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaccinee  $vaccinee
     * @return \Illuminate\Http\Response
     */
    public function updateShedule(Request $request, Vaccinee $vaccinee)
    {
        $validated = $request->validate([
            'schedule' => 'required|date|after_or_equal:today'
        ]);
        // dd($validated);
        $vaccinee->update($validated);

        /**
         * FIX THE MESSAGE
         * ADD VALIDATION TO NUMBER (NUMBER SHOULD HAVE A PATTERN OR FORMAT)
         */
        Nexmo::message()->send([
            'to'   => '639076047145',
            'from' => '639076047145',
            'text' => 'Test 2 - Using the facade to send a message.'
        ]);

        return redirect()->back();
    }

    public function verify(Vaccinee $vaccinee)
    {
        return view('vaccinee.verify', compact('vaccinee'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccinee  $vaccinee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaccinee $vaccinee)
    {
        //
    }
}
