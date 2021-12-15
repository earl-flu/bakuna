<?php

namespace App\Exports;

use App\Models\Vaccinee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class VaccineesExport implements FromView //FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $vaccination_date;

    public function __construct($date)
    {
        $this->vaccination_date = $date;
    }

    public function view(): View
    {
        return view('exports.vaccinees', [
            'vaccinees' => Vaccinee::where('vaccination_date', $this->vaccination_date)->get()
        ]);
    }

            // public function collection()
        // {
        //     return Vaccinee::where('vaccination_date', $this->vaccination_date)->get();
        // }
}
