<?php

namespace App\Http\Controllers;

use App\Models\LotNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LotNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth_user = Auth::user();
        if (!$auth_user->is_super_admin) return abort(403, "Access denied");

        $lot_numbers = LotNumber::orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $status = $request->get('status');

            //all
            $status == "all" ? $lot_numbers = $lot_numbers : "";

            //active
            $status == "active" ? $lot_numbers = $lot_numbers->where('is_active', 1) : "";

            //inactive
            $status == "inactive" ? $lot_numbers = $lot_numbers->where('is_active', 0) : "";
        }

        if ($request->filled('code')) {
            $fname = $request->get('code');
            $lot_numbers = $lot_numbers->where('code', 'like', '%' . $fname . '%');
        }

        if ($request->filled('manufacturer_name')) {
            $fname = $request->get('manufacturer_name');
            $lot_numbers = $lot_numbers->where('manufacturer_name', 'like', '%' . $fname . '%');
        }

        $lot_numbers = $lot_numbers->paginate(10);
        return view('lot-number.index', compact('lot_numbers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_user = Auth::user();
        if (!$auth_user->is_super_admin) return abort(403, "Access denied");

        return view('lot-number.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth_user = Auth::user();
        if (!$auth_user->is_super_admin) return abort(403, "Access denied");

        $validated = $request->validate([
            'code' => 'required|unique:lot_numbers',
            'manufacturer_name' => 'required',
            'is_active' => "boolean",
        ]);

        $validated['is_active'] = $request->has('is_active');
        LotNumber::create($validated);

        return redirect()
            ->route('lot-numbers.index')
            ->with('success', $request->code . ' is successfully registered!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LotNumber  $lotNumber
     * @return \Illuminate\Http\Response
     */
    public function show(LotNumber $lotNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LotNumber  $lotNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(LotNumber $lotNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LotNumber  $lotNumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LotNumber $lotNumber)
    {
        $auth_user = Auth::user();
        if (!$auth_user->is_super_admin) return abort(403, "Access denied");

        $validated = $request->validate([
            'code' => 'required|unique:lot_numbers,code,' . $lotNumber->code . ',code',
            'manufacturer_name' => 'required',
            'is_active' => "boolean",
        ]);

        $validated['is_active'] = $request->has('is_active');
        $lotNumber->update($validated);

        return redirect()
            ->route('lot-numbers.index')
            ->with('success', $request->code . ' is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LotNumber  $lotNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(LotNumber $lotNumber)
    {
        //
    }
}
