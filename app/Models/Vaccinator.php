<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccinator extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getFullNameAttribute()
    {
        return strtolower("{$this->last_name}, {$this->first_name} {$this->middle_name} {$this->suffix}");
    }

    public function vaccinees()
    {
        return $this->hasMany(Vaccinee::class);
    }

    /**
     * Abbreviates the first name and add the last name
     */
    public function getNameAbbrvAttribute()
    {
        // Delimit by multiple spaces, hyphen, underscore, comma
        $words = preg_split("/[\s,_-]+/", $this->first_name);
        // Maximum of two words
        $words = array_slice($words, 0, 3);
        $initial = "";

        foreach ($words as $w) {
            $initial .= "{$w[0]}.";
        }

        //E. Sarmiento
        return "{$initial} {$this->last_name}";
    }
}
