<?php

namespace App\Http\Controllers;

use App\Models\Bakuna;
use App\Models\Vaccinee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //first dose total
        //second dose
        //booster
        $firstD = Bakuna::where('vaccine_shot', 1)->get()->count();
        $secondD = Bakuna::where('vaccine_shot', 2)->get()->count();
        $booster = Bakuna::where('vaccine_shot', 3)->get()->count();

        //manufacturers
        $sinovac = Bakuna::where('manufacturer_name', 'Sinovac')->get()->count();
        $az = Bakuna::where('manufacturer_name', 'AZ')->get()->count();
        $pfizer = Bakuna::where('manufacturer_name', 'Pfizer')->get()->count();
        $moderna = Bakuna::where('manufacturer_name', 'Moderna')->get()->count();
        $sputnik = Bakuna::where('manufacturer_name', 'Gamaleya')->get()->count();
        $novavax = Bakuna::where('manufacturer_name', 'Novavax')->get()->count();
        $jj = Bakuna::where('manufacturer_name', 'J&J')->get()->count();

        //total vaccinated
        $total = Bakuna::where('is_deferred', '!=', 1)->get()->count();

        //select all that does not have any bakuna
        //eloquent relationships
        $tests = Vaccinee::has('bakunas', '>', 1)->get();
        $tests2 = Vaccinee::has('bakunas', '<', 1)->get();

        $aztrapips = Bakuna::where('manufacturer_name', 'AZ')->get();
        $gurangpfis = Bakuna::where('manufacturer_name', 'Pfizer')->Where('vaccine_shot',1)->get();
        
        $sputpips = Bakuna::where('manufacturer_name', 'Gamaleya')->get();
        // dd($tests2);
        //select all those bakunas more than one

        return view('dashboard', compact(
            'sputpips',
            'gurangpfis',
            'aztrapips',
            'tests',
            'tests2',
            'firstD',
            'secondD',
            'booster',
            'total',
            'sinovac',
            'az',
            'pfizer',
            'moderna',
            'sputnik',
            'novavax',
            'jj'
        ));
    }
}
