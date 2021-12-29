<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccinee extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    protected $casts = [
        'pwd' => 'boolean',
        'indigenous_member' => 'boolean',
    ];

    public const SEXES = [
        'Male' => 'M', 'Female' => 'F'
    ];

    public const SUFFIXES = [
        'I', 'II', 'III', 'IV', 'JR', 'SR'
    ];

    public const PWDS = [
        'No' => 0,
        'Yes' => 1,
    ];

    public const INDIGENOUS_MEMBERS = [
        'No' => 0,
        'Yes' => 1,
    ];

    public const MUNICIPALITIES = [
        'BAGAMANOC' => '052001000Bagamanoc',
        'BARAS' => '052002000Baras',
        'BATO' => '052003000Bato',
        'CARAMORAN' => '052004000Caramoran',
        'GIGMOTO' => '052005000Gigmoto',
        'PANDAN' => '052006000Pandan',
        'PANGANIBAN' => '052007000Panganiban',
        'SAN ANDRES' => '052008000San Andres',
        'SAN MIGUEL' => '052009000San Miguel',
        'VIGA' => '052010000Viga',
        'VIRAC (CAPITAL)' => '052011000Virac (Capital)',
    ];

    public function bakunas()
    {
        return $this->hasMany(Bakuna::class);
    }

    public function vaccinator()
    {
        return $this->belongsTo(Vaccinator::class);
    }

    public function getFullNameAttribute()
    {
        return mb_strtolower("{$this->last_name}, {$this->first_name} {$this->middle_name} {$this->suffix}");
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->age;
    }

    // public function getVaccinationDateStrAttribute()
    // {

    //     if (Carbon::parse($this->vaccination_date)->isToday()) return 'TODAY';
    //     return Carbon::parse($this->vaccination_date)->format('M. d, Y - l');
    // }

    public function getDateRegisteredAttribute()
    {
        return Carbon::parse($this->created_at)->format('M. d, Y - g:i a');
    }

    public function getFirstNameAttribute($value)
    {
        return mb_strtolower($value);
    }

    public function getMiddleNameAttribute($value)
    {
        return mb_strtolower($value);
    }

    public function getLastNameAttribute($value)
    {
        return mb_strtolower($value);
    }

    public function getVaccinatorNameAttribute($value)
    {
        return mb_strtolower($value);
    }

    public function getBarangayNameAttribute($value)
    {
        return mb_strtolower($value);
    }

    public function getMunicipalityStrAttribute($value)
    {
        $muni = array_search($this->municipality, self::MUNICIPALITIES);
        return ($muni);
    }

    public function getMunicipalityLwrAttribute()
    {
        return strtolower($this->municipality);
    }

    public function getBarangayAttribute($value)
    {
        return strtolower($value);
    }

    public function getBirthdateMdyAttribute()
    {
        return Carbon::parse($this->birthdate)->format('m/d/Y');
    }

    /**
     * MUTATORS
     */
    // public function setFirstNameAttribute($value)
    // {
    //     $this->attributes['first_name'] = strtolower($value);
    // }

    // public function setMiddleNameAttribute($value)
    // {
    //     $this->attributes['middle_name'] = strtolower($value);
    // }

    // public function setLastNameAttribute($value)
    // {
    //     $this->attributes['last_name'] = strtolower($value);
    // }

}
