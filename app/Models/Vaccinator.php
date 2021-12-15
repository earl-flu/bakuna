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
}
