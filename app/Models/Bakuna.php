<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bakuna extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'is_comorbidity' => 'boolean',
        'adverse_event' => 'boolean',
    ];

    public const CBCR_ID = 'CBC05329';

    public const SHOTS = [
        'FIRST DOSE' => 1,
        'SECOND DOSE' => 2,
        'BOOSTER SHOT' => 3,
    ];

    public const ADVERSE_EVENTS = [
        'NO' => 0,
        'YES' => 1,
    ];

    public const VACCINE_MANUFACTURER_NAMES = [
        'Sinovac' => 'Sinovac',
        'AztraZeneca' => 'AZ',
        'Pfizer' => 'Pfizer',
        'Moderna' => 'Moderna',
        'Sputnik V/Gamaleya' => 'Gamaleya',
        'Novavax' => 'Novavax',
        'Johnson and Johnson' => 'J&J'
    ];

    public const ADVERSE_EVENT_CONDITIONS = [
        'AE01_General Symptoms',
        'AE02_Cardiac Symptoms',
        'AE03_Ear Symptoms',
        'AE04_Endocrine Symptoms',
        'AE05_Examinations',
        'AE06_Eye Symptoms',
        'AE07_Gastrointestinal Symptoms',
        'AE08_Hepatobiliary Symptoms',
        'AE09_Immune System Symptoms',
        'AE10_Infections',
        'AE11_Nutrition-Related Symptoms',
        'AE12_Musculoskeletal Symptoms',
        'AE13_Neurological Symptoms',
        'AE14_Perinatal Conditions',
        'AE15_Procedural Symptoms',
        'AE16_Psychiatric Symptoms',
        'AE17_Renal and Urinary Symptoms',
        'AE18_Reproductive Symptoms',
        'AE19_Respiratory Symptoms',
        'AE20_Skin Symptoms',
        'AE21_Lymphatic System Symptoms',
        'AE22_Vascular Symptoms'
    ];

    public const CATEGORIES = [
        'A1: Workers in Frontline Health Services' => 'A1',
        'A1.8: Outbound OFWS' => 'A1.8',
        'A1.9: Family Members of Healthcare Workers' => 'A1.9',
        'A2: All Senior Citizens' => 'A2',
        'A3: Persons with Comorbidities' => 'A3',
        'A4: Frontline personnel in essential sectors, including uniformed personnel' => 'A4',
        'A5: Indigent Population' => 'A5',
        'PA3: Pediatric Persons with Comorbidities' => 'PA3',
        'ROP: Rest of the population' => 'ROP',
        'ROPP: Pediatric Rest of the population' => 'ROPP',
    ];

    public function vaccinee()
    {
        return $this->belongsTo(Vaccinee::class);
    }

    public function getVaccinatorNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getCreatedAtStringAttribute()
    {
        if (Carbon::parse($this->created_at)->isToday()) return 'TODAY';
        return Carbon::parse($this->created_at)->format('M. d, Y - l');
    }

    public function getManufacturerNameStringAttribute()
    {
        return strtoupper($this->manufacturer_name);
    }

    public function getVaccineShotStringAttribute()
    {
        if ($this->vaccine_shot == 1) return 'FIRST DOSE';
        if ($this->vaccine_shot == 2) return 'SECOND DOSE';
        if ($this->vaccine_shot == 3) return 'BOOSTER SHOT';
    }


    public function getVaccinationDateStrAttribute()
    {
        if (Carbon::parse($this->vaccination_date)->isToday()) return 'TODAY';
        return Carbon::parse($this->vaccination_date)->format('M. d, Y - l');
    }

    public function getVaccinationDateMdyAttribute()
    {
        return Carbon::parse($this->vaccination_date)->format('m/d/Y');
    }
}
