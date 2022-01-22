<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotNumber extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'manufacturer_name', 'is_active'];

    //setting a string as primary key
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
