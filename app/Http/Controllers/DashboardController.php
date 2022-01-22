<?php

namespace App\Http\Controllers;

use App\Models\Bakuna;
use App\Models\Vaccinee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        //DEC 20 2021 FIRST TIME GINAAMIT ITONG SYSTEM
        $vax_date = $request->get('vax_date') ?: now();
 
        $firstD_data = $this->setDataPerDose($vax_date, 1);
        $secondD_data = $this->setDataPerDose($vax_date, 2);
        $boosterD_data =  $this->setDataPerDose($vax_date, 3);

        $firstD = Bakuna::where('vaccine_shot', 1)
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        // dd($firstD);
        $secondD = Bakuna::where('vaccine_shot', 2)
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();

        $booster = Bakuna::where('vaccine_shot', 3)
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();

        //manufacturers
        $sinovac = Bakuna::where('manufacturer_name', 'Sinovac')
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $az = Bakuna::where('manufacturer_name', 'AZ')
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $pfizer = Bakuna::where('manufacturer_name', 'Pfizer')
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $moderna = Bakuna::where('manufacturer_name', 'Moderna')
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $sputnik = Bakuna::where('manufacturer_name', 'Gamaleya')
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $novavax = Bakuna::where('manufacturer_name', 'Novavax')
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $jj = Bakuna::where('manufacturer_name', 'J&J')
            ->where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();

        $deferred = Bakuna::where('is_deferred',  1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();

        //CATEGORIES
        $a1 = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'A1')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $a1_8 = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'A1.8')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $a1_9 = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'A1.9')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $a2 = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'A2')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $a3 = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'A3')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $a4 = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'A4')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $a5 = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'A5')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $pa3 = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'PA3')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();

        $rop = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'ROP')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $roap = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'ROAP')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();
        $ropp = Bakuna::where('is_deferred', '!=',  1)
            ->where('category', 'ROPP')
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();

        //total vaccinated
        $total = Bakuna::where('is_deferred', '!=', 1)
            ->whereDate('vaccination_date', $vax_date)
            ->get()
            ->count();


        //select all that does not have any bakuna
        //eloquent relationships
        // $tests = Vaccinee::has('bakunas', '>', 1)->get();
        // $tests2 = Vaccinee::has('bakunas', '<', 1)->get();

        // $aztrapips = Bakuna::where('manufacturer_name', 'AZ')->get();
        // $gurangpfis = Bakuna::where('manufacturer_name', 'Pfizer')->Where('vaccine_shot', 1)->get();

        // $sputpips = Bakuna::where('manufacturer_name', 'Gamaleya')->get();
        // dd($tests2);
        //select all those bakunas more than one
        $vaccination_dates = Bakuna::all()->pluck('vaccination_date')->unique()->sort();

        // dd($vaccination_dates);
        return view('dashboard', compact(
            // 'sputpips',
            // 'gurangpfis',
            // 'aztrapips',
            // 'tests',
            // 'tests2',
            'firstD_data',
            'secondD_data',
            'boosterD_data',
            'a1',
            'a1_8',
            'a1_9',
            'a2',
            'a3',
            'a4',
            'a5',
            'pa3',
            'rop',
            'roap',
            'ropp',
            'deferred',
            'vaccination_dates',
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

    private function setDataPerDose($date, $dose)
    {
        $bakunas = Bakuna::where('vaccine_shot', $dose)
            ->where('vaccination_date', $date)
            ->where('is_deferred', 0)
            ->get()
            ->sortBy('manufacturer_name');

        $bakunas_total = [];

        //creates data structure that will be inserted in $bakunas_total for example ['AZ' => ['A1' => 10, 'A2' => 5], Pfizer=> ['A1' => 44]]
        foreach ($bakunas as $bakuna) {
            //check if the manufacturer name exists, else create a new key with blank array
            !isset($bakunas_total[$bakuna->manufacturer_name]) ? $bakunas_total[$bakuna->manufacturer_name] = [] : $bakunas_total;
            //add category in specific manufacturer name
            isset($bakunas_total[$bakuna->manufacturer_name]["{$bakuna->category}"]) ? $bakunas_total[$bakuna->manufacturer_name]["{$bakuna->category}"] += 1 : $bakunas_total[$bakuna->manufacturer_name]["{$bakuna->category}"] = 1;
        }

        return $bakunas_total;
    }
}
