<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'username',
        'is_super_admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->last_name}, {$this->first_name} {$this->middle_name}";
    }

    public function initial()
    {
        // Delimit by multiple spaces, hyphen, underscore, comma
        $words = preg_split("/[\s,_-]+/", $this->first_name);
        // Maximum of two words
        $words = array_slice($words, 0, 2);
        $initial = "";

        foreach ($words as $w) {
            $initial .= $w[0];
        }
        return $initial;
    }
}
