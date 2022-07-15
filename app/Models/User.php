<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'name', 'email', 'password', 'phone', 'address', 'date_of_birth', 'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // user allergies
    public function allergy()
    {
        return $this->hasOne(Allergy::class)->latest();
    }

    // // user medictions
    // public function medications()
    // {
    //     return $this->hasMany(Medication::class)->latest();
    // }

    // user appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class)->latest();
    }
}
