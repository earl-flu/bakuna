<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Bakuna extends Model
{
    use LogsActivity;
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    //activity log spatie
    protected static $logUnguarded = true;

    protected $casts = [
        'is_comorbidity' => 'boolean',
        'is_adverse_event' => 'boolean',
        'is_deferred' => 'boolean'
    ];

    public const CBCR_ID = 'CBC05329';

    public const SHOTS = [
        'FIRST DOSE' => 1,
        'SECOND DOSE' => 2,
        'BOOSTER SHOT' => 3,
    ];

    public const DEFERRAL_REASONS = [
        'DC01_Age Requirement',
        'DC02_1st Dose Other Brand',
        'DC03_Allergy to Vaccine component',
        'DC04_Severe Allergy to 1st Dose',
        'DC05_Allergy/Asthma, No monitor',
        'DC06_History of Anaphylaxis',
        'DC07_Bleeding disorders/Taking anti-coagulants',
        'DC08_Symptomatic for COVID-19 Infection',
        'DC09_High SBP, DBP, Organ Damage',
        'DC10_Covid-19 Exposure',
        'DC11_Ongoing Covid-19 Treatment',
        'DC12_Attach, Admissions, Meds Change',
        'DC13_Other Vaccine/s within 2 weeks',
        'DC14_Plasma or Antibodies',
        'DC15_Pregnant or Breastfeeding',
        'DC16_No Med Clearance for Comorbidity',
    ];

    public const VACCINE_MANUFACTURER_NAMES = [
        'AstraZeneca' => 'AZ',
        'Janssen' => 'J&J',
        'Moderna' => 'Moderna',
        'Novavax' => 'Novavax',
        'Pfizer' => 'Pfizer',
        'Sinovac' => 'Sinovac',
        'Sputnik V' => 'Gamaleya',
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
        'ROAP: Rest of the adult population' => 'ROAP',
        'ROPP: Pediatric Rest of the population' => 'ROPP',
    ];

    public function vaccinee()
    {
        return $this->belongsTo(Vaccinee::class);
    }

    public function vaccinator()
    {
        return $this->belongsTo(Vaccinator::class);
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

    public function getManufacturernameStrAttribute()
    {
        $manuf_name = array_search($this->manufacturer_name, self::VACCINE_MANUFACTURER_NAMES);
        return $manuf_name;
    }

    public function getVaccineShotStringAttribute()
    {
        if ($this->vaccine_shot == 1) return 'First Dose';
        if ($this->vaccine_shot == 2) return 'Second Dose';
        if ($this->vaccine_shot == 3) return 'Booster Shot';
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

    public function getVaccinationDateStrMdyAttribute()
    {
        return Carbon::parse($this->vaccination_date)->format('M. d, Y');
    }
}
