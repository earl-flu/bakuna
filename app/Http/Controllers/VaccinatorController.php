<?php

namespace App\Http\Controllers;

use App\Models\Vaccinator;
use Illuminate\Http\Request;

class VaccinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vaccinators = Vaccinator::orderBy('created_at', 'desc');
        if ($request->filled('status')) {
            $status = $request->get('status');

            //all
            $status == "all" ? $vaccinators = $vaccinators : "";

            //active
            $status == "active" ? $vaccinators = $vaccinators->where('is_active', 1) : "";

            //inactive
            $status == "inactive" ? $vaccinators = $vaccinators->where('is_active', 0) : "";
        }

        if ($request->filled('first_name')) {

            $fname = $request->get('first_name');
            $vaccinators = $vaccinators->where('first_name', 'like', '%' . $fname . '%');
        }
        if ($request->filled('last_name')) {
            $lname = $request->get('last_name');
            $vaccinators = $vaccinators->where('last_name', 'like', '%' . $lname . '%');
        }

        if ($request->filled('middle_name')) {
            $mname = $request->get('middle_name');
            $vaccinators = $vaccinators->where('middle_name', 'like', '%' . $mname . '%');
        }
        $vaccinators = $vaccinators->paginate(10);
        return view('vaccinator.index', compact('vaccinators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vaccinator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('test');
        $validated = $request->validate([
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'middle_name' => 'nullable|max:50',
            'suffix' => "nullable",
            'office' => "nullable",
            'remarks' => "nullable",
            'is_active' => "boolean",
            'remarks' => "nullable",
        ]);
        $validated['is_active'] = $request->has('is_active');
        Vaccinator::create($validated);

        return redirect()
            ->route('vaccinators.index')
            ->with('success', $request->first_name . ' is successfully registered!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccinator  $vaccinator
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccinator $vaccinator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccinator  $vaccinator
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccinator $vaccinator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaccinator  $vaccinator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaccinator $vaccinator)
    {
        // dd($request->has('is_active'));
        $validated = $request->validate([
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'middle_name' => 'nullable|max:50',
            'suffix' => "nullable",
            'office' => "nullable",
            'remarks' => "nullable",
            'is_active' => "boolean",
            'remarks' => "nullable",
        ]);
        // dd($request->has('is_active'));
        $validated['is_active'] = $request->has('is_active');
        $vaccinator->update($validated);
        $fn = strtoupper($request->first_name);
        $ln = strtoupper($request->last_name);
        return redirect()->back()->with('success', "{$fn}, {$ln} is successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccinator  $vaccinator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaccinator $vaccinator)
    {
        //
    }
}
